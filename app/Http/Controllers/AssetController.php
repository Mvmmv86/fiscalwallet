<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AssetController extends Controller
{
    /**
     * Lista todos os ativos do usuário
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        $query = $user->assets();

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('symbol', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('wallet_id')) {
            $query->where('wallet_id', $request->wallet_id);
        }

        // Ordenação
        $sortBy = $request->get('sort', 'total_brl');
        $sortDir = $request->get('dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $assets = $query->paginate(20)->withQueryString();

        // Carteiras para filtro
        $wallets = $user->wallets()->with('exchange')->get();

        // Resumo do portfólio
        $summary = [
            'total_assets' => $user->assets()->count(),
            'total_value' => $user->assets()->sum('total_brl'),
            'total_invested' => $user->assets()->sum('total_cost_brl'),
            'total_profit' => $user->assets()->sum('total_brl') - $user->assets()->sum('total_cost_brl'),
        ];

        return view('ativos', compact('assets', 'wallets', 'summary'));
    }

    /**
     * Exibe detalhes de um ativo específico
     */
    public function show(Asset $asset): View
    {
        $this->authorize('view', $asset);

        // Operações do ativo
        $operations = $asset->operations()
            ->orderBy('executed_at', 'desc')
            ->paginate(20);

        // Estatísticas do ativo
        $stats = [
            'total_bought' => $asset->operations()->where('type', 'buy')->sum('quantity'),
            'total_sold' => $asset->operations()->where('type', 'sell')->sum('quantity'),
            'average_buy_price' => $asset->average_price_brl,
            'current_value' => $asset->total_brl,
            'profit_loss' => $asset->total_brl - $asset->total_cost_brl,
            'profit_percentage' => $asset->total_cost_brl > 0
                ? (($asset->total_brl - $asset->total_cost_brl) / $asset->total_cost_brl) * 100
                : 0,
        ];

        // Histórico de preços (últimos 30 dias)
        // TODO: Implementar histórico real de preços
        $priceHistory = $this->getMockPriceHistory($asset);

        return view('ativos.show', compact('asset', 'operations', 'stats', 'priceHistory'));
    }

    /**
     * Retorna dados do ativo em JSON (para gráficos)
     */
    public function data(Asset $asset)
    {
        $this->authorize('view', $asset);

        return response()->json([
            'asset' => $asset,
            'stats' => [
                'quantity' => $asset->quantity,
                'total_value' => $asset->total_brl,
                'average_price' => $asset->average_price_brl,
                'profit_loss' => $asset->total_brl - $asset->total_cost_brl,
            ],
            'price_history' => $this->getMockPriceHistory($asset),
        ]);
    }

    /**
     * Retorna alocação do portfólio por ativo
     */
    public function allocation()
    {
        $user = Auth::user();

        $assets = $user->assets()
            ->where('total_brl', '>', 0)
            ->orderBy('total_brl', 'desc')
            ->get();

        $totalValue = $assets->sum('total_brl');

        $allocation = $assets->map(function ($asset) use ($totalValue) {
            return [
                'symbol' => $asset->symbol,
                'name' => $asset->name,
                'value' => $asset->total_brl,
                'percentage' => $totalValue > 0
                    ? round(($asset->total_brl / $totalValue) * 100, 2)
                    : 0,
            ];
        });

        return response()->json([
            'total' => $totalValue,
            'assets' => $allocation,
        ]);
    }

    /**
     * Retorna resumo do portfólio
     */
    public function summary()
    {
        $user = Auth::user();

        $totalValue = $user->assets()->sum('total_brl');
        $totalCost = $user->assets()->sum('total_cost_brl');
        $profitLoss = $totalValue - $totalCost;

        // Top 5 ativos por valor
        $topAssets = $user->assets()
            ->where('total_brl', '>', 0)
            ->orderBy('total_brl', 'desc')
            ->limit(5)
            ->get(['symbol', 'name', 'quantity', 'total_brl', 'total_cost_brl']);

        // Ativos com maior lucro
        $topGainers = $user->assets()
            ->whereRaw('total_brl > total_cost_brl')
            ->orderByRaw('(total_brl - total_cost_brl) DESC')
            ->limit(5)
            ->get(['symbol', 'name', 'total_brl', 'total_cost_brl']);

        // Ativos com maior prejuízo
        $topLosers = $user->assets()
            ->whereRaw('total_brl < total_cost_brl')
            ->orderByRaw('(total_brl - total_cost_brl) ASC')
            ->limit(5)
            ->get(['symbol', 'name', 'total_brl', 'total_cost_brl']);

        return response()->json([
            'total_value' => $totalValue,
            'total_cost' => $totalCost,
            'profit_loss' => $profitLoss,
            'profit_percentage' => $totalCost > 0 ? ($profitLoss / $totalCost) * 100 : 0,
            'top_assets' => $topAssets,
            'top_gainers' => $topGainers,
            'top_losers' => $topLosers,
        ]);
    }

    /**
     * Atualiza preços de todos os ativos
     */
    public function refreshPrices()
    {
        $user = Auth::user();

        // TODO: Implementar atualização de preços via API externa
        // Por ora, apenas retornar sucesso
        // PriceUpdateJob::dispatch($user);

        return response()->json([
            'message' => 'Atualização de preços iniciada.',
        ]);
    }

    /**
     * Gera histórico de preços mock (para desenvolvimento)
     */
    private function getMockPriceHistory(Asset $asset): array
    {
        $labels = [];
        $values = [];

        // Últimos 30 dias
        $currentPrice = $asset->average_price_brl ?? 100;

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d/m');

            // Variação aleatória de ±5%
            $variation = (mt_rand(-500, 500) / 10000);
            $currentPrice = $currentPrice * (1 + $variation);
            $values[] = round($currentPrice, 2);
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }
}
