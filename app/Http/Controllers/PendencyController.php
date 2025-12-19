<?php

namespace App\Http\Controllers;

use App\Models\Declaration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PendencyController extends Controller
{
    /**
     * Lista todas as pendências fiscais do usuário
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        // Buscar todas as pendências
        $pendencies = $this->getAllPendencies($user);

        // Filtros
        if ($request->filled('type')) {
            $pendencies = $pendencies->where('type', $request->type);
        }

        if ($request->filled('priority')) {
            $pendencies = $pendencies->where('priority', $request->priority);
        }

        if ($request->filled('year')) {
            $year = $request->year;
            $pendencies = $pendencies->filter(function ($p) use ($year) {
                if (isset($p['deadline'])) {
                    return date('Y', strtotime($p['deadline'])) == $year;
                }
                return isset($p['reference_year']) && $p['reference_year'] == $year;
            });
        }

        // Ordenar por prioridade e prazo
        $pendencies = $pendencies->sortBy([
            ['priority_order', 'asc'],
            ['deadline', 'asc'],
        ])->values();

        // Resumo
        $summary = [
            'total' => $pendencies->count(),
            'critical' => $pendencies->where('priority', 'critical')->count(),
            'high' => $pendencies->where('priority', 'high')->count(),
            'medium' => $pendencies->where('priority', 'medium')->count(),
            'total_tax_due' => $pendencies->sum('tax_due'),
        ];

        // Anos disponíveis para filtro
        $years = collect(range(now()->year - 2, now()->year + 1))->reverse();

        return view('pendencias', compact('pendencies', 'summary', 'years'));
    }

    /**
     * Exibe detalhes de como resolver uma pendência
     */
    public function show(string $type, string $reference): View
    {
        $user = Auth::user();

        // Buscar a pendência específica
        $pendency = $this->getPendencyByTypeAndReference($user, $type, $reference);

        if (!$pendency) {
            abort(404, 'Pendência não encontrada.');
        }

        // Buscar instruções de resolução
        $instructions = $this->getResolutionInstructions($type);

        // Links úteis
        $usefulLinks = $this->getUsefulLinks($type);

        return view('pendencias.show', compact('pendency', 'instructions', 'usefulLinks'));
    }

    /**
     * Busca todas as pendências do usuário
     */
    private function getAllPendencies($user): \Illuminate\Support\Collection
    {
        $pendencies = collect();

        // 1. DARFs pendentes (imposto sobre ganho de capital)
        $pendingDARFs = $user->declarations()
            ->where('type', 'gcap')
            ->where('status', 'pending')
            ->where('tax_due', '>', 0)
            ->get();

        foreach ($pendingDARFs as $darf) {
            $pendencies->push([
                'id' => 'darf_' . $darf->id,
                'type' => 'darf',
                'title' => 'DARF - Imposto sobre Ganho de Capital',
                'description' => 'Imposto pendente referente a ' . $this->formatMonth($darf->reference_month),
                'reference' => $darf->reference_month,
                'tax_due' => $darf->tax_due,
                'deadline' => $darf->deadline,
                'priority' => $this->calculatePriority($darf->deadline, $darf->tax_due),
                'priority_order' => $this->getPriorityOrder($this->calculatePriority($darf->deadline, $darf->tax_due)),
                'declaration_id' => $darf->id,
            ]);
        }

        // 2. IN 1888 pendentes (declaração mensal)
        $pendingIN1888 = $this->getPendingIN1888($user);
        foreach ($pendingIN1888 as $in1888) {
            $pendencies->push($in1888);
        }

        // 3. GCAP pendentes (meses com vendas > R$ 35k sem declaração)
        $pendingGCAP = $this->getPendingGCAP($user);
        foreach ($pendingGCAP as $gcap) {
            $pendencies->push($gcap);
        }

        // 4. IRPF pendente (se patrimônio > R$ 5k e não declarou)
        $pendingIRPF = $this->getPendingIRPF($user);
        if ($pendingIRPF) {
            $pendencies->push($pendingIRPF);
        }

        // 5. Carteiras com erro de sincronização
        $walletsWithError = $user->wallets()
            ->where('status', 'error')
            ->get();

        foreach ($walletsWithError as $wallet) {
            $pendencies->push([
                'id' => 'wallet_' . $wallet->id,
                'type' => 'wallet_error',
                'title' => 'Erro na Carteira: ' . $wallet->name,
                'description' => 'A sincronização desta carteira falhou. Verifique as credenciais da API.',
                'reference' => $wallet->id,
                'deadline' => null,
                'priority' => 'medium',
                'priority_order' => 3,
                'wallet_id' => $wallet->id,
            ]);
        }

        return $pendencies;
    }

    /**
     * Busca IN 1888 pendentes
     */
    private function getPendingIN1888($user): array
    {
        $pendencies = [];

        // Verificar últimos 3 meses
        for ($i = 1; $i <= 3; $i++) {
            $month = now()->subMonths($i);
            $referenceMonth = $month->format('Y-m');

            // Verificar se teve operações no mês
            $hasOperations = $user->operations()
                ->whereYear('executed_at', $month->year)
                ->whereMonth('executed_at', $month->month)
                ->exists();

            if (!$hasOperations) {
                continue;
            }

            // Verificar se já declarou
            $hasDeclaration = $user->declarations()
                ->where('type', 'in1888')
                ->where('reference_month', $referenceMonth)
                ->whereIn('status', ['completed', 'draft'])
                ->exists();

            if (!$hasDeclaration) {
                $deadline = $month->copy()->addMonth()->endOfMonth();

                $pendencies[] = [
                    'id' => 'in1888_' . $referenceMonth,
                    'type' => 'in1888',
                    'title' => 'IN 1888 - Declaração Mensal',
                    'description' => 'Declaração de operações de ' . $this->formatMonth($referenceMonth) . ' pendente',
                    'reference' => $referenceMonth,
                    'deadline' => $deadline->format('Y-m-d'),
                    'priority' => $this->calculatePriority($deadline),
                    'priority_order' => $this->getPriorityOrder($this->calculatePriority($deadline)),
                ];
            }
        }

        return $pendencies;
    }

    /**
     * Busca GCAP pendentes
     */
    private function getPendingGCAP($user): array
    {
        $pendencies = [];

        // Verificar últimos 12 meses
        for ($i = 1; $i <= 12; $i++) {
            $month = now()->subMonths($i);
            $referenceMonth = $month->format('Y-m');

            // Calcular vendas do mês
            $monthlySales = $user->operations()
                ->whereIn('type', ['sell', 'swap_out'])
                ->whereYear('executed_at', $month->year)
                ->whereMonth('executed_at', $month->month)
                ->sum('total_brl');

            // Se vendas > R$ 35k, precisa de GCAP
            if ($monthlySales > 35000) {
                // Verificar se já tem GCAP
                $hasGCAP = $user->declarations()
                    ->where('type', 'gcap')
                    ->where('reference_month', $referenceMonth)
                    ->exists();

                if (!$hasGCAP) {
                    $deadline = $month->copy()->addMonth()->endOfMonth();

                    $pendencies[] = [
                        'id' => 'gcap_' . $referenceMonth,
                        'type' => 'gcap',
                        'title' => 'GCAP - Ganho de Capital',
                        'description' => 'Vendas de R$ ' . number_format($monthlySales, 2, ',', '.') . ' em ' . $this->formatMonth($referenceMonth) . ' - acima da isenção',
                        'reference' => $referenceMonth,
                        'deadline' => $deadline->format('Y-m-d'),
                        'priority' => 'critical',
                        'priority_order' => 1,
                        'monthly_sales' => $monthlySales,
                    ];
                }
            }
        }

        return $pendencies;
    }

    /**
     * Verifica se há pendência de IRPF
     */
    private function getPendingIRPF($user): ?array
    {
        // Verificar apenas no período de declaração (março a maio)
        $currentMonth = now()->month;
        if ($currentMonth < 3 || $currentMonth > 5) {
            return null;
        }

        $referenceYear = now()->year - 1;

        // Verificar se patrimônio > R$ 5k
        $totalPatrimony = $user->assets()->sum('total_brl');

        if ($totalPatrimony <= 5000) {
            return null;
        }

        // Verificar se já declarou
        $hasIRPF = $user->declarations()
            ->where('type', 'irpf')
            ->where('reference_year', $referenceYear)
            ->whereIn('status', ['completed', 'draft'])
            ->exists();

        if ($hasIRPF) {
            return null;
        }

        return [
            'id' => 'irpf_' . $referenceYear,
            'type' => 'irpf',
            'title' => 'IRPF - Declaração Anual',
            'description' => 'Patrimônio em criptoativos acima de R$ 5.000 - declaração obrigatória',
            'reference' => (string) $referenceYear,
            'deadline' => now()->setMonth(5)->endOfMonth()->format('Y-m-d'),
            'priority' => 'high',
            'priority_order' => 2,
            'total_patrimony' => $totalPatrimony,
        ];
    }

    /**
     * Busca pendência por tipo e referência
     */
    private function getPendencyByTypeAndReference($user, string $type, string $reference): ?array
    {
        $pendencies = $this->getAllPendencies($user);

        return $pendencies->first(function ($p) use ($type, $reference) {
            return $p['type'] === $type && $p['reference'] === $reference;
        });
    }

    /**
     * Calcula a prioridade baseada no prazo e valor
     */
    private function calculatePriority($deadline, float $taxDue = 0): string
    {
        if (!$deadline) {
            return 'medium';
        }

        $daysUntilDeadline = now()->diffInDays($deadline, false);

        // Se já passou o prazo
        if ($daysUntilDeadline < 0) {
            return 'critical';
        }

        // Se tem menos de 7 dias
        if ($daysUntilDeadline <= 7) {
            return 'critical';
        }

        // Se tem menos de 30 dias
        if ($daysUntilDeadline <= 30) {
            return 'high';
        }

        // Se tem imposto alto (> R$ 1000)
        if ($taxDue > 1000) {
            return 'high';
        }

        return 'medium';
    }

    /**
     * Retorna ordem numérica da prioridade para ordenação
     */
    private function getPriorityOrder(string $priority): int
    {
        return match ($priority) {
            'critical' => 1,
            'high' => 2,
            'medium' => 3,
            'low' => 4,
            default => 5,
        };
    }

    /**
     * Formata mês para exibição
     */
    private function formatMonth(string $yearMonth): string
    {
        $date = \Carbon\Carbon::createFromFormat('Y-m', $yearMonth);
        return $date->translatedFormat('F/Y');
    }

    /**
     * Retorna instruções de resolução por tipo
     */
    private function getResolutionInstructions(string $type): array
    {
        return match ($type) {
            'darf' => [
                'Acesse o programa SICALC da Receita Federal',
                'Selecione o código 4600 (Ganhos de Capital)',
                'Informe o período de apuração e o valor do imposto',
                'Gere o DARF e realize o pagamento até a data de vencimento',
                'Guarde o comprovante de pagamento',
            ],
            'in1888' => [
                'Acesse o sistema da Receita Federal',
                'Selecione "Declaração sobre Operações com Criptoativos"',
                'Informe todas as operações do mês de referência',
                'Utilize os dados exportados pela Fiscal Wallet',
                'Envie a declaração até o último dia útil do mês seguinte',
            ],
            'gcap' => [
                'Baixe o programa GCAP do site da Receita Federal',
                'Preencha os dados de cada venda realizada',
                'O programa calculará automaticamente o imposto devido',
                'Gere a DARF para pagamento',
                'O prazo é até o último dia útil do mês seguinte à venda',
            ],
            'irpf' => [
                'Baixe o programa IRPF do ano correspondente',
                'Na ficha "Bens e Direitos", selecione o grupo 08 (Criptoativos)',
                'Informe cada criptoativo com saldo superior a R$ 5.000',
                'Utilize o custo de aquisição (não o valor de mercado)',
                'O prazo de entrega é até 31 de maio',
            ],
            default => [
                'Entre em contato com um contador especializado',
                'Consulte a documentação da Receita Federal',
            ],
        };
    }

    /**
     * Retorna links úteis por tipo
     */
    private function getUsefulLinks(string $type): array
    {
        $baseLinks = [
            'Receita Federal' => 'https://www.gov.br/receitafederal',
            'e-CAC' => 'https://cav.receita.fazenda.gov.br/',
        ];

        $specificLinks = match ($type) {
            'darf' => [
                'SICALC' => 'https://sicalc.receita.economia.gov.br/',
            ],
            'in1888' => [
                'Declaração de Criptoativos' => 'https://www.gov.br/receitafederal/pt-br/assuntos/orientacao-tributaria/declaracoes-e-demonstrativos/criptoativos',
            ],
            'gcap' => [
                'Download GCAP' => 'https://www.gov.br/receitafederal/pt-br/assuntos/orientacao-tributaria/pagamentos-e-parcelamentos/pagamento-do-imposto-de-renda-de-pessoa-fisica/ganho-de-capital/programa-de-apuracao-de-ganhos-de-capital-gcap',
            ],
            'irpf' => [
                'Download IRPF' => 'https://www.gov.br/receitafederal/pt-br/assuntos/meu-imposto-de-renda',
            ],
            default => [],
        };

        return array_merge($baseLinks, $specificLinks);
    }
}
