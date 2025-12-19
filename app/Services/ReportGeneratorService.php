<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ReportGeneratorService
{
    protected CapitalGainService $capitalGainService;
    protected TaxCalculationService $taxCalculationService;

    public function __construct(
        CapitalGainService $capitalGainService,
        TaxCalculationService $taxCalculationService
    ) {
        $this->capitalGainService = $capitalGainService;
        $this->taxCalculationService = $taxCalculationService;
    }

    /**
     * Gera relatório mensal completo
     */
    public function generateMonthlyReport(User $user, string $yearMonth): array
    {
        $startDate = $yearMonth . '-01';
        $endDate = date('Y-m-t', strtotime($startDate)) . ' 23:59:59';

        // Operações do mês
        $operations = $user->operations()
            ->whereBetween('executed_at', [$startDate, $endDate])
            ->with(['wallet', 'asset'])
            ->orderBy('executed_at')
            ->get();

        // Ganho de capital
        $capitalGain = $this->capitalGainService->getMonthlyCapitalGain($user, $yearMonth);

        // Resumo por tipo de operação
        $byType = $operations->groupBy('type')->map(function ($ops, $type) {
            return [
                'type' => $type,
                'count' => $ops->count(),
                'total_brl' => $ops->sum('total_brl'),
                'total_quantity' => $ops->sum('quantity'),
            ];
        });

        // Resumo por ativo
        $byAsset = $operations->groupBy('asset_id')->map(function ($ops) {
            $asset = $ops->first()->asset;
            return [
                'symbol' => $asset->symbol,
                'name' => $asset->name,
                'bought' => $ops->whereIn('type', ['buy', 'swap_in'])->sum('quantity'),
                'sold' => $ops->whereIn('type', ['sell', 'swap_out'])->sum('quantity'),
                'total_brl' => $ops->sum('total_brl'),
            ];
        });

        // Carteiras utilizadas
        $wallets = $operations->groupBy('wallet_id')->map(function ($ops) {
            $wallet = $ops->first()->wallet;
            return [
                'name' => $wallet->name,
                'exchange' => $wallet->exchange?->name,
                'operations_count' => $ops->count(),
                'volume' => $ops->sum('total_brl'),
            ];
        });

        // Posição final do mês
        $assets = $user->assets()
            ->where('quantity', '>', 0)
            ->get()
            ->map(function ($asset) {
                return [
                    'symbol' => $asset->symbol,
                    'name' => $asset->name,
                    'quantity' => $asset->quantity,
                    'average_price' => $asset->average_price_brl,
                    'total_value' => $asset->total_brl,
                ];
            });

        return [
            'period' => [
                'year_month' => $yearMonth,
                'start_date' => $startDate,
                'end_date' => date('Y-m-t', strtotime($startDate)),
            ],
            'summary' => [
                'total_operations' => $operations->count(),
                'total_buys' => $byType->get('buy')['total_brl'] ?? 0,
                'total_sells' => $byType->get('sell')['total_brl'] ?? 0,
                'total_fees' => $operations->sum('fee_brl'),
            ],
            'capital_gain' => $capitalGain,
            'by_type' => $byType->values(),
            'by_asset' => $byAsset->values(),
            'wallets' => $wallets->values(),
            'assets_position' => $assets,
            'total_patrimony' => $assets->sum('total_value'),
            'generated_at' => now()->toISOString(),
        ];
    }

    /**
     * Gera relatório anual completo
     */
    public function generateAnnualReport(User $user, int $year): array
    {
        $monthlyReports = [];
        $totalOperations = 0;
        $totalBuys = 0;
        $totalSells = 0;
        $totalFees = 0;

        // Gerar relatório para cada mês
        for ($month = 1; $month <= 12; $month++) {
            $yearMonth = sprintf('%04d-%02d', $year, $month);
            $monthlyReport = $this->generateMonthlyReport($user, $yearMonth);

            $monthlyReports[$yearMonth] = $monthlyReport;
            $totalOperations += $monthlyReport['summary']['total_operations'];
            $totalBuys += $monthlyReport['summary']['total_buys'];
            $totalSells += $monthlyReport['summary']['total_sells'];
            $totalFees += $monthlyReport['summary']['total_fees'];
        }

        // Ganho de capital anual
        $annualCapitalGain = $this->capitalGainService->getAnnualCapitalGain($user, $year);

        // Obrigações fiscais
        $taxObligations = $this->taxCalculationService->calculateAnnualObligations($user, $year);

        return [
            'year' => $year,
            'summary' => [
                'total_operations' => $totalOperations,
                'total_buys' => $totalBuys,
                'total_sells' => $totalSells,
                'total_fees' => $totalFees,
                'net_flow' => $totalBuys - $totalSells,
            ],
            'capital_gain' => $annualCapitalGain,
            'tax_obligations' => $taxObligations,
            'monthly' => $monthlyReports,
            'generated_at' => now()->toISOString(),
        ];
    }

    /**
     * Gera relatório para IN 1888
     */
    public function generateIN1888Report(User $user, string $yearMonth): array
    {
        $startDate = $yearMonth . '-01';
        $endDate = date('Y-m-t', strtotime($startDate)) . ' 23:59:59';

        // Buscar todas as operações do mês
        $operations = $user->operations()
            ->whereBetween('executed_at', [$startDate, $endDate])
            ->with(['wallet.exchange', 'asset'])
            ->orderBy('executed_at')
            ->get();

        // Formatar para o padrão da Receita Federal
        $formattedOperations = $operations->map(function ($op) {
            return [
                'data' => $op->executed_at->format('d/m/Y'),
                'tipo_operacao' => $this->mapOperationType($op->type),
                'moeda_referencia' => $op->asset->symbol,
                'quantidade' => number_format($op->quantity, 8, ',', ''),
                'valor_unitario' => number_format($op->price_brl, 2, ',', ''),
                'valor_total' => number_format($op->total_brl, 2, ',', ''),
                'exchange' => $op->wallet->exchange?->name ?? 'Manual',
                'cnpj_exchange' => $op->wallet->exchange?->cnpj ?? '',
            ];
        });

        // Resumo por tipo
        $resumo = [
            'compras' => $operations->where('type', 'buy')->sum('total_brl'),
            'vendas' => $operations->where('type', 'sell')->sum('total_brl'),
            'permutas' => $operations->whereIn('type', ['swap_in', 'swap_out'])->sum('total_brl'),
            'transferencias' => $operations->whereIn('type', ['transfer_in', 'transfer_out', 'deposit', 'withdrawal'])->sum('total_brl'),
        ];

        return [
            'declarante' => [
                'cpf' => $user->document,
                'nome' => $user->name,
            ],
            'periodo' => [
                'mes_referencia' => $yearMonth,
                'ano' => substr($yearMonth, 0, 4),
                'mes' => substr($yearMonth, 5, 2),
            ],
            'resumo' => $resumo,
            'total_operacoes' => $operations->count(),
            'operacoes' => $formattedOperations,
            'prazo_entrega' => $this->getIN1888Deadline($yearMonth),
            'generated_at' => now()->toISOString(),
        ];
    }

    /**
     * Gera relatório GCAP
     */
    public function generateGCAPReport(User $user, string $yearMonth): array
    {
        $capitalGainReport = $this->capitalGainService->generateReport($user, $yearMonth);
        $darf = $this->taxCalculationService->generateDARF($user, $yearMonth);

        return [
            'declarante' => [
                'cpf' => $user->document,
                'nome' => $user->name,
            ],
            'periodo' => [
                'mes_referencia' => $yearMonth,
            ],
            'capital_gain' => $capitalGainReport,
            'darf' => $darf,
            'generated_at' => now()->toISOString(),
        ];
    }

    /**
     * Gera relatório para IRPF
     */
    public function generateIRPFReport(User $user, int $year): array
    {
        // Bens e Direitos (posição em 31/12)
        $assets = $user->assets()
            ->where('total_brl', '>', 0)
            ->get()
            ->map(function ($asset) use ($year) {
                return [
                    'grupo' => '08', // Criptoativos
                    'codigo' => $this->getIRPFCode($asset->symbol),
                    'discriminacao' => $this->formatIRPFDescription($asset, $year),
                    'situacao_anterior' => 0, // TODO: Buscar do ano anterior
                    'situacao_atual' => $asset->total_cost_brl, // Usar custo de aquisição
                ];
            });

        // Ganhos de Capital
        $annualGains = $this->capitalGainService->getAnnualCapitalGain($user, $year);

        // Rendimentos Isentos (vendas até R$ 35k/mês)
        $exemptIncome = collect($annualGains['monthly'])
            ->filter(fn ($m) => $m['is_exempt'] && $m['total_profit_loss'] > 0)
            ->sum('total_profit_loss');

        // Rendimentos Tributáveis
        $taxableIncome = collect($annualGains['monthly'])
            ->filter(fn ($m) => !$m['is_exempt'] && $m['total_profit_loss'] > 0)
            ->sum('total_profit_loss');

        return [
            'declarante' => [
                'cpf' => $user->document,
                'nome' => $user->name,
            ],
            'ano_calendario' => $year,
            'ano_exercicio' => $year + 1,
            'bens_e_direitos' => $assets,
            'total_patrimonio' => $assets->sum('situacao_atual'),
            'rendimentos' => [
                'isentos' => [
                    'total' => $exemptIncome,
                    'descricao' => 'Ganhos em alienação de bens de pequeno valor (art. 22 Lei 9.250/95)',
                ],
                'tributaveis' => [
                    'total' => $taxableIncome,
                    'imposto_pago' => $annualGains['total_tax_due'],
                ],
            ],
            'ganhos_capital' => $annualGains,
            'generated_at' => now()->toISOString(),
        ];
    }

    /**
     * Exporta relatório para CSV
     */
    public function exportToCSV(array $data, string $type): string
    {
        $filename = $type . '_' . now()->format('Y-m-d_His') . '.csv';
        $path = 'exports/' . $filename;

        $csv = '';

        // Gerar CSV baseado no tipo
        switch ($type) {
            case 'operations':
                $csv = $this->operationsToCSV($data);
                break;
            case 'in1888':
                $csv = $this->in1888ToCSV($data);
                break;
            case 'irpf':
                $csv = $this->irpfToCSV($data);
                break;
            default:
                $csv = json_encode($data, JSON_PRETTY_PRINT);
        }

        Storage::disk('local')->put($path, $csv);

        return Storage::disk('local')->path($path);
    }

    /**
     * Converte operações para CSV
     */
    protected function operationsToCSV(array $data): string
    {
        $csv = "Data;Tipo;Ativo;Quantidade;Preco;Total;Taxa;Carteira\n";

        foreach ($data['operacoes'] ?? [] as $op) {
            $csv .= sprintf(
                "%s;%s;%s;%s;%s;%s;%s;%s\n",
                $op['data'],
                $op['tipo_operacao'],
                $op['moeda_referencia'],
                $op['quantidade'],
                $op['valor_unitario'],
                $op['valor_total'],
                '0',
                $op['exchange']
            );
        }

        return $csv;
    }

    /**
     * Converte IN 1888 para CSV
     */
    protected function in1888ToCSV(array $data): string
    {
        $csv = "Data;Tipo Operacao;Moeda;Quantidade;Valor Unitario;Valor Total;Exchange;CNPJ Exchange\n";

        foreach ($data['operacoes'] ?? [] as $op) {
            $csv .= sprintf(
                "%s;%s;%s;%s;%s;%s;%s;%s\n",
                $op['data'],
                $op['tipo_operacao'],
                $op['moeda_referencia'],
                $op['quantidade'],
                $op['valor_unitario'],
                $op['valor_total'],
                $op['exchange'],
                $op['cnpj_exchange']
            );
        }

        return $csv;
    }

    /**
     * Converte IRPF para CSV
     */
    protected function irpfToCSV(array $data): string
    {
        $csv = "Grupo;Codigo;Discriminacao;Situacao Anterior;Situacao Atual\n";

        foreach ($data['bens_e_direitos'] ?? [] as $bem) {
            $csv .= sprintf(
                "%s;%s;%s;%s;%s\n",
                $bem['grupo'],
                $bem['codigo'],
                str_replace(';', ',', $bem['discriminacao']),
                number_format($bem['situacao_anterior'], 2, ',', ''),
                number_format($bem['situacao_atual'], 2, ',', '')
            );
        }

        return $csv;
    }

    /**
     * Mapeia tipo de operação para IN 1888
     */
    protected function mapOperationType(string $type): string
    {
        return match ($type) {
            'buy' => 'Compra',
            'sell' => 'Venda',
            'swap_in', 'swap_out' => 'Permuta',
            'deposit' => 'Deposito',
            'withdrawal' => 'Saque',
            'transfer_in' => 'Transferencia Entrada',
            'transfer_out' => 'Transferencia Saida',
            default => 'Outros',
        };
    }

    /**
     * Retorna código IRPF do ativo
     */
    protected function getIRPFCode(string $symbol): string
    {
        return match (strtoupper($symbol)) {
            'BTC' => '01',
            'ETH', 'SOL', 'ADA', 'DOT', 'AVAX', 'MATIC' => '02',
            'USDT', 'USDC', 'BUSD', 'DAI' => '03',
            default => '99',
        };
    }

    /**
     * Formata descrição para IRPF
     */
    protected function formatIRPFDescription(object $asset, int $year): string
    {
        return sprintf(
            '%s %s (%s) custodiado em carteira digital. ' .
            'Custo médio de aquisição: R$ %s por unidade. ' .
            'Posição em 31/12/%d.',
            number_format($asset->quantity, 8, ',', '.'),
            $asset->name,
            $asset->symbol,
            number_format($asset->average_price_brl, 2, ',', '.'),
            $year
        );
    }

    /**
     * Retorna prazo IN 1888
     */
    protected function getIN1888Deadline(string $yearMonth): string
    {
        $date = \Carbon\Carbon::createFromFormat('Y-m', $yearMonth);
        $nextMonth = $date->addMonth();
        $lastDay = $nextMonth->endOfMonth();

        while ($lastDay->isWeekend()) {
            $lastDay->subDay();
        }

        return $lastDay->format('d/m/Y');
    }
}
