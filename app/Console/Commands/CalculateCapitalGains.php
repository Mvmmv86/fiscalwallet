<?php

namespace App\Console\Commands;

use App\Models\Operation;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateCapitalGains extends Command
{
    protected $signature = 'operations:calculate-gains {user_id?}';
    protected $description = 'Calcula o ganho de capital para todas as operações de venda';

    public function handle()
    {
        $userId = $this->argument('user_id');

        if ($userId) {
            $users = User::where('id', $userId)->get();
        } else {
            $users = User::has('operations')->get();
        }

        foreach ($users as $user) {
            $this->info("Calculando ganhos para usuário: {$user->email}");
            $this->calculateForUser($user);
        }

        $this->info('Cálculo de ganho de capital concluído!');
    }

    protected function calculateForUser(User $user): void
    {
        // Buscar todos os ativos únicos das operações do usuário
        $assets = Operation::where('user_id', $user->id)
            ->selectRaw("DISTINCT CASE WHEN from_asset != 'BRL' AND from_asset IS NOT NULL THEN from_asset ELSE to_asset END as asset")
            ->whereRaw("(from_asset != 'BRL' OR to_asset != 'BRL')")
            ->pluck('asset')
            ->filter()
            ->unique()
            ->values();

        $this->info("  Encontrados {$assets->count()} ativos");

        foreach ($assets as $assetSymbol) {
            if ($assetSymbol === 'BRL' || empty($assetSymbol)) {
                continue;
            }

            $this->calculateForAsset($user->id, $assetSymbol);
        }
    }

    protected function calculateForAsset(int $userId, string $symbol): void
    {
        $this->line("    Processando: {$symbol}");

        // Buscar todas as operações deste ativo ordenadas por data
        $operations = Operation::where('user_id', $userId)
            ->where(function ($query) use ($symbol) {
                $query->where('from_asset', $symbol)
                    ->orWhere('to_asset', $symbol);
            })
            ->orderBy('executed_at', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $totalQuantity = 0.0;
        $totalCost = 0.0;
        $averageCost = 0.0;

        $updatedSells = 0;

        foreach ($operations as $operation) {
            $isIncoming = $operation->to_asset === $symbol;
            $isOutgoing = $operation->from_asset === $symbol;

            // Determinar quantidade
            $quantity = $isIncoming
                ? (float) $operation->to_amount
                : (float) $operation->from_amount;

            if ($quantity <= 0) {
                continue;
            }

            // COMPRA / ENTRADA: atualizar custo médio
            if (in_array($operation->type, ['buy', 'deposit', 'transfer_in']) && $isIncoming) {
                // Para compras, o custo é o valor em BRL gasto
                $cost = (float) ($operation->total_brl ?? 0);

                // Se não tiver total_brl, tentar calcular pelo from_amount (que seria BRL)
                if ($cost <= 0 && $operation->from_asset === 'BRL') {
                    $cost = (float) $operation->from_amount;
                }

                // Adicionar taxa ao custo
                $cost += (float) ($operation->fee_brl ?? 0);

                if ($cost > 0) {
                    $totalCost += $cost;
                    $totalQuantity += $quantity;
                    $averageCost = $totalQuantity > 0 ? $totalCost / $totalQuantity : 0;
                } else {
                    // Entrada sem custo (airdrop, transferência de outra carteira)
                    // Usar custo médio atual ou zero
                    $totalQuantity += $quantity;
                    // Custo médio permanece o mesmo
                    if ($totalQuantity > 0 && $totalCost > 0) {
                        $averageCost = $totalCost / $totalQuantity;
                    }
                }

            // VENDA / SAÍDA: calcular lucro/prejuízo
            } elseif (in_array($operation->type, ['sell']) && $isOutgoing) {
                // Custo de aquisição da quantidade vendida
                $costBasis = $averageCost * $quantity;

                // Valor recebido na venda (já descontando taxa)
                $saleValue = (float) ($operation->total_brl ?? 0);
                if ($saleValue <= 0 && $operation->to_asset === 'BRL') {
                    $saleValue = (float) $operation->to_amount;
                }
                $saleValue -= (float) ($operation->fee_brl ?? 0);

                // Ganho/Perda = Valor de Venda - Custo de Aquisição
                $gainLoss = $saleValue - $costBasis;

                // Atualizar a operação
                $operation->update([
                    'cost_basis_brl' => round($costBasis, 2),
                    'gain_loss_brl' => round($gainLoss, 2),
                ]);
                $updatedSells++;

                // Reduzir posição
                $totalCost = max(0, $totalCost - $costBasis);
                $totalQuantity = max(0, $totalQuantity - $quantity);
                $averageCost = $totalQuantity > 0 ? $totalCost / $totalQuantity : 0;

            // SAQUE / TRANSFERÊNCIA SAÍDA: apenas reduzir posição (sem ganho de capital)
            } elseif (in_array($operation->type, ['withdrawal', 'transfer_out']) && $isOutgoing) {
                $costBasis = $averageCost * $quantity;
                $totalCost = max(0, $totalCost - $costBasis);
                $totalQuantity = max(0, $totalQuantity - $quantity);
                $averageCost = $totalQuantity > 0 ? $totalCost / $totalQuantity : 0;
            }
        }

        if ($updatedSells > 0) {
            $this->info("      -> {$updatedSells} vendas atualizadas");
        }
    }
}
