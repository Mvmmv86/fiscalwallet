<?php

namespace App\Services;

use App\Models\Declaration;
use App\Models\User;
use Illuminate\Support\Collection;

class TaxCalculationService
{
    protected CapitalGainService $capitalGainService;

    public function __construct(CapitalGainService $capitalGainService)
    {
        $this->capitalGainService = $capitalGainService;
    }

    /**
     * Calcula todas as obrigações fiscais do usuário para um ano
     */
    public function calculateAnnualObligations(User $user, int $year): array
    {
        $obligations = [];

        // 1. IN 1888 - Declaração Mensal
        $obligations['in1888'] = $this->calculateIN1888Obligations($user, $year);

        // 2. GCAP - Ganho de Capital
        $obligations['gcap'] = $this->calculateGCAPObligations($user, $year);

        // 3. IRPF - Declaração Anual
        $obligations['irpf'] = $this->calculateIRPFObligations($user, $year);

        // Resumo
        $obligations['summary'] = [
            'total_tax_due' => collect($obligations['gcap'])->sum('tax_due'),
            'total_tax_paid' => collect($obligations['gcap'])->where('is_paid', true)->sum('tax_due'),
            'pending_declarations' => collect($obligations['in1888'])->where('is_submitted', false)->count(),
            'irpf_required' => $obligations['irpf']['is_required'],
        ];

        return $obligations;
    }

    /**
     * Calcula obrigações IN 1888 (declaração mensal de operações)
     */
    protected function calculateIN1888Obligations(User $user, int $year): array
    {
        $obligations = [];

        for ($month = 1; $month <= 12; $month++) {
            $yearMonth = sprintf('%04d-%02d', $year, $month);

            // Verificar se teve operações no mês
            $hasOperations = $user->operations()
                ->whereYear('executed_at', $year)
                ->whereMonth('executed_at', $month)
                ->exists();

            // Verificar se já declarou (usando year e month separados)
            $declaration = $user->declarations()
                ->where('year', $year)
                ->where('month', $month)
                ->first();

            $deadline = $this->getIN1888Deadline($yearMonth);
            $isOverdue = now()->gt($deadline) && $declaration?->in1888_status !== 'enviado';

            $obligations[] = [
                'month' => $yearMonth,
                'has_operations' => $hasOperations,
                'is_required' => $hasOperations,
                'is_submitted' => $declaration?->in1888_status === 'enviado',
                'declaration_id' => $declaration?->id,
                'deadline' => $deadline->format('Y-m-d'),
                'is_overdue' => $isOverdue,
            ];
        }

        return $obligations;
    }

    /**
     * Calcula obrigações GCAP (ganho de capital mensal)
     */
    protected function calculateGCAPObligations(User $user, int $year): array
    {
        $obligations = [];

        for ($month = 1; $month <= 12; $month++) {
            $yearMonth = sprintf('%04d-%02d', $year, $month);

            // Calcular ganho de capital do mês
            $capitalGain = $this->capitalGainService->getMonthlyCapitalGain($user, $yearMonth);

            // Verificar se já tem declaração (usando year e month separados)
            $declaration = $user->declarations()
                ->where('year', $year)
                ->where('month', $month)
                ->first();

            $deadline = $this->capitalGainService->getTaxDeadline($yearMonth);
            $isOverdue = now()->gt($deadline) && $capitalGain['tax_due'] > 0 && $declaration?->gcap_status !== 'enviado';

            $obligations[] = [
                'month' => $yearMonth,
                'total_sells' => $capitalGain['total_sells'],
                'profit_loss' => $capitalGain['total_profit_loss'],
                'is_exempt' => $capitalGain['is_exempt'],
                'tax_rate' => $capitalGain['tax_rate'],
                'tax_due' => $capitalGain['tax_due'],
                'declaration_id' => $declaration?->id,
                'is_paid' => $declaration?->gcap_status === 'enviado',
                'deadline' => $deadline,
                'is_overdue' => $isOverdue,
            ];
        }

        return $obligations;
    }

    /**
     * Calcula obrigações IRPF (declaração anual)
     */
    protected function calculateIRPFObligations(User $user, int $year): array
    {
        // Verificar se precisa declarar IRPF
        // Obrigatório se patrimônio > R$ 5.000 em 31/12

        $totalPatrimony = $user->assets()->sum('current_value_brl');
        $isRequired = $totalPatrimony > 5000;

        // Verificar se já declarou (usando year e checando irpf_status)
        // Para IRPF anual, usamos mês 12 como referência
        $declaration = $user->declarations()
            ->where('year', $year)
            ->where('month', 12)
            ->first();

        // Prazo: último dia útil de abril do ano seguinte
        $deadline = \Carbon\Carbon::create($year + 1, 4, 30);
        while ($deadline->isWeekend()) {
            $deadline->subDay();
        }

        return [
            'year' => $year,
            'total_patrimony' => $totalPatrimony,
            'is_required' => $isRequired,
            'threshold' => 5000,
            'declaration_id' => $declaration?->id,
            'is_submitted' => $declaration?->irpf_status === 'enviado',
            'deadline' => $deadline->format('Y-m-d'),
            'is_overdue' => now()->gt($deadline) && $isRequired && $declaration?->irpf_status !== 'enviado',
            'assets' => $this->getAssetsForIRPF($user),
            'capital_gains' => $this->capitalGainService->getAnnualCapitalGain($user, $year),
        ];
    }

    /**
     * Retorna ativos formatados para IRPF
     */
    protected function getAssetsForIRPF(User $user): Collection
    {
        return $user->assets()
            ->where('current_value_brl', '>', 0)
            ->get()
            ->map(function ($asset) {
                return [
                    'codigo' => $this->getIRPFCode($asset->symbol),
                    'symbol' => $asset->symbol,
                    'name' => $asset->name,
                    'quantity' => $asset->quantity,
                    'cost_basis' => $asset->total_invested_brl,
                    'description' => $this->getIRPFDescription($asset),
                ];
            });
    }

