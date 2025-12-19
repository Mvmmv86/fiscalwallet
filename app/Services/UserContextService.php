<?php

namespace App\Services;

use App\Models\User;
use App\Models\FiscalLawUpdate;
use Illuminate\Support\Facades\Cache;

class UserContextService
{
    protected TaxCalculationService $taxService;
    protected CapitalGainService $capitalGainService;

    public function __construct(
        TaxCalculationService $taxService,
        CapitalGainService $capitalGainService
    ) {
        $this->taxService = $taxService;
        $this->capitalGainService = $capitalGainService;
    }

    /**
     * Extrai contexto completo do usuário para a IA
     */
    public function getFullContext(User $user): array
    {
        $cacheKey = "user_context:{$user->id}";
        $cacheTtl = 300; // 5 minutos

        return Cache::remember($cacheKey, $cacheTtl, function () use ($user) {
            return [
                'user' => $this->getUserProfile($user),
                'wallets' => $this->getWalletsContext($user),
                'assets' => $this->getAssetsContext($user),
                'current_month' => $this->getCurrentMonthContext($user),
                'pending_obligations' => $this->getPendingObligations($user),
                'recent_operations' => $this->getRecentOperations($user),
                'annual_summary' => $this->getAnnualSummary($user),
                'law_updates' => $this->getRecentLawUpdates(),
            ];
        });
    }

