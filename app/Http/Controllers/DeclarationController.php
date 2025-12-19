<?php

namespace App\Http\Controllers;

use App\Models\Declaration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DeclarationController extends Controller
{
    /**
     * Lista todas as declarações do usuário
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        $query = $user->declarations();

        // Filtros
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('year')) {
            $query->where(function ($q) use ($request) {
                $q->where('reference_year', $request->year)
                    ->orWhere('reference_month', 'LIKE', $request->year . '-%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $declarations = $query
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        // Anos disponíveis para filtro
        $years = $user->declarations()
            ->selectRaw('DISTINCT COALESCE(reference_year, SUBSTRING(reference_month, 1, 4)) as year')
            ->whereNotNull('reference_year')
            ->orWhereNotNull('reference_month')
            ->pluck('year')
            ->filter()
            ->unique()
            ->sort()
            ->reverse();

        // Resumo
        $summary = [
            'total' => $user->declarations()->count(),
            'pending' => $user->declarations()->where('status', 'pending')->count(),
            'completed' => $user->declarations()->where('status', 'completed')->count(),
            'tax_due' => $user->declarations()->where('status', 'pending')->sum('tax_due'),
        ];

        return view('declaracoes', compact('declarations', 'years', 'summary'));
    }

    /**
     * Exibe uma declaração específica
     */
    public function show(Declaration $declaration): View
    {
        $this->authorize('view', $declaration);

        return view('declaracoes.show', compact('declaration'));
    }

    /**
     * Inicia a geração de uma nova declaração IN 1888
     */
    public function createIN1888(Request $request): View
    {
        $user = Auth::user();

        // Meses disponíveis (últimos 12 meses)
        $months = collect();
        for ($i = 1; $i <= 12; $i++) {
            $date = now()->subMonths($i);
            $months->push([
                'value' => $date->format('Y-m'),
                'label' => $date->translatedFormat('F/Y'),
            ]);
        }

        // Verificar se já existe declaração para algum mês
        $existingDeclarations = $user->declarations()
            ->where('type', 'in1888')
            ->whereIn('reference_month', $months->pluck('value'))
            ->pluck('reference_month');

        return view('declaracoes.create-in1888', compact('months', 'existingDeclarations'));
    }

    /**
     * Gera a declaração IN 1888
     */
    public function storeIN1888(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reference_month' => 'required|date_format:Y-m',
        ]);

        $user = Auth::user();

        // Verificar se já existe
        $existing = $user->declarations()
            ->where('type', 'in1888')
            ->where('reference_month', $validated['reference_month'])
            ->first();

        if ($existing) {
            return redirect()
                ->route('declaracoes.show', $existing)
                ->with('info', 'Declaração já existente para este período.');
        }

        // Buscar operações do mês
        $startDate = $validated['reference_month'] . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));

        $operations = $user->operations()
            ->whereBetween('executed_at', [$startDate, $endDate . ' 23:59:59'])
            ->get();

        // Calcular totais
        $totalBuys = $operations->where('type', 'buy')->sum('total_brl');
        $totalSells = $operations->where('type', 'sell')->sum('total_brl');
        $profitLoss = $operations->whereIn('type', ['sell', 'swap_out'])->sum('profit_loss_brl');

        // Criar declaração
        $declaration = $user->declarations()->create([
            'type' => 'in1888',
            'reference_month' => $validated['reference_month'],
            'status' => 'draft',
            'data' => [
                'total_buys' => $totalBuys,
                'total_sells' => $totalSells,
                'profit_loss' => $profitLoss,
                'operations_count' => $operations->count(),
                'generated_at' => now()->toISOString(),
            ],
        ]);

        return redirect()
            ->route('declaracoes.show', $declaration)
            ->with('success', 'Declaração gerada com sucesso! Revise os dados antes de finalizar.');
    }

    /**
     * Inicia a geração do GCAP (Ganho de Capital)
     */
    public function createGCAP(Request $request): View
    {
        $user = Auth::user();

        // Meses com vendas tributáveis
        $monthsWithSales = $user->operations()
            ->whereIn('type', ['sell', 'swap_out'])
            ->selectRaw('DATE_FORMAT(executed_at, "%Y-%m") as month')
            ->groupBy('month')
            ->havingRaw('SUM(total_brl) > 35000') // Acima da isenção
            ->pluck('month');

        // Verificar se já existe GCAP
        $existingGCAP = $user->declarations()
            ->where('type', 'gcap')
            ->whereIn('reference_month', $monthsWithSales)
            ->pluck('reference_month');

        return view('declaracoes.create-gcap', compact('monthsWithSales', 'existingGCAP'));
    }

    /**
     * Gera o GCAP
     */
    public function storeGCAP(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reference_month' => 'required|date_format:Y-m',
        ]);

        $user = Auth::user();

        // Verificar se já existe
        $existing = $user->declarations()
            ->where('type', 'gcap')
            ->where('reference_month', $validated['reference_month'])
            ->first();

        if ($existing) {
            return redirect()
                ->route('declaracoes.show', $existing)
                ->with('info', 'GCAP já existente para este período.');
        }

        // Buscar vendas do mês
        $startDate = $validated['reference_month'] . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));

        $sales = $user->operations()
            ->whereIn('type', ['sell', 'swap_out'])
            ->whereBetween('executed_at', [$startDate, $endDate . ' 23:59:59'])
            ->get();

        $totalSells = $sales->sum('total_brl');
        $profitLoss = $sales->sum('profit_loss_brl');

        // Verificar isenção
        $isExempt = $totalSells <= 35000;
        $taxDue = 0;

        if (!$isExempt && $profitLoss > 0) {
            // Alíquota progressiva
            if ($profitLoss <= 5000000) { // Até R$ 5 milhões
                $taxDue = $profitLoss * 0.15; // 15%
            } elseif ($profitLoss <= 10000000) { // Até R$ 10 milhões
                $taxDue = $profitLoss * 0.175; // 17.5%
            } elseif ($profitLoss <= 30000000) { // Até R$ 30 milhões
                $taxDue = $profitLoss * 0.20; // 20%
            } else {
                $taxDue = $profitLoss * 0.225; // 22.5%
            }
        }

        // Criar declaração
        $declaration = $user->declarations()->create([
            'type' => 'gcap',
            'reference_month' => $validated['reference_month'],
            'status' => $taxDue > 0 ? 'pending' : 'completed',
            'tax_due' => $taxDue,
            'deadline' => date('Y-m-t', strtotime($endDate . ' +1 month')), // Último dia do mês seguinte
            'data' => [
                'total_sells' => $totalSells,
                'profit_loss' => $profitLoss,
                'is_exempt' => $isExempt,
                'tax_rate' => $isExempt ? 0 : ($taxDue / $profitLoss * 100),
                'sales_count' => $sales->count(),
                'generated_at' => now()->toISOString(),
            ],
        ]);

        return redirect()
            ->route('declaracoes.show', $declaration)
            ->with('success', 'GCAP gerado com sucesso!');
    }

    /**
     * Gera relatório para IRPF (Bens e Direitos)
     */
    public function createIRPF(Request $request): View
    {
        $user = Auth::user();

        // Anos disponíveis
        $currentYear = now()->year;
        $years = collect(range($currentYear - 5, $currentYear - 1))->reverse();

        // Verificar se já existe IRPF
        $existingIRPF = $user->declarations()
            ->where('type', 'irpf')
            ->pluck('reference_year');

        return view('declaracoes.create-irpf', compact('years', 'existingIRPF'));
    }

    /**
     * Gera o relatório IRPF
     */
    public function storeIRPF(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reference_year' => 'required|integer|min:2020|max:' . (now()->year - 1),
        ]);

        $user = Auth::user();

        // Verificar se já existe
        $existing = $user->declarations()
            ->where('type', 'irpf')
            ->where('reference_year', $validated['reference_year'])
            ->first();

        if ($existing) {
            return redirect()
                ->route('declaracoes.show', $existing)
                ->with('info', 'Relatório IRPF já existente para este ano.');
        }

        // Buscar posição dos ativos no final do ano
        $endOfYear = $validated['reference_year'] . '-12-31 23:59:59';

        // Por ora, usar posição atual (TODO: implementar histórico)
        $assets = $user->assets()
            ->where('total_brl', '>', 0)
            ->get();

        $totalPatrimony = $assets->sum('total_brl');

        // Criar declaração
        $declaration = $user->declarations()->create([
            'type' => 'irpf',
            'reference_year' => $validated['reference_year'],
            'status' => 'draft',
            'data' => [
                'total_patrimony' => $totalPatrimony,
                'assets' => $assets->map(function ($asset) {
                    return [
                        'symbol' => $asset->symbol,
                        'name' => $asset->name,
                        'quantity' => $asset->quantity,
                        'total_brl' => $asset->total_brl,
                        'average_price' => $asset->average_price_brl,
                    ];
                })->toArray(),
                'generated_at' => now()->toISOString(),
            ],
        ]);

        return redirect()
            ->route('declaracoes.show', $declaration)
            ->with('success', 'Relatório IRPF gerado com sucesso!');
    }

    /**
     * Marca declaração como finalizada
     */
    public function complete(Declaration $declaration): RedirectResponse
    {
        $this->authorize('update', $declaration);

        if ($declaration->status === 'completed') {
            return back()->with('info', 'Esta declaração já está finalizada.');
        }

        $declaration->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Declaração finalizada com sucesso!');
    }

    /**
     * Faz download do arquivo da declaração
     */
    public function download(Declaration $declaration)
    {
        $this->authorize('view', $declaration);

        // TODO: Implementar geração de PDF/arquivo
        // Por ora, retornar JSON
        $filename = $declaration->type . '_' . ($declaration->reference_month ?? $declaration->reference_year) . '.json';

        return response()->json($declaration->data)
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }

    /**
     * Remove uma declaração em rascunho
     */
    public function destroy(Declaration $declaration): RedirectResponse
    {
        $this->authorize('delete', $declaration);

        if ($declaration->status !== 'draft') {
            return back()->withErrors([
                'declaration' => 'Apenas declarações em rascunho podem ser removidas.',
            ]);
        }

        $declaration->delete();

        return redirect()
            ->route('declaracoes')
            ->with('success', 'Declaração removida com sucesso!');
    }
}
