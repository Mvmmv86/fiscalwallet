<?php

namespace App\Services;

use App\Models\FiscalLaw;
use Illuminate\Support\Facades\Cache;

class FiscalKnowledgeBase
{
    /**
     * Retorna todo o conhecimento fiscal para o system prompt
     */
    public function getFullKnowledge(): string
    {
        return Cache::remember('fiscal_knowledge_base', 3600, function () {
            $knowledge = $this->getBaseKnowledge();

            // Adicionar leis do banco de dados
            $laws = FiscalLaw::active()->get();
            foreach ($laws as $law) {
                $knowledge .= "\n\n" . $law->getAIContext();
            }

            return $knowledge;
        });
    }

    /**
     * Conhecimento base hardcoded (sempre disponível)
     */
    public function getBaseKnowledge(): string
    {
        return <<<'KNOWLEDGE'
# CONHECIMENTO FISCAL - CRIPTOMOEDAS NO BRASIL

## 1. IN 1888/2019 - Instrução Normativa da Receita Federal

### O que é
A IN 1888 estabelece a obrigatoriedade de prestação de informações relativas às operações realizadas com criptoativos à Secretaria Especial da Receita Federal do Brasil (RFB).

### Quem deve declarar
- Exchanges brasileiras: devem reportar TODAS as operações
- Pessoas físicas: devem declarar quando operarem em exchanges ESTRANGEIRAS ou P2P

### Quando declarar (Pessoa Física)
Obrigatório quando o valor mensal das operações (isolado ou conjunto) ultrapassar R$ 30.000,00.

### Prazo
Último dia útil do mês subsequente ao das operações.

### Informações obrigatórias
- Data da operação
- Tipo de operação (compra, venda, permuta, doação, etc.)
- Titulares da operação (CPF/CNPJ)
- Criptoativos negociados
- Quantidade negociada
- Valor da operação em reais

### Penalidades por não declarar
- Multa de R$ 100,00 a R$ 500,00 por mês de atraso (pessoa física)
- Multa de 1,5% a 3% do valor das operações não declaradas

### Exchanges consideradas ESTRANGEIRAS
- Binance (sede: Malta/Ilhas Cayman)
- Coinbase (sede: EUA)
- Kraken (sede: EUA)
- FTX (sede: Bahamas) - falida
- KuCoin (sede: Seychelles)
- Bybit (sede: Dubai)
- OKX (sede: Seychelles)

### Exchanges consideradas BRASILEIRAS
- Mercado Bitcoin
- Foxbit
- NovaDAX
- BitcoinTrade
- Bitcointoyou

## 2. GCAP - Ganho de Capital

### O que é
O GCAP (Programa de Apuração de Ganhos de Capital) é utilizado para calcular e declarar o imposto sobre ganhos obtidos na venda de criptoativos.

### Regra de Isenção
Vendas de criptoativos são ISENTAS de imposto quando o TOTAL de alienações no mês for igual ou inferior a R$ 35.000,00.

**IMPORTANTE:**
- O limite de R$ 35.000 considera o valor TOTAL vendido, não o lucro
- Se ultrapassar R$ 35.000 em vendas no mês, TODO o lucro é tributável
- Vendas abaixo de R$ 35.000 com prejuízo não geram imposto, mas o prejuízo pode ser compensado

### Alíquotas de Imposto
| Faixa de Ganho | Alíquota |
|----------------|----------|
| Até R$ 5 milhões | 15% |
| De R$ 5M a R$ 10M | 17,5% |
| De R$ 10M a R$ 30M | 20% |
| Acima de R$ 30M | 22,5% |

### Cálculo do Ganho
```
Ganho de Capital = Valor de Venda - Custo de Aquisição - Taxas
```

### Método de Cálculo do Custo
O Brasil adota o método do **Custo Médio Ponderado** (também chamado de Preço Médio):
```
Custo Médio = Soma de todas as compras em R$ / Quantidade total adquirida
```

### Prazo de Pagamento
O DARF deve ser pago até o último dia útil do mês subsequente ao da operação.

### Código do DARF
- **4600** - Ganhos de Capital na alienação de bens e direitos

### Compensação de Prejuízos
- Prejuízos em um mês podem ser compensados com lucros em meses subsequentes
- Não há limite temporal para compensação
- O prejuízo deve ser do mesmo tipo de operação (criptoativos com criptoativos)

## 3. IRPF - Declaração Anual

### Obrigatoriedade
Criptoativos devem ser declarados na ficha "Bens e Direitos" quando o valor de aquisição for superior a R$ 5.000,00 por tipo de criptoativo.

### Grupo e Códigos
**Grupo 08 - Criptoativos**

| Código | Descrição |
|--------|-----------|
| 01 | Bitcoin (BTC) |
| 02 | Outras criptomoedas (Altcoins): ETH, LTC, XRP, etc. |
| 03 | Stablecoins: USDT, USDC, BUSD, DAI, etc. |
| 10 | NFTs (Tokens Não Fungíveis) |
| 99 | Outros criptoativos |

### O que declarar
- Quantidade do ativo
- Valor de aquisição (custo total em R$)
- Localização (exchange ou carteira)
- Descrição detalhada

### Exemplo de Discriminação
```
0,5 Bitcoin (BTC) adquirido em 15/03/2024 na exchange Binance.
Custo total de aquisição: R$ 150.000,00.
Preço médio: R$ 300.000,00 por unidade.
```

## 4. Operações Especiais

### Permuta (Swap/Trade)
- Troca entre criptoativos é considerada ALIENAÇÃO
- Deve ser calculado ganho de capital na moeda de saída
- Valor de referência: cotação em BRL no momento da operação

### Staking/Yield
- Rendimentos de staking são tributáveis
- Considerados como "outros rendimentos"
- Alíquota de 15% a 27,5% (tabela progressiva IRPF)

### Airdrops
- Ativos recebidos gratuitamente
- Custo de aquisição = R$ 0,00
- Na venda, todo valor é ganho de capital

### Hard Forks
- Novos ativos recebidos têm custo de aquisição = R$ 0,00
- Tributação apenas na alienação

### DeFi (Finanças Descentralizadas)
- Operações em DEXs são tributáveis
- Farming/Liquidity: rendimentos são tributáveis
- Empréstimos: juros recebidos são tributáveis

## 5. Prazos Importantes

| Obrigação | Prazo |
|-----------|-------|
| IN 1888 (mensal) | Último dia útil do mês seguinte |
| DARF GCAP | Último dia útil do mês seguinte |
| IRPF | Último dia útil de abril do ano seguinte |

## 6. Multas e Penalidades

### Atraso no pagamento do DARF
- Multa: 0,33% ao dia, limitado a 20%
- Juros: Taxa SELIC acumulada

### Não declaração IN 1888
- Multa de 1,5% a 3% sobre o valor das operações
- Mínimo: R$ 100,00 (pessoa física) ou R$ 500,00 (pessoa jurídica)

### Omissão na IRPF
- Multa de 75% sobre o imposto devido
- Em caso de fraude: 150%

## 7. Dicas de Planejamento Tributário

### Tax Loss Harvesting
- Realizar prejuízos em meses com lucro para compensar
- Não há limite temporal para uso de prejuízos acumulados

### Controle do limite de R$ 35.000
- Distribuir vendas entre meses diferentes
- Monitorar o total vendido durante o mês

### Documentação
- Guardar todos os comprovantes por no mínimo 5 anos
- Manter registro de todas as operações, mesmo isentas
- Screenshots de transações em exchanges

### Atenção com Stablecoins
- Conversão para stablecoins é considerada venda
- Mesmo trocando BTC por USDT, há evento tributável

## 8. Fontes Oficiais

- Receita Federal: https://www.gov.br/receitafederal
- IN 1888: http://normas.receita.fazenda.gov.br/sijut2consulta/link.action?idAto=100592
- Perguntas e Respostas IRPF: https://www.gov.br/receitafederal/pt-br/assuntos/meu-imposto-de-renda

## 9. Últimas Atualizações (2024-2025)

### Lei 14.754/2023 (Nova tributação de offshores)
- Afeta brasileiros com criptoativos em exchanges estrangeiras
- Novas regras de declaração de ativos no exterior
- Vigência a partir de 2024

### Projeto de Lei sobre Criptoativos
- Em discussão no Congresso
- Pode alterar regras de tributação
- Acompanhar: PL 4401/2021 (Marco Regulatório Cripto)
KNOWLEDGE;
    }

