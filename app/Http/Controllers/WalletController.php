<?php

namespace App\Http\Controllers;

use App\Jobs\SyncWalletJob;
use App\Models\Exchange;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class WalletController extends Controller
{
    /**
     * Lista todas as carteiras do usuário
     */
    public function index(): View
    {
        $user = Auth::user();

        $wallets = $user->wallets()
            ->with('exchange')
            ->withCount('operations')
            ->orderBy('created_at', 'desc')
            ->get();

        $exchanges = Exchange::where('is_active', true)
            ->orderBy('name')
            ->get();

        $summary = [
            'total_wallets' => $wallets->count(),
            'total_balance' => $wallets->sum('total_balance_brl'),
            'synced_wallets' => $wallets->where('status', 'active')->count(),
            'pending_sync' => $wallets->where('status', 'syncing')->count(),
        ];

        return view('carteiras', compact('wallets', 'exchanges', 'summary'));
    }

    /**
     * Exibe o formulário de conexão com exchange
     */
    public function create(Request $request): View
    {
        $exchanges = Exchange::where('is_active', true)
            ->orderBy('name')
            ->get();

        $selectedExchange = null;
        if ($request->has('exchange')) {
            $selectedExchange = Exchange::where('slug', $request->exchange)->first();
        }

        return view('carteiras.create', compact('exchanges', 'selectedExchange'));
    }

    /**
     * Armazena uma nova carteira (conexão via API)
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'exchange_id' => 'required|exists:exchanges,id',
            'name' => 'nullable|string|max:100',
            'api_key' => 'required|string|max:255',
            'api_secret' => 'required|string|max:255',
            'api_passphrase' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $exchange = Exchange::findOrFail($validated['exchange_id']);

        // Verificar se já existe uma carteira com essa exchange
        $existingWallet = $user->wallets()
            ->where('exchange_id', $exchange->id)
            ->first();

        if ($existingWallet) {
            return back()->withErrors([
                'exchange_id' => 'Você já possui uma carteira conectada com esta exchange.',
            ]);
        }

        // Criar a carteira
        $wallet = $user->wallets()->create([
            'exchange_id' => $exchange->id,
            'name' => $validated['name'] ?? $exchange->name,
            'type' => 'exchange',
            'api_key' => Crypt::encryptString($validated['api_key']),
            'api_secret' => Crypt::encryptString($validated['api_secret']),
            'api_passphrase' => $validated['api_passphrase']
                ? Crypt::encryptString($validated['api_passphrase'])
                : null,
            'status' => 'pending',
        ]);

        // TODO: Disparar job de sincronização
        // SyncWalletJob::dispatch($wallet);

        return redirect()
            ->route('carteiras')
            ->with('success', 'Carteira adicionada! A sincronização será iniciada em breve.');
    }

    /**
     * Armazena uma carteira manual (importação CSV/XLS)
     */
    public function storeManual(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:exchange,wallet,defi',
            'file' => 'required|file|mimes:csv,xlsx,xls|max:10240', // max 10MB
        ]);

        $user = Auth::user();

        // Criar carteira manual
        $wallet = $user->wallets()->create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'status' => 'pending',
            'is_manual' => true,
        ]);

        // Armazenar o arquivo
        $path = $request->file('file')->store('imports/' . $user->id, 'local');

        // TODO: Disparar job de importação
        // ImportOperationsJob::dispatch($wallet, $path);

        return redirect()
            ->route('carteiras')
            ->with('success', 'Arquivo enviado! A importação será processada em breve.');
    }

    /**
     * Exibe detalhes de uma carteira específica
     */
    public function show(Wallet $wallet): View
    {
        // Verificar se a carteira pertence ao usuário
        if ($wallet->user_id !== Auth::id()) {
            abort(403);
        }

        $wallet->load(['exchange', 'operations' => function ($query) {
            $query->orderBy('executed_at', 'desc')->limit(50);
        }]);

        $summary = [
            'total_balance' => $wallet->total_balance_brl,
            'total_operations' => $wallet->operations()->count(),
            'last_sync' => $wallet->last_sync_at,
        ];

        return view('carteiras.show', compact('wallet', 'summary'));
    }

    /**
     * Exibe formulário de edição
     */
    public function edit(Wallet $wallet): View
    {
        if ($wallet->user_id !== Auth::id()) {
            abort(403);
        }

        return view('carteiras.edit', compact('wallet'));
    }

    /**
     * Atualiza uma carteira
     */
    public function update(Request $request, Wallet $wallet): RedirectResponse
    {
        if ($wallet->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'api_key' => 'nullable|string|max:255',
            'api_secret' => 'nullable|string|max:255',
            'api_passphrase' => 'nullable|string|max:255',
        ]);

        $wallet->name = $validated['name'];

        // Atualizar credenciais se fornecidas
        if (!empty($validated['api_key'])) {
            $wallet->api_key = Crypt::encryptString($validated['api_key']);
        }
        if (!empty($validated['api_secret'])) {
            $wallet->api_secret = Crypt::encryptString($validated['api_secret']);
        }
        if (!empty($validated['api_passphrase'])) {
            $wallet->api_passphrase = Crypt::encryptString($validated['api_passphrase']);
        }

        $wallet->save();

        return redirect()
            ->route('carteiras.show', $wallet)
            ->with('success', 'Carteira atualizada com sucesso!');
    }

    /**
     * Remove uma carteira
     */
    public function destroy(Wallet $wallet): RedirectResponse
    {
        if ($wallet->user_id !== Auth::id()) {
            abort(403);
        }

        // Deletar operações associadas primeiro
        $wallet->operations()->delete();

        // Deletar a carteira
        $wallet->delete();

        return redirect()
            ->route('carteiras')
            ->with('success', 'Carteira removida com sucesso!');
    }

    /**
     * Força sincronização manual de uma carteira
     */
    public function sync(Wallet $wallet): RedirectResponse
    {
        if ($wallet->user_id !== Auth::id()) {
            abort(403);
        }

        if ($wallet->status === 'syncing') {
            return back()->with('error', 'Esta carteira já está sendo sincronizada.');
        }

        $wallet->update(['status' => 'syncing']);

        // Disparar job de sincronização
        SyncWalletJob::dispatch($wallet);

        return back()->with('success', 'Sincronização iniciada!');
    }

    /**
     * Sincroniza todas as carteiras do usuário
     */
    public function syncAll(): RedirectResponse
    {
        $user = Auth::user();

        $wallets = $user->wallets()
            ->where('status', '!=', 'syncing')
            ->whereNotNull('api_key')
            ->get();

        $count = 0;
        foreach ($wallets as $wallet) {
            $wallet->update(['status' => 'syncing']);
            SyncWalletJob::dispatch($wallet);
            $count++;
        }

        if ($count === 0) {
            return back()->with('info', 'Nenhuma carteira disponível para sincronização.');
        }

        return back()->with('success', "Sincronização iniciada para {$count} carteira(s)!");
    }

    /**
     * Retorna as operações de uma carteira (para paginação AJAX)
     */
    public function operations(Request $request, Wallet $wallet)
    {
        if ($wallet->user_id !== Auth::id()) {
            abort(403);
        }

        $operations = $wallet->operations()
            ->orderBy('executed_at', 'desc')
            ->paginate(20);

        if ($request->wantsJson()) {
            return response()->json($operations);
        }

        return view('carteiras.operations', compact('wallet', 'operations'));
    }
}
