<?php

namespace App\Integrations;

use App\Contracts\ExchangeIntegrationInterface;
use App\DTOs\NormalizedOperation;
use App\Services\CurrencyConverterService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BinanceIntegration implements ExchangeIntegrationInterface
{
    protected string $baseUrl;
    protected int $timeout;
    protected CurrencyConverterService $converter;

    /**
     * Offset entre o relógio local e o servidor da Binance (em ms)
     */
    protected static ?int $serverTimeOffset = null;

    public function __construct(CurrencyConverterService $converter)
    {
        $this->baseUrl = config('services.binance.base_url', 'https://api.binance.com');
        $this->timeout = config('services.binance.timeout', 30);
        $this->converter = $converter;
    }

    public function getExchangeName(): string
    {
        return 'Binance';
    }

    public function getExchangeSlug(): string
    {
        return 'binance';
    }

    public function supportsCSVImport(): bool
    {
        return true;
    }

    public function getSupportedSymbols(): array
    {
        return ['BTC', 'ETH', 'BNB', 'SOL', 'ADA', 'XRP', 'DOT', 'AVAX', 'MATIC', 'LINK'];
    }

    /**
     * Valida credenciais da API - RÁPIDO, sem chamadas extras
     */
    public function validateCredentials(string $apiKey, string $apiSecret): bool
    {
        try {
            // Pega timestamp do servidor primeiro (uma única chamada)
            $serverTime = $this->fetchServerTime();
            if (!$serverTime) {
                Log::error('Failed to get Binance server time for validation');
                return false;
            }

            $query = "timestamp={$serverTime}";
            $signature = hash_hmac('sha256', $query, $apiSecret);

            $response = Http::timeout(10)
                ->withOptions(['verify' => false])
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/api/v3/account", [
                    'timestamp' => $serverTime,
                    'signature' => $signature,
                ]);

            if (!$response->successful()) {
                Log::warning('Binance credential validation failed', [
                    'status' => $response->status(),
                    'error' => $response->json(),
                ]);
            }

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Binance credential validation exception', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Busca o timestamp do servidor da Binance (chamada única e rápida)
     */
    protected function fetchServerTime(): ?int
    {
        try {
            $response = Http::timeout(5)
                ->withOptions(['verify' => false])
                ->get("{$this->baseUrl}/api/v3/time");

            if ($response->successful()) {
                return $response->json('serverTime');
            }
        } catch (\Exception $e) {
            Log::warning('Failed to fetch Binance server time', ['error' => $e->getMessage()]);
        }
        return null;
    }

    /**
     * Obtém timestamp sincronizado com o servidor da Binance
     * Usa offset cacheado para evitar muitas chamadas
     */
    protected function getServerTimestamp(): int
    {
        // Se não tem offset, busca do servidor
        if (self::$serverTimeOffset === null) {
            $serverTime = $this->fetchServerTime();
            if ($serverTime) {
                self::$serverTimeOffset = $serverTime - now()->getTimestampMs();
            } else {
                self::$serverTimeOffset = 0;
            }
        }

        return now()->getTimestampMs() + self::$serverTimeOffset;
    }

    /**
     * Cria uma instância HTTP configurada para chamadas longas
     */
    protected function makeRequest(int $timeout = 30): \Illuminate\Http\Client\PendingRequest
    {
        return Http::timeout($timeout)->withOptions(['verify' => false]);
    }

    /**
     * Busca todas as operações de trade
     * NOTA: Binance limita a 1000 trades por símbolo, sem filtro de tempo
     * Para histórico antigo, usar importação CSV é recomendado
     */
    public function fetchTrades(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allTrades = collect();
        $symbols = $this->getSymbolsToFetch($apiKey, $apiSecret);

        Log::info('Fetching trades for symbols (sem filtro de data)', ['count' => count($symbols)]);

        foreach ($symbols as $index => $symbol) {
            // Busca últimos 1000 trades do símbolo (sem filtro de data)
            $trades = $this->fetchTradesForSymbol($apiKey, $apiSecret, $symbol);

            // Filtra por data se especificado
            if ($startTime || $endTime) {
                $trades = $trades->filter(function ($trade) use ($startTime, $endTime) {
                    $tradeDate = $trade->executedAt;
                    if ($startTime && $tradeDate < $startTime) return false;
                    if ($endTime && $tradeDate > $endTime) return false;
                    return true;
                });
            }

            $allTrades = $allTrades->merge($trades);

            // Log progresso a cada 10 símbolos
            if (($index + 1) % 10 === 0) {
                Log::info('Trade fetch progress', [
                    'processed' => $index + 1,
                    'total' => count($symbols),
                    'trades_found' => $allTrades->count(),
                ]);
            }

            usleep(100000); // 100ms entre símbolos (respeita rate limit)
        }

        return $allTrades;
    }

    /**
     * Busca trades para um símbolo específico (últimos 1000)
     */
    protected function fetchTradesForSymbol(
        string $apiKey,
        string $apiSecret,
        string $symbol
    ): Collection {
        $trades = collect();

        try {
            $timestamp = $this->getServerTimestamp();
            $params = [
                'symbol' => $symbol,
                'limit' => 1000,
                'timestamp' => $timestamp,
            ];

            $query = http_build_query($params);
            $params['signature'] = hash_hmac('sha256', $query, $apiSecret);

            $response = $this->makeRequest(15)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/api/v3/myTrades", $params);

            if (!$response->successful()) {
                $error = $response->json();
                $code = $error['code'] ?? 0;

                // -1121 = símbolo inválido (normal, ignora)
                // -1100 = parâmetro inválido (ignora)
                // -1127 = janela de tempo muito grande (ignora)
                if (!in_array($code, [-1121, -1100, -1127])) {
                    Log::warning('Binance trades fetch failed', [
                        'symbol' => $symbol,
                        'status' => $response->status(),
                        'error' => $error,
                    ]);
                }
                return $trades;
            }

            foreach ($response->json() ?? [] as $trade) {
                $normalized = $this->normalizeTrade($trade, $symbol);
                if ($normalized) {
                    $trades->push($normalized);
                }
            }

            if ($trades->isNotEmpty()) {
                Log::info("Found trades for {$symbol}", ['count' => $trades->count()]);
            }

        } catch (\Exception $e) {
            Log::error('Binance fetchTradesForSymbol error', [
                'symbol' => $symbol,
                'error' => $e->getMessage(),
            ]);
        }

        return $trades;
    }

    /**
     * Busca todos os depósitos
     */
    public function fetchDeposits(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allDeposits = collect();

        $start = $startTime ?? Carbon::create(2017, 1, 1);
        $end = $endTime ?? now();

        Log::info('Fetching deposits', ['start' => $start->toDateString(), 'end' => $end->toDateString()]);

        // Binance limita a 90 dias por requisição
        while ($start < $end) {
            $windowEnd = $start->copy()->addDays(89);
            if ($windowEnd > $end) {
                $windowEnd = $end;
            }

            $deposits = $this->fetchDepositsWindow($apiKey, $apiSecret, $start, $windowEnd);
            $allDeposits = $allDeposits->merge($deposits);

            $start = $windowEnd->copy()->addDay();
            usleep(200000); // 200ms entre chamadas
        }

        Log::info('Deposits fetched', ['count' => $allDeposits->count()]);

        return $allDeposits;
    }

    /**
     * Busca depósitos em uma janela de 90 dias
     */
    protected function fetchDepositsWindow(
        string $apiKey,
        string $apiSecret,
        Carbon $startTime,
        Carbon $endTime
    ): Collection {
        $deposits = collect();

        try {
            $timestamp = $this->getServerTimestamp();
            $params = [
                'startTime' => $startTime->getTimestampMs(),
                'endTime' => $endTime->getTimestampMs(),
                'timestamp' => $timestamp,
            ];

            $query = http_build_query($params);
            $params['signature'] = hash_hmac('sha256', $query, $apiSecret);

            $response = $this->makeRequest(15)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/sapi/v1/capital/deposit/hisrec", $params);

            if (!$response->successful()) {
                return $deposits;
            }

            foreach ($response->json() ?? [] as $deposit) {
                $normalized = $this->normalizeDeposit($deposit);
                if ($normalized) {
                    $deposits->push($normalized);
                }
            }
        } catch (\Exception $e) {
            Log::error('Binance fetchDepositsWindow error', ['error' => $e->getMessage()]);
        }

        return $deposits;
    }

    /**
     * Busca todos os saques
     */
    public function fetchWithdrawals(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allWithdrawals = collect();

        $start = $startTime ?? Carbon::create(2017, 1, 1);
        $end = $endTime ?? now();

        Log::info('Fetching withdrawals', ['start' => $start->toDateString(), 'end' => $end->toDateString()]);

        while ($start < $end) {
            $windowEnd = $start->copy()->addDays(89);
            if ($windowEnd > $end) {
                $windowEnd = $end;
            }

            $withdrawals = $this->fetchWithdrawalsWindow($apiKey, $apiSecret, $start, $windowEnd);
            $allWithdrawals = $allWithdrawals->merge($withdrawals);

            $start = $windowEnd->copy()->addDay();
            usleep(200000);
        }

        Log::info('Withdrawals fetched', ['count' => $allWithdrawals->count()]);

        return $allWithdrawals;
    }

    /**
     * Busca saques em uma janela de 90 dias
     */
    protected function fetchWithdrawalsWindow(
        string $apiKey,
        string $apiSecret,
        Carbon $startTime,
        Carbon $endTime
    ): Collection {
        $withdrawals = collect();

        try {
            $timestamp = $this->getServerTimestamp();
            $params = [
                'startTime' => $startTime->getTimestampMs(),
                'endTime' => $endTime->getTimestampMs(),
                'timestamp' => $timestamp,
            ];

            $query = http_build_query($params);
            $params['signature'] = hash_hmac('sha256', $query, $apiSecret);

            $response = $this->makeRequest(15)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/sapi/v1/capital/withdraw/history", $params);

            if (!$response->successful()) {
                return $withdrawals;
            }

            foreach ($response->json() ?? [] as $withdrawal) {
                $normalized = $this->normalizeWithdrawal($withdrawal);
                if ($normalized) {
                    $withdrawals->push($normalized);
                }
            }
        } catch (\Exception $e) {
            Log::error('Binance fetchWithdrawalsWindow error', ['error' => $e->getMessage()]);
        }

        return $withdrawals;
    }

    /**
     * Busca todas as operações
     */
    public function fetchAllOperations(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        Log::info('Starting full Binance sync', [
            'start' => $startTime?->toDateString(),
            'end' => $endTime?->toDateString(),
        ]);

        // Operações básicas
        $trades = $this->fetchTrades($apiKey, $apiSecret, $startTime, $endTime);
        $deposits = $this->fetchDeposits($apiKey, $apiSecret, $startTime, $endTime);
        $withdrawals = $this->fetchWithdrawals($apiKey, $apiSecret, $startTime, $endTime);

        // Depósitos e saques FIAT (BRL via PIX/TED)
        $fiatDeposits = $this->fetchFiatDeposits($apiKey, $apiSecret, $startTime, $endTime);
        $fiatWithdrawals = $this->fetchFiatWithdrawals($apiKey, $apiSecret, $startTime, $endTime);

        // Conversões (Convert, Dust, Swaps)
        $converts = $this->fetchConvertTrades($apiKey, $apiSecret, $startTime, $endTime);
        $dust = $this->fetchDustConversions($apiKey, $apiSecret, $startTime, $endTime);

        // Staking rewards e dividendos
        $staking = $this->fetchStakingRecords($apiKey, $apiSecret, $startTime, $endTime);
        $dividends = $this->fetchDividends($apiKey, $apiSecret, $startTime, $endTime);

        $total = $trades
            ->merge($deposits)
            ->merge($withdrawals)
            ->merge($fiatDeposits)
            ->merge($fiatWithdrawals)
            ->merge($converts)
            ->merge($dust)
            ->merge($staking)
            ->merge($dividends)
            ->sortBy('executedAt');

        Log::info('Binance sync completed', [
            'trades' => $trades->count(),
            'deposits' => $deposits->count(),
            'withdrawals' => $withdrawals->count(),
            'fiat_deposits' => $fiatDeposits->count(),
            'fiat_withdrawals' => $fiatWithdrawals->count(),
            'converts' => $converts->count(),
            'dust' => $dust->count(),
            'staking' => $staking->count(),
            'dividends' => $dividends->count(),
            'total' => $total->count(),
        ]);

        return $total;
    }

    /**
     * Retorna lista de símbolos para buscar - SIMPLIFICADO
     * Pega ativos da conta + lista popular fixa
     */
    protected function getSymbolsToFetch(string $apiKey, string $apiSecret): array
    {
        $assets = [];

        // 1. Tenta pegar ativos com saldo da conta
        try {
            $timestamp = $this->getServerTimestamp();
            $query = "timestamp={$timestamp}";
            $signature = hash_hmac('sha256', $query, $apiSecret);

            $response = $this->makeRequest(10)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/api/v3/account", [
                    'timestamp' => $timestamp,
                    'signature' => $signature,
                ]);

            if ($response->successful()) {
                foreach ($response->json('balances') ?? [] as $balance) {
                    $free = (float) ($balance['free'] ?? 0);
                    $locked = (float) ($balance['locked'] ?? 0);
                    if ($free > 0 || $locked > 0) {
                        $assets[] = $balance['asset'];
                    }
                }
                Log::info('Found assets with balance', ['count' => count($assets)]);
            }
        } catch (\Exception $e) {
            Log::warning('Failed to get account balances', ['error' => $e->getMessage()]);
        }

        // 2. Adiciona criptos populares
        $popular = [
            'BTC', 'ETH', 'BNB', 'SOL', 'ADA', 'XRP', 'DOT', 'AVAX', 'MATIC', 'LINK',
            'DOGE', 'SHIB', 'LTC', 'UNI', 'ATOM', 'TRX', 'APE', 'OP', 'ARB',
            'PEPE', 'WLD', 'FET', 'RNDR', 'GRT', 'RVN', 'JASMY',
        ];

        $assets = array_unique(array_merge($assets, $popular));

        // Remove stablecoins
        $stablecoins = ['USDT', 'BUSD', 'USDC', 'TUSD', 'FDUSD', 'DAI', 'BRL', 'USD', 'EUR'];
        $assets = array_filter($assets, fn($a) => !in_array($a, $stablecoins));

        // Gera pares USDT e BRL
        $symbols = [];
        foreach ($assets as $asset) {
            $symbols[] = "{$asset}USDT";
            $symbols[] = "{$asset}BRL";
        }

        return array_unique($symbols);
    }

    /**
     * Normaliza trade da Binance para DTO
     * OTIMIZADO: Usa o preço da trade diretamente, converte USD para BRL usando taxa fixa aproximada
     * Os preços serão recalculados posteriormente em batch se necessário
     */
    protected function normalizeTrade(array $trade, string $symbol): ?NormalizedOperation
    {
        try {
            $isBuyer = $trade['isBuyer'] ?? false;
            $type = $isBuyer ? 'buy' : 'sell';

            $quantity = (float) ($trade['qty'] ?? 0);
            $tradePrice = (float) ($trade['price'] ?? 0);
            $commission = (float) ($trade['commission'] ?? 0);

            $baseAsset = $this->extractBaseAsset($symbol);
            $quoteAsset = $this->extractQuoteAsset($symbol);

            $executedAt = Carbon::createFromTimestampMs($trade['time']);

            // Determina se o par é em BRL ou USD
            $isBrlPair = $quoteAsset === 'BRL';

            // Taxa USD/BRL aproximada (será refinada depois se necessário)
            $usdBrlRate = 5.50;

            if ($isBrlPair) {
                // Par já está em BRL (ex: BTCBRL)
                $priceBrl = $tradePrice;
                $priceUsd = $tradePrice / $usdBrlRate;
            } else {
                // Par está em USD/USDT (ex: BTCUSDT)
                $priceUsd = $tradePrice;
                $priceBrl = $tradePrice * $usdBrlRate;
            }

            $totalUsd = $quantity * $priceUsd;
            $totalBrl = $quantity * $priceBrl;

            // Taxa aproximada para comissão
            $feeUsd = 0;
            $feeBrl = 0;
            if ($commission > 0) {
                // Simplificação: assume comissão pequena, usa taxa aproximada
                $feeBrl = $commission * 0.10; // Aproximação conservadora
                $feeUsd = $feeBrl / $usdBrlRate;
            }

            return new NormalizedOperation(
                externalId: (string) $trade['id'],
                symbol: $baseAsset,
                type: $type,
                quantity: $quantity,
                priceUsd: $priceUsd,
                priceBrl: $priceBrl,
                totalUsd: $totalUsd,
                totalBrl: $totalBrl,
                feeUsd: $feeUsd,
                feeBrl: $feeBrl,
                executedAt: $executedAt,
                source: 'binance_api',
                quoteAsset: $quoteAsset,
                rawData: $trade,
            );
        } catch (\Exception $e) {
            Log::error('Error normalizing Binance trade', [
                'trade' => $trade,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Normaliza depósito da Binance para DTO
     * OTIMIZADO: Usa preços aproximados para velocidade
     */
    protected function normalizeDeposit(array $deposit): ?NormalizedOperation
    {
        try {
            $quantity = (float) ($deposit['amount'] ?? 0);
            $asset = $deposit['coin'] ?? '';

            $executedAt = isset($deposit['insertTime'])
                ? Carbon::createFromTimestampMs($deposit['insertTime'])
                : now();

            // Usa taxa aproximada para depósitos (preço será calculado depois se necessário)
            $usdBrlRate = 5.50;

            // Para depósitos, não temos o preço - deixa 0 para ser calculado depois
            $priceBrl = 0;
            $priceUsd = 0;

            return new NormalizedOperation(
                externalId: $deposit['txId'] ?? md5(json_encode($deposit)),
                symbol: $asset,
                type: 'deposit',
                quantity: $quantity,
                priceUsd: $priceUsd,
                priceBrl: $priceBrl,
                totalUsd: 0,
                totalBrl: 0,
                feeUsd: 0,
                feeBrl: 0,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $deposit,
            );
        } catch (\Exception $e) {
            Log::error('Error normalizing Binance deposit', [
                'deposit' => $deposit,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Normaliza saque da Binance para DTO
     * OTIMIZADO: Usa preços aproximados para velocidade
     */
    protected function normalizeWithdrawal(array $withdrawal): ?NormalizedOperation
    {
        try {
            $quantity = (float) ($withdrawal['amount'] ?? 0);
            $asset = $withdrawal['coin'] ?? '';
            $fee = (float) ($withdrawal['transactionFee'] ?? 0);

            // completeTime e applyTime podem ser timestamp em ms ou string de data
            $executedAt = now();
            if (isset($withdrawal['completeTime'])) {
                $executedAt = is_numeric($withdrawal['completeTime'])
                    ? Carbon::createFromTimestampMs($withdrawal['completeTime'])
                    : Carbon::parse($withdrawal['completeTime']);
            } elseif (isset($withdrawal['applyTime'])) {
                $executedAt = is_numeric($withdrawal['applyTime'])
                    ? Carbon::createFromTimestampMs($withdrawal['applyTime'])
                    : Carbon::parse($withdrawal['applyTime']);
            }

            // Para saques, não temos o preço - deixa 0 para ser calculado depois
            $priceBrl = 0;
            $priceUsd = 0;
            $feeBrl = 0;
            $feeUsd = 0;

            return new NormalizedOperation(
                externalId: $withdrawal['id'] ?? md5(json_encode($withdrawal)),
                symbol: $asset,
                type: 'withdrawal',
                quantity: $quantity,
                priceUsd: $priceUsd,
                priceBrl: $priceBrl,
                totalUsd: 0,
                totalBrl: 0,
                feeUsd: $feeUsd,
                feeBrl: $feeBrl,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $withdrawal,
            );
        } catch (\Exception $e) {
            Log::error('Error normalizing Binance withdrawal', [
                'withdrawal' => $withdrawal,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    protected function extractBaseAsset(string $symbol): string
    {
        $quoteAssets = ['USDT', 'BUSD', 'BRL', 'BTC', 'ETH', 'BNB', 'USD'];
        foreach ($quoteAssets as $quote) {
            if (str_ends_with($symbol, $quote)) {
                return str_replace($quote, '', $symbol);
            }
        }
        return $symbol;
    }

    protected function extractQuoteAsset(string $symbol): string
    {
        $quoteAssets = ['USDT', 'BUSD', 'BRL', 'BTC', 'ETH', 'BNB', 'USD'];
        foreach ($quoteAssets as $quote) {
            if (str_ends_with($symbol, $quote)) {
                return $quote;
            }
        }
        return 'USDT';
    }

    protected function generateSignature(string $query, string $secret): string
    {
        return hash_hmac('sha256', $query, $secret);
    }

    /**
     * Busca saques FIAT (BRL via PIX/TED)
     */
    public function fetchFiatWithdrawals(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allWithdrawals = collect();

        $start = $startTime ?? Carbon::now()->subYears(2);
        $end = $endTime ?? Carbon::now();

        Log::info('Fetching FIAT withdrawals', ['start' => $start->toDateString(), 'end' => $end->toDateString()]);

        // Janela de 90 dias para FIAT
        while ($start->lt($end)) {
            $windowEnd = $start->copy()->addDays(90);
            if ($windowEnd->gt($end)) {
                $windowEnd = $end;
            }

            $withdrawals = $this->fetchFiatWithdrawalsWindow($apiKey, $apiSecret, $start, $windowEnd);
            $allWithdrawals = $allWithdrawals->merge($withdrawals);

            $start = $windowEnd->copy()->addSecond();
        }

        Log::info('FIAT withdrawals fetched', ['total' => $allWithdrawals->count()]);

        return $allWithdrawals;
    }

    /**
     * Busca saques FIAT em uma janela de 90 dias
     * Usa o endpoint /sapi/v1/fiat/orders que é o correto para Binance Brasil
     */
    protected function fetchFiatWithdrawalsWindow(
        string $apiKey,
        string $apiSecret,
        Carbon $start,
        Carbon $end
    ): Collection {
        $withdrawals = collect();

        try {
            $timestamp = $this->getServerTimestamp();
            $params = [
                'transactionType' => 1, // 1 = withdraw
                'beginTime' => $start->getTimestampMs(),
                'endTime' => $end->getTimestampMs(),
                'timestamp' => $timestamp,
            ];

            $query = http_build_query($params);
            $params['signature'] = $this->generateSignature($query, $apiSecret);

            // Endpoint correto para Binance Brasil: /sapi/v1/fiat/orders
            $response = $this->makeRequest($this->timeout)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/sapi/v1/fiat/orders", $params);

            if (!$response->successful()) {
                Log::warning('FIAT withdrawals API error', [
                    'status' => $response->status(),
                    'error' => $response->json(),
                ]);
                return $withdrawals;
            }

            $data = $response->json();
            foreach ($data['data'] ?? [] as $withdrawal) {
                $normalized = $this->normalizeFiatWithdrawal($withdrawal);
                if ($normalized) {
                    $withdrawals->push($normalized);
                }
            }
        } catch (\Exception $e) {
            Log::error('Binance fetchFiatWithdrawalsWindow error', ['error' => $e->getMessage()]);
        }

        return $withdrawals;
    }

    /**
     * Normaliza saque FIAT da Binance para DTO
     * Campos da API /sapi/v1/fiat/orders:
     * - orderNo, fiatCurrency, indicatedAmount, amount, totalFee, method, status, createTime, updateTime
     */
    protected function normalizeFiatWithdrawal(array $withdrawal): ?NormalizedOperation
    {
        try {
            // indicatedAmount = valor total solicitado
            // amount = valor líquido recebido (já com taxa descontada)
            $amount = (float) ($withdrawal['indicatedAmount'] ?? $withdrawal['amount'] ?? 0);
            $fiatCurrency = $withdrawal['fiatCurrency'] ?? 'BRL';
            $fee = (float) ($withdrawal['totalFee'] ?? 0);
            $status = $withdrawal['status'] ?? '';

            // Só importar saques concluídos
            if (!in_array($status, ['Successful', 'Completed', 'Finished'])) {
                return null;
            }

            $executedAt = isset($withdrawal['updateTime'])
                ? Carbon::createFromTimestampMs($withdrawal['updateTime'])
                : (isset($withdrawal['createTime']) ? Carbon::createFromTimestampMs($withdrawal['createTime']) : now());

            return new NormalizedOperation(
                externalId: $withdrawal['orderNo'] ?? md5(json_encode($withdrawal)),
                symbol: $fiatCurrency,
                type: 'transfer_out',
                quantity: $amount,
                priceUsd: 0,
                priceBrl: 1.0, // BRL já está em BRL
                totalUsd: 0,
                totalBrl: $amount,
                feeUsd: 0,
                feeBrl: $fee,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $withdrawal,
            );
        } catch (\Exception $e) {
            Log::error('Error normalizing FIAT withdrawal', [
                'withdrawal' => $withdrawal,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Busca depósitos FIAT (BRL via PIX/TED)
     */
    public function fetchFiatDeposits(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allDeposits = collect();

        $start = $startTime ?? Carbon::now()->subYears(2);
        $end = $endTime ?? Carbon::now();

        Log::info('Fetching FIAT deposits', ['start' => $start->toDateString(), 'end' => $end->toDateString()]);

        // Janela de 90 dias para FIAT
        while ($start->lt($end)) {
            $windowEnd = $start->copy()->addDays(90);
            if ($windowEnd->gt($end)) {
                $windowEnd = $end;
            }

            $deposits = $this->fetchFiatDepositsWindow($apiKey, $apiSecret, $start, $windowEnd);
            $allDeposits = $allDeposits->merge($deposits);

            $start = $windowEnd->copy()->addSecond();
        }

        Log::info('FIAT deposits fetched', ['total' => $allDeposits->count()]);

        return $allDeposits;
    }

    /**
     * Busca depósitos FIAT em uma janela de 90 dias
     * Usa o endpoint /sapi/v1/fiat/orders que é o correto para Binance Brasil
     */
    protected function fetchFiatDepositsWindow(
        string $apiKey,
        string $apiSecret,
        Carbon $start,
        Carbon $end
    ): Collection {
        $deposits = collect();

        try {
            $timestamp = $this->getServerTimestamp();
            $params = [
                'transactionType' => 0, // 0 = deposit
                'beginTime' => $start->getTimestampMs(),
                'endTime' => $end->getTimestampMs(),
                'timestamp' => $timestamp,
            ];

            $query = http_build_query($params);
            $params['signature'] = $this->generateSignature($query, $apiSecret);

            // Endpoint correto para Binance Brasil: /sapi/v1/fiat/orders
            $response = $this->makeRequest($this->timeout)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/sapi/v1/fiat/orders", $params);

            if (!$response->successful()) {
                Log::warning('FIAT deposits API error', [
                    'status' => $response->status(),
                    'error' => $response->json(),
                ]);
                return $deposits;
            }

            $data = $response->json();
            foreach ($data['data'] ?? [] as $deposit) {
                $normalized = $this->normalizeFiatDeposit($deposit);
                if ($normalized) {
                    $deposits->push($normalized);
                }
            }
        } catch (\Exception $e) {
            Log::error('Binance fetchFiatDepositsWindow error', ['error' => $e->getMessage()]);
        }

        return $deposits;
    }

    /**
     * Normaliza depósito FIAT da Binance para DTO
     */
    protected function normalizeFiatDeposit(array $deposit): ?NormalizedOperation
    {
        try {
            $amount = (float) ($deposit['indicatedAmount'] ?? $deposit['amount'] ?? 0);
            $fiatCurrency = $deposit['fiatCurrency'] ?? 'BRL';
            $fee = (float) ($deposit['totalFee'] ?? 0);
            $status = $deposit['status'] ?? '';

            // Só importar depósitos concluídos
            if (!in_array($status, ['Successful', 'Completed', 'Finished'])) {
                return null;
            }

            $executedAt = isset($deposit['updateTime'])
                ? Carbon::createFromTimestampMs($deposit['updateTime'])
                : (isset($deposit['createTime']) ? Carbon::createFromTimestampMs($deposit['createTime']) : now());

            return new NormalizedOperation(
                externalId: $deposit['orderNo'] ?? md5(json_encode($deposit)),
                symbol: $fiatCurrency,
                type: 'transfer_in',
                quantity: $amount,
                priceUsd: 0,
                priceBrl: 1.0, // BRL já está em BRL
                totalUsd: 0,
                totalBrl: $amount,
                feeUsd: 0,
                feeBrl: $fee,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $deposit,
            );
        } catch (\Exception $e) {
            Log::error('Error normalizing FIAT deposit', [
                'deposit' => $deposit,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    // ========================================================================
    // CONVERT TRADES (Conversões cripto-cripto)
    // ========================================================================

    /**
     * Busca todas as conversões (Convert trades)
     * Endpoint: GET /sapi/v1/convert/tradeFlow
     * Weight: 3000
     */
    public function fetchConvertTrades(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allConverts = collect();

        // Convert disponível desde 2021
        $start = $startTime ?? Carbon::create(2021, 1, 1);
        $end = $endTime ?? now();

        Log::info('Fetching convert trades', ['start' => $start->toDateString(), 'end' => $end->toDateString()]);

        // Binance limita a 30 dias por requisição para convert
        while ($start < $end) {
            $windowEnd = $start->copy()->addDays(29);
            if ($windowEnd > $end) {
                $windowEnd = $end;
            }

            $converts = $this->fetchConvertTradesWindow($apiKey, $apiSecret, $start, $windowEnd);
            $allConverts = $allConverts->merge($converts);

            $start = $windowEnd->copy()->addDay();
            usleep(500000); // 500ms entre chamadas (weight alto: 3000)
        }

        Log::info('Convert trades fetched', ['count' => $allConverts->count()]);

        return $allConverts;
    }

    /**
     * Busca conversões em uma janela de 30 dias
     */
    protected function fetchConvertTradesWindow(
        string $apiKey,
        string $apiSecret,
        Carbon $startTime,
        Carbon $endTime
    ): Collection {
        $converts = collect();

        try {
            $timestamp = $this->getServerTimestamp();
            $params = [
                'startTime' => $startTime->getTimestampMs(),
                'endTime' => $endTime->getTimestampMs(),
                'limit' => 1000,
                'timestamp' => $timestamp,
            ];

            $query = http_build_query($params);
            $params['signature'] = hash_hmac('sha256', $query, $apiSecret);

            $response = $this->makeRequest(30)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/sapi/v1/convert/tradeFlow", $params);

            if (!$response->successful()) {
                $error = $response->json();
                // Ignora erros de endpoint não disponível
                if (($error['code'] ?? 0) !== -1002) {
                    Log::warning('Convert trades API error', [
                        'status' => $response->status(),
                        'error' => $error,
                    ]);
                }
                return $converts;
            }

            $data = $response->json();
            foreach ($data['list'] ?? [] as $convert) {
                $normalized = $this->normalizeConvertTrade($convert);
                foreach ($normalized as $op) {
                    if ($op) {
                        $converts->push($op);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Binance fetchConvertTradesWindow error', ['error' => $e->getMessage()]);
        }

        return $converts;
    }

    /**
     * Normaliza conversão da Binance para DTOs
     * Uma conversão gera 2 operações: swap_out (origem) e swap_in (destino)
     *
     * Campos da API:
     * - quoteId, orderId, orderStatus
     * - fromAsset, fromAmount
     * - toAsset, toAmount
     * - ratio (taxa de conversão)
     * - inverseRatio
     * - createTime
     */
    protected function normalizeConvertTrade(array $convert): array
    {
        $operations = [];

        try {
            $fromAsset = $convert['fromAsset'] ?? '';
            $fromAmount = (float) ($convert['fromAmount'] ?? 0);
            $toAsset = $convert['toAsset'] ?? '';
            $toAmount = (float) ($convert['toAmount'] ?? 0);
            $orderId = $convert['orderId'] ?? md5(json_encode($convert));

            $executedAt = isset($convert['createTime'])
                ? Carbon::createFromTimestampMs($convert['createTime'])
                : now();

            // Taxa aproximada USD/BRL
            $usdBrlRate = 5.50;

            // Operação 1: Saída do ativo origem (swap_out)
            $operations[] = new NormalizedOperation(
                externalId: $orderId . '_out',
                symbol: $fromAsset,
                type: 'swap_out',
                quantity: $fromAmount,
                priceUsd: 0,
                priceBrl: 0,
                totalUsd: 0,
                totalBrl: 0,
                feeUsd: 0,
                feeBrl: 0,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $convert,
            );

            // Operação 2: Entrada do ativo destino (swap_in)
            $operations[] = new NormalizedOperation(
                externalId: $orderId . '_in',
                symbol: $toAsset,
                type: 'swap_in',
                quantity: $toAmount,
                priceUsd: 0,
                priceBrl: 0,
                totalUsd: 0,
                totalBrl: 0,
                feeUsd: 0,
                feeBrl: 0,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $convert,
            );

        } catch (\Exception $e) {
            Log::error('Error normalizing convert trade', [
                'convert' => $convert,
                'error' => $e->getMessage(),
            ]);
        }

        return $operations;
    }

    // ========================================================================
    // DUST CONVERSIONS (Pequenos ativos convertidos para BNB)
    // ========================================================================

    /**
     * Busca conversões de dust para BNB
     * Endpoint: GET /sapi/v1/asset/dribblet
     * Weight: 1
     * Nota: API retorna apenas últimos 100 registros
     */
    public function fetchDustConversions(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allDust = collect();

        Log::info('Fetching dust conversions');

        try {
            $timestamp = $this->getServerTimestamp();
            $params = [
                'timestamp' => $timestamp,
            ];

            // Adiciona filtro de tempo se especificado
            if ($startTime) {
                $params['startTime'] = $startTime->getTimestampMs();
            }
            if ($endTime) {
                $params['endTime'] = $endTime->getTimestampMs();
            }

            $query = http_build_query($params);
            $params['signature'] = hash_hmac('sha256', $query, $apiSecret);

            $response = $this->makeRequest(15)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/sapi/v1/asset/dribblet", $params);

            if (!$response->successful()) {
                $error = $response->json();
                if (($error['code'] ?? 0) !== -1002) {
                    Log::warning('Dust conversions API error', [
                        'status' => $response->status(),
                        'error' => $error,
                    ]);
                }
                return $allDust;
            }

            $data = $response->json();
            foreach ($data['userAssetDribblets'] ?? [] as $dustEvent) {
                $normalized = $this->normalizeDustConversion($dustEvent);
                foreach ($normalized as $op) {
                    if ($op) {
                        $allDust->push($op);
                    }
                }
            }

            Log::info('Dust conversions fetched', ['count' => $allDust->count()]);

        } catch (\Exception $e) {
            Log::error('Binance fetchDustConversions error', ['error' => $e->getMessage()]);
        }

        return $allDust;
    }

    /**
     * Normaliza conversão de dust para DTOs
     * Cada evento de dust pode conter múltiplos ativos convertidos
     *
     * Campos da API:
     * - operateTime, totalTransferedAmount (BNB recebido), totalServiceChargeAmount
     * - userAssetDribbletDetails: array de ativos convertidos
     *   - fromAsset, amount, transferedAmount (BNB), serviceChargeAmount
     */
    protected function normalizeDustConversion(array $dustEvent): array
    {
        $operations = [];

        try {
            $operateTime = $dustEvent['operateTime'] ?? now()->getTimestampMs();
            $executedAt = Carbon::createFromTimestampMs($operateTime);
            $totalBnbReceived = (float) ($dustEvent['totalTransferedAmount'] ?? 0);
            $eventId = md5(json_encode($dustEvent));

            // Processa cada ativo convertido
            foreach ($dustEvent['userAssetDribbletDetails'] ?? [] as $index => $detail) {
                $fromAsset = $detail['fromAsset'] ?? '';
                $fromAmount = (float) ($detail['amount'] ?? 0);
                $bnbReceived = (float) ($detail['transferedAmount'] ?? 0);
                $fee = (float) ($detail['serviceChargeAmount'] ?? 0);

                if ($fromAmount <= 0) {
                    continue;
                }

                // Operação 1: Saída do ativo (swap_out)
                $operations[] = new NormalizedOperation(
                    externalId: $eventId . '_dust_out_' . $index,
                    symbol: $fromAsset,
                    type: 'swap_out',
                    quantity: $fromAmount,
                    priceUsd: 0,
                    priceBrl: 0,
                    totalUsd: 0,
                    totalBrl: 0,
                    feeUsd: 0,
                    feeBrl: 0,
                    executedAt: $executedAt,
                    source: 'binance_api',
                    rawData: $detail,
                );

                // Operação 2: Entrada de BNB (swap_in)
                $operations[] = new NormalizedOperation(
                    externalId: $eventId . '_dust_in_' . $index,
                    symbol: 'BNB',
                    type: 'swap_in',
                    quantity: $bnbReceived,
                    priceUsd: 0,
                    priceBrl: 0,
                    totalUsd: 0,
                    totalBrl: 0,
                    feeUsd: 0,
                    feeBrl: 0,
                    executedAt: $executedAt,
                    source: 'binance_api',
                    rawData: $detail,
                );
            }

        } catch (\Exception $e) {
            Log::error('Error normalizing dust conversion', [
                'dustEvent' => $dustEvent,
                'error' => $e->getMessage(),
            ]);
        }

        return $operations;
    }

    // ========================================================================
    // STAKING REWARDS (Rendimentos de staking)
    // ========================================================================

    /**
     * Busca registros de staking (rewards)
     * Endpoint: GET /sapi/v1/staking/stakingRecord
     * Weight: 1
     * Product types: STAKING, F_DEFI, L_DEFI
     */
    public function fetchStakingRecords(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allStaking = collect();

        $start = $startTime ?? Carbon::create(2020, 1, 1);
        $end = $endTime ?? now();

        Log::info('Fetching staking records', ['start' => $start->toDateString(), 'end' => $end->toDateString()]);

        // Buscar para cada tipo de produto
        $productTypes = ['STAKING', 'F_DEFI', 'L_DEFI'];
        $txnTypes = ['INTEREST']; // INTEREST = rewards

        foreach ($productTypes as $product) {
            foreach ($txnTypes as $txnType) {
                $records = $this->fetchStakingRecordsForProduct(
                    $apiKey, $apiSecret, $product, $txnType, $start, $end
                );
                $allStaking = $allStaking->merge($records);
                usleep(200000); // 200ms entre chamadas
            }
        }

        // Também buscar Simple Earn (novo sistema de staking)
        $simpleEarnRecords = $this->fetchSimpleEarnRewards($apiKey, $apiSecret, $start, $end);
        $allStaking = $allStaking->merge($simpleEarnRecords);

        Log::info('Staking records fetched', ['count' => $allStaking->count()]);

        return $allStaking;
    }

    /**
     * Busca staking records para um produto específico
     */
    protected function fetchStakingRecordsForProduct(
        string $apiKey,
        string $apiSecret,
        string $product,
        string $txnType,
        Carbon $startTime,
        Carbon $endTime
    ): Collection {
        $records = collect();

        try {
            $timestamp = $this->getServerTimestamp();
            $params = [
                'product' => $product,
                'txnType' => $txnType,
                'startTime' => $startTime->getTimestampMs(),
                'endTime' => $endTime->getTimestampMs(),
                'size' => 100,
                'timestamp' => $timestamp,
            ];

            $query = http_build_query($params);
            $params['signature'] = hash_hmac('sha256', $query, $apiSecret);

            $response = $this->makeRequest(15)
                ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                ->get("{$this->baseUrl}/sapi/v1/staking/stakingRecord", $params);

            if (!$response->successful()) {
                // Ignora erros silenciosamente (endpoint pode não estar disponível)
                return $records;
            }

            foreach ($response->json() ?? [] as $record) {
                $normalized = $this->normalizeStakingRecord($record);
                if ($normalized) {
                    $records->push($normalized);
                }
            }

        } catch (\Exception $e) {
            Log::error('Binance fetchStakingRecordsForProduct error', [
                'product' => $product,
                'error' => $e->getMessage(),
            ]);
        }

        return $records;
    }

    /**
     * Busca Simple Earn rewards (sistema novo de staking)
     * Endpoint: GET /sapi/v1/simple-earn/flexible/history/rewardsRecord
     */
    protected function fetchSimpleEarnRewards(
        string $apiKey,
        string $apiSecret,
        Carbon $startTime,
        Carbon $endTime
    ): Collection {
        $allRewards = collect();

        // Janela de 30 dias para Simple Earn
        $start = $startTime->copy();
        $end = $endTime;

        while ($start < $end) {
            $windowEnd = $start->copy()->addDays(29);
            if ($windowEnd > $end) {
                $windowEnd = $end;
            }

            try {
                $timestamp = $this->getServerTimestamp();
                $params = [
                    'type' => 'REWARDS',
                    'startTime' => $start->getTimestampMs(),
                    'endTime' => $windowEnd->getTimestampMs(),
                    'size' => 100,
                    'timestamp' => $timestamp,
                ];

                $query = http_build_query($params);
                $params['signature'] = hash_hmac('sha256', $query, $apiSecret);

                $response = $this->makeRequest(15)
                    ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                    ->get("{$this->baseUrl}/sapi/v1/simple-earn/flexible/history/rewardsRecord", $params);

                if ($response->successful()) {
                    $data = $response->json();
                    foreach ($data['rows'] ?? [] as $record) {
                        $normalized = $this->normalizeSimpleEarnReward($record);
                        if ($normalized) {
                            $allRewards->push($normalized);
                        }
                    }
                }

            } catch (\Exception $e) {
                // Ignora erros silenciosamente
            }

            $start = $windowEnd->copy()->addDay();
            usleep(200000);
        }

        return $allRewards;
    }

    /**
     * Normaliza registro de staking para DTO
     *
     * Campos da API:
     * - positionId, time, asset, amount, status
     */
    protected function normalizeStakingRecord(array $record): ?NormalizedOperation
    {
        try {
            $asset = $record['asset'] ?? '';
            $amount = (float) ($record['amount'] ?? 0);

            if ($amount <= 0) {
                return null;
            }

            $executedAt = isset($record['time'])
                ? Carbon::createFromTimestampMs($record['time'])
                : now();

            return new NormalizedOperation(
                externalId: ($record['positionId'] ?? '') . '_staking_' . $record['time'],
                symbol: $asset,
                type: 'staking',
                quantity: $amount,
                priceUsd: 0,
                priceBrl: 0,
                totalUsd: 0,
                totalBrl: 0,
                feeUsd: 0,
                feeBrl: 0,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $record,
            );

        } catch (\Exception $e) {
            Log::error('Error normalizing staking record', [
                'record' => $record,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Normaliza Simple Earn reward para DTO
     *
     * Campos da API:
     * - asset, rewards, time, projectId
     */
    protected function normalizeSimpleEarnReward(array $record): ?NormalizedOperation
    {
        try {
            $asset = $record['asset'] ?? '';
            $amount = (float) ($record['rewards'] ?? 0);

            if ($amount <= 0) {
                return null;
            }

            $executedAt = isset($record['time'])
                ? Carbon::createFromTimestampMs($record['time'])
                : now();

            return new NormalizedOperation(
                externalId: 'simple_earn_' . ($record['projectId'] ?? '') . '_' . $record['time'],
                symbol: $asset,
                type: 'staking',
                quantity: $amount,
                priceUsd: 0,
                priceBrl: 0,
                totalUsd: 0,
                totalBrl: 0,
                feeUsd: 0,
                feeBrl: 0,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $record,
            );

        } catch (\Exception $e) {
            Log::error('Error normalizing simple earn reward', [
                'record' => $record,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    // ========================================================================
    // DIVIDENDS / DISTRIBUTIONS (Airdrops, dividendos, etc)
    // ========================================================================

    /**
     * Busca distribuições de ativos (airdrops, dividendos, etc)
     * Endpoint: GET /sapi/v1/asset/assetDividend
     * Weight: 10
     */
    public function fetchDividends(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection {
        $allDividends = collect();

        $start = $startTime ?? Carbon::create(2020, 1, 1);
        $end = $endTime ?? now();

        Log::info('Fetching dividends/distributions', ['start' => $start->toDateString(), 'end' => $end->toDateString()]);

        // Janela de 90 dias
        while ($start < $end) {
            $windowEnd = $start->copy()->addDays(89);
            if ($windowEnd > $end) {
                $windowEnd = $end;
            }

            try {
                $timestamp = $this->getServerTimestamp();
                $params = [
                    'startTime' => $start->getTimestampMs(),
                    'endTime' => $windowEnd->getTimestampMs(),
                    'limit' => 500,
                    'timestamp' => $timestamp,
                ];

                $query = http_build_query($params);
                $params['signature'] = hash_hmac('sha256', $query, $apiSecret);

                $response = $this->makeRequest(15)
                    ->withHeaders(['X-MBX-APIKEY' => $apiKey])
                    ->get("{$this->baseUrl}/sapi/v1/asset/assetDividend", $params);

                if ($response->successful()) {
                    $data = $response->json();
                    foreach ($data['rows'] ?? [] as $dividend) {
                        $normalized = $this->normalizeDividend($dividend);
                        if ($normalized) {
                            $allDividends->push($normalized);
                        }
                    }
                }

            } catch (\Exception $e) {
                Log::error('Binance fetchDividends error', ['error' => $e->getMessage()]);
            }

            $start = $windowEnd->copy()->addDay();
            usleep(200000);
        }

        Log::info('Dividends fetched', ['count' => $allDividends->count()]);

        return $allDividends;
    }

    /**
     * Normaliza dividend/airdrop para DTO
     *
     * Campos da API:
     * - id, divTime, asset, amount, tranId, enInfo
     */
    protected function normalizeDividend(array $dividend): ?NormalizedOperation
    {
        try {
            $asset = $dividend['asset'] ?? '';
            $amount = (float) ($dividend['amount'] ?? 0);

            if ($amount <= 0) {
                return null;
            }

            $executedAt = isset($dividend['divTime'])
                ? Carbon::createFromTimestampMs($dividend['divTime'])
                : now();

            // Determina tipo baseado na descrição
            $info = strtolower($dividend['enInfo'] ?? '');
            $type = 'airdrop';
            if (str_contains($info, 'staking') || str_contains($info, 'interest')) {
                $type = 'staking';
            }

            return new NormalizedOperation(
                externalId: 'dividend_' . ($dividend['id'] ?? $dividend['tranId'] ?? md5(json_encode($dividend))),
                symbol: $asset,
                type: $type,
                quantity: $amount,
                priceUsd: 0,
                priceBrl: 0,
                totalUsd: 0,
                totalBrl: 0,
                feeUsd: 0,
                feeBrl: 0,
                executedAt: $executedAt,
                source: 'binance_api',
                rawData: $dividend,
            );

        } catch (\Exception $e) {
            Log::error('Error normalizing dividend', [
                'dividend' => $dividend,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }
}
