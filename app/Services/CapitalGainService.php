<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Support\Collection;

class CapitalGainService
{
    /**
     * Isenção mensal de vendas em BRL
     */
    public const MONTHLY_EXEMPTION = 35000;

    /**
     * Alíquotas de imposto sobre ganho de capital
     */
    public const TAX_RATES = [
        5000000 => 0.15,    // Até R$ 5 milhões: 15%
        10000000 => 0.175,  // Até R$ 10 milhões: 17.5%
        30000000 => 0.20,   // Até R$ 30 milhões: 20%
        PHP_INT_MAX => 0.225, // Acima: 22.5%
    ];

    /**
     * Calcula ganho de capital para um ativo específico
     */
    public function calculateForAsset(Asset $asset): void
    {
        // Buscar todas as operações do ativo ordenadas por data
        // O asset tem um symbol, e as operações têm from_asset e to_asset
        $operations = Operation::where('user_id', $asset->user_id)
            ->where(function ($query) use ($asset) {
                $query->where('from_asset', $asset->symbol)
                    ->orWhere('to_asset', $asset->symbol);
            })
            ->orderBy('executed_at')
            ->get();

        // Implementar método PEPS (Primeiro a Entrar, Primeiro a Sair)
        // ou Custo Médio Ponderado
        $this->calculateUsingAverageCost($asset, $operations);
    }

    /**
     * Calcula usando método de Custo Médio Ponderado
     */
    protected function calculateUsingAverageCost(Asset $asset, Collection $operations): void
    {
        $totalQuantity = 0;
        $totalCost = 0;
        $averageCost = 0;
        $symbol = $asset->symbol;

        foreach ($operations as $operation) {
            // Determinar a quantidade baseado se o ativo está em from ou to
            $isIncoming = $operation->to_asset === $symbol;
            $isOutgoing = $operation->from_asset === $symbol;
            $quantity = $isIncoming ? (float)$operation->to_amount : (float)$operation->from_amount;

            if (in_array($operation->type, ['buy', 'swap_in', 'deposit', 'transfer_in']) && $isIncoming) {
                // Compra/Entrada: atualizar custo médio
                $cost = (float)($operation->total_brl ?? 0) + (float)($operation->fee_brl ?? 0);
                $totalCost += $cost;
                $totalQuantity += $quantity;
                $averageCost = $totalQuantity > 0 ? $totalCost / $totalQuantity : 0;

            } elseif (in_array($operation->type, ['sell', 'swap_out']) && $isOutgoing) {
                // Venda: calcular lucro/prejuízo
                $costBasis = $averageCost * $quantity;
                $saleValue = (float)($operation->total_brl ?? 0) - (float)($operation->fee_brl ?? 0);
                $profitLoss = $saleValue - $costBasis;

                // Atualizar a operação com o ganho/perda calculado
                $operation->update([
                    'cost_basis_brl' => $costBasis,
                    'gain_loss_brl' => $profitLoss,
                ]);

                // Atualizar posição
                $totalCost = max(0, $totalCost - $costBasis);
                $totalQuantity = max(0, $totalQuantity - $quantity);
                $averageCost = $totalQuantity > 0 ? $totalCost / $totalQuantity : 0;

            } elseif (in_array($operation->type, ['withdrawal', 'transfer_out']) && $isOutgoing) {
                // Saque/transferência: apenas reduzir posição (não gera ganho de capital)
                $costBasis = $averageCost * $quantity;
                $totalCost = max(0, $totalCost - $costBasis);
                $totalQuantity = max(0, $totalQuantity - $quantity);
                $averageCost = $totalQuantity > 0 ? $totalCost / $totalQuantity : 0;
            }
        }

        // Atualizar ativo com valores finais
        $asset->update([
            'quantity' => max(0, $totalQuantity),
            'average_cost_brl' => $averageCost,
            'total_invested_brl' => max(0, $totalCost),
        ]);
    }

    /**
     * Calcula resumo de ganho de capital mensal
     */
    public function getMonthlyCapitalGain(User $user, string $yearMonth): array
    {
        $startDate = $yearMonth . '-01';
        $endDate = date('Y-m-t', strtotime($startDate)) . ' 23:59:59';

        // Buscar vendas do mês
        $sales = $user->operations()
            ->whereIn('type', ['sell', 'swap_out'])
            ->whereBetween('executed_at', [$startDate, $endDate])
            ->get();

        $totalSells = $sales->sum('total_brl');
        $totalProfitLoss = $sales->sum('gain_loss_brl');

        // Separar lucros e prejuízos
        $profits = $sales->where('gain_loss_brl', '>', 0)->sum('gain_loss_brl');
        $losses = abs($sales->where('gain_loss_brl', '<', 0)->sum('gain_loss_brl'));

        // Verificar isenção
        $isExempt = $totalSells <= self::MONTHLY_EXEMPTION;

        // Calcular imposto devido
        $taxableAmount = $isExempt ? 0 : max(0, $totalProfitLoss);
        $taxDue = $this->calculateTax($taxableAmount);

        return [
            'year_month' => $yearMonth,
            'total_sells' => $totalSells,
            'total_profit_loss' => $totalProfitLoss,
            'profits' => $profits,
            'losses' => $losses,
            'is_exempt' => $isExempt,
            'exemption_limit' => self::MONTHLY_EXEMPTION,
            'taxable_amount' => $taxableAmount,
            'tax_rate' => $taxableAmount > 0 ? $this->getTaxRate($taxableAmount) : 0,
            'tax_due' => $taxDue,
            'deadline' => $this->getTaxDeadline($yearMonth),
            'operations_count' => $sales->count(),
        ];
    }

