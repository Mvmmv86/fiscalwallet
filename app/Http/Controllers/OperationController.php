<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OperationController extends Controller
{
    /**
     * Lista todas as operações do usuário
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        $query = Operation::where('user_id', $user->id)
            ->with(['wallet']);

        // Filtros
        if ($request->filled('wallet_id')) {
            $query->where('wallet_id', $request->wallet_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('asset')) {
            $query->where(function ($q) use ($request) {
                $q->where('from_asset', $request->asset)
                  ->orWhere('to_asset', $request->asset);
            });
        }

        if ($request->filled('start_date')) {
            $query->where('executed_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('executed_at', '<=', $request->end_date . ' 23:59:59');
        }

        // Ordenação
        $sortBy = $request->get('sort', 'executed_at');
        $sortDir = $request->get('dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $operations = $query->paginate(50)->withQueryString();

        // Dados para filtros
        $wallets = Wallet::where('user_id', $user->id)->get();

        // Resumo
        $summary = [
            'total_operations' => Operation::where('user_id', $user->id)->count(),
            'total_buys' => Operation::where('user_id', $user->id)->where('type', 'buy')->sum('total_brl'),
            'total_sells' => Operation::where('user_id', $user->id)->where('type', 'sell')->sum('total_brl'),
            'total_profit' => Operation::where('user_id', $user->id)->whereIn('type', ['sell', 'swap_out'])->sum('gain_loss_brl'),
        ];

        return view('operacoes', compact('operations', 'wallets', 'summary'));
    }

    /**
     * Retorna operações em JSON para API
     */
    public function apiList(Request $request)
    {
        $user = Auth::user();

        $query = Operation::where('user_id', $user->id)
            ->with(['wallet:id,name']);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('wallet_id')) {
            $query->where('wallet_id', $request->wallet_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('from_asset', 'like', "%{$search}%")
                  ->orWhere('to_asset', 'like', "%{$search}%");
            });
        }

        $operations = $query->orderBy('executed_at', 'desc')
            ->paginate($request->get('per_page', 50));

        $wallets = Wallet::where('user_id', $user->id)->get(['id', 'name']);

        return response()->json([
            'operations' => $operations->items(),
            'wallets' => $wallets,
            'pagination' => [
                'current_page' => $operations->currentPage(),
                'last_page' => $operations->lastPage(),
                'per_page' => $operations->perPage(),
                'total' => $operations->total(),
                'from' => $operations->firstItem(),
                'to' => $operations->lastItem(),
            ]
        ]);
    }

    /**
     * Exibe detalhes de uma operação específica
     */
    public function show(Operation $operation): View
    {
        $this->authorize('view', $operation);

        $operation->load(['wallet.exchange', 'asset']);

        // Buscar operações relacionadas (mesmo ativo, próximas no tempo)
        $relatedOperations = $operation->wallet->operations()
            ->where('id', '!=', $operation->id)
            ->where('asset_id', $operation->asset_id)
            ->orderBy('executed_at', 'desc')
            ->limit(5)
            ->get();

        return view('operacoes.show', compact('operation', 'relatedOperations'));
    }

    /**
     * Formulário para adicionar operação manual
     */
    public function create(): View
    {
        $user = Auth::user();

        $wallets = $user->wallets()->get();
        $assets = $user->assets()->distinct()->pluck('symbol');

        return view('operacoes.create', compact('wallets', 'assets'));
    }

    /**
     * Armazena uma operação manual
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'type' => 'required|in:buy,sell,deposit,withdrawal,swap_in,swap_out,transfer_in,transfer_out',
            'asset_symbol' => 'required|string|max:20',
            'quantity' => 'required|numeric|min:0.00000001',
            'price_brl' => 'required|numeric|min:0',
            'fee_brl' => 'nullable|numeric|min:0',
            'executed_at' => 'required|date|before_or_equal:now',
            'notes' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $wallet = Wallet::findOrFail($validated['wallet_id']);

        // Verificar se a carteira pertence ao usuário
        if ($wallet->user_id !== $user->id) {
            abort(403);
        }

        // Buscar ou criar o ativo
        $asset = $user->assets()->firstOrCreate(
            ['symbol' => strtoupper($validated['asset_symbol'])],
            ['name' => strtoupper($validated['asset_symbol'])]
        );

        // Calcular total
        $totalBrl = $validated['quantity'] * $validated['price_brl'];
        $feeBrl = $validated['fee_brl'] ?? 0;

        // Criar a operação
        $operation = $wallet->operations()->create([
            'user_id' => $user->id,
            'asset_id' => $asset->id,
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'price_brl' => $validated['price_brl'],
            'total_brl' => $totalBrl,
            'fee_brl' => $feeBrl,
            'executed_at' => $validated['executed_at'],
            'notes' => $validated['notes'],
            'is_manual' => true,
        ]);

        // TODO: Recalcular ganho de capital
        // CapitalGainService::recalculate($user, $asset);

        return redirect()
            ->route('operacoes')
            ->with('success', 'Operação adicionada com sucesso!');
    }

    /**
     * Formulário de edição de operação manual
     */
    public function edit(Operation $operation): View
    {
        $this->authorize('update', $operation);

        // Só permite editar operações manuais
        if (!$operation->is_manual) {
            abort(403, 'Apenas operações manuais podem ser editadas.');
        }

        $user = Auth::user();
        $wallets = $user->wallets()->get();
        $assets = $user->assets()->distinct()->pluck('symbol');

        return view('operacoes.edit', compact('operation', 'wallets', 'assets'));
    }

    /**
     * Atualiza uma operação manual
     */
    public function update(Request $request, Operation $operation): RedirectResponse
    {
        $this->authorize('update', $operation);

        // Só permite editar operações manuais
        if (!$operation->is_manual) {
            return back()->withErrors([
                'operation' => 'Apenas operações manuais podem ser editadas.',
            ]);
        }

        $validated = $request->validate([
            'type' => 'required|in:buy,sell,deposit,withdrawal,swap_in,swap_out,transfer_in,transfer_out',
            'quantity' => 'required|numeric|min:0.00000001',
            'price_brl' => 'required|numeric|min:0',
            'fee_brl' => 'nullable|numeric|min:0',
            'executed_at' => 'required|date|before_or_equal:now',
            'notes' => 'nullable|string|max:500',
        ]);

        // Calcular total
        $totalBrl = $validated['quantity'] * $validated['price_brl'];
        $feeBrl = $validated['fee_brl'] ?? 0;

        $operation->update([
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'price_brl' => $validated['price_brl'],
            'total_brl' => $totalBrl,
            'fee_brl' => $feeBrl,
            'executed_at' => $validated['executed_at'],
            'notes' => $validated['notes'],
        ]);

        // TODO: Recalcular ganho de capital
        // CapitalGainService::recalculate($operation->user, $operation->asset);

        return redirect()
            ->route('operacoes.show', $operation)
            ->with('success', 'Operação atualizada com sucesso!');
    }

    /**
     * Remove uma operação manual
     */
    public function destroy(Operation $operation): RedirectResponse
    {
        $this->authorize('delete', $operation);

        // Só permite deletar operações manuais
        if (!$operation->is_manual) {
            return back()->withErrors([
                'operation' => 'Apenas operações manuais podem ser removidas.',
            ]);
        }

        $asset = $operation->asset;
        $user = $operation->user;

        $operation->delete();

        // TODO: Recalcular ganho de capital
        // CapitalGainService::recalculate($user, $asset);

        return redirect()
            ->route('operacoes')
            ->with('success', 'Operação removida com sucesso!');
    }

    /**
     * Exporta operações para CSV
     */
    public function export(Request $request)
    {
        $user = Auth::user();

        $query = $user->operations()
            ->with(['wallet.exchange', 'asset']);

        // Aplicar mesmos filtros do index
        if ($request->filled('wallet_id')) {
            $query->where('wallet_id', $request->wallet_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('start_date')) {
            $query->where('executed_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('executed_at', '<=', $request->end_date . ' 23:59:59');
        }

        $operations = $query->orderBy('executed_at', 'desc')->get();

        $filename = 'operacoes_' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($operations) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, [
                'Data',
                'Tipo',
                'Ativo',
                'Quantidade',
                'Preço (BRL)',
                'Total (BRL)',
                'Taxa (BRL)',
                'Lucro/Prejuízo (BRL)',
                'Carteira',
                'Exchange',
            ]);

            // Dados
            foreach ($operations as $op) {
                fputcsv($file, [
                    $op->executed_at->format('d/m/Y H:i'),
                    $op->type,
                    $op->asset->symbol ?? '-',
                    number_format($op->quantity, 8, '.', ''),
                    number_format($op->price_brl, 2, '.', ''),
                    number_format($op->total_brl, 2, '.', ''),
                    number_format($op->fee_brl, 2, '.', ''),
                    number_format($op->profit_loss_brl ?? 0, 2, '.', ''),
                    $op->wallet->name ?? '-',
                    $op->wallet->exchange->name ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