    /**
     * Limpa o cache do knowledge base
     */
    public function clearCache(): void
    {
        Cache::forget('fiscal_knowledge_base');
    }

    /**
     * Retorna conhecimento específico por tema
     */
    public function getKnowledgeByTopic(string $topic): ?string
    {
        $topics = [
            'in1888' => $this->getIN1888Knowledge(),
            'gcap' => $this->getGCAPKnowledge(),
            'irpf' => $this->getIRPFKnowledge(),
            'isencao' => $this->getIsencaoKnowledge(),
            'multas' => $this->getMultasKnowledge(),
            'darf' => $this->getDARFKnowledge(),
        ];

        return $topics[$topic] ?? null;
    }

    protected function getIN1888Knowledge(): string
    {
        return <<<'TEXT'
A IN 1888/2019 obriga a declaração mensal de operações com criptoativos.

QUEM DEVE DECLARAR:
- Exchanges brasileiras: reportam automaticamente
- Pessoas físicas: apenas se operarem em exchanges estrangeiras E o valor mensal ultrapassar R$ 30.000

PRAZO: Último dia útil do mês seguinte às operações.

MULTA POR ATRASO: R$ 100 a R$ 500 por mês + 1,5% a 3% do valor não declarado.
TEXT;
    }

    protected function getGCAPKnowledge(): string
    {
        return <<<'TEXT'
O GCAP é o programa para calcular ganho de capital na venda de criptoativos.

ISENÇÃO: Vendas até R$ 35.000/mês são ISENTAS.

ALÍQUOTAS:
- Até R$ 5M: 15%
- R$ 5M a R$ 10M: 17,5%
- R$ 10M a R$ 30M: 20%
- Acima de R$ 30M: 22,5%

CÁLCULO: Ganho = Valor Venda - Custo Aquisição - Taxas

PRAZO DARF: Último dia útil do mês seguinte.
TEXT;
    }

