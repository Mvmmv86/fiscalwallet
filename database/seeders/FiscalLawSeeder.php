<?php

namespace Database\Seeders;

use App\Models\FiscalLaw;
use Illuminate\Database\Seeder;

class FiscalLawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laws = [
            [
                'code' => 'IN1888',
                'title' => 'Instrução Normativa RFB nº 1.888/2019',
                'description' => 'Obrigatoriedade de prestação de informações relativas às operações realizadas com criptoativos à Receita Federal.',
                'full_content' => $this->getIN1888Content(),
                'effective_date' => '2019-08-01',
                'last_updated' => '2023-06-15',
                'source_url' => 'http://normas.receita.fazenda.gov.br/sijut2consulta/link.action?idAto=100592',
                'keywords' => ['declaração', 'criptoativos', 'exchange', 'mensal', 'receita federal'],
                'metadata' => [
                    'limite_declaracao' => 30000,
                    'multa_minima_pf' => 100,
                    'multa_minima_pj' => 500,
                    'multa_percentual_min' => 1.5,
                    'multa_percentual_max' => 3.0,
                ],
                'is_active' => true,
            ],
            [
                'code' => 'GCAP',
                'title' => 'Ganho de Capital em Criptoativos',
                'description' => 'Regras de tributação sobre ganhos obtidos na alienação de criptoativos, incluindo isenção para vendas até R$ 35.000/mês.',
                'full_content' => $this->getGCAPContent(),
                'effective_date' => '2016-11-23',
                'last_updated' => '2024-01-01',
                'source_url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/orientacao-tributaria/declaracoes-e-demonstrativos/gcap',
                'keywords' => ['ganho de capital', 'imposto', 'venda', 'alienação', 'isenção', '35000'],
                'metadata' => [
                    'isencao_mensal' => 35000,
                    'aliquota_ate_5m' => 15,
                    'aliquota_5m_10m' => 17.5,
                    'aliquota_10m_30m' => 20,
                    'aliquota_acima_30m' => 22.5,
                    'codigo_darf' => '4600',
                ],
                'is_active' => true,
            ],
            [
                'code' => 'IRPF_CRIPTO',
                'title' => 'Declaração de Criptoativos no IRPF',
                'description' => 'Obrigatoriedade de declarar criptoativos na ficha Bens e Direitos quando valor de aquisição superior a R$ 5.000.',
                'full_content' => $this->getIRPFContent(),
                'effective_date' => '2019-01-01',
                'last_updated' => '2024-03-01',
                'source_url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/meu-imposto-de-renda',
                'keywords' => ['IRPF', 'declaração anual', 'bens e direitos', 'grupo 08'],
                'metadata' => [
                    'limite_declaracao' => 5000,
                    'grupo' => '08',
                    'codigo_btc' => '01',
                    'codigo_altcoins' => '02',
                    'codigo_stablecoins' => '03',
                    'codigo_nft' => '10',
                    'codigo_outros' => '99',
                ],
                'is_active' => true,
            ],
            [
                'code' => 'LEI_14754',
                'title' => 'Lei 14.754/2023 - Tributação de Offshores',
                'description' => 'Nova lei que afeta a tributação de ativos mantidos no exterior, incluindo criptoativos em exchanges estrangeiras.',
                'full_content' => $this->getLei14754Content(),
                'effective_date' => '2024-01-01',
                'last_updated' => '2023-12-13',
                'source_url' => 'https://www.planalto.gov.br/ccivil_03/_ato2023-2026/2023/lei/L14754.htm',
                'keywords' => ['offshore', 'exterior', 'exchange estrangeira', 'tributação'],
                'metadata' => [
                    'vigencia' => '2024-01-01',
                ],
                'is_active' => true,
            ],
            [
                'code' => 'COMPENSACAO_PREJUIZO',
                'title' => 'Compensação de Prejuízos em Criptoativos',
                'description' => 'Regras para compensação de prejuízos obtidos em operações com criptoativos.',
                'full_content' => $this->getCompensacaoContent(),
                'effective_date' => '2019-01-01',
                'last_updated' => '2023-01-01',
                'source_url' => 'https://www.gov.br/receitafederal/pt-br',
                'keywords' => ['prejuízo', 'compensação', 'perda', 'abatimento'],
                'metadata' => [
                    'limite_temporal' => 'sem_limite',
                    'mesmo_tipo_operacao' => true,
                ],
                'is_active' => true,
            ],
        ];

        foreach ($laws as $law) {
            FiscalLaw::updateOrCreate(
                ['code' => $law['code']],
                $law
            );
        }

        $this->command->info('Leis fiscais inseridas/atualizadas com sucesso!');
    }

    protected function getIN1888Content(): string
    {
        return <<<'CONTENT'
## IN 1888/2019 - Declaração de Operações com Criptoativos

### Obrigatoriedade
A pessoa física residente no Brasil que realizar operações com criptoativos em exchanges estrangeiras deve informar à Receita Federal quando o valor mensal das operações, isolado ou conjuntamente, ultrapassar R$ 30.000,00.

### Exchanges Consideradas Estrangeiras
- Binance (sede: Malta/Ilhas Cayman)
- Coinbase (sede: EUA)
- Kraken (sede: EUA)
- KuCoin (sede: Seychelles)
- Bybit (sede: Dubai)
- OKX (sede: Seychelles)

### Exchanges Brasileiras (não precisa declarar por conta própria)
- Mercado Bitcoin
- Foxbit
- NovaDAX
- BitcoinTrade

### Informações a Declarar
1. Data da operação
2. Tipo de operação (compra, venda, permuta, doação, transferência)
3. Titulares da operação
4. Criptoativos utilizados
5. Quantidade negociada
6. Valor da operação em reais

### Prazo
Último dia útil do mês seguinte às operações.

### Penalidades
- Multa por atraso: R$ 100,00 a R$ 500,00 por mês (pessoa física)
- Multa por omissão: 1,5% a 3% do valor das operações não declaradas
- Informações incorretas: multa de 3% sobre o valor incorreto

### Como Declarar
Através do programa e-Financeira ou sistema próprio da Receita Federal para criptoativos.
CONTENT;
    }

    protected function getGCAPContent(): string
    {
        return <<<'CONTENT'
## GCAP - Ganho de Capital em Criptoativos

### Conceito
O ganho de capital é a diferença positiva entre o valor de venda (alienação) e o custo de aquisição do criptoativo.

### Regra de Isenção (MUITO IMPORTANTE)
Alienações cujo valor total seja igual ou inferior a R$ 35.000,00 no mês são ISENTAS de imposto.

⚠️ ATENÇÃO: O limite de R$ 35.000 considera o VALOR TOTAL vendido no mês, NÃO o lucro.

Exemplo:
- Vendeu R$ 40.000 com lucro de R$ 5.000 = PAGA imposto sobre R$ 5.000
- Vendeu R$ 30.000 com lucro de R$ 5.000 = ISENTO

### Alíquotas
| Faixa de Ganho | Alíquota |
|----------------|----------|
| Até R$ 5 milhões | 15% |
| De R$ 5M a R$ 10M | 17,5% |
| De R$ 10M a R$ 30M | 20% |
| Acima de R$ 30M | 22,5% |

### Cálculo
```
Ganho = Valor de Venda - Custo de Aquisição - Taxas (corretagem, etc.)
Imposto = Ganho × Alíquota
```

### Método de Cálculo do Custo
Brasil adota o Custo Médio Ponderado:
```
Custo Médio = Total investido em R$ / Quantidade total
```

### Prazo de Pagamento
DARF deve ser pago até o último dia útil do mês seguinte à operação.

### Código DARF
4600 - Ganhos de Capital - Alienação de Bens e Direitos

### Operações que Geram Ganho de Capital
- Venda de criptoativo por reais
- Permuta (troca) entre criptoativos
- Pagamento de bens/serviços com criptoativos
- Doação (para quem recebe, se houver valorização)
CONTENT;
    }

    protected function getIRPFContent(): string
    {
        return <<<'CONTENT'
## Declaração de Criptoativos no IRPF

### Obrigatoriedade
Criptoativos devem ser declarados na ficha "Bens e Direitos" quando o custo de aquisição for superior a R$ 5.000,00 por tipo de criptoativo.

### Classificação - Grupo 08 (Criptoativos)
| Código | Descrição | Exemplos |
|--------|-----------|----------|
| 01 | Bitcoin | BTC |
| 02 | Outras criptomoedas | ETH, SOL, ADA, XRP, etc. |
| 03 | Stablecoins | USDT, USDC, BUSD, DAI |
| 10 | NFTs | Tokens Não Fungíveis |
| 99 | Outros criptoativos | Demais |

### O que informar
1. Código do bem (conforme tabela acima)
2. Discriminação detalhada
3. Situação em 31/12 do ano anterior
4. Situação em 31/12 do ano corrente (custo de aquisição)

### Modelo de Discriminação
```
2,5 Ethereum (ETH) adquiridos entre Jan-Dez/2024 nas exchanges
Binance e Mercado Bitcoin. Custo total de aquisição: R$ 25.000,00.
Preço médio de aquisição: R$ 10.000,00 por unidade.
Custodiados em carteira pessoal (hardware wallet).
```

### Valor a Declarar
Sempre declarar pelo CUSTO DE AQUISIÇÃO, nunca pelo valor de mercado.

### Prazo
Último dia útil de abril do ano seguinte ao ano-calendário.
CONTENT;
    }

    protected function getLei14754Content(): string
    {
        return <<<'CONTENT'
## Lei 14.754/2023 - Nova Tributação de Ativos no Exterior

### O que muda para Criptoativos
A lei estabelece novas regras de tributação para rendimentos e ganhos de capital em ativos mantidos no exterior.

### Impacto em Criptoativos
- Criptoativos mantidos em exchanges estrangeiras podem ser afetados
- Novas regras de apuração e recolhimento
- Atenção redobrada para quem opera em Binance, Coinbase, etc.

### Vigência
A partir de 1º de janeiro de 2024.

### Recomendação
Acompanhar regulamentações específicas da Receita Federal sobre a aplicação desta lei a criptoativos.
CONTENT;
    }

    protected function getCompensacaoContent(): string
    {
        return <<<'CONTENT'
## Compensação de Prejuízos em Criptoativos

### Regra Geral
Prejuízos apurados em operações com criptoativos podem ser compensados com lucros em operações futuras.

### Condições
1. O prejuízo deve ser do mesmo tipo de operação (criptoativos com criptoativos)
2. Não há limite temporal para utilização do prejuízo
3. O prejuízo deve estar devidamente documentado

### Como funciona
- Mês 1: Prejuízo de R$ 10.000
- Mês 2: Lucro de R$ 15.000
- Base de cálculo: R$ 15.000 - R$ 10.000 = R$ 5.000 tributável

### Importante
- Prejuízos em meses isentos também podem ser acumulados
- Manter registro de todos os prejuízos para compensação futura
- Não é possível compensar prejuízo de cripto com outras operações (ações, imóveis, etc.)

### Documentação
Guardar comprovantes por no mínimo 5 anos:
- Extratos de exchanges
- Histórico de operações
- Cálculos de ganho/perda por operação
CONTENT;
    }
}