    /**
     * Retorna código do bem para IRPF
     */
    protected function getIRPFCode(string $symbol): string
    {
        // Códigos IRPF para criptoativos
        return match (strtoupper($symbol)) {
            'BTC' => '08.01', // Bitcoin
            'ETH', 'SOL', 'ADA', 'DOT', 'AVAX' => '08.02', // Altcoins
            'USDT', 'USDC', 'BUSD', 'DAI' => '08.03', // Stablecoins
            default => '08.99', // Outros criptoativos
        };
    }

    /**
     * Gera descrição para IRPF
     */
    protected function getIRPFDescription(object $asset): string
    {
        return sprintf(
            '%s %s (%s) custodiado em carteira digital. ' .
            'Quantidade: %s. Custo médio de aquisição: R$ %s por unidade.',
            number_format($asset->quantity, 8, ',', '.'),
            $asset->name ?? $asset->symbol,
            $asset->symbol,
            number_format($asset->quantity, 8, ',', '.'),
            number_format($asset->average_cost_brl ?? 0, 2, ',', '.')
        );
    }

    /**
     * Calcula prazo IN 1888
     */
    protected function getIN1888Deadline(string $yearMonth): \Carbon\Carbon
    {
        // Último dia útil do mês seguinte
        $date = \Carbon\Carbon::createFromFormat('Y-m', $yearMonth);
        $nextMonth = $date->addMonth();
        $lastDay = $nextMonth->endOfMonth();

        while ($lastDay->isWeekend()) {
            $lastDay->subDay();
        }

        return $lastDay;
    }

    /**
     * Gera DARF para pagamento
     */
    public function generateDARF(User $user, string $yearMonth): array
    {
        $capitalGain = $this->capitalGainService->getMonthlyCapitalGain($user, $yearMonth);

        if ($capitalGain['is_exempt'] || $capitalGain['tax_due'] <= 0) {
            return [
                'success' => false,
                'message' => 'Não há imposto devido para este período.',
            ];
        }

        $deadline = $capitalGain['deadline'];
        $isOverdue = now()->gt($deadline);

        // Calcular multa e juros se em atraso
        $fine = 0;
        $interest = 0;

        if ($isOverdue) {
            $daysLate = now()->diffInDays($deadline);

            // Multa: 0,33% ao dia, máximo 20%
            $fineRate = min(0.20, $daysLate * 0.0033);
            $fine = $capitalGain['tax_due'] * $fineRate;

            // Juros: SELIC do período (simplificado: 1% ao mês)
            $monthsLate = ceil($daysLate / 30);
            $interestRate = $monthsLate * 0.01;
            $interest = $capitalGain['tax_due'] * $interestRate;
        }

        $totalDue = $capitalGain['tax_due'] + $fine + $interest;

        return [
            'success' => true,
            'reference_month' => $yearMonth,
            'codigo_receita' => '4600', // Ganho de Capital - Pessoa Física
            'cpf' => $user->document,
            'nome' => $user->name,
            'periodo_apuracao' => $yearMonth,
            'data_vencimento' => $deadline,
            'valor_principal' => $capitalGain['tax_due'],
            'multa' => round($fine, 2),
            'juros' => round($interest, 2),
            'valor_total' => round($totalDue, 2),
            'is_overdue' => $isOverdue,
            'days_late' => $isOverdue ? now()->diffInDays($deadline) : 0,
        ];
    }

    /**
     * Verifica pendências fiscais do usuário
     */
    public function checkPendencies(User $user): array
    {
        $pendencies = [];
        $currentYear = now()->year;

        // Verificar últimos 3 anos
        for ($year = $currentYear - 2; $year <= $currentYear; $year++) {
            $obligations = $this->calculateAnnualObligations($user, $year);

            // IN 1888 pendentes
            foreach ($obligations['in1888'] as $in1888) {
                if ($in1888['is_required'] && !$in1888['is_submitted']) {
                    $pendencies[] = [
                        'type' => 'in1888',
                        'reference' => $in1888['month'],
                        'deadline' => $in1888['deadline'],
                        'is_overdue' => $in1888['is_overdue'],
                        'priority' => $in1888['is_overdue'] ? 'critical' : 'high',
                    ];
                }
            }

            // GCAP pendentes (com imposto devido)
            foreach ($obligations['gcap'] as $gcap) {
                if ($gcap['tax_due'] > 0 && !$gcap['is_paid']) {
                    $pendencies[] = [
                        'type' => 'gcap',
                        'reference' => $gcap['month'],
                        'tax_due' => $gcap['tax_due'],
                        'deadline' => $gcap['deadline'],
                        'is_overdue' => $gcap['is_overdue'],
                        'priority' => $gcap['is_overdue'] ? 'critical' : 'high',
                    ];
                }
            }

            // IRPF pendente
            if ($obligations['irpf']['is_required'] && !$obligations['irpf']['is_submitted']) {
                $pendencies[] = [
                    'type' => 'irpf',
                    'reference' => (string) $year,
                    'deadline' => $obligations['irpf']['deadline'],
                    'is_overdue' => $obligations['irpf']['is_overdue'],
                    'priority' => $obligations['irpf']['is_overdue'] ? 'critical' : 'medium',
                ];
            }
        }

        // Ordenar por prioridade
        usort($pendencies, function ($a, $b) {
            $priorityOrder = ['critical' => 0, 'high' => 1, 'medium' => 2, 'low' => 3];
            return $priorityOrder[$a['priority']] <=> $priorityOrder[$b['priority']];
        });

        return $pendencies;
    }
}
