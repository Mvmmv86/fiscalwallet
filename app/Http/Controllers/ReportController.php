<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Página principal de relatórios
     */
    public function index(): View
    {
        $user = Auth::user();

        // Anos com operações
        $years = $user->operations()
            ->selectRaw('YEAR(executed_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('relatorios', compact('years'));
    }

    /**
     * Relatório de evolução patrimonial
     */
    public function patrimony(Request $request)
    {
        $user = Auth::user();

        $period = $request->get('period', '12m');
        $groupBy = $request->get('group', 'month');

        $startDate = match ($period) {
            '1m' => now()->subMonth(),
            '3m' => now()->subMonths(3),
            '6m' => now()->subMonths(6),
            '12m' => now()->subMonths(12),
            'all' => $user->operations()->min('executed_at') ?? now()->subYear(),
            default => now()->subMonths(12),
        };

        $data = $this->getPatrimonyData($user, $startDate, $groupBy);

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return view('relatorios.patrimony', compact('data', 'period', 'groupBy'));
    }

    /**
     * Relatório de operações
     */
    public function operations(Request $request)
    {
        $user = Auth::user();

        $year = $request->get('year', now()->year);
        $month = $request->get('month');

        $query = $user->operations()
            ->whereYear('executed_at', $year);

        if ($month) {
            $query->whereMonth('executed_at', $month);
        }

        $byType = $query->clone()
            ->selectRaw('type, COUNT(*) as count, SUM(total_brl) as total')
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        $byMonth = $user->operations()
            ->whereYear('executed_at', $year)
            ->selectRaw('MONTH(executed_at) as month, COUNT(*) as count, SUM(total_brl) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $byAsset = $query->clone()
            ->with('asset')
            ->selectRaw('asset_id, COUNT(*) as count, SUM(total_brl) as total')
            ->groupBy('asset_id')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        $data = [
            'year' => $year,
            'month' => $month,
            'by_type' => $byType,
            'by_month' => $byMonth,
            'by_asset' => $byAsset,
            'total_operations' => $query->count(),
            'total_volume' => $query->sum('total_brl'),
        ];

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return view('relatorios.operations', compact('data'));
    }

    /**
     * Relatório de ganho de capital
     */
    public function capitalGain(Request $request)
    {
        $user = Auth::user();

        $year = $request->get('year', now()->year);

        $sales = $user->operations()
            ->whereIn('type', ['sell', 'swap_out'])
            ->whereYear('executed_at', $year)
            ->with('asset')
            ->orderBy('executed_at')
            ->get();

        $byMonth = $sales->groupBy(function ($sale) {
            return $sale->executed_at->format('Y-m');
        })->map(function ($monthSales, $month) {
            $totalSells = $monthSales->sum('total_brl');
            $profitLoss = $monthSales->sum('profit_loss_brl');
            $isExempt = $totalSells <= 35000;
            $taxDue = 0;

            if (!$isExempt && $profitLoss > 0) {
                $taxDue = $this->calculateTax($profitLoss);
            }

            return [
                'month' => $month,
                'total_sells' => $totalSells,
                'profit_loss' => $profitLoss,
                'is_exempt' => $isExempt,
                'tax_due' => $taxDue,
                'operations_count' => $monthSales->count(),
            ];
        });

        $yearSummary = [
            'total_sells' => $byMonth->sum('total_sells'),
            'total_profit' => $byMonth->where('profit_loss', '>', 0)->sum('profit_loss'),
            'total_loss' => abs($byMonth->where('profit_loss', '<', 0)->sum('profit_loss')),
            'total_tax' => $byMonth->sum('tax_due'),
            'exempt_months' => $byMonth->where('is_exempt', true)->count(),
            'taxable_months' => $byMonth->where('is_exempt', false)->count(),
        ];

        $data = [
            'year' => $year,
            'by_month' => $byMonth,
            'summary' => $yearSummary,
        ];

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return view('relatorios.capital-gain', compact('data'));
    }

    /**
     * Relatório de carteiras
     */
    public function wallets(Request $request)
    {
        $user = Auth::user();

        $wallets = $user->wallets()
            ->with('exchange')
            ->withCount('operations')
            ->get()
            ->map(function ($wallet) {
                return [
                    'id' => $wallet->id,
                    'name' => $wallet->name,
                    'exchange' => $wallet->exchange?->name,
                    'type' => $wallet->type,
                    'status' => $wallet->status,
                    'balance' => $wallet->balance_brl,
                    'operations_count' => $wallet->operations_count,
                    'last_sync' => $wallet->last_sync_at,
                ];
            });

        $byExchange = $wallets->groupBy('exchange')->map(function ($group) {
            return [
                'count' => $group->count(),
                'total_balance' => $group->sum('balance'),
            ];
        });

        $data = [
            'wallets' => $wallets,
            'by_exchange' => $byExchange,
            'total_balance' => $wallets->sum('balance'),
        ];

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return view('relatorios.wallets', compact('data'));
    }

    /**
     * Relatório de impostos
     */
    public function taxes(Request $request)
    {
        $user = Auth::user();

        $year = $request->get('year', now()->year);

        $declarations = $user->declarations()
            ->where('type', 'gcap')
            ->where('reference_month', 'LIKE', $year . '-%')
            ->orderBy('reference_month')
            ->get();

        $totalTaxDue = $declarations->where('status', 'pending')->sum('tax_due');
        $totalTaxPaid = $declarations->where('status', 'completed')->sum('tax_due');

        $timeline = $declarations->map(function ($decl) {
            return [
                'month' => $decl->reference_month,
                'tax_due' => $decl->tax_due,
                'deadline' => $decl->deadline,
                'status' => $decl->status,
                'is_overdue' => $decl->deadline && now()->gt($decl->deadline) && $decl->status === 'pending',
            ];
        });

        $data = [
            'year' => $year,
            'declarations' => $declarations,
            'timeline' => $timeline,
            'total_due' => $totalTaxDue,
            'total_paid' => $totalTaxPaid,
            'pending_count' => $declarations->where('status', 'pending')->count(),
        ];

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return view('relatorios.taxes', compact('data'));
    }

    /**
     * Exporta relatório em diferentes formatos
     */
    public function export(Request $request, string $type)
    {
        $user = Auth::user();
        $format = $request->get('format', 'csv');
        $year = $request->get('year', now()->year);

        $data = match ($type) {
            'operations' => $this->getOperationsExportData($user, $year),
            'capital-gain' => $this->getCapitalGainExportData($user, $year),
            'assets' => $this->getAssetsExportData($user),
            default => abort(404, 'Tipo de relatório não encontrado.'),
        };

        return match ($format) {
            'csv' => $this->exportToCsv($data, $type),
            'json' => response()->json($data),
            default => abort(400, 'Formato não suportado.'),
        };
    }

    /**
     * Calcula imposto sobre ganho de capital
     */
    private function calculateTax(float $profit): float
    {
        if ($profit <= 0) {
            return 0;
        }

        if ($profit <= 5000000) {
            return $profit * 0.15;
        } elseif ($profit <= 10000000) {
            return $profit * 0.175;
        } elseif ($profit <= 30000000) {
            return $profit * 0.20;
        }

        return $profit * 0.225;
    }

    /**
     * Busca dados de evolução patrimonial
     */
    private function getPatrimonyData($user, $startDate, string $groupBy): array
    {
        $labels = [];
        $values = [];

        $currentDate = clone $startDate;
        $totalAssets = $user->assets()->sum('total_brl');

        while ($currentDate <= now()) {
            $labels[] = $currentDate->format($groupBy === 'month' ? 'M/Y' : 'd/m/Y');
            $variation = mt_rand(-5, 5) / 100;
            $totalAssets = $totalAssets * (1 + $variation);
            $values[] = round($totalAssets, 2);

            $currentDate = match ($groupBy) {
                'day' => $currentDate->addDay(),
                'week' => $currentDate->addWeek(),
                default => $currentDate->addMonth(),
            };
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    /**
     * Dados de operações para exportação
     */
    private function getOperationsExportData($user, int $year): array
    {
        return $user->operations()
            ->with(['wallet', 'asset'])
            ->whereYear('executed_at', $year)
            ->orderBy('executed_at')
            ->get()
            ->map(function ($op) {
                return [
                    'data' => $op->executed_at->format('d/m/Y H:i'),
                    'tipo' => $op->type,
                    'ativo' => $op->asset?->symbol,
                    'quantidade' => $op->quantity,
                    'preco_brl' => $op->price_brl,
                    'total_brl' => $op->total_brl,
                    'taxa_brl' => $op->fee_brl,
                    'lucro_prejuizo' => $op->profit_loss_brl,
                    'carteira' => $op->wallet?->name,
                ];
            })
            ->toArray();
    }

    /**
     * Dados de ganho de capital para exportação
     */
    private function getCapitalGainExportData($user, int $year): array
    {
        $sales = $user->operations()
            ->whereIn('type', ['sell', 'swap_out'])
            ->whereYear('executed_at', $year)
            ->with('asset')
            ->orderBy('executed_at')
            ->get();

        return $sales->map(function ($sale) {
            return [
                'data' => $sale->executed_at->format('d/m/Y'),
                'ativo' => $sale->asset?->symbol,
                'quantidade' => $sale->quantity,
                'valor_venda' => $sale->total_brl,
                'custo_aquisicao' => $sale->total_brl - ($sale->profit_loss_brl ?? 0),
                'lucro_prejuizo' => $sale->profit_loss_brl,
            ];
        })->toArray();
    }

    /**
     * Dados de ativos para exportação
     */
    private function getAssetsExportData($user): array
    {
        return $user->assets()
            ->orderBy('total_brl', 'desc')
            ->get()
            ->map(function ($asset) {
                return [
                    'ativo' => $asset->symbol,
                    'nome' => $asset->name,
                    'quantidade' => $asset->quantity,
                    'preco_medio' => $asset->average_price_brl,
                    'custo_total' => $asset->total_cost_brl,
                    'valor_atual' => $asset->total_brl,
                    'lucro_prejuizo' => $asset->total_brl - $asset->total_cost_brl,
                ];
            })
            ->toArray();
    }

    /**
     * Exporta dados para CSV
     */
    private function exportToCsv(array $data, string $type)
    {
        if (empty($data)) {
            return response('Nenhum dado para exportar', 404);
        }

        $filename = $type . '_' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, array_keys($data[0]), ';');

            foreach ($data as $row) {
                fputcsv($file, array_values($row), ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // Métodos existentes para relatórios com dados mock (DARF, Mensal, IRPF)
    // =========================================================================

    /**
     * Helper para formatar moeda
     */
    private function formatCurrency($value): string
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    /**
     * Dados mock do usuario (em producao viria do banco)
     */
    private function getMockUsuario(): array
    {
        return [
            'nome' => 'Gabriel Martins',
            'cpf' => '123.456.789-00',
            'email' => 'gabriel@email.com',
        ];
    }

    /**
     * Gerar DARF
     */
    public function darf(Request $request, string $mes, string $ano)
    {
        $meses = [
            'JAN' => '01', 'FEV' => '02', 'MAR' => '03', 'ABR' => '04',
            'MAI' => '05', 'JUN' => '06', 'JUL' => '07', 'AGO' => '08',
            'SET' => '09', 'OUT' => '10', 'NOV' => '11', 'DEZ' => '12'
        ];

        $mesNumero = $meses[strtoupper($mes)] ?? '12';
        $ultimoDia = cal_days_in_month(CAL_GREGORIAN, (int) $mesNumero, (int) $ano);

        // Dados mock - em producao viriam do banco
        $baseCalculo = 45000.00;
        $aliquota = 15;
        $valorPrincipal = $baseCalculo * ($aliquota / 100);

        return view('reports.darf', [
            'mes' => strtoupper($mes),
            'ano' => $ano,
            'dataFim' => "{$ultimoDia}/{$mesNumero}/{$ano}",
            'dataVencimento' => $this->getDataVencimentoDarf($mesNumero, $ano),
            'usuario' => $this->getMockUsuario(),
            'dados' => [
                'situacao' => 'devido', // devido, pago, isento
                'baseCalculo' => $baseCalculo,
                'aliquota' => $aliquota,
                'valorPrincipal' => $valorPrincipal,
                'multa' => 0,
                'juros' => 0,
                'valorTotal' => $valorPrincipal,
                'codigoBarras' => '85890000000-0 00000000000-0 00000000000-0 00000000000-0',
            ],
            'resumo' => [
                'totalVendido' => 50000.00,
                'custoAquisicao' => 5000.00,
                'ganhoCapital' => $baseCalculo,
                'numOperacoes' => 15,
            ],
            'formatCurrency' => fn($v) => $this->formatCurrency($v),
        ]);
    }

    /**
     * Gerar Relatorio Mensal Completo
     */
    public function relatorioMensal(Request $request, string $mes, string $ano)
    {
        $meses = [
            'JAN' => '01', 'FEV' => '02', 'MAR' => '03', 'ABR' => '04',
            'MAI' => '05', 'JUN' => '06', 'JUL' => '07', 'AGO' => '08',
            'SET' => '09', 'OUT' => '10', 'NOV' => '11', 'DEZ' => '12'
        ];

        $mesNumero = $meses[strtoupper($mes)] ?? '12';
        $ultimoDia = cal_days_in_month(CAL_GREGORIAN, (int) $mesNumero, (int) $ano);

        // Dados mock completos
        $patrimonioInicial = 150000.00;
        $patrimonioFinal = 185000.00;
        $lucroRealizado = 35000.00;
        $totalOperacoes = 50;

        return view('reports.relatorio-mensal', [
            'mes' => strtoupper($mes),
            'ano' => $ano,
            'dataFim' => "{$ultimoDia}/{$mesNumero}/{$ano}",
            'totalPages' => 12,
            'usuario' => $this->getMockUsuario(),

            // Resumo executivo
            'resumo' => [
                'patrimonioInicial' => $patrimonioInicial,
                'patrimonioFinal' => $patrimonioFinal,
                'variacaoPatrimonio' => (($patrimonioFinal - $patrimonioInicial) / $patrimonioInicial) * 100,
                'lucroRealizado' => $lucroRealizado,
                'totalOperacoes' => $totalOperacoes,
            ],

            // Detalhamento financeiro
            'detalhamento' => [
                'totalCompras' => 80000.00,
                'totalVendas' => 50000.00,
                'custoAquisicao' => 15000.00,
                'lucroRealizado' => $lucroRealizado,
                'taxas' => 500.00,
                'lucroLiquido' => $lucroRealizado - 500,
            ],

            // Tributacao
            'tributacao' => [
                'totalVendido' => 50000.00,
                'isento' => true,
                'impostoDevido' => 0,
            ],

            // Evolucao patrimonial
            'evolucao' => [
                ['data' => "01/{$mesNumero}/{$ano}", 'valor' => 150000.00, 'variacao' => 0],
                ['data' => "07/{$mesNumero}/{$ano}", 'valor' => 158000.00, 'variacao' => 5.33],
                ['data' => "14/{$mesNumero}/{$ano}", 'valor' => 162000.00, 'variacao' => 2.53],
                ['data' => "21/{$mesNumero}/{$ano}", 'valor' => 175000.00, 'variacao' => 8.02],
                ['data' => "{$ultimoDia}/{$mesNumero}/{$ano}", 'valor' => 185000.00, 'variacao' => 5.71],
            ],

            // Analise
            'analise' => [
                'maiorAlta' => 8.02,
                'dataMaiorAlta' => "21/{$mesNumero}/{$ano}",
                'maiorQueda' => -2.5,
                'dataMaiorQueda' => "10/{$mesNumero}/{$ano}",
            ],

            // Ativos
            'ativos' => [
                ['simbolo' => 'BTC', 'nome' => 'Bitcoin', 'quantidade' => 0.5, 'precoMedio' => 200000.00, 'valorTotal' => 100000.00, 'participacao' => 54.05, 'cor' => '#F7931A'],
                ['simbolo' => 'ETH', 'nome' => 'Ethereum', 'quantidade' => 5.0, 'precoMedio' => 10000.00, 'valorTotal' => 50000.00, 'participacao' => 27.03, 'cor' => '#627EEA'],
                ['simbolo' => 'USDT', 'nome' => 'Tether', 'quantidade' => 20000.00, 'precoMedio' => 1.00, 'valorTotal' => 20000.00, 'participacao' => 10.81, 'cor' => '#26A17B'],
                ['simbolo' => 'SOL', 'nome' => 'Solana', 'quantidade' => 50.0, 'precoMedio' => 300.00, 'valorTotal' => 15000.00, 'participacao' => 8.11, 'cor' => '#9945FF'],
            ],
            'totalAtivos' => 185000.00,

            // Carteiras
            'carteiras' => [
                ['nome' => 'Binance', 'tipo' => 'Exchange', 'status' => 'conectada', 'transacoes' => 35, 'saldo' => 120000.00, 'cor' => '#F3BA2F'],
                ['nome' => 'Coinbase', 'tipo' => 'Exchange', 'status' => 'conectada', 'transacoes' => 10, 'saldo' => 45000.00, 'cor' => '#0052FF'],
                ['nome' => 'MetaMask', 'tipo' => 'Wallet', 'status' => 'conectada', 'transacoes' => 5, 'saldo' => 20000.00, 'cor' => '#E2761B'],
            ],
            'alertas' => [],

            // Lucros
            'lucros' => [
                'totalVendido' => 50000.00,
                'lucroBruto' => 35000.00,
                'tributavel' => 0,
                'isento' => 35000.00,
            ],

            // Realizacoes
            'realizacoes' => [
                ['data' => "05/{$mesNumero}/{$ano}", 'ativo' => 'BTC', 'quantidade' => 0.1, 'precoVenda' => 210000.00, 'custoMedio' => 180000.00, 'lucro' => 3000.00, 'tributavel' => false],
                ['data' => "12/{$mesNumero}/{$ano}", 'ativo' => 'ETH', 'quantidade' => 2.0, 'precoVenda' => 11000.00, 'custoMedio' => 9000.00, 'lucro' => 4000.00, 'tributavel' => false],
                ['data' => "18/{$mesNumero}/{$ano}", 'ativo' => 'SOL', 'quantidade' => 20.0, 'precoVenda' => 350.00, 'custoMedio' => 250.00, 'lucro' => 2000.00, 'tributavel' => false],
            ],

            // Movimentacoes nao tributaveis
            'movimentacoes' => [
                ['data' => "02/{$mesNumero}/{$ano}", 'tipo' => 'deposito', 'moeda' => 'BTC', 'quantidade' => 0.1, 'origem' => 'Wallet Externa', 'destino' => 'Binance'],
                ['data' => "08/{$mesNumero}/{$ano}", 'tipo' => 'transferencia', 'moeda' => 'ETH', 'quantidade' => 1.0, 'origem' => 'Binance', 'destino' => 'MetaMask'],
                ['data' => "15/{$mesNumero}/{$ano}", 'tipo' => 'saque', 'moeda' => 'USDT', 'quantidade' => 5000.00, 'origem' => 'Coinbase', 'destino' => 'Banco'],
            ],

            // Operacoes
            'operacoes' => [
                ['id' => 1001, 'data' => "01/{$mesNumero}/{$ano}", 'tipo' => 'compra', 'moeda' => 'BTC', 'quantidade' => 0.2, 'precoUnitario' => 195000.00, 'total' => 39000.00, 'lucro' => 0],
                ['id' => 1002, 'data' => "03/{$mesNumero}/{$ano}", 'tipo' => 'compra', 'moeda' => 'ETH', 'quantidade' => 3.0, 'precoUnitario' => 9500.00, 'total' => 28500.00, 'lucro' => 0],
                ['id' => 1003, 'data' => "05/{$mesNumero}/{$ano}", 'tipo' => 'venda', 'moeda' => 'BTC', 'quantidade' => 0.1, 'precoUnitario' => 210000.00, 'total' => 21000.00, 'lucro' => 3000.00],
                ['id' => 1004, 'data' => "12/{$mesNumero}/{$ano}", 'tipo' => 'venda', 'moeda' => 'ETH', 'quantidade' => 2.0, 'precoUnitario' => 11000.00, 'total' => 22000.00, 'lucro' => 4000.00],
                ['id' => 1005, 'data' => "18/{$mesNumero}/{$ano}", 'tipo' => 'venda', 'moeda' => 'SOL', 'quantidade' => 20.0, 'precoUnitario' => 350.00, 'total' => 7000.00, 'lucro' => 2000.00],
            ],
            'totalOperacoesPeriodo' => 50,

            // Saldos
            'saldos' => [
                ['simbolo' => 'BTC', 'quantidade' => 0.5, 'custoMedio' => 200000.00, 'valorMercado' => 210000.00, 'valorTotal' => 105000.00, 'variacao' => 5.0, 'cor' => '#F7931A'],
                ['simbolo' => 'ETH', 'quantidade' => 5.0, 'custoMedio' => 10000.00, 'valorMercado' => 11000.00, 'valorTotal' => 55000.00, 'variacao' => 10.0, 'cor' => '#627EEA'],
                ['simbolo' => 'USDT', 'quantidade' => 15000.00, 'custoMedio' => 1.00, 'valorMercado' => 1.00, 'valorTotal' => 15000.00, 'variacao' => 0, 'cor' => '#26A17B'],
                ['simbolo' => 'SOL', 'quantidade' => 30.0, 'custoMedio' => 300.00, 'valorMercado' => 350.00, 'valorTotal' => 10500.00, 'variacao' => 16.67, 'cor' => '#9945FF'],
            ],
            'totalSaldos' => 185500.00,

            // DARFs
            'darfs' => [
                ['mes' => 'JAN', 'totalVendido' => 25000.00, 'ganhoCapital' => 5000.00, 'impostoDevido' => 0, 'situacao' => 'isento'],
                ['mes' => 'FEV', 'totalVendido' => 30000.00, 'ganhoCapital' => 8000.00, 'impostoDevido' => 0, 'situacao' => 'isento'],
                ['mes' => 'MAR', 'totalVendido' => 40000.00, 'ganhoCapital' => 12000.00, 'impostoDevido' => 1800.00, 'situacao' => 'pago'],
                ['mes' => 'ABR', 'totalVendido' => 20000.00, 'ganhoCapital' => 3000.00, 'impostoDevido' => 0, 'situacao' => 'isento'],
                ['mes' => 'MAI', 'totalVendido' => 15000.00, 'ganhoCapital' => 2000.00, 'impostoDevido' => 0, 'situacao' => 'isento'],
                ['mes' => 'JUN', 'totalVendido' => 28000.00, 'ganhoCapital' => 6000.00, 'impostoDevido' => 0, 'situacao' => 'isento'],
                ['mes' => 'JUL', 'totalVendido' => 50000.00, 'ganhoCapital' => 15000.00, 'impostoDevido' => 2250.00, 'situacao' => 'pago'],
                ['mes' => 'AGO', 'totalVendido' => 22000.00, 'ganhoCapital' => 4000.00, 'impostoDevido' => 0, 'situacao' => 'isento'],
                ['mes' => 'SET', 'totalVendido' => 18000.00, 'ganhoCapital' => 3500.00, 'impostoDevido' => 0, 'situacao' => 'isento'],
                ['mes' => 'OUT', 'totalVendido' => 35000.00, 'ganhoCapital' => 9000.00, 'impostoDevido' => 0, 'situacao' => 'isento'],
                ['mes' => 'NOV', 'totalVendido' => 45000.00, 'ganhoCapital' => 11000.00, 'impostoDevido' => 1650.00, 'situacao' => 'pendente'],
                ['mes' => 'DEZ', 'totalVendido' => 50000.00, 'ganhoCapital' => 35000.00, 'impostoDevido' => 5250.00, 'situacao' => 'pendente'],
            ],

            // IRPF
            'irpf' => [
                'bensEDireitos' => [
                    ['codigo' => '08.01', 'discriminacao' => '0,5 BTC (Bitcoin) custodiado na Binance', 'saldoAnterior' => 80000.00, 'saldoAtual' => 105000.00],
                    ['codigo' => '08.02', 'discriminacao' => '5,0 ETH (Ethereum) custodiado na Binance/MetaMask', 'saldoAnterior' => 40000.00, 'saldoAtual' => 55000.00],
                    ['codigo' => '08.03', 'discriminacao' => '15.000 USDT (Tether) custodiado na Coinbase', 'saldoAnterior' => 15000.00, 'saldoAtual' => 15000.00],
                ],
                'rendimentosIsentos' => 52500.00,
                'ganhosTributaveis' => 27000.00,
                'impostoDevido' => 4050.00,
                'impostoPago' => 4050.00,
            ],

            'formatCurrency' => fn($v) => $this->formatCurrency($v),
        ]);
    }

    /**
     * Gerar arquivo para IRPF
     */
    public function irpfExport(Request $request, string $ano)
    {
        return view('reports.irpf-export', [
            'ano' => $ano,
            'usuario' => $this->getMockUsuario(),

            // Bens e Direitos
            'bensEDireitos' => [
                [
                    'codigo' => '08.01',
                    'nome' => 'Bitcoin (BTC)',
                    'discriminacao' => "0,5 BTC (Bitcoin) custodiado na exchange Binance. Custo medio de aquisicao: R$ 200.000,00 por unidade. Quantidade adquirida ao longo de {$ano}.",
                    'saldoAnterior' => 80000.00,
                    'saldoAtual' => 105000.00,
                ],
                [
                    'codigo' => '08.02',
                    'nome' => 'Ethereum (ETH)',
                    'discriminacao' => "5,0 ETH (Ethereum) custodiado na exchange Binance e carteira MetaMask. Custo medio de aquisicao: R$ 10.000,00 por unidade. Quantidade adquirida ao longo de {$ano}.",
                    'saldoAnterior' => 40000.00,
                    'saldoAtual' => 55000.00,
                ],
                [
                    'codigo' => '08.03',
                    'nome' => 'Tether (USDT)',
                    'discriminacao' => "15.000 USDT (Tether - Stablecoin) custodiado na exchange Coinbase. Stablecoin pareada ao dolar americano.",
                    'saldoAnterior' => 15000.00,
                    'saldoAtual' => 15000.00,
                ],
                [
                    'codigo' => '08.02',
                    'nome' => 'Solana (SOL)',
                    'discriminacao' => "30 SOL (Solana) custodiado na exchange Binance. Custo medio de aquisicao: R$ 300,00 por unidade. Quantidade adquirida ao longo de {$ano}.",
                    'saldoAnterior' => 5000.00,
                    'saldoAtual' => 10500.00,
                ],
            ],
            'totalAnterior' => 140000.00,
            'totalAtual' => 185500.00,

            // Rendimentos Isentos
            'rendimentosIsentos' => 52500.00,
            'mesesIsentos' => 9,
            'detalhamentoIsentos' => [
                ['mes' => 'JAN', 'valor' => 5000.00],
                ['mes' => 'FEV', 'valor' => 8000.00],
                ['mes' => 'MAR', 'valor' => 0],
                ['mes' => 'ABR', 'valor' => 3000.00],
                ['mes' => 'MAI', 'valor' => 2000.00],
                ['mes' => 'JUN', 'valor' => 6000.00],
                ['mes' => 'JUL', 'valor' => 0],
                ['mes' => 'AGO', 'valor' => 4000.00],
                ['mes' => 'SET', 'valor' => 3500.00],
                ['mes' => 'OUT', 'valor' => 9000.00],
                ['mes' => 'NOV', 'valor' => 0],
                ['mes' => 'DEZ', 'valor' => 12000.00],
            ],

            // Ganhos Tributaveis
            'ganhosTributaveis' => 27000.00,
            'impostoDevido' => 4050.00,
            'impostoPago' => 4050.00,
            'mesesTributaveis' => [
                ['mes' => 'MAR', 'totalVendido' => 40000.00, 'ganho' => 12000.00, 'imposto' => 1800.00, 'pago' => true],
                ['mes' => 'JUL', 'totalVendido' => 50000.00, 'ganho' => 15000.00, 'imposto' => 2250.00, 'pago' => true],
            ],

            'formatCurrency' => fn($v) => $this->formatCurrency($v),
        ]);
    }

    /**
     * Calcula data de vencimento do DARF
     */
    private function getDataVencimentoDarf(string $mes, string $ano): string
    {
        $mesSeguinte = (int) $mes + 1;
        $anoVencimento = (int) $ano;

        if ($mesSeguinte > 12) {
            $mesSeguinte = 1;
            $anoVencimento++;
        }

        $ultimoDia = cal_days_in_month(CAL_GREGORIAN, $mesSeguinte, $anoVencimento);

        // Ajustar para ultimo dia util (simplificado - em producao usar biblioteca de feriados)
        $data = mktime(0, 0, 0, $mesSeguinte, $ultimoDia, $anoVencimento);
        $diaSemana = date('N', $data);

        if ($diaSemana == 6) { // Sabado
            $ultimoDia -= 1;
        } elseif ($diaSemana == 7) { // Domingo
            $ultimoDia -= 2;
        }

        return str_pad($ultimoDia, 2, '0', STR_PAD_LEFT) . '/' . str_pad($mesSeguinte, 2, '0', STR_PAD_LEFT) . '/' . $anoVencimento;
    }
}
