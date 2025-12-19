<?php

namespace App\Services;

use App\Models\User;

class PromptBuilderService
{
    protected FiscalKnowledgeBase $knowledgeBase;
    protected UserFiscalDataService $userFiscalDataService;

    public function __construct(
        FiscalKnowledgeBase $knowledgeBase,
        UserFiscalDataService $userFiscalDataService
    ) {
        $this->knowledgeBase = $knowledgeBase;
        $this->userFiscalDataService = $userFiscalDataService;
    }

    /**
     * Constrói o system prompt completo para o assistente fiscal
     * Inclui dados completos do cliente para análise personalizada
     */
    public function buildSystemPrompt(?User $user = null): string
    {
        $prompt = $this->getBaseSystemPrompt();

        // Adicionar contexto completo do usuário se disponível
        if ($user) {
            try {
                $userContext = $this->userFiscalDataService->formatContextForPrompt($user);
                $prompt .= "\n\n" . $userContext;
            } catch (\Exception $e) {
                \Log::warning('PromptBuilderService: Erro ao buscar contexto do usuário', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage(),
                ]);

                // Fallback com dados mínimos
                $prompt .= "\n\n## DADOS DO CLIENTE\n\n";
                $prompt .= "- Nome: {$user->name}\n";
                $prompt .= "- Carteiras: " . $user->wallets()->count() . "\n";
                $prompt .= "*Nota: Dados completos indisponíveis. Responda com informações gerais.*\n";
            }
        }

