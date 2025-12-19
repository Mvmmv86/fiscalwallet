<?php

namespace App\Services;

use App\DTOs\NormalizedOperation;
use App\Integrations\BinanceIntegration;
use App\Models\Asset;
use App\Models\Operation;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class WalletSyncService
{
    protected CapitalGainService $capitalGainService;
    protected CurrencyConverterService $currencyConverter;

    public function __construct(
        CapitalGainService $capitalGainService,
        CurrencyConverterService $currencyConverter
    ) {
        $this->capitalGainService = $capitalGainService;
        $this->currencyConverter = $currencyConverter;
    }

    /**
     * Sincroniza todas as carteiras de um usuário
     */
    public function syncAllWallets(int $userId): array
    {
        $wallets = Wallet::where('user_id', $userId)
            ->where('status', '!=', 'syncing')
            ->whereNotNull('api_key')
            ->get();

        $results = [];

        foreach ($wallets as $wallet) {
            $results[$wallet->id] = $this->syncWallet($wallet);
        }

        return $results;
    }

    /**
     * Sincroniza uma carteira específica
     */
    public function syncWallet(Wallet $wallet, bool $fullSync = false): array
    {
        $wallet->update(['status' => 'syncing']);

        try {
            // Buscar operações da exchange
            $operations = $this->fetchOperationsFromExchange($wallet, $fullSync);

            // Processar operações
            $imported = $this->processOperations($wallet, $operations);

            // Atualizar saldos REAIS diretamente da API da exchange
            $this->updateRealBalancesFromExchange($wallet);

            // Recalcular ganho de capital
            $this->recalculateCapitalGain($wallet->user_id);

            $wallet->update([
                'status' => 'active',
                'last_sync_at' => now(),
                'sync_error' => null,
            ]);

            return [
                'success' => true,
                'imported' => $imported,
                'message' => "Sincronização concluída. {$imported} operações importadas.",
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao sincronizar carteira', [
                'wallet_id' => $wallet->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $wallet->update([
                'status' => 'error',
                'sync_error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Atualiza saldos reais diretamente da API da exchange
     */
    protected function updateRealBalancesFromExchange(Wallet $wallet): void
    {
        try {
            $exchange = $wallet->exchange;
            if (!$exchange || $exchange->slug !== 'binance') {
                // Fallback para cálculo por operações para outras exchanges
                $this->updateAssetBalances($wallet->user_id);
                return;
            }

            $apiKey = Crypt::decryptString($wallet->api_key);
            $apiSecret = Crypt::decryptString($wallet->api_secret);

            // Buscar saldos da Binance
            $baseUrl = config('services.binance.base_url', 'https://api.binance.com');

            $timeResponse = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])
                ->timeout(10)
                ->get("{$baseUrl}/api/v3/time");

            if (!$timeResponse->successful()) {
                Log::warning('Falha ao buscar timestamp da Binance, usando cálculo por operações');
                $this->updateAssetBalances($wallet->user_id);
                return;
            }

            $serverTime = $timeResponse->json('serverTime');
            $query = "timestamp={$serverTime}";
            $signature = hash_hmac('sha256', $query, $apiSecret);

            $response = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])
                ->timeout(30)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$baseUrl}/api/v3/account", [
                    'timestamp' => $serverTime,
                    'signature' => $signature,
                ]);

            if (!$response->successful()) {
                Log::warning('Falha ao buscar saldos da Binance, usando cálculo por operações');
                $this->updateAssetBalances($wallet->user_id);
                return;
            }

            $balances = $response->json('balances');
            $stablecoins = ['USDT', 'USDC', 'BUSD', 'TUSD', 'FDUSD', 'DAI', 'BRL', 'USD', 'EUR'];

            // Buscar assets existentes
            $existingAssets = Asset::where('user_id', $wallet->user_id)->get()->keyBy('symbol');

            $assetsWithBalance = [];
            foreach ($balances as $balance) {
                $symbol = $balance['asset'];
                $total = (float) $balance['free'] + (float) $balance['locked'];

                if ($total > 0.00000001) {
                    $assetsWithBalance[$symbol] = $total;

                    // Atualizar ou criar asset (exceto stablecoins)
                    if (!in_array($symbol, $stablecoins)) {
                        if (isset($existingAssets[$symbol])) {
                            $existingAssets[$symbol]->update(['quantity' => $total]);
                        } else {
                            Asset::create([
                                'user_id' => $wallet->user_id,
                                'symbol' => $symbol,
                                'name' => $symbol,
                                'quantity' => $total,
                                'average_cost_brl' => 0,
                                'total_invested_brl' => 0,
                            ]);
                        }
                    }
                }
            }

            // Zerar assets que não estão mais na exchange
            foreach ($existingAssets as $symbol => $asset) {
                if (!isset($assetsWithBalance[$symbol]) && $asset->quantity > 0 && !in_array($symbol, $stablecoins)) {
                    $asset->update(['quantity' => 0]);
                }
            }

            Log::info('Saldos reais atualizados da Binance', [
                'wallet_id' => $wallet->id,
                'assets_count' => count($assetsWithBalance),
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao atualizar saldos reais', [
                'wallet_id' => $wallet->id,
                'error' => $e->getMessage(),
            ]);
            // Fallback para cálculo por operações
            $this->updateAssetBalances($wallet->user_id);
        }
    }

    /**
     * Busca operações da exchange via API
     * SEMPRE faz sincronização completa (fullSync) para garantir dados atualizados
     */
    protected function fetchOperationsFromExchange(Wallet $wallet, bool $fullSync = false): array
    {
        $exchange = $wallet->exchange;

        if (!$exchange) {
            throw new \Exception('Exchange não configurada para esta carteira.');
        }

        // Descriptografar credenciais
        $apiKey = Crypt::decryptString($wallet->api_key);
        $apiSecret = Crypt::decryptString($wallet->api_secret);

        // Selecionar integração baseada na exchange
        $integration = $this->getExchangeIntegration($exchange->slug);

        if (!$integration) {
            throw new \Exception("Integração não disponível para {$exchange->name}.");
        }

        // SEMPRE fazer fullSync - buscar desde a data configurada ou 2 anos atrás
        // Isso garante que novas operações nunca sejam perdidas
        $startTime = $wallet->import_start_date
            ? Carbon::parse($wallet->import_start_date)
            : Carbon::now()->subYears(2);
        $endTime = Carbon::now();

        Log::info('WalletSync: Buscando operações', [
            'wallet_id' => $wallet->id,
            'start' => $startTime->toDateString(),
            'end' => $endTime->toDateString(),
        ]);

        // Usar o método correto da integração
        $operations = $integration->fetchAllOperations($apiKey, $apiSecret, $startTime, $endTime);

        // Converte Collection para array se necessário
        if ($operations instanceof \Illuminate\Support\Collection) {
            return $operations->all();
        }

        return $operations;
    }

    /**
     * Retorna a integração correta para cada exchange
     */
    protected function getExchangeIntegration(string $slug)
    {
        return match ($slug) {
            'binance' => app(BinanceIntegration::class),
            // Futuras integrações:
            // 'coinbase' => app(CoinbaseIntegration::class),
            // 'mercado-bitcoin' => app(MercadoBitcoinIntegration::class),
            default => null,
        };
    }

    /**
     * Processa e salva operações importadas (NormalizedOperation DTOs)
     */
    protected function processOperations(Wallet $wallet, array $operations): int
    {
        $imported = 0;

        foreach ($operations as $op) {
            // Suporta tanto arrays quanto NormalizedOperation DTOs
            if ($op instanceof NormalizedOperation) {
                $saved = $this->saveNormalizedOperation($wallet, $op);
            } else {
                $saved = $this->saveLegacyOperation($wallet, $op);
            }

            if ($saved) {
                $imported++;
            }
        }

        return $imported;
    }

    /**
     * Salva uma operação normalizada (DTO)
     */
    protected function saveNormalizedOperation(Wallet $wallet, NormalizedOperation $op): bool
    {
        // Verificar se já existe (evitar duplicatas)
        $exists = Operation::where('wallet_id', $wallet->id)
            ->where('external_id', $op->externalId)
            ->exists();

        if ($exists) {
            return false;
        }

        // Mapear tipo de operação para a estrutura do banco
        $operationType = $this->mapOperationType($op->type);

        // Determinar from_asset e to_asset baseado no tipo
        $fromAsset = null;
        $toAsset = null;
        $fromAmount = null;
        $toAmount = null;
        $fromPriceBrl = null;
        $toPriceBrl = null;

        switch ($op->type) {
            case 'buy':
                $toAsset = strtoupper($op->symbol);
                $toAmount = $op->quantity;
                $toPriceBrl = $op->priceBrl;
                $fromAsset = 'BRL';
                $fromAmount = $op->totalBrl;
                break;

            case 'sell':
                $fromAsset = strtoupper($op->symbol);
                $fromAmount = $op->quantity;
                $fromPriceBrl = $op->priceBrl;
                $toAsset = 'BRL';
                $toAmount = $op->totalBrl;
                break;

            case 'deposit':
            case 'transfer_in':
                $toAsset = strtoupper($op->symbol);
                $toAmount = $op->quantity;
                $toPriceBrl = $op->priceBrl;
                break;

            case 'withdrawal':
            case 'transfer_out':
                $fromAsset = strtoupper($op->symbol);
                $fromAmount = $op->quantity;
                $fromPriceBrl = $op->priceBrl;
                break;

            case 'swap_out':
                // Saída de ativo em conversão
                $fromAsset = strtoupper($op->symbol);
                $fromAmount = $op->quantity;
                $fromPriceBrl = $op->priceBrl;
                break;

            case 'swap_in':
                // Entrada de ativo em conversão
                $toAsset = strtoupper($op->symbol);
                $toAmount = $op->quantity;
                $toPriceBrl = $op->priceBrl;
                break;

            case 'staking':
            case 'reward':
            case 'interest':
                // Rendimentos de staking são entrada de ativo
                $toAsset = strtoupper($op->symbol);
                $toAmount = $op->quantity;
                $toPriceBrl = $op->priceBrl;
                break;

            case 'airdrop':
            case 'dividend':
                // Airdrops e dividendos são entrada de ativo
                $toAsset = strtoupper($op->symbol);
                $toAmount = $op->quantity;
                $toPriceBrl = $op->priceBrl;
                break;

            default:
                $toAsset = strtoupper($op->symbol);
                $toAmount = $op->quantity;
                $toPriceBrl = $op->priceBrl;
        }

        // Criar a operação
        Operation::create([
            'user_id' => $wallet->user_id,
            'wallet_id' => $wallet->id,
            'external_id' => $op->externalId,
            'type' => $operationType,
            'from_asset' => $fromAsset,
            'from_amount' => $fromAmount,
            'from_price_brl' => $fromPriceBrl,
            'to_asset' => $toAsset,
            'to_amount' => $toAmount,
            'to_price_brl' => $toPriceBrl,
            'total_brl' => $op->totalBrl,
            'fee_brl' => $op->feeBrl ?? 0,
            'executed_at' => $op->executedAt,
        ]);

        return true;
    }

    /**
     * Salva uma operação no formato antigo (array)
     */
    protected function saveLegacyOperation(Wallet $wallet, array $op): bool
    {
        // Verificar se já existe (evitar duplicatas)
        $externalId = $op['external_id'] ?? md5(json_encode($op));

        $exists = Operation::where('wallet_id', $wallet->id)
            ->where('external_id', $externalId)
            ->exists();

        if ($exists) {
            return false;
        }

        $type = $this->mapOperationType($op['type'] ?? 'buy');
        $symbol = strtoupper($op['symbol'] ?? '');

        // Determinar from/to baseado no tipo
        $fromAsset = null;
        $toAsset = null;
        $fromAmount = null;
        $toAmount = null;

        if (in_array($type, ['buy', 'transfer_in', 'airdrop', 'staking'])) {
            $toAsset = $symbol;
            $toAmount = $op['quantity'] ?? 0;
        } else {
            $fromAsset = $symbol;
            $fromAmount = $op['quantity'] ?? 0;
        }

        Operation::create([
            'user_id' => $wallet->user_id,
            'wallet_id' => $wallet->id,
            'external_id' => $externalId,
            'type' => $type,
            'from_asset' => $fromAsset,
            'from_amount' => $fromAmount,
            'from_price_brl' => $op['price_brl'] ?? null,
            'to_asset' => $toAsset,
            'to_amount' => $toAmount,
            'to_price_brl' => $op['price_brl'] ?? null,
            'total_brl' => $op['total_brl'] ?? 0,
            'fee_brl' => $op['fee_brl'] ?? 0,
            'executed_at' => $this->parseDate($op['executed_at'] ?? now()),
        ]);

        return true;
    }

    /**
     * Mapeia tipo de operação para os tipos permitidos no banco
     */
    protected function mapOperationType(string $type): string
    {
        return match (strtolower($type)) {
            'buy', 'compra' => 'buy',
            'sell', 'venda' => 'sell',
            'deposit', 'deposito' => 'transfer_in',
            'withdrawal', 'saque' => 'transfer_out',
            'transfer_in', 'transferencia_entrada' => 'transfer_in',
            'transfer_out', 'transferencia_saida' => 'transfer_out',
            'swap', 'trade', 'swap_in', 'swap_out' => 'swap',
            'staking', 'reward', 'interest' => 'staking',
            'airdrop', 'dividend' => 'airdrop',
            default => 'buy',
        };
    }

    /**
     * Atualiza saldos dos ativos após sincronização
     */
    protected function updateAssetBalances(int $userId): void
    {
        // Buscar todos os símbolos únicos das operações do usuário
        $symbols = Operation::where('user_id', $userId)
            ->whereNotNull('to_asset')
            ->where('to_asset', '!=', 'BRL')
            ->select('to_asset')
            ->distinct()
            ->pluck('to_asset')
            ->merge(
                Operation::where('user_id', $userId)
                    ->whereNotNull('from_asset')
                    ->where('from_asset', '!=', 'BRL')
                    ->select('from_asset')
                    ->distinct()
                    ->pluck('from_asset')
            )
            ->unique()
            ->filter();

        foreach ($symbols as $symbol) {
            $this->updateSingleAssetBalance($userId, $symbol);
        }
    }

    /**
     * Atualiza saldo de um ativo específico
     */
    protected function updateSingleAssetBalance(int $userId, string $symbol): void
    {
        // Calcular entradas (compras, depósitos, swaps para este ativo)
        $inflow = Operation::where('user_id', $userId)
            ->where('to_asset', $symbol)
            ->sum('to_amount');

        // Calcular saídas (vendas, saques, swaps deste ativo)
        $outflow = Operation::where('user_id', $userId)
            ->where('from_asset', $symbol)
            ->sum('from_amount');

        $quantity = $inflow - $outflow;

        // Calcular custo médio ponderado
        $totalCost = Operation::where('user_id', $userId)
            ->where('to_asset', $symbol)
            ->whereIn('type', ['buy', 'swap'])
            ->selectRaw('SUM(total_brl + fee_brl) as total')
            ->value('total') ?? 0;

        $totalBought = Operation::where('user_id', $userId)
            ->where('to_asset', $symbol)
            ->whereIn('type', ['buy', 'swap'])
            ->sum('to_amount');

        $averageCost = $totalBought > 0 ? $totalCost / $totalBought : 0;

        // Calcular ganho/perda realizado
        $realizedGain = Operation::where('user_id', $userId)
            ->where('from_asset', $symbol)
            ->whereIn('type', ['sell', 'swap'])
            ->sum('gain_loss_brl');

        // Atualizar ou criar o asset
        Asset::updateOrCreate(
            [
                'user_id' => $userId,
                'symbol' => strtoupper($symbol),
            ],
            [
                'name' => strtoupper($symbol),
                'quantity' => max(0, $quantity),
                'average_cost_brl' => $averageCost,
                'total_invested_brl' => max(0, $quantity) * $averageCost,
                'realized_gain_loss_brl' => $realizedGain,
            ]
        );
    }

    /**
     * Recalcula ganho de capital para todas as operações
     */
    protected function recalculateCapitalGain(int $userId): void
    {
        $assets = Asset::where('user_id', $userId)->get();

        foreach ($assets as $asset) {
            $this->capitalGainService->calculateForAsset($asset);
        }
    }

    /**
     * Importa operações de arquivo CSV/XLS
     */
    public function importFromFile(Wallet $wallet, string $filePath, string $exchangeSlug = 'binance'): array
    {
        $wallet->update(['status' => 'syncing']);

        try {
            // Detectar formato do arquivo
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);

            // Usar parser específico da exchange
            $parser = $this->getParserForExchange($exchangeSlug);

            if ($parser) {
                $operations = $parser->parse($filePath);
            } else {
                // Fallback para parser genérico
                $operations = match ($extension) {
                    'csv' => $this->parseGenericCSV($filePath),
                    'xlsx', 'xls' => $this->parseExcel($filePath),
                    default => throw new \Exception('Formato de arquivo não suportado.'),
                };
            }

            // Processar operações
            $imported = $this->processOperations($wallet, $operations);

            // Atualizar saldos
            $this->updateAssetBalances($wallet->user_id);

            // Recalcular ganho de capital
            $this->recalculateCapitalGain($wallet->user_id);

            $wallet->update([
                'status' => 'active',
                'last_sync_at' => now(),
            ]);

            return [
                'success' => true,
                'imported' => $imported,
                'message' => "{$imported} operações importadas com sucesso.",
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao importar arquivo', [
                'wallet_id' => $wallet->id,
                'file' => $filePath,
                'error' => $e->getMessage(),
            ]);

            $wallet->update([
                'status' => 'error',
                'sync_error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Retorna o parser correto para cada exchange
     */
    protected function getParserForExchange(string $slug)
    {
        return match ($slug) {
            'binance' => app(\App\Services\Parsers\BinanceCSVParser::class),
            // Futuras exchanges:
            // 'coinbase' => app(CoinbaseCSVParser::class),
            default => null,
        };
    }

    /**
     * Parse arquivo CSV genérico
     */
    protected function parseGenericCSV(string $filePath): array
    {
        $operations = [];
        $handle = fopen($filePath, 'r');

        if ($handle === false) {
            throw new \Exception('Não foi possível abrir o arquivo.');
        }

        // Pular header
        $header = fgetcsv($handle, 0, ';');

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            if (count($row) < 6) {
                continue;
            }

            $operations[] = [
                'external_id' => md5(implode('|', $row)),
                'symbol' => $row[1] ?? '',
                'type' => $this->normalizeOperationType($row[2] ?? ''),
                'quantity' => (float) str_replace(',', '.', $row[3] ?? 0),
                'price_brl' => (float) str_replace(',', '.', $row[4] ?? 0),
                'total_brl' => (float) str_replace(',', '.', $row[5] ?? 0),
                'fee_brl' => (float) str_replace(',', '.', $row[6] ?? 0),
                'executed_at' => $this->parseDate($row[0] ?? ''),
            ];
        }

        fclose($handle);

        return $operations;
    }

    /**
     * Parse arquivo Excel
     */
    protected function parseExcel(string $filePath): array
    {
        // Verificar se PhpSpreadsheet está disponível
        if (!class_exists(\PhpOffice\PhpSpreadsheet\IOFactory::class)) {
            throw new \Exception('PhpSpreadsheet não está instalado. Execute: composer require phpoffice/phpspreadsheet');
        }

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Remover header
        array_shift($rows);

        $operations = [];

        foreach ($rows as $row) {
            if (count($row) < 6 || empty($row[0])) {
                continue;
            }

            $operations[] = [
                'external_id' => md5(implode('|', $row)),
                'symbol' => $row[1] ?? '',
                'type' => $this->normalizeOperationType($row[2] ?? ''),
                'quantity' => (float) str_replace(',', '.', $row[3] ?? 0),
                'price_brl' => (float) str_replace(',', '.', $row[4] ?? 0),
                'total_brl' => (float) str_replace(',', '.', $row[5] ?? 0),
                'fee_brl' => (float) str_replace(',', '.', $row[6] ?? 0),
                'executed_at' => $this->parseDate($row[0] ?? ''),
            ];
        }

        return $operations;
    }

    /**
     * Normaliza tipo de operação
     */
    protected function normalizeOperationType(string $type): string
    {
        $type = strtolower(trim($type));

        return match ($type) {
            'compra', 'buy', 'c' => 'buy',
            'venda', 'sell', 'v' => 'sell',
            'deposito', 'deposit', 'd' => 'transfer_in',
            'saque', 'withdrawal', 'w' => 'transfer_out',
            'transferencia_entrada', 'transfer_in' => 'transfer_in',
            'transferencia_saida', 'transfer_out' => 'transfer_out',
            default => 'buy',
        };
    }

    /**
     * Parse data em diversos formatos
     */
    protected function parseDate($date): Carbon
    {
        if ($date instanceof Carbon) {
            return $date;
        }

        if ($date instanceof \DateTime) {
            return Carbon::instance($date);
        }

        if (is_numeric($date)) {
            return Carbon::createFromTimestamp($date);
        }

        $formats = [
            'd/m/Y H:i:s',
            'd/m/Y H:i',
            'd/m/Y',
            'Y-m-d H:i:s',
            'Y-m-d\TH:i:s',
            'Y-m-d',
        ];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, $date);
            } catch (\Exception $e) {
                continue;
            }
        }

        return Carbon::now();
    }
}
