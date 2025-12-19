<?php

namespace App\Listeners;

use App\Events\WalletSyncCompleted;
use App\Models\Asset;
use App\Models\Operation;
use Illuminate\Support\Facades\Log;

class UpdateAssetBalancesAfterSync
{
    /**
     * Handle the event.
     */
    public function handle(WalletSyncCompleted $event): void
    {
        $wallet = $event->wallet;
        $userId = $wallet->user_id;

        Log::info('UpdateAssetBalancesAfterSync started', [
            'wallet_id' => $wallet->id,
            'user_id' => $userId,
        ]);

        // Buscar todos os símbolos únicos das operações desta carteira
        $symbols = Operation::where('wallet_id', $wallet->id)
            ->whereNotNull('to_asset')
            ->select('to_asset')
            ->distinct()
            ->pluck('to_asset')
            ->merge(
                Operation::where('wallet_id', $wallet->id)
                    ->whereNotNull('from_asset')
                    ->select('from_asset')
                    ->distinct()
                    ->pluck('from_asset')
            )
            ->unique()
            ->filter();

        foreach ($symbols as $symbol) {
            $this->updateAssetBalance($userId, $symbol);
        }

        // Atualizar saldo total da carteira
        $this->updateWalletTotalBalance($wallet);

        Log::info('UpdateAssetBalancesAfterSync completed', [
            'wallet_id' => $wallet->id,
            'symbols_updated' => $symbols->count(),
        ]);
    }

    /**
     * Atualiza o saldo de um ativo específico
     */
    protected function updateAssetBalance(int $userId, string $symbol): void
    {
        // Calcular entradas (compras, depósitos, swaps para este ativo)
        $inflow = Operation::where('user_id', $userId)
            ->where('to_asset', $symbol)
            ->whereIn('type', ['buy', 'transfer_in', 'swap', 'staking', 'airdrop'])
            ->sum('to_amount');

        // Calcular saídas (vendas, saques, swaps deste ativo)
        $outflow = Operation::where('user_id', $userId)
            ->where('from_asset', $symbol)
            ->whereIn('type', ['sell', 'transfer_out', 'swap'])
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
     * Atualiza o saldo total da carteira
     */
    protected function updateWalletTotalBalance($wallet): void
    {
        $total = Asset::where('user_id', $wallet->user_id)
            ->sum('current_value_brl');

        $wallet->update(['total_balance_brl' => $total]);
    }
}