    /**
     * Calcula resumo de ganho de capital anual
     */
    public function getAnnualCapitalGain(User $user, int $year): array
    {
        $monthlyData = [];
        $totalTaxDue = 0;
        $totalProfit = 0;
        $totalLoss = 0;
        $totalExempt = 0;

        for ($month = 1; $month <= 12; $month++) {
            $yearMonth = sprintf('%04d-%02d', $year, $month);
            $data = $this->getMonthlyCapitalGain($user, $yearMonth);

            $monthlyData[$yearMonth] = $data;
            $totalTaxDue += $data['tax_due'];
            $totalProfit += $data['profits'];
            $totalLoss += $data['losses'];

            if ($data['is_exempt'] && $data['total_profit_loss'] > 0) {
                $totalExempt += $data['total_profit_loss'];
            }
        }

        return [
            'year' => $year,
            'monthly' => $monthlyData,
            'total_profit' => $totalProfit,
            'total_loss' => $totalLoss,
            'net_profit_loss' => $totalProfit - $totalLoss,
            'total_exempt' => $totalExempt,
            'total_tax_due' => $totalTaxDue,
            'taxable_months' => collect($monthlyData)->where('is_exempt', false)->count(),
            'exempt_months' => collect($monthlyData)->where('is_exempt', true)->count(),
        ];
    }

    /**
     * Calcula o imposto devido sobre o ganho de capital
     */
    public function calculateTax(float $profit): float
    {
        if ($profit <= 0) {
            return 0;
        }

        $rate = $this->getTaxRate($profit);

        return round($profit * $rate, 2);
    }

    /**
     * Retorna a alíquota de imposto baseada no valor
     */
    public function getTaxRate(float $value): float
    {
        foreach (self::TAX_RATES as $limit => $rate) {
            if ($value <= $limit) {
                return $rate;
            }
        }

        return 0.225; // Default: 22.5%
    }

    /**
     * Retorna a data limite para pagamento do DARF
     */
    public function getTaxDeadline(string $yearMonth): string
    {
        // Último dia útil do mês seguinte
        $date = \Carbon\Carbon::createFromFormat('Y-m', $yearMonth);
        $nextMonth = $date->addMonth();
        $lastDay = $nextMonth->endOfMonth();

        // Ajustar para dia útil
        while ($lastDay->isWeekend()) {
            $lastDay->subDay();
        }

        return $lastDay->format('Y-m-d');
    }

    /**
     * Verifica se há prejuízos a compensar
     */
    public function getPendingLosses(User $user): float
    {
        // Prejuízos podem ser compensados em meses futuros
        $totalProfitLoss = $user->operations()
            ->whereIn('type', ['sell', 'swap_out'])
            ->sum('gain_loss_brl');

        return $totalProfitLoss < 0 ? abs($totalProfitLoss) : 0;
    }

    /**
     * Recalcula ganho de capital para todas as operações de um usuário
     */
    public function recalculateAll(User $user): void
    {
        $assets = $user->assets()->get();

        foreach ($assets as $asset) {
            $this->calculateForAsset($asset);
        }
    }

    /**
     * Gera relatório detalhado de ganho de capital
     */
    public function generateReport(User $user, string $yearMonth): array
    {
        $summary = $this->getMonthlyCapitalGain($user, $yearMonth);

        // Buscar operações detalhadas
        $startDate = $yearMonth . '-01';
        $endDate = date('Y-m-t', strtotime($startDate)) . ' 23:59:59';

        $operations = $user->operations()
            ->whereIn('type', ['sell', 'swap_out'])
            ->whereBetween('executed_at', [$startDate, $endDate])
            ->with('asset')
            ->orderBy('executed_at')
            ->get()
            ->map(function ($op) {
                return [
                    'date' => $op->executed_at->format('d/m/Y'),
                    'asset' => $op->from_asset ?? $op->to_asset,
                    'quantity' => $op->from_amount ?? $op->to_amount,
                    'sale_value' => $op->total_brl,
                    'cost_basis' => $op->cost_basis_brl ?? 0,
                    'profit_loss' => $op->gain_loss_brl ?? 0,
                    'average_cost' => $op->cost_basis_brl && $op->from_amount ? ($op->cost_basis_brl / $op->from_amount) : 0,
                ];
            });

        return [
            'summary' => $summary,
            'operations' => $operations,
            'generated_at' => now()->toISOString(),
        ];
    }
}