    protected function getIRPFKnowledge(): string
    {
        return <<<'TEXT'
Criptoativos devem ser declarados no IRPF se valor > R$ 5.000 por tipo.

CÓDIGOS (Grupo 08):
- 01: Bitcoin
- 02: Altcoins (ETH, etc)
- 03: Stablecoins (USDT, etc)
- 10: NFTs
- 99: Outros

PRAZO: Último dia útil de abril do ano seguinte.
TEXT;
    }

    protected function getIsencaoKnowledge(): string
    {
        return <<<'TEXT'
REGRA DE ISENÇÃO:
Vendas de criptoativos são isentas quando o TOTAL vendido no mês for até R$ 35.000.

IMPORTANTE:
- O limite considera o VALOR TOTAL vendido, não o lucro
- Se ultrapassar R$ 35.000, TODO o lucro é tributável
- Inclui todas as vendas somadas (BTC + ETH + outras)
- Conversão para stablecoins também conta como venda
TEXT;
    }

    protected function getMultasKnowledge(): string
    {
        return <<<'TEXT'
MULTAS E PENALIDADES:

DARF em atraso:
- Multa: 0,33% ao dia (máximo 20%)
- Juros: Taxa SELIC

IN 1888 não declarada:
- Multa: 1,5% a 3% do valor das operações
- Mínimo: R$ 100 (PF) ou R$ 500 (PJ)

IRPF omissão:
- Multa: 75% do imposto devido
- Fraude: 150% do imposto devido
TEXT;
    }

    protected function getDARFKnowledge(): string
    {
        return <<<'TEXT'
DARF - Documento de Arrecadação de Receitas Federais

CÓDIGO: 4600 (Ganho de Capital - Pessoa Física)

PRAZO: Último dia útil do mês seguinte à operação com lucro.

DADOS NECESSÁRIOS:
- CPF
- Código de receita: 4600
- Período de apuração: mês/ano da operação
- Valor principal
- Multa/Juros (se em atraso)

COMO EMITIR: Pelo programa SICALC da Receita Federal ou pelo e-CAC.
TEXT;
    }
}
