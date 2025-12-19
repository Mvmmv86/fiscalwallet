<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Declaration;
use App\Models\Operation;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard principal
     */
    public function index(): View
    {
        $user = Auth::user();
        $userId = $user->id;

        // Primeiro dia do mês atual
        $startOfMonth = Carbon::now()->startOfMonth();

        // ==========================================
        // LINHA 1: 4 Cards de Métricas (Mês Atual)
        // ==========================================

        // Total de Ganhos do Mês (soma de gain_loss_brl onde gain_loss_brl > 0)
        $totalGanhos = Operation::where('user_id', $userId)
            ->where('type', 'sell')
            ->where('executed_at', '>=', $startOfMonth)
            ->where('gain_loss_brl', '>', 0)
            ->sum('gain_loss_brl');

        // Total de Perdas do Mês (soma absoluta de gain_loss_brl onde gain_loss_brl < 0)
        $totalPerdas = abs(Operation::where('user_id', $userId)
            ->where('type', 'sell')
            ->where('executed_at', '>=', $startOfMonth)
            ->where('gain_loss_brl', '<', 0)
            ->sum('gain_loss_brl'));

        // Resultado do Mês (ganhos - perdas)
        $resultadoMes = $totalGanhos - $totalPerdas;

        // Operações Realizadas no Mês
        $operacoesRealizadas = Operation::where('user_id', $userId)
            ->where('executed_at', '>=', $startOfMonth)
            ->count();

        // ==========================================
        // LINHA 2: Desempenho + Resumo Mês Atual
        // ==========================================

        // Valor total de vendas do mês (para limite de isenção R$ 35k)
        $vendasMes = Operation::where('user_id', $userId)
            ->where('type', 'sell')
            ->where('executed_at', '>=', $startOfMonth)
            ->sum('total_brl');

        // Imposto devido (se vendas > 35k e tem lucro)
        $impostoDevido = 0;
        if ($vendasMes > 35000 && $resultadoMes > 0) {
            // Alíquota progressiva simplificada (15% base)
            $impostoDevido = $resultadoMes * 0.15;
        }

        // Próxima data de declaração (último dia útil do mês seguinte)
        $proximaDeclaracao = Carbon::now()->addMonth()->endOfMonth()->format('d/M');

        // Distribuição por ativo (calculado pelo saldo de operações)
        $distribuicaoAtivos = $this->getDistribuicaoAtivos($userId);

        // Total movimentado = tudo que entrou na conta (compras + depósitos em BRL)
        $totalEntradas = Operation::where('user_id', $userId)
            ->whereIn('type', ['buy', 'deposit', 'transfer_in'])
            ->sum('total_brl');

        // Total que passou pela conta (valor consolidado histórico)
        $valorConsolidado = $totalEntradas;

        // Últimas operações
        $ultimasOperacoes = Operation::where('user_id', $userId)
            ->with('wallet')
            ->orderBy('executed_at', 'desc')
            ->limit(5)
            ->get();

        // Dados para gráfico (evolução mensal)
        $chartData = $this->getChartData($userId);

        // Montar array de dados para a view
        $dashboardData = [
            'resultado_mes' => $resultadoMes,
            'total_ganhos' => $totalGanhos,
            'total_perdas' => $totalPerdas,
            'operacoes_realizadas' => $operacoesRealizadas,
            'valor_consolidado' => $valorConsolidado,
            'limite_isencao_usado' => min($vendasMes, 35000),
            'limite_isencao_total' => 35000,
            'imposto_devido' => $impostoDevido,
            'proxima_declaracao' => $proximaDeclaracao,
            'operacoes_periodo' => $vendasMes, // Volume de vendas no período
        ];

        return view('dashboard', compact(
            'dashboardData',
            'distribuicaoAtivos',
            'ultimasOperacoes',
            'chartData'
        ));
    }

    /**
     * Calcula a distribuição de ativos do usuário
     * Usa os saldos reais da tabela assets (sincronizados da Binance)
     */
    private function getDistribuicaoAtivos(int $userId): array
    {
        // Buscar assets com saldo real > 0 da tabela assets
        $assets = Asset::where('user_id', $userId)
            ->where('quantity', '>', 0.00001)
            ->get();

        if ($assets->isEmpty()) {
            return [];
        }

        // Stablecoins não devem aparecer na distribuição de ativos
        $stablecoins = ['USDT', 'USDC', 'BUSD', 'TUSD', 'FDUSD', 'DAI', 'BRL', 'USD', 'EUR'];

        // Buscar último preço de cada ativo das operações
        $precos = [];
        foreach ($assets as $asset) {
            if (in_array($asset->symbol, $stablecoins)) {
                continue;
            }

            // Buscar último preço do ativo nas operações
            $ultimaOp = Operation::where('user_id', $userId)
                ->where(function ($q) use ($asset) {
                    $q->where(function ($q2) use ($asset) {
                        $q2->where('to_asset', $asset->symbol)->where('to_price_brl', '>', 0);
                    })->orWhere(function ($q2) use ($asset) {
                        $q2->where('from_asset', $asset->symbol)->where('from_price_brl', '>', 0);
                    });
                })
                ->orderBy('executed_at', 'desc')
                ->first();

            if ($ultimaOp) {
                $preco = $ultimaOp->to_asset === $asset->symbol
                    ? $ultimaOp->to_price_brl
                    : $ultimaOp->from_price_brl;
                $precos[$asset->symbol] = $preco;
            }
        }

        $cores = ['#9333EA', '#A855F7', '#C084FC', '#D8B4FE', '#E9D5FF', '#F3E8FF'];
        $resultado = [];
        $index = 0;

        foreach ($assets as $asset) {
            // Pular stablecoins
            if (in_array($asset->symbol, $stablecoins)) {
                continue;
            }

            $preco = $precos[$asset->symbol] ?? 0;

            // Se tem quantidade e preço, calcular valor
            if ($asset->quantity > 0.00001 && $preco > 0) {
                $valorBrl = $asset->quantity * $preco;
                if ($valorBrl > 1) {
                    $resultado[] = [
                        'nome' => $asset->symbol,
                        'quantidade' => $asset->quantity,
                        'valor' => $valorBrl,
                        'cor' => $cores[$index % count($cores)],
                    ];
                    $index++;
                }
            }
        }

        // Ordenar por valor e pegar os top 5
        usort($resultado, fn($a, $b) => $b['valor'] <=> $a['valor']);
        $top5 = array_slice($resultado, 0, 5);

        // Se tiver mais, agrupa em "Outros"
        if (count($resultado) > 5) {
            $outros = array_slice($resultado, 5);
            $valorOutros = array_sum(array_column($outros, 'valor'));
            if ($valorOutros > 1) {
                $top5[] = [
                    'nome' => 'Outros',
                    'quantidade' => 0,
                    'valor' => $valorOutros,
                    'cor' => '#E9D5FF',
                ];
            }
        }

        return $top5;
    }

    /**
     * Gera dados para o gráfico de evolução patrimonial
     * Mostra: Total de entradas (compras) acumulado mês a mês
     */
    private function getChartData(int $userId): array
    {
        // Buscar todas as operações de compra
        $operations = Operation::where('user_id', $userId)
            ->where('type', 'buy')
            ->select('total_brl', 'executed_at')
            ->orderBy('executed_at')
            ->get();

        $values = [];

        // Últimos 12 meses
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $endOfMonth = $date->copy()->endOfMonth();

            // Total de compras até o final deste mês
            $totalCompras = $operations->filter(fn($op) => $op->executed_at <= $endOfMonth)->sum('total_brl');

            $values[] = $totalCompras;
        }

        return $values;
    }

}