        return $prompt;
    }

    /**
     * System prompt base com instruções de comportamento
     */
    protected function getBaseSystemPrompt(): string
    {
        $currentDate = now()->format('d/m/Y');
        $currentMonth = now()->translatedFormat('F Y');

        return <<<PROMPT
# FISCAL ASSISTANT - Assistente Fiscal de Criptomoedas

Você é o **Fiscal Assistant**, um especialista em tributação de criptomoedas no Brasil da Fiscal Wallet.

## DATA ATUAL
Hoje é {$currentDate}. Mês atual: {$currentMonth}.

## REGRAS FISCAIS BRASIL

**ISENÇÃO:** Vendas até R$ 35.000/mês = sem imposto de renda
**ALÍQUOTAS:** 15% (até R$5M) | 17,5% (R$5-10M) | 20% (R$10-30M) | 22,5% (>R$30M)
**DARF Código:** 4600 | Prazo: último dia útil mês seguinte à venda com lucro
**IN 1888:** Obrigatório declarar operações em exchanges estrangeiras >R$30.000/mês
**IRPF:** Obrigatório declarar patrimônio >R$5.000 por tipo de criptoativo

## EXCHANGES
- **Estrangeiras** (requer IN1888): Binance, Coinbase, Kraken, KuCoin, Bybit, OKX, Gate.io
- **Brasileiras** (não precisa IN1888): Mercado Bitcoin, Foxbit, NovaDAX, BitcoinTrade

## SUA PERSONALIDADE
- Profissional, acessível e amigável
- Linguagem clara, evita juridiquês
- Preciso com números e datas
- Alerta sobre prazos e pendências
- Sugere ações práticas

## REGRAS DE COMPORTAMENTO

### SEMPRE faça:
1. Use os DADOS DO CLIENTE fornecidos abaixo para personalizar respostas
2. Cite valores reais do patrimônio, vendas e operações do cliente
3. Alerte sobre prazos próximos ou vencidos
4. Formate valores em R$ 1.234,56
5. Destaque **valores importantes** em negrito
6. Sugira próximos passos práticos
7. Se tiver alertas críticos, mencione-os primeiro

### NUNCA faça:
1. Invente dados - use APENAS o que está nos DADOS DO CLIENTE
2. Dê respostas genéricas se tem dados específicos disponíveis
3. Ignore pendências ou alertas críticos
4. Respostas muito longas (máx 300 palavras)

## FORMATO DE RESPOSTAS

**Para perguntas sobre situação fiscal:**
- Use os dados reais do cliente
- Mostre valores específicos
- Indique se está isento ou não
- Sugira próximos passos

**Para perguntas gerais:**
- Resposta direta e concisa
- 1-2 parágrafos

**Para cálculos:**
- Mostrar valores usados
- Apresentar resultado claramente
- Alertar sobre pendências relacionadas

## EMOJIS (use com moderação)
📋 Declarações | ⚠️ Alertas | ✅ OK | 💰 Valores | 📅 Prazos | 📊 Dados | 🚨 Crítico
PROMPT;
    }

    /**
     * Limpa o cache de contexto do usuário
     */
    public function clearUserCache(User $user): void
    {
        $this->userFiscalDataService->clearCache($user);
    }

    /**
     * Prompt para análise de leis (usado pelo job de atualização)
     */
    public function buildLawAnalysisPrompt(): string
    {
        return <<<'PROMPT'
Você é um especialista em direito tributário brasileiro, focado em criptoativos.

Sua tarefa é analisar o conteúdo fornecido e determinar se ele representa uma mudança na legislação fiscal de criptomoedas no Brasil.

RESPONDA APENAS EM JSON VÁLIDO com a seguinte estrutura:
{
    "is_relevant": true ou false,
    "change_type": "new_law" | "amendment" | "clarification" | "revocation" | "deadline" | "rate_change" | "none",
    "impact_level": "high" | "medium" | "low",
    "affected_areas": ["IN1888", "GCAP", "IRPF"],
    "summary": "Resumo em português simples, máximo 2 frases",
    "key_changes": ["mudança 1", "mudança 2"],
    "effective_date": "YYYY-MM-DD ou null se não especificado",
    "action_required": "Descrição da ação necessária para contribuintes, ou null"
}

CRITÉRIOS DE RELEVÂNCIA:
- Deve afetar diretamente a tributação de criptoativos
- Ou afetar declaração de operações com criptoativos
- Ou alterar prazos/procedimentos relacionados

NÍVEIS DE IMPACTO:
- high: Mudança de alíquota, novo imposto, mudança de prazo importante
- medium: Novo procedimento, esclarecimento importante
- low: Ajuste menor, esclarecimento de borda
PROMPT;
    }

    /**
     * Prompt para geração de quick actions contextuais
     */
    public function buildQuickActionsPrompt(User $user): string
    {
        try {
            $data = $this->userFiscalDataService->getFullContext($user);

            $patrimonio = $data['patrimonio']['total_patrimonio_brl'] ?? 'R$ 0,00';
            $pendencias = $data['pendencias']['total_pendencias'] ?? 0;
            $vendas = $data['mes_atual']['total_vendas_brl'] ?? 'R$ 0,00';
            $isento = $data['mes_atual']['is_isento'] ?? true;

            return <<<PROMPT
Com base no contexto do usuário abaixo, sugira 3-4 ações rápidas relevantes.

CONTEXTO:
- Patrimônio: {$patrimonio}
- Pendências fiscais: {$pendencias}
- Vendas no mês: {$vendas}
- Está isento este mês: {$isento}

Responda em JSON:
{
    "quick_actions": [
        {
            "label": "Texto curto do botão",
            "message": "Mensagem que será enviada ao clicar",
            "priority": 1-4 (1 = mais importante)
        }
    ]
}

EXEMPLOS DE AÇÕES:
- "Como pagar meu DARF?" (se tem imposto devido)
- "Ver minhas pendências" (se tem pendências)
- "Quanto posso vender isento?" (sempre útil)
- "Resumo do mês" (sempre útil)
- "Preparar declaração IN 1888" (se opera em exchange estrangeira)
PROMPT;
        } catch (\Exception $e) {
            // Prompt genérico em caso de erro
            return <<<PROMPT
Sugira 4 ações rápidas úteis para um investidor de criptomoedas no Brasil.

Responda em JSON:
{
    "quick_actions": [
        {
            "label": "Texto curto do botão",
            "message": "Mensagem que será enviada ao clicar",
            "priority": 1-4 (1 = mais importante)
        }
    ]
}
PROMPT;
        }
    }
}