    /**
     * Contexto resumido para perguntas simples
     * Versão otimizada que evita queries pesadas
     */
    public function getBasicContext(User $user): array
    {
        try {
            // Dados básicos do usuário (queries simples)
            $userProfile = [
                'name' => $user->name,
                'email' => $user->email,
                'has_document' => !empty($user->document),
                'wallets_count' => $user->wallets()->count(),
                'total_patrimony' => $user->assets()->sum('current_value_brl') ?? 0,
                'member_since' => $user->created_at?->format('d/m/Y'),
            ];

            // Contexto do mês atual (query mais leve)
            $currentMonth = $this->getCurrentMonthContext($user);

            // Contagem rápida de declarações pendentes (sem checkPendencies pesado)
            $pendingCount = $user->declarations()
                ->where('in1888_status', '!=', 'enviado')
                ->orWhere('gcap_status', '!=', 'enviado')
                ->count();

            return [
                'user' => $userProfile,
                'current_month' => $currentMonth,
                'pending_count' => $pendingCount,
            ];
        } catch (\Exception $e) {
            // Retornar contexto mínimo em caso de erro
            return [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'has_document' => !empty($user->document),
                    'wallets_count' => 0,
                    'total_patrimony' => 0,
                    'member_since' => $user->created_at?->format('d/m/Y'),
                ],
                'current_month' => [
                    'year_month' => now()->format('Y-m'),
                    'month_name' => now()->translatedFormat('F Y'),
                    'total_sells' => 0,
                    'profit_loss' => 0,
                    'is_exempt' => true,
                    'exemption_limit' => 35000,
                    'exemption_remaining' => 35000,
                    'tax_due' => 0,
                ],
                'pending_count' => 0,
            ];
        }
    }

    /**
     * Perfil básico do usuário
     */
    protected function getUserProfile(User $user): array
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'has_document' => !empty($user->document),
            'wallets_count' => $user->wallets()->count(),
            'total_patrimony' => $user->assets()->sum('current_value_brl'),
            'member_since' => $user->created_at?->format('d/m/Y'),
        ];
    }

    /**
     * Contexto das carteiras conectadas
     */
    protected function getWalletsContext(User $user): array
    {
        return $user->wallets()
            ->with(['operations' => function ($query) {
                $query->latest('executed_at')->limit(1);
            }])
            ->get()
            ->map(function ($wallet) {
                $lastSync = $wallet->operations->first()?->executed_at;
                return [
                    'id' => $wallet->id,
                    'platform' => $wallet->platform,
                    'nickname' => $wallet->nickname,
                    'status' => $wallet->status,
                    'operations_count' => $wallet->operations()->count(),
                    'last_sync' => $lastSync?->format('d/m/Y H:i'),
                    'is_active' => $wallet->status === 'active',
                ];
            })
            ->toArray();
    }

    /**
     * Contexto dos ativos (holdings)
     */
    protected function getAssetsContext(User $user): array
    {
        $assets = $user->assets()
            ->where('quantity', '>', 0)
            ->orderByDesc('current_value_brl')
            ->limit(10)
            ->get();

        $totalValue = $assets->sum('current_value_brl');

        return [
            'total_value_brl' => $totalValue,
            'assets_count' => $assets->count(),
            'holdings' => $assets->map(function ($asset) use ($totalValue) {
                return [
                    'symbol' => $asset->symbol,
                    'name' => $asset->name ?? $asset->symbol,
                    'quantity' => $asset->quantity,
                    'value_brl' => $asset->current_value_brl,
                    'average_cost' => $asset->average_cost_brl,
                    'percentage' => $totalValue > 0 ? round(($asset->current_value_brl / $totalValue) * 100, 2) : 0,
                ];
            })->toArray(),
        ];
    }

    /**
     * Contexto do mês atual
     */
    protected function getCurrentMonthContext(User $user): array
    {
        $yearMonth = now()->format('Y-m');
        $capitalGain = $this->capitalGainService->getMonthlyCapitalGain($user, $yearMonth);

        return [
            'year_month' => $yearMonth,
            'month_name' => now()->translatedFormat('F Y'),
            'total_sells' => $capitalGain['total_sells'],
            'profit_loss' => $capitalGain['total_profit_loss'],
            'is_exempt' => $capitalGain['is_exempt'],
            'exemption_limit' => $capitalGain['exemption_limit'],
            'exemption_used' => min($capitalGain['total_sells'], $capitalGain['exemption_limit']),
            'exemption_remaining' => max(0, $capitalGain['exemption_limit'] - $capitalGain['total_sells']),
            'tax_due' => $capitalGain['tax_due'],
            'tax_rate' => $capitalGain['tax_rate'] * 100, // em porcentagem
            'deadline' => $capitalGain['deadline'],
            'operations_count' => $capitalGain['operations_count'],
        ];
    }

    /**
     * Obrigações fiscais pendentes
     */
    protected function getPendingObligations(User $user): array
    {
        $pendencies = $this->taxService->checkPendencies($user);

        return [
            'total_count' => count($pendencies),
            'critical_count' => collect($pendencies)->where('priority', 'critical')->count(),
            'high_count' => collect($pendencies)->where('priority', 'high')->count(),
            'items' => array_slice($pendencies, 0, 5), // Limita a 5 itens
        ];
    }

    /**
     * Operações recentes
     */
    protected function getRecentOperations(User $user): array
    {
        $operations = $user->operations()
            ->with('wallet')
            ->orderByDesc('executed_at')
            ->limit(10)
            ->get();

        return [
            'count' => $operations->count(),
            'items' => $operations->map(function ($op) {
                return [
                    'type' => $op->type,
                    'type_label' => $this->getOperationTypeLabel($op->type),
                    'from_asset' => $op->from_asset,
                    'to_asset' => $op->to_asset,
                    'amount' => $op->from_amount ?? $op->to_amount,
                    'total_brl' => $op->total_brl,
                    'date' => $op->executed_at?->format('d/m/Y'),
                    'wallet' => $op->wallet?->nickname ?? $op->wallet?->platform,
                ];
            })->toArray(),
        ];
    }

    /**
     * Resumo anual
     */
    protected function getAnnualSummary(User $user): array
    {
        $year = now()->year;
        $annualData = $this->capitalGainService->getAnnualCapitalGain($user, $year);

        return [
            'year' => $year,
            'total_profit' => $annualData['total_profit'],
            'total_loss' => $annualData['total_loss'],
            'net_result' => $annualData['net_profit_loss'],
            'total_tax_due' => $annualData['total_tax_due'],
            'taxable_months' => $annualData['taxable_months'],
            'exempt_months' => $annualData['exempt_months'],
        ];
    }

    /**
     * Atualizações recentes de leis fiscais
     */
    protected function getRecentLawUpdates(): array
    {
        $updates = FiscalLawUpdate::query()
            ->recent(30) // últimos 30 dias
            ->orderByDesc('discovered_at')
            ->limit(5)
            ->get();

        return $updates->map(function ($update) {
            return [
                'title' => $update->title,
                'type' => $update->getTypeLabel(),
                'impact' => $update->impact_level,
                'summary' => $update->change_summary,
                'date' => $update->discovered_at?->format('d/m/Y'),
                'affected_areas' => $update->affected_areas,
            ];
        })->toArray();
    }

    /**
     * Formata o contexto para inclusão no prompt da IA
     */
    public function formatContextForPrompt(User $user): string
    {
        try {
            $context = $this->getFullContext($user);

            $text = "## DADOS DO USUÁRIO\n\n";

            // Perfil
            $text .= "### Perfil\n";
            $text .= "- Nome: {$context['user']['name']}\n";
            $text .= "- Patrimônio total: R$ " . number_format($context['user']['total_patrimony'] ?? 0, 2, ',', '.') . "\n";
            $text .= "- Carteiras conectadas: {$context['user']['wallets_count']}\n\n";

            // Mês atual
            $monthName = $context['current_month']['month_name'] ?? now()->translatedFormat('F Y');
            $text .= "### Situação do Mês Atual ({$monthName})\n";
            $text .= "- Total de vendas: R$ " . number_format($context['current_month']['total_sells'] ?? 0, 2, ',', '.') . "\n";
            $text .= "- Resultado (lucro/prejuízo): R$ " . number_format($context['current_month']['profit_loss'] ?? 0, 2, ',', '.') . "\n";
            $text .= "- Limite de isenção: R$ " . number_format($context['current_month']['exemption_limit'] ?? 35000, 2, ',', '.') . "\n";
            $text .= "- Isenção disponível: R$ " . number_format($context['current_month']['exemption_remaining'] ?? 35000, 2, ',', '.') . "\n";
            $text .= "- Está isento este mês: " . (($context['current_month']['is_exempt'] ?? true) ? 'Sim' : 'Não') . "\n";
            if (!($context['current_month']['is_exempt'] ?? true)) {
                $text .= "- Imposto devido: R$ " . number_format($context['current_month']['tax_due'] ?? 0, 2, ',', '.') . "\n";
                $text .= "- Prazo para pagamento: " . ($context['current_month']['deadline'] ?? 'N/A') . "\n";
            }
            $text .= "\n";

            // Ativos
            if (!empty($context['assets']['holdings'])) {
                $text .= "### Principais Ativos\n";
                foreach ($context['assets']['holdings'] as $asset) {
                    $text .= "- {$asset['symbol']}: {$asset['quantity']} unidades (R$ " .
                        number_format($asset['value_brl'] ?? 0, 2, ',', '.') . " - " . ($asset['percentage'] ?? 0) . "%)\n";
                }
                $text .= "\n";
            }

            // Pendências
            if (isset($context['pending_obligations']) && ($context['pending_obligations']['total_count'] ?? 0) > 0) {
                $text .= "### ⚠️ Pendências Fiscais\n";
                $text .= "- Total de pendências: {$context['pending_obligations']['total_count']}\n";
                if (($context['pending_obligations']['critical_count'] ?? 0) > 0) {
                    $text .= "- Pendências críticas (em atraso): {$context['pending_obligations']['critical_count']}\n";
                }
                foreach ($context['pending_obligations']['items'] ?? [] as $item) {
                    $typeLabel = strtoupper($item['type'] ?? 'N/A');
                    $text .= "  - [" . ($item['priority'] ?? 'N/A') . "] {$typeLabel} - Ref: " . ($item['reference'] ?? 'N/A') . " - Prazo: " . ($item['deadline'] ?? 'N/A') . "\n";
                }
                $text .= "\n";
            }

            // Resumo anual
            if (isset($context['annual_summary'])) {
                $text .= "### Resumo " . ($context['annual_summary']['year'] ?? now()->year) . "\n";
                $text .= "- Lucros realizados: R$ " . number_format($context['annual_summary']['total_profit'] ?? 0, 2, ',', '.') . "\n";
                $text .= "- Prejuízos: R$ " . number_format($context['annual_summary']['total_loss'] ?? 0, 2, ',', '.') . "\n";
                $text .= "- Resultado líquido: R$ " . number_format($context['annual_summary']['net_result'] ?? 0, 2, ',', '.') . "\n";
                $text .= "- Total de impostos devidos: R$ " . number_format($context['annual_summary']['total_tax_due'] ?? 0, 2, ',', '.') . "\n";
            }

            return $text;

        } catch (\Exception $e) {
            // Retornar contexto mínimo em caso de erro
            return "## DADOS DO USUÁRIO\n\n" .
                   "### Perfil\n" .
                   "- Nome: {$user->name}\n" .
                   "- Carteiras conectadas: " . $user->wallets()->count() . "\n\n" .
                   "*Nota: Alguns dados do usuário não puderam ser carregados completamente.*\n";
        }
    }

    /**
     * Limpa o cache de contexto do usuário
     */
    public function clearCache(User $user): void
    {
        Cache::forget("user_context:{$user->id}");
    }

    /**
     * Retorna label do tipo de operação
     */
    protected function getOperationTypeLabel(string $type): string
    {
        return match ($type) {
            'buy' => 'Compra',
            'sell' => 'Venda',
            'deposit' => 'Depósito',
            'withdrawal' => 'Saque',
            'transfer_in' => 'Transferência (entrada)',
            'transfer_out' => 'Transferência (saída)',
            'swap_in' => 'Conversão (entrada)',
            'swap_out' => 'Conversão (saída)',
            default => ucfirst($type),
        };
    }
}
