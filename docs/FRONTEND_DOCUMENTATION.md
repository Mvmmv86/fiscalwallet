# Fiscal Wallet - Documentacao Frontend

## Indice
1. [Design System](#design-system)
2. [Layout Base](#layout-base)
3. [Telas e Wireframes](#telas-e-wireframes)
4. [Componentes Reutilizaveis](#componentes-reutilizaveis)
5. [Responsividade](#responsividade)
6. [Assets e Imagens](#assets-e-imagens)

---

## Design System

### Paleta de Cores

#### Cores Primarias
| Nome | Hex | RGB | Uso |
|------|-----|-----|-----|
| Primary Purple | `#9333EA` | rgb(147, 51, 234) | Botoes primarios, links, destaques |
| Primary Purple Light | `#A855F7` | rgb(168, 85, 247) | Hover states, gradientes |
| Primary Purple Dark | `#7C3AED` | rgb(124, 58, 237) | Active states |

#### Cores de Status
| Nome | Hex | RGB | Uso |
|------|-----|-----|-----|
| Success Green | `#22C55E` | rgb(34, 197, 94) | Ganhos, sucesso, isento |
| Danger Red | `#EF4444` | rgb(239, 68, 68) | Perdas, erros, saida |
| Warning Yellow | `#F59E0B` | rgb(245, 158, 11) | Pendente, alertas |
| Info Blue | `#3B82F6` | rgb(59, 130, 246) | Informacoes |

#### Cores Neutras
| Nome | Hex | RGB | Uso |
|------|-----|-----|-----|
| Background | `#F8F8FA` | rgb(248, 248, 250) | Fundo da aplicacao |
| Surface | `#FFFFFF` | rgb(255, 255, 255) | Cards, modais |
| Border | `#DDD8E1` | rgb(221, 216, 225) | Bordas, divisores |
| Text Primary | `#1F1F1F` | rgb(31, 31, 31) | Texto principal |
| Text Secondary | `#6B7280` | rgb(107, 114, 128) | Texto secundario |
| Text Muted | `#9CA3AF` | rgb(156, 163, 175) | Labels, placeholders |

#### Cores do Sidebar
| Nome | Hex | RGB | Uso |
|------|-----|-----|-----|
| Sidebar Background | `#F8F8FA` | rgb(248, 248, 250) | Fundo do menu lateral |
| Sidebar Active | `#9333EA` | rgb(147, 51, 234) | Item ativo |
| Sidebar Hover | `#F3E8FF` | rgb(243, 232, 255) | Hover nos itens |

### Tipografia

#### Fonte Principal
- **Font Family:** Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif

#### Tamanhos
| Nome | Size | Weight | Line Height | Uso |
|------|------|--------|-------------|-----|
| Display | 32px | 700 | 1.2 | Titulos de pagina |
| Heading 1 | 24px | 600 | 1.3 | Titulos de secao |
| Heading 2 | 20px | 600 | 1.4 | Subtitulos |
| Heading 3 | 18px | 600 | 1.4 | Titulos de cards |
| Body Large | 16px | 400 | 1.5 | Texto principal |
| Body | 14px | 400 | 1.5 | Texto padrao |
| Body Small | 12px | 400 | 1.5 | Texto auxiliar |
| Caption | 11px | 500 | 1.4 | Labels, badges |

### Espacamento

#### Sistema de Grid
- **Base Unit:** 4px
- **Espacamentos:** 4, 8, 12, 16, 20, 24, 32, 40, 48, 64px

#### Padding de Componentes
| Componente | Padding |
|------------|---------|
| Cards | 24px |
| Botoes LG | 16px 32px |
| Botoes MD | 12px 24px |
| Botoes SM | 8px 16px |
| Inputs | 12px 16px |
| Modais | 32px |

### Border Radius
| Nome | Valor | Uso |
|------|-------|-----|
| Small | 4px | Badges, tags |
| Default | 8px | Inputs, botoes |
| Medium | 12px | Cards pequenos |
| Large | 16px | Cards, modais |
| XLarge | 24px | Cards destacados |
| Full | 9999px | Botoes pill, avatares |

### Sombras
```css
/* Card Shadow */
box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);

/* Elevated Shadow */
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);

/* Modal Shadow */
box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15), 0 10px 10px rgba(0, 0, 0, 0.04);
```

---

## Layout Base

### Estrutura Principal (Desktop)
```
+------------------+----------------------------------------+
|                  |              HEADER (64px)             |
|     SIDEBAR      +----------------------------------------+
|     (240px)      |                                        |
|                  |              CONTENT AREA              |
|                  |           (padding: 32px)              |
|                  |                                        |
+------------------+----------------------------------------+
```

### Header
- **Altura:** 64px
- **Background:** #FFFFFF
- **Border Bottom:** 1px solid #DDD8E1
- **Componentes:**
  - Logo (esquerda no mobile)
  - Titulo da pagina (centro)
  - Notificacoes (icone sino)
  - Avatar do usuario com dropdown

### Sidebar (Desktop)
- **Largura:** 240px
- **Background:** #F8F8FA
- **Border Right:** 1px solid #DDD8E1
- **Itens do Menu:**
  - Dashboard (icone: grid)
  - Portfolio (icone: wallet)
  - Carteiras (icone: credit-card)
  - Operacoes (icone: list)
  - Declaracoes (icone: file-text)
  - Blog (icone: book)
  - Central de ajuda (icone: help-circle)

### Content Area
- **Background:** #F8F8FA
- **Padding:** 32px
- **Max Width:** 1440px (centralizado)

---

## Telas e Wireframes

### 1. Dashboard (Home)
**Arquivo:** `dashboard-v1.png`

#### Estrutura do Wireframe
```
+------------------------------------------------------------------+
| [<-] [2023 v] [Calendario]                                       |
+------------------------------------------------------------------+
| +----------------+ +------------+ +------------+ +---------------+|
| | DESEMPENHO MES | |   GANHOS   | |   PERDAS   | | QTD OPERACOES ||
| | R$ 34.000,00   | | R$50.000   | | R$16.000   | |      58       ||
| | (purple bg)    | | (green)    | | (red)      | | (neutral)     ||
| +----------------+ +------------+ +------------+ +---------------+|
+------------------------------------------------------------------+
| +---------------------------+ +------------------+ +-------------+|
| |      VISAO GERAL          | |     RESUMO       | |   BANNER    ||
| | [1D][1S][1M][1A][Tudo]    | | Limite isencao   | |  MBR INVEST ||
| | Total: R$ 3.232.786,93    | | Valor tributario | |  (imagem)   ||
| |                           | | Prox declaracao  | |             ||
| | [GRAFICO DE LINHA]        | | Qtd operacoes    | |             ||
| |    Jan-Dez                | | [Ver declaracoes]| |             ||
| +---------------------------+ +------------------+ +-------------+|
+------------------------------------------------------------------+
| +---------------------------+ +----------------------------------+|
| |    PRINCIPAIS ATIVOS      | |       ULTIMAS OPERACOES          ||
| | [GRAFICO PIZZA]           | | Valor | Moeda | Taxa | Data|Tipo ||
| | - BTC    R$ 1.000.000     | | 1M    | USDT  | 0,5  | 20/01|Ent ||
| | - ETH    R$ 500.000       | | 1M    | BTC   | 0,5  | 20/01|Sai ||
| | - USDT   R$ 500.000       | | 1M    | ETH   | 0,5  | 20/01|Sai ||
| | - XRP    R$ 500.000       | |                                  ||
| | [Ver todas]               | | [Ver todas]                      ||
| +---------------------------+ +----------------------------------+|
+------------------------------------------------------------------+
```

#### Componentes da Tela
1. **Header de Navegacao**
   - Botao voltar (seta esquerda)
   - Seletor de ano (2023)
   - Icone calendario

2. **Cards de Metricas (4 cards)**
   - Desempenho do mes (fundo roxo, texto branco)
   - Ganhos (icone verde)
   - Perdas (icone vermelho)
   - Quantidade de operacoes

3. **Secao Visao Geral**
   - Filtros de periodo: 1D, 1S, 1M, 1A, Tudo
   - Valor total de mercado
   - Grafico de linha (eixo Y: valores, eixo X: meses)

4. **Secao Resumo**
   - Limite de isencao com barra de progresso
   - Valor tributario a pagar
   - Proxima data para declaracao
   - Quantidade de operacoes
   - Botao "Ver declaracoes"

5. **Banner Promocional**
   - Imagem MBR Invest
   - Texto promocional

6. **Principais Ativos**
   - Grafico de pizza/donut
   - Lista de ativos com valores
   - Botao "Ver todas"

7. **Ultimas Operacoes**
   - Tabela com colunas: Valor, Moeda, Taxa, Data/Hora, Tipo
   - Badge de tipo (Entrada=verde, Saida=vermelho)
   - Botao "Ver todas"

#### Responsividade Dashboard
- **Desktop (>1200px):** Layout em grid 3 colunas
- **Tablet (768-1199px):** Layout em grid 2 colunas
- **Mobile (<768px):** Layout em coluna unica, cards empilhados

---

### 2. Declaracoes
**Arquivo:** `declaracoes.png`

#### Estrutura do Wireframe
```
+------------------------------------------------------------------+
|                                        [Validar operacoes] btn   |
+------------------------------------------------------------------+
| [2023 v] [Calendario]                                            |
+------------------------------------------------------------------+
| +----------------------------------------------------------------+|
| | TABELA DE DECLARACOES                                          ||
| +----------------------------------------------------------------+|
| | Mes | Valor Op. | Valor Alien. | Taxas | N Trans | IN1888 |...|
| +----------------------------------------------------------------+|
| | DEZ | 3.000.000 | 3.000.000    | 3M    | 50      | Pend.  |...|
| | NOV | 3.000.000 | 3.000.000    | 3M    | 50      | Isento |...|
| | OUT | 3.000.000 | 3.000.000    | 3M    | 50      | Isento |...|
| | ... | ...       | ...          | ...   | ...     | ...    |...|
| +----------------------------------------------------------------+|
+------------------------------------------------------------------+
```

#### Colunas da Tabela
1. **Mes** - Abreviacao do mes (DEZ, NOV, OUT...)
2. **Valor total operado** - Formato: R$ X.XXX.XXX,XX
3. **Valor total de alienacao** - Formato: R$ X.XXX.XXX,XX
4. **Taxas** - Formato: R$ X.XXX.XXX,XX
5. **N de transacoes** - Numero inteiro
6. **IN.1888** - Badge de status (Pendente/Isento)
7. **GCAP** - Badge de status (Pendente/Isento)
8. **IRPF** - Badge de status (Pendente/Isento)
9. **Acoes** - Menu de 3 pontos (more-vertical)

#### Status Badges
- **Pendente:** Background amarelo/laranja claro, texto escuro
- **Isento:** Background verde claro, texto verde escuro

#### Responsividade Declaracoes
- **Desktop:** Tabela completa
- **Tablet:** Scroll horizontal na tabela
- **Mobile:** Cards empilhados com informacoes resumidas

---

### 3. Operacoes
**Arquivo:** `operacoes.png`

#### Estrutura do Wireframe
```
+------------------------------------------------------------------+
| [Adicionar operacao] [Recalcular] [Validar op.] [Exportar]       |
+------------------------------------------------------------------+
| [2023/Jul v] [Pesquisar Q] [Carteiras v] [Ordem v] [Filtro Y]    |
+------------------------------------------------------------------+
| [ ] | Tipo     | Data           | Crypto | Carteira | V.Entrada..|
+------------------------------------------------------------------+
| [ ] | Saque    | Jul 25 22:15   | USDT   | Binance  | R$ 0,00   ..|
| [ ] | Deposito | Jul 25 22:15   | USDT   | Binance  | R$ 0,00   ..|
| [ ] | Deposito | Jul 25 22:15   | USDT   | Binance  | R$ 0,00   ..|
| ... |          |                |        |          |           ..|
+------------------------------------------------------------------+
|                                         1-50 de 1000  [<] [>]    |
+------------------------------------------------------------------+
```

#### Botoes de Acao (Header)
1. **Adicionar operacao** - Botao primario roxo
2. **Recalcular** - Botao outline roxo
3. **Validar operacoes** - Botao outline roxo
4. **Exportar** - Botao outline neutro

#### Filtros
- Seletor de mes/ano
- Campo de pesquisa
- Dropdown de carteiras
- Dropdown de ordenacao
- Botao de filtros avancados

#### Colunas da Tabela
1. **Checkbox** - Para selecao multipla
2. **Tipo** - Badge colorido (Saque=roxo, Deposito=verde)
3. **Data** - Formato: Jul 25 2023 22:15
4. **Crypto** - Simbolo da moeda (USDT, BTC, ETH)
5. **Carteira** - Nome da exchange/carteira
6. **Valor de entrada** - Formato monetario
7. **Valor de saida** - Formato monetario
8. **Taxa** - Formato monetario
9. **Preco medio** - Formato monetario
10. **Lucro/Prejuizo** - Formato monetario (verde/vermelho)
11. **Acoes** - Menu de 3 pontos

#### Paginacao
- Texto: "1-50 de 1000"
- Botoes de navegacao: anterior (<) e proximo (>)

---

### 4. Carteiras
**Arquivo:** `carteiras.png`

#### Estrutura do Wireframe
```
+------------------------------------------------------------------+
|                              [Adicionar carteira] [Sincronizar]  |
+------------------------------------------------------------------+
| [2023/Jul v] [Pesquisar Q] [Carteiras v] [Ordem v] [Filtro Y]    |
+------------------------------------------------------------------+
| +----------------------------------------------------------------+|
| | Binance        | 64 operacoes  | Sincronizado | R$ 0,00 | ... ||
| | Exchange       | 51 dias atras | 6 dias atras | R$ 0,00 |     ||
| +----------------------------------------------------------------+|
|                                              1-10 de 1  [<] [>]  |
+------------------------------------------------------------------+
```

#### Botoes de Acao
1. **Adicionar carteira** - Botao primario roxo
2. **Sincronizar tudo** - Botao outline roxo

#### Card de Carteira
- Nome da carteira (Binance)
- Tipo (Exchange)
- Quantidade de operacoes
- Tempo desde ultima importacao
- Status de sincronizacao
- Valores (2 colunas)
- Menu de acoes (3 pontos)

---

### 5. Modal: Conectar com Binance
**Arquivo:** `conectar-binance.png`

#### Estrutura do Wireframe
```
+------------------------------------------+
| Conectar com a Binance              [X]  |
+------------------------------------------+
| Digite o nome da carteira                |
| +--------------------------------------+ |
| | Pesquisar                        [Q] | |
| +--------------------------------------+ |
|                                          |
| Importar operacoes                       |
| +--------------------------------------+ |
| |      Importacao automatica           | |
| +--------------------------------------+ |
| +--------------------------------------+ |
| |      Importacao manual               | |
| +--------------------------------------+ |
|                                          |
|                          [Continuar btn] |
+------------------------------------------+
```

#### Componentes
1. **Header do Modal**
   - Titulo: "Conectar com a Binance"
   - Botao fechar (X)

2. **Campo de Nome**
   - Label: "Digite o nome da carteira"
   - Input com icone de busca

3. **Opcoes de Importacao**
   - Label: "Importar operacoes"
   - Radio/Toggle: Importacao automatica
   - Radio/Toggle: Importacao manual

4. **Botao de Acao**
   - Botao "Continuar" - primario roxo

#### Dimensoes do Modal
- **Largura:** 480px (max)
- **Padding:** 32px
- **Border Radius:** 16px

---

### 6. Modal: Gerar Relatorio Fiscal
**Arquivos:** `relatorio-fiscal-v1.png`, `relatorio-fiscal-v2.png`, `relatorio-fiscal-v3.png`

#### Estado 1: Formulario
```
+------------------------------------------+
| Gerar relatorio fiscal              [X]  |
+------------------------------------------+
| Periodo do relatorio                     |
| +--------------------------------------+ |
| | Selecionar data                      | |
| +--------------------------------------+ |
|                                          |
| Descricao                                |
| +--------------------------------------+ |
| | Digite aqui a descricao              | |
| |                                      | |
| +--------------------------------------+ |
|                                          |
|                              [Gerar btn] |
+------------------------------------------+
```

#### Estado 2: Processando
```
+------------------------------------------+
| Gerar relatorio fiscal              [X]  |
+------------------------------------------+
| [check] Consultando transacoes           |
| [spin]  Consolidando operacoes           |
| [spin]  Calculando lucros                |
| [spin]  Aplicando regras fiscais         |
| [spin]  Gerando documento                |
+------------------------------------------+
```

#### Estado 3: Concluido
```
+------------------------------------------+
| Gerar relatorio fiscal              [X]  |
+------------------------------------------+
| [check] Consultando transacoes           |
| [check] Consolidando operacoes           |
| [check] Calculando lucros                |
| [check] Aplicando regras fiscais         |
| [check] Gerando documento                |
|                                          |
|                     [Baixar relatorio]   |
+------------------------------------------+
```

#### Componentes
1. **Formulario**
   - Input de data (date picker)
   - Textarea para descricao

2. **Lista de Progresso**
   - Icone de status (check verde ou spinner)
   - Texto da etapa

3. **Botoes**
   - "Gerar" - primario roxo
   - "Baixar relatorio" - primario roxo

---

### 7. Relatorios
**Arquivo:** `dashboard-v2.png` (renomear para `relatorios.png`)

> **NOTA:** Esta tela é a de Relatórios, NÃO é o Dashboard.
> O Dashboard (Home) é a tela com cards de métricas, gráfico de pizza e últimas operações.
> Esta tela de Relatórios exibe apenas o gráfico em tela inteira com filtros de exportação.

#### Estrutura do Wireframe
```
+------------------------------------------------------------------+
| [<-] [2023 v] [Carteiras v]                  [Exportar relatorio]|
+------------------------------------------------------------------+
| +----------------------------------------------------------------+|
| | VISAO GERAL                                                    ||
| +----------------------------------------------------------------+|
| | * Valor declarado (i)  | * Operacoes (i)  | * Lucro/Prej (i)  ||
| | R$ 3.232.786,93        | 1000             | R$ 3.232.786,93   ||
| +----------------------------------------------------------------+|
| |                                                                ||
| | [GRAFICO DE LINHAS - 2 series: verde e roxo]                   ||
| | Jan  Fev  Mar  Abril  Mai  Jun  Jul  Ago  Set  Out  Nov  Dez   ||
| |                                                                ||
| +----------------------------------------------------------------+|
+------------------------------------------------------------------+
| +----------------------------------------------------------------+|
| | ATIVOS                                                         ||
| +----------------------------------------------------------------+|
| | * BTC                                         R$ 1.000.000,00  ||
| | * ETH                                         R$ 500.000,00    ||
| | * USDT                                        R$ 500.000,00    ||
| | * XRP                                         R$ 500.000,00    ||
| | * Outros                                      R$ 500.000,00    ||
| +----------------------------------------------------------------+|
+------------------------------------------------------------------+
```

---

### 8. Versao Mobile
**Arquivo:** `iphone-mobile.png`

#### Estrutura do Wireframe (Mobile)
```
+-------------------------+
| [Logo]     [Bell] [Menu]|
+-------------------------+
| +---------------------+ |
| | DESEMPENHO DO MES   | |
| | R$ 34.000,00        | |
| | (purple gradient)   | |
| +---------------------+ |
| +---------------------+ |
| |      GANHOS         | |
| |   R$ 50.000,00      | |
| +---------------------+ |
| +---------------------+ |
| |      PERDAS         | |
| |   R$ 16.000,00      | |
| +---------------------+ |
| +---------------------+ |
| | QTD DE OPERACOES    | |
| |        58           | |
| +---------------------+ |
| +---------------------+ |
| | Limite de isencao   | |
| | R$34.000/R$35.000   | |
| |---------------------| |
| | Valor tributario    | |
| | R$0,00              | |
| |---------------------| |
| | Prox. declaracao    | |
| | 24/Abr              | |
| |---------------------| |
| |   [Declaracoes]     | |
| +---------------------+ |
+-------------------------+
```

#### Adaptacoes Mobile
- Header simplificado com menu hamburger
- Cards em coluna unica (full width)
- Botoes ocupando largura total
- Tabelas convertidas em cards
- Menu lateral convertido em drawer

---

## Componentes Reutilizaveis

### 1. Botoes

#### Variantes
```
Primary (Roxo):     bg-purple-600, text-white, hover:bg-purple-700
Secondary (Outline): border-purple-600, text-purple-600, hover:bg-purple-50
Neutral (Outline):   border-gray-300, text-gray-700, hover:bg-gray-50
Danger (Vermelho):   bg-red-500, text-white, hover:bg-red-600
Success (Verde):     bg-green-500, text-white, hover:bg-green-600
```

#### Tamanhos
```
XL: h-14, px-8, text-lg
LG: h-12, px-6, text-base
MD: h-10, px-4, text-sm
SM: h-8, px-3, text-xs
```

### 2. Inputs

#### Estados
- **Default:** border-gray-200, bg-gray-50
- **Focus:** border-purple-500, ring-2, ring-purple-100
- **Error:** border-red-500, ring-2, ring-red-100
- **Disabled:** bg-gray-100, text-gray-400

#### Variantes
- Input de texto simples
- Input com icone (esquerda ou direita)
- Select/Dropdown
- Date picker
- Textarea

### 3. Cards

#### Estrutura Base
```html
<div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
  <h3 class="text-lg font-semibold text-gray-900">Titulo</h3>
  <div class="mt-4">Conteudo</div>
</div>
```

#### Variantes
- Card de metrica (com icone e valor)
- Card de lista (com itens)
- Card destacado (com fundo colorido)

### 4. Tabelas

#### Estrutura
```html
<table class="w-full">
  <thead class="bg-gray-50 border-b">
    <tr>
      <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">
        Coluna
      </th>
    </tr>
  </thead>
  <tbody class="divide-y divide-gray-100">
    <tr class="hover:bg-gray-50">
      <td class="px-4 py-4 text-sm text-gray-900">Valor</td>
    </tr>
  </tbody>
</table>
```

### 5. Badges/Tags

#### Variantes de Status
```
Entrada:  bg-green-100, text-green-700, border-green-200
Saida:    bg-red-100, text-red-700, border-red-200
Pendente: bg-yellow-100, text-yellow-700, border-yellow-200
Isento:   bg-green-100, text-green-700, border-green-200
Saque:    bg-purple-100, text-purple-700, border-purple-200
Deposito: bg-green-100, text-green-700, border-green-200
```

### 6. Modais

#### Estrutura Base
```html
<!-- Overlay -->
<div class="fixed inset-0 bg-black/50 flex items-center justify-center">
  <!-- Modal -->
  <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 shadow-xl">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-semibold">Titulo</h2>
      <button class="p-2 hover:bg-gray-100 rounded-full">
        <X class="w-5 h-5" />
      </button>
    </div>
    <!-- Content -->
    <div class="space-y-4">...</div>
    <!-- Footer -->
    <div class="mt-6 flex justify-end">
      <button>Acao</button>
    </div>
  </div>
</div>
```

### 7. Sidebar

#### Estrutura
```html
<aside class="w-60 h-screen bg-gray-50 border-r border-gray-200">
  <!-- Logo -->
  <div class="p-6">
    <img src="logo.svg" alt="Fiscal Wallet" />
  </div>
  <!-- Menu -->
  <nav class="px-3 space-y-1">
    <a class="flex items-center gap-3 px-3 py-2 rounded-lg
              text-purple-600 bg-purple-50 font-medium">
      <Icon /> Dashboard
    </a>
    <a class="flex items-center gap-3 px-3 py-2 rounded-lg
              text-gray-600 hover:bg-gray-100">
      <Icon /> Portfolio
    </a>
  </nav>
</aside>
```

### 8. Graficos

#### Grafico de Linha
- Biblioteca sugerida: Chart.js ou ApexCharts
- Cores: Roxo (#9333EA) e Verde (#22C55E)
- Grid: Linhas horizontais tracejadas
- Tooltips: Card branco com sombra

#### Grafico de Pizza/Donut
- Cores: Gradiente de roxos e complementares
- Legenda: Lista ao lado (desktop) ou abaixo (mobile)

---

## Responsividade

### Breakpoints
```css
/* Mobile First */
sm: 640px   /* Celulares grandes */
md: 768px   /* Tablets */
lg: 1024px  /* Laptops */
xl: 1280px  /* Desktops */
2xl: 1536px /* Telas grandes */
```

### Comportamento por Breakpoint

#### Mobile (<768px)
- Sidebar: Hidden, menu hamburger
- Cards: Full width, empilhados
- Tabelas: Convertidas em cards ou scroll horizontal
- Botoes: Full width
- Modais: Full screen ou quase

#### Tablet (768px - 1024px)
- Sidebar: Colapsada (apenas icones) ou drawer
- Cards: Grid de 2 colunas
- Tabelas: Scroll horizontal se necessario
- Modais: Centralizados, max-width 90%

#### Desktop (>1024px)
- Sidebar: Expandida (240px)
- Cards: Grid de 3-4 colunas
- Tabelas: Full width
- Modais: Centralizados, max-width definido

---

## Assets e Imagens

### Icones
Biblioteca sugerida: **Lucide Icons** ou **Heroicons**

Icones utilizados:
- `grid` - Dashboard
- `wallet` - Portfolio
- `credit-card` - Carteiras
- `list` - Operacoes
- `file-text` - Declaracoes
- `book` - Blog
- `help-circle` - Central de ajuda
- `bell` - Notificacoes
- `search` - Pesquisa
- `filter` - Filtros
- `calendar` - Calendario
- `chevron-down` - Dropdowns
- `arrow-left` - Voltar
- `arrow-right` - Avancar
- `x` - Fechar
- `more-vertical` - Menu de acoes
- `check` - Sucesso/Concluido
- `alert-circle` - Alerta

### Imagens Exportadas
Localizacao: `docs/images/`

| Arquivo | Descricao |
|---------|-----------|
| dashboard-v1.png | Dashboard (Home) - tela principal com cards e gráficos |
| relatorios.png | Relatórios - gráfico em tela inteira com exportação |
| declaracoes.png | Listagem de declaracoes |
| operacoes.png | Listagem de operacoes |
| carteiras.png | Gestao de carteiras |
| conectar-binance.png | Modal conexao Binance |
| relatorio-fiscal-v1.png | Modal relatorio - form |
| relatorio-fiscal-v2.png | Modal relatorio - sucesso |
| relatorio-fiscal-v3.png | Modal relatorio - processando |
| iphone-mobile.png | Versao mobile |

### Logo
- Logo principal com icone e texto "Fiscal Wallet"
- Icone: Simbolo geometrico roxo/verde/azul
- Versoes: Colorido, monocromatico, icone apenas

---

## Implementacao Laravel/Livewire

### Estrutura Sugerida de Componentes Livewire

```
app/Livewire/
├── Dashboard/
│   ├── Index.php
│   ├── MetricCard.php
│   ├── ChartLine.php
│   ├── ChartPie.php
│   └── RecentOperations.php
├── Declarations/
│   ├── Index.php
│   └── Table.php
├── Operations/
│   ├── Index.php
│   ├── Table.php
│   └── AddOperationModal.php
├── Wallets/
│   ├── Index.php
│   ├── Card.php
│   └── ConnectBinanceModal.php
├── Reports/
│   ├── Index.php
│   └── GenerateReportModal.php
└── Shared/
    ├── Sidebar.php
    ├── Header.php
    ├── Pagination.php
    └── FilterBar.php
```

### Estrutura de Views Blade

```
resources/views/
├── components/
│   ├── button.blade.php
│   ├── input.blade.php
│   ├── card.blade.php
│   ├── badge.blade.php
│   ├── modal.blade.php
│   └── table.blade.php
├── layouts/
│   ├── app.blade.php
│   └── guest.blade.php
└── livewire/
    ├── dashboard/
    ├── declarations/
    ├── operations/
    ├── wallets/
    └── reports/
```

---

## Proximos Passos

1. [ ] Configurar projeto Laravel com Livewire
2. [ ] Instalar e configurar TailwindCSS
3. [ ] Criar componentes base (Button, Input, Card, etc.)
4. [ ] Implementar layout base (Sidebar + Header)
5. [ ] Desenvolver tela de Dashboard
6. [ ] Desenvolver tela de Declaracoes
7. [ ] Desenvolver tela de Operacoes
8. [ ] Desenvolver tela de Carteiras
9. [ ] Implementar modais
10. [ ] Ajustar responsividade
11. [ ] Testes de UI

---

*Documento gerado automaticamente a partir do Figma*
*Projeto: Plataforma - Fiscal Wallet*
*Data: Dezembro 2025*
