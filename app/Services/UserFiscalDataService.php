<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Serviço responsável por extrair e formatar dados fiscais do usuário
 * para uso pelo Assistente Fiscal IA.
 *
 * Este serviço consolida todas as informações relevantes do cliente
 * de forma otimizada (com cache) para que a IA possa fazer análises precisas.
 */
class UserFiscalDataService
{
    /**
     * Tempo de cache em segundos (5 minutos)
     */
    private const CACHE_TTL = 300;

    /**
     * Obtém todos os dados fiscais do usuário para análise da IA
     */
    public function getFullContext(User $user): array
    {
        $cacheKey = "user_fiscal_context:{$user->id}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($user) {
            return [
                'perfil' => $this->getPerfilData($user),
                'patrimonio' => $this->getPatrimonioData($user),
                'mes_atual' => $this->getMesAtualData($user),
                'historico_mensal' => $this->getHistoricoMensalData($user),
                'carteiras' => $this->getCarteirasData($user),
                'pendencias' => $this->getPendenciasData($user),
                'ultimas_operacoes' => $this->getUltimasOperacoesData($user),
                'alertas' => $this->getAlertasData($user),
            ];
        });
    }

    /**
     * Dados básicos do perfil
     */
    protected function getPerfilData(User $user): array
    {
        return [
            'nome' => $user->name,
            'email' => $user->email,
            'documento' => $user->document ? $this->maskDocument($user->document) : null,
            'membro_desde' => $user->created_at?->format('d/m/Y'),
            'plano' => $user->subscription?->plan?->name ?? 'Free',
        ];
    }

    /**
     * Dados consolidados do patrimônio
     */
    protected function getPatrimonioData(User $user): array
    {
        $assets = $user->assets()
            ->where('quantity', '>', 0)
            ->orderByDesc('current_value_brl')
            ->get();

        $totalPatrimonio = $assets->sum('current_value_brl');
        $totalInvestido = $assets->sum('total_invested_brl');
        $lucroNaoRealizado = $assets->sum('unrealized_gain_loss_brl');
        $lucroRealizado = $assets->sum('realized_gain_loss_brl');

        // Top 5 ativos por valor
        $topAtivos = $assets->take(5)->map(function ($asset) use ($totalPatrimonio) {
            return [
                'symbol' => $asset->symbol,
                'quantidade' => number_format($asset->quantity, 4, ',', '.'),
                'valor_brl' => $this->formatCurrency($asset->current_value_brl),
                'percentual' => $totalPatrimonio > 0
                    ? round(($asset->current_value_brl / $totalPatrimonio) * 100, 1)
                    : 0,
                'lucro_perc' => $asset->total_invested_brl > 0
                    ? round((($asset->current_value_brl - $asset->total_invested_brl) / $asset->total_invested_brl) * 100, 1)
                    : 0,
            ];
        })->toArray();

        return [
            'total_patrimonio_brl' => $this->formatCurrency($totalPatrimonio),
            'total_investido_brl' => $this->formatCurrency($totalInvestido),
            'lucro_nao_realizado_brl' => $this->formatCurrency($lucroNaoRealizado),
            'lucro_realizado_brl' => $this->formatCurrency($lucroRealizado),
            'num_ativos' => $assets->count(),
            'top_ativos' => $topAtivos,
            'precisa_declarar_irpf' => $totalPatrimonio >= 5000,
        ];
    }

    /**
     * Dados do mês atual (crítico para análise de isenção)
     */
    protected function getMesAtualData(User $user): array
    {
        $mesAtual = now()->month;
        $anoAtual = now()->year;

        // Buscar operações do mês atual
        $operacoesMes = $user->operations()
            ->whereYear('executed_at', $anoAtual)
            ->whereMonth('executed_at', $mesAtual)
            ->get();

        $totalVendas = $operacoesMes->where('type', 'sell')->sum('total_brl');
        $totalCompras = $operacoesMes->where('type', 'buy')->sum('total_brl');
        $ganhoCapital = $operacoesMes->where('type', 'sell')->sum('gain_loss_brl');
        $lucro = $operacoesMes->where('gain_loss_brl', '>', 0)->sum('gain_loss_brl');
        $prejuizo = $operacoesMes->where('gain_loss_brl', '<', 0)->sum('gain_loss_brl');

        $limiteIsencao = 35000;
        $isento = $totalVendas <= $limiteIsencao;
        $margemIsencao = max(0, $limiteIsencao - $totalVendas);

        // Calcular imposto se não isento
        $impostoDevido = 0;
        if (!$isento && $ganhoCapital > 0) {
            $impostoDevido = $this->calcularImposto($ganhoCapital);
        }

        return [
            'mes_referencia' => now()->translatedFormat('F/Y'),
            'total_vendas_brl' => $this->formatCurrency($totalVendas),
            'total_compras_brl' => $this->formatCurrency($totalCompras),
            'ganho_capital_brl' => $this->formatCurrency($ganhoCapital),
            'lucro_brl' => $this->formatCurrency($lucro),
            'prejuizo_brl' => $this->formatCurrency(abs($prejuizo)),
            'num_operacoes' => $operacoesMes->count(),
            'is_isento' => $isento,
            'margem_isencao_brl' => $this->formatCurrency($margemIsencao),
            'imposto_devido_brl' => $this->formatCurrency($impostoDevido),
            'prazo_darf' => $this->getProximoPrazoDarf(),
            'prazo_in1888' => $this->getProximoPrazoIN1888(),
        ];
    }

    /**
     * Histórico dos últimos 6 meses
     */
    protected function getHistoricoMensalData(User $user): array
    {
        $historico = [];

        for ($i = 0; $i < 6; $i++) {
            $data = now()->subMonths($i);
            $mes = $data->month;
            $ano = $data->year;

            $operacoes = $user->operations()
                ->whereYear('executed_at', $ano)
                ->whereMonth('executed_at', $mes)
                ->get();

            $totalVendas = $operacoes->where('type', 'sell')->sum('total_brl');
            $ganho = $operacoes->where('type', 'sell')->sum('gain_loss_brl');

            $historico[] = [
                'mes' => $data->translatedFormat('M/Y'),
                'vendas_brl' => $this->formatCurrency($totalVendas),
                'ganho_brl' => $this->formatCurrency($ganho),
                'operacoes' => $operacoes->count(),
                'isento' => $totalVendas <= 35000,
            ];
        }

        return $historico;
    }

    /**
     * Dados das carteiras conectadas
     */
    protected function getCarteirasData(User $user): array
    {
        $carteiras = $user->wallets()->with('exchange')->get();

        return $carteiras->map(function ($wallet) {
            $exchange = $wallet->exchange;
            $isForeign = $exchange && in_array($exchange->slug, [
                'binance', 'coinbase', 'kraken', 'kucoin', 'bybit', 'okx', 'gate-io'
            ]);

            return [
                'nome' => $wallet->name,
                'exchange' => $exchange?->name ?? 'Manual',
                'tipo' => $isForeign ? 'estrangeira' : 'brasileira',
                'status' => $wallet->status,
                'ultima_sync' => $wallet->last_sync_at?->diffForHumans() ?? 'Nunca',
                'saldo_brl' => $this->formatCurrency($wallet->total_balance_brl),
                'requer_in1888' => $isForeign,
            ];
        })->toArray();
    }

    /**
     * Dados das pendências fiscais
     */
    protected function getPendenciasData(User $user): array
    {
        $pendencias = $user->pendencies()
            ->where('status', 'pending')
            ->orderBy('priority', 'desc')
            ->orderBy('due_date')
            ->get();

        $criticas = $pendencias->where('priority', 'critica');
        $atencao = $pendencias->where('priority', 'atencao');
        $normais = $pendencias->whereNotIn('priority', ['critica', 'atencao']);

        $totalDevido = $pendencias->sum('updated_value_brl');

        return [
            'total_pendencias' => $pendencias->count(),
            'criticas' => $criticas->count(),
            'atencao' => $atencao->count(),
            'normais' => $normais->count(),
            'valor_total_devido_brl' => $this->formatCurrency($totalDevido),
            'lista' => $pendencias->take(5)->map(function ($p) {
                return [
                    'tipo' => $p->type,
                    'titulo' => $p->title,
                    'prioridade' => $p->priority,
                    'vencimento' => $p->due_date?->format('d/m/Y'),
                    'valor_brl' => $this->formatCurrency($p->updated_value_brl),
                    'dias_vencido' => $p->due_date && $p->due_date->isPast()
                        ? $p->due_date->diffInDays(now())
                        : 0,
                ];
            })->toArray(),
        ];
    }

    /**
     * Últimas operações registradas
     */
    protected function getUltimasOperacoesData(User $user): array
    {
        $operacoes = $user->operations()
            ->with('wallet.exchange')
            ->orderByDesc('executed_at')
            ->limit(10)
            ->get();

        return $operacoes->map(function ($op) {
            return [
                'data' => $op->executed_at->format('d/m/Y H:i'),
                'tipo' => $op->type,
                'de' => $op->from_asset,
                'para' => $op->to_asset,
                'quantidade' => number_format($op->to_amount, 4, ',', '.'),
                'valor_brl' => $this->formatCurrency($op->total_brl),
                'ganho_brl' => $op->gain_loss_brl ? $this->formatCurrency($op->gain_loss_brl) : null,
                'exchange' => $op->wallet?->exchange?->name ?? 'Manual',
            ];
        })->toArray();
    }

    /**
     * Gera alertas automáticos baseados na situação fiscal
     */
    protected function getAlertasData(User $user): array
    {
        $alertas = [];

        // Verificar mês atual
        $mesAtual = $this->getMesAtualData($user);

        // Alerta de proximidade do limite
        $vendasMes = (float) str_replace(['R$ ', '.', ','], ['', '', '.'], $mesAtual['total_vendas_brl']);
        if ($vendasMes >= 28000 && $vendasMes < 35000) {
            $alertas[] = [
                'tipo' => 'atencao',
                'mensagem' => "Você está próximo do limite de isenção. Vendas: {$mesAtual['total_vendas_brl']} de R$ 35.000",
            ];
        }

        // Alerta de ultrapassou limite
        if ($vendasMes > 35000) {
            $alertas[] = [
                'tipo' => 'critico',
                'mensagem' => "Limite de isenção ultrapassado! Vendas: {$mesAtual['total_vendas_brl']}. Imposto devido: {$mesAtual['imposto_devido_brl']}",
            ];
        }

        // Verificar carteiras estrangeiras sem declaração IN1888
        $carteirasEstrangeiras = collect($this->getCarteirasData($user))
            ->where('requer_in1888', true)
            ->count();

        if ($carteirasEstrangeiras > 0) {
            $alertas[] = [
                'tipo' => 'info',
                'mensagem' => "Você tem {$carteirasEstrangeiras} carteira(s) em exchanges estrangeiras. Lembre-se da obrigação IN1888 se operar >R$ 30.000/mês.",
            ];
        }

        // Verificar pendências críticas
        $pendencias = $this->getPendenciasData($user);
        if ($pendencias['criticas'] > 0) {
            $alertas[] = [
                'tipo' => 'critico',
                'mensagem' => "Você tem {$pendencias['criticas']} pendência(s) crítica(s) a resolver!",
            ];
        }

        // Prazo DARF próximo
        $diasParaDarf = now()->diffInDays(now()->endOfMonth()->addDay(), false);
        if ($diasParaDarf <= 5 && !$mesAtual['is_isento'] && $vendasMes > 0) {
            $alertas[] = [
                'tipo' => 'atencao',
                'mensagem' => "Prazo do DARF em {$diasParaDarf} dia(s)! Vencimento: {$mesAtual['prazo_darf']}",
            ];
        }

        return $alertas;
    }

    /**
     * Formata o contexto completo como texto para o prompt da IA
     * Otimizado para ser compacto mas informativo
     */
    public function formatContextForPrompt(User $user): string
    {
        try {
            $data = $this->getFullContext($user);

            $prompt = "## DADOS DO CLIENTE\n\n";

            // Perfil
            $prompt .= "### Perfil\n";
            $prompt .= "- Nome: {$data['perfil']['nome']}\n";
            $prompt .= "- Plano: {$data['perfil']['plano']}\n";
            $prompt .= "- Cliente desde: {$data['perfil']['membro_desde']}\n\n";

            // Patrimônio
            $prompt .= "### Patrimônio Atual\n";
            $prompt .= "- Total: {$data['patrimonio']['total_patrimonio_brl']}\n";
            $prompt .= "- Investido: {$data['patrimonio']['total_investido_brl']}\n";
            $prompt .= "- Lucro não realizado: {$data['patrimonio']['lucro_nao_realizado_brl']}\n";
            $prompt .= "- Lucro realizado: {$data['patrimonio']['lucro_realizado_brl']}\n";
            $prompt .= "- Precisa declarar IRPF: " . ($data['patrimonio']['precisa_declarar_irpf'] ? 'SIM' : 'NÃO') . "\n";

            if (!empty($data['patrimonio']['top_ativos'])) {
                $prompt .= "- Top ativos:\n";
                foreach ($data['patrimonio']['top_ativos'] as $ativo) {
                    $prompt .= "  - {$ativo['symbol']}: {$ativo['valor_brl']} ({$ativo['percentual']}%)\n";
                }
            }
            $prompt .= "\n";

            // Mês Atual (CRÍTICO para análise fiscal)
            $prompt .= "### Situação Mês Atual ({$data['mes_atual']['mes_referencia']})\n";
            $prompt .= "- Total vendas: {$data['mes_atual']['total_vendas_brl']}\n";
            $prompt .= "- Total compras: {$data['mes_atual']['total_compras_brl']}\n";
            $prompt .= "- Ganho de capital: {$data['mes_atual']['ganho_capital_brl']}\n";
            $prompt .= "- Operações: {$data['mes_atual']['num_operacoes']}\n";
            $prompt .= "- **ISENTO**: " . ($data['mes_atual']['is_isento'] ? 'SIM' : 'NÃO') . "\n";
            $prompt .= "- Margem para isenção: {$data['mes_atual']['margem_isencao_brl']}\n";

            if (!$data['mes_atual']['is_isento']) {
                $prompt .= "- **IMPOSTO DEVIDO**: {$data['mes_atual']['imposto_devido_brl']}\n";
            }
            $prompt .= "- Prazo DARF: {$data['mes_atual']['prazo_darf']}\n";
            $prompt .= "- Prazo IN1888: {$data['mes_atual']['prazo_in1888']}\n\n";

            // Carteiras
            if (!empty($data['carteiras'])) {
                $prompt .= "### Carteiras Conectadas\n";
                foreach ($data['carteiras'] as $carteira) {
                    $tipo = $carteira['requer_in1888'] ? '(ESTRANGEIRA - requer IN1888)' : '(brasileira)';
                    $prompt .= "- {$carteira['nome']} ({$carteira['exchange']}) {$tipo}: {$carteira['saldo_brl']}\n";
                }
                $prompt .= "\n";
            }

            // Pendências
            if ($data['pendencias']['total_pendencias'] > 0) {
                $prompt .= "### Pendências Fiscais\n";
                $prompt .= "- Total: {$data['pendencias']['total_pendencias']} ({$data['pendencias']['criticas']} críticas)\n";
                $prompt .= "- Valor devido: {$data['pendencias']['valor_total_devido_brl']}\n";

                if (!empty($data['pendencias']['lista'])) {
                    foreach ($data['pendencias']['lista'] as $p) {
                        $status = $p['dias_vencido'] > 0 ? "VENCIDO há {$p['dias_vencido']} dias" : "Vence: {$p['vencimento']}";
                        $prompt .= "  - [{$p['prioridade']}] {$p['titulo']}: {$p['valor_brl']} - {$status}\n";
                    }
                }
                $prompt .= "\n";
            }

            // Alertas
            if (!empty($data['alertas'])) {
                $prompt .= "### ALERTAS IMPORTANTES\n";
                foreach ($data['alertas'] as $alerta) {
                    $icon = $alerta['tipo'] === 'critico' ? '🚨' : ($alerta['tipo'] === 'atencao' ? '⚠️' : 'ℹ️');
                    $prompt .= "{$icon} {$alerta['mensagem']}\n";
                }
                $prompt .= "\n";
            }

            // Histórico resumido
            if (!empty($data['historico_mensal'])) {
                $prompt .= "### Histórico (últimos 6 meses)\n";
                foreach (array_slice($data['historico_mensal'], 0, 3) as $h) {
                    $status = $h['isento'] ? 'isento' : 'tributável';
                    $prompt .= "- {$h['mes']}: Vendas {$h['vendas_brl']}, Ganho {$h['ganho_brl']} ({$status})\n";
                }
                $prompt .= "\n";
            }

            // Últimas operações
            if (!empty($data['ultimas_operacoes'])) {
                $prompt .= "### Últimas 5 Operações\n";
                foreach (array_slice($data['ultimas_operacoes'], 0, 5) as $op) {
                    $ganho = $op['ganho_brl'] ? " | Ganho: {$op['ganho_brl']}" : '';
                    $prompt .= "- {$op['data']}: {$op['tipo']} {$op['quantidade']} {$op['para']} = {$op['valor_brl']}{$ganho}\n";
                }
            }

            return $prompt;

        } catch (\Exception $e) {
            Log::error('UserFiscalDataService: Erro ao formatar contexto', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return "## DADOS DO CLIENTE\n\n*Erro ao carregar dados completos. Algumas informações podem estar indisponíveis.*\n";
        }
    }

    /**
     * Limpa o cache do contexto do usuário
     */
    public function clearCache(User $user): void
    {
        Cache::forget("user_fiscal_context:{$user->id}");
    }

    /**
     * Calcula imposto baseado no ganho de capital
     */
    protected function calcularImposto(float $ganho): float
    {
        if ($ganho <= 0) return 0;

        // Alíquotas progressivas
        if ($ganho <= 5000000) {
            return $ganho * 0.15;
        } elseif ($ganho <= 10000000) {
            return $ganho * 0.175;
        } elseif ($ganho <= 30000000) {
            return $ganho * 0.20;
        } else {
            return $ganho * 0.225;
        }
    }

    /**
     * Formata valor em Real brasileiro
     */
    protected function formatCurrency(float $value): string
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    /**
     * Mascara documento (CPF/CNPJ)
     */
    protected function maskDocument(string $document): string
    {
        $clean = preg_replace('/\D/', '', $document);

        if (strlen($clean) === 11) {
            return substr($clean, 0, 3) . '.***.***-' . substr($clean, -2);
        } elseif (strlen($clean) === 14) {
            return substr($clean, 0, 2) . '.***.***/****-' . substr($clean, -2);
        }

        return '***';
    }

    /**
     * Retorna o próximo prazo do DARF
     */
    protected function getProximoPrazoDarf(): string
    {
        // Último dia útil do mês seguinte
        $proximoMes = now()->addMonth();
        $ultimoDia = $proximoMes->endOfMonth();

        // Ajustar para dia útil
        while ($ultimoDia->isWeekend()) {
            $ultimoDia->subDay();
        }

        return $ultimoDia->format('d/m/Y');
    }

    /**
     * Retorna o próximo prazo da IN1888
     */
    protected function getProximoPrazoIN1888(): string
    {
        // Último dia útil do mês seguinte
        return $this->getProximoPrazoDarf(); // Mesmo prazo
    }
}
