# PRD - Product Requirements Document
## Fiscal Wallet

**Versao:** 1.0
**Data:** Dezembro 2025
**Status:** Em Desenvolvimento

---

## 1. Visao Geral do Produto

### 1.1 O que e a Fiscal Wallet?

A **Fiscal Wallet** e uma plataforma de gestao fiscal para criptomoedas, desenvolvida para automatizar e gerenciar a declaracao de impostos sobre criptoativos no Brasil.

### 1.2 Proposta de Valor

> "Simplificar a vida de quem investe em criptomoedas, automatizando a parte fiscal e garantindo conformidade com a Receita Federal."

### 1.3 Problema que Resolve

| Problema | Impacto |
|----------|---------|
| Complexidade fiscal | Investidores nao sabem declarar criptos corretamente |
| Obrigacoes multiplas | IN 1888, GCAP, IRPF - cada um com regras diferentes |
| Rastreamento manual | Dificil consolidar operacoes de multiplas exchanges |
| Risco de multas | Declaracao incorreta gera penalidades da Receita Federal |
| Tempo gasto | Horas calculando ganho de capital manualmente |

### 1.4 Solucao

Plataforma que:
- Conecta automaticamente com exchanges (Binance, Mercado Bitcoin, etc.)
- Importa todas as transacoes via API
- Calcula ganho de capital automaticamente
- Gera relatorios prontos para declaracao
- Alerta sobre prazos e pendencias fiscais

---

## 2. Contexto de Mercado

### 2.1 Regulamentacao Brasileira

| Obrigacao | Descricao | Prazo |
|-----------|-----------|-------|
| **IN 1888** | Declaracao mensal de operacoes em exchanges estrangeiras | Ultimo dia util do mes seguinte |
| **GCAP** | Programa de Ganhos de Capital (quando ha lucro tributavel) | Ultimo dia util do mes seguinte |
| **IRPF** | Declaracao anual de Imposto de Renda | Abril de cada ano |

### 2.2 Regras de Tributacao

- **Isencao:** Vendas ate R$ 35.000/mes sao isentas de IR
- **Obrigatoriedade de declarar:** Patrimonio acima de R$ 5.000 em criptos
- **Aliquotas de IR sobre ganho de capital:**
  - Ate R$ 5 milhoes: **15%**
  - De R$ 5M a R$ 10M: **17,5%**
  - De R$ 10M a R$ 30M: **20%**
  - Acima de R$ 30M: **22,5%**

### 2.3 Concorrentes

| Plataforma | Foco | Preco |
|------------|------|-------|
| Koinly | Internacional | $49-$279/ano |
| CoinTracker | Internacional | $59-$199/ano |
| Declarando Bitcoin | Brasil | R$ 99-499/ano |
| TaxBit | Internacional/Enterprise | Variavel |

### 2.4 Diferencial Competitivo

- 100% focado no mercado brasileiro
- Interface em portugues
- Regras fiscais brasileiras nativas (IN 1888, GCAP, IRPF)
- Suporte a exchanges locais (Mercado Bitcoin, Foxbit, etc.)
- Preco competitivo em Reais

---

## 3. Usuarios e Personas

### 3.1 Persona Primaria: Investidor Individual

**Nome:** Carlos, 32 anos
**Perfil:** Desenvolvedor de software, investe em criptos desde 2020
**Patrimonio:** R$ 50.000 - R$ 500.000 em criptoativos
**Dor:** "Tenho medo de declarar errado e cair na malha fina"
**Objetivo:** Manter-se em dia com a Receita sem perder horas calculando

### 3.2 Persona Secundaria: Trader Ativo

**Nome:** Marina, 28 anos
**Perfil:** Day trader, faz dezenas de operacoes por mes
**Patrimonio:** R$ 100.000 - R$ 1.000.000 em criptoativos
**Dor:** "Impossivel rastrear centenas de operacoes manualmente"
**Objetivo:** Ter todas as operacoes consolidadas e impostos calculados automaticamente

### 3.3 Persona Terciaria: Holder de Longo Prazo

**Nome:** Roberto, 45 anos
**Perfil:** Empresario, comprou Bitcoin como reserva de valor
**Patrimonio:** R$ 500.000+ em criptoativos
**Dor:** "Nao entendo nada de imposto sobre cripto"
**Objetivo:** Delegar a parte fiscal para um sistema confiavel

---

## 4. Funcionalidades do Produto

### 4.1 MVP - Versao 1.0

#### 4.1.1 Autenticacao e Onboarding
- [ ] Cadastro com email/senha
- [ ] Login com autenticacao segura
- [ ] Fluxo de onboarding para novos usuarios
- [ ] Selecao de exchanges para conectar

#### 4.1.2 Integracao com Exchanges
- [ ] Conexao via API com Binance
- [ ] Conexao via API com Mercado Bitcoin
- [ ] Importacao manual via CSV/Excel
- [ ] Sincronizacao automatica periodica

#### 4.1.3 Dashboard (Home)
- [ ] Card de desempenho do mes
- [ ] Card de ganhos totais
- [ ] Card de perdas totais
- [ ] Card de quantidade de operacoes
- [ ] Grafico de evolucao patrimonial (linha)
- [ ] Grafico de alocacao por ativo (pizza)
- [ ] Resumo fiscal (limite isencao, valor a pagar, proxima declaracao)
- [ ] Lista de ultimas operacoes
- [ ] Banner promocional

#### 4.1.4 Gestao de Carteiras
- [ ] Listagem de carteiras conectadas
- [ ] Adicionar nova carteira
- [ ] Sincronizar carteira individual
- [ ] Sincronizar todas as carteiras
- [ ] Remover carteira
- [ ] Visualizar detalhes da carteira

#### 4.1.5 Gestao de Operacoes
- [ ] Listagem de todas as operacoes
- [ ] Filtros por periodo, carteira, tipo, crypto
- [ ] Pesquisa por operacao
- [ ] Adicionar operacao manual
- [ ] Editar operacao
- [ ] Excluir operacao
- [ ] Recalcular operacoes
- [ ] Validar operacoes
- [ ] Exportar operacoes (CSV/Excel)
- [ ] Paginacao

#### 4.1.6 Declaracoes Fiscais
- [ ] Listagem de declaracoes por mes
- [ ] Status de cada obrigacao (IN 1888, GCAP, IRPF)
- [ ] Visualizar detalhes da declaracao
- [ ] Validar operacoes para declaracao
- [ ] Marcar como enviado

#### 4.1.7 Relatorios
- [ ] Visao geral com metricas
- [ ] Grafico de evolucao (multiplas series)
- [ ] Filtro por periodo e carteira
- [ ] Listagem de ativos
- [ ] Exportar relatorio fiscal (PDF)

#### 4.1.8 Gerar Relatorio Fiscal
- [ ] Modal para selecionar periodo
- [ ] Campo de descricao
- [ ] Processamento com feedback visual
- [ ] Download do relatorio gerado

### 4.2 Versao 2.0 (Futuro)

- [ ] Integracao com mais exchanges (KuCoin, Foxbit, Bitget, etc.)
- [ ] Integracao com wallets DeFi (MetaMask, Trust Wallet)
- [ ] Calculo automatico de DARF
- [ ] Geracao de DARF para pagamento
- [ ] Integracao com contadores
- [ ] Alertas por email/push
- [ ] App mobile nativo
- [ ] Suporte a NFTs
- [ ] Suporte a staking/yield

### 4.3 Versao 3.0 (Futuro)

- [ ] API para contadores
- [ ] Plano empresarial
- [ ] Multi-usuarios por conta
- [ ] Relatorios personalizados
- [ ] Integracao direta com e-CAC
- [ ] IA para otimizacao fiscal

---

## 5. Requisitos Tecnicos

### 5.1 Stack Tecnologico

| Camada | Tecnologia |
|--------|------------|
| **Backend** | PHP 8.2+ / Laravel 11 |
| **Frontend** | Livewire 3 (com Alpine.js integrado) |
| **CSS** | TailwindCSS 3 |
| **Banco de Dados** | MySQL 8 / PostgreSQL 15 |
| **Cache** | Redis |
| **Filas** | Laravel Queue + Redis |
| **Autenticacao** | Laravel Breeze / Jetstream |
| **APIs Externas** | Binance API, Mercado Bitcoin API |
| **Hospedagem** | AWS / DigitalOcean / Vercel |

> **IMPORTANTE:** O frontend sera desenvolvido 100% com **Livewire** (sem Vue, React ou outros frameworks JS).
> Livewire permite criar interfaces reativas usando apenas PHP + Blade, mantendo a simplicidade do ecossistema Laravel.

### 5.2 Requisitos de Performance

| Metrica | Meta |
|---------|------|
| Tempo de carregamento | < 2 segundos |
| Uptime | 99.9% |
| Sincronizacao de operacoes | < 30 segundos para 1000 operacoes |
| Geracao de relatorio | < 60 segundos |

### 5.3 Requisitos de Seguranca

- [ ] HTTPS obrigatorio
- [ ] Criptografia de dados sensiveis (AES-256)
- [ ] API keys armazenadas de forma segura
- [ ] Rate limiting em endpoints
- [ ] Protecao contra CSRF, XSS, SQL Injection
- [ ] Autenticacao 2FA (futuro)
- [ ] Logs de auditoria
- [ ] Backup automatico diario

### 5.4 Requisitos de Escalabilidade

- Arquitetura stateless
- Cache agressivo de dados
- Filas para processamento pesado
- CDN para assets estaticos
- Database read replicas (futuro)

---

## 6. Arquitetura do Sistema

### 6.1 Diagrama de Alto Nivel

```
+------------------+     +------------------+     +------------------+
|                  |     |                  |     |                  |
|   USUARIO        |---->|   FISCAL WALLET  |---->|   EXCHANGES      |
|   (Browser)      |     |   (Laravel)      |     |   (APIs)         |
|                  |     |                  |     |                  |
+------------------+     +--------+---------+     +------------------+
                                  |
                                  v
                         +--------+---------+
                         |                  |
                         |   DATABASE       |
                         |   (MySQL)        |
                         |                  |
                         +------------------+
```

### 6.2 Modulos do Sistema

```
fiscal-wallet/
├── Modulo de Autenticacao
│   ├── Login/Logout
│   ├── Cadastro
│   ├── Recuperacao de senha
│   └── Perfil do usuario
│
├── Modulo de Carteiras
│   ├── CRUD de carteiras
│   ├── Conexao com exchanges
│   └── Sincronizacao
│
├── Modulo de Operacoes
│   ├── Importacao de transacoes
│   ├── CRUD de operacoes
│   ├── Calculo de ganho de capital
│   └── Validacao fiscal
│
├── Modulo de Declaracoes
│   ├── Consolidacao mensal
│   ├── Status de obrigacoes
│   └── Historico
│
├── Modulo de Relatorios
│   ├── Dashboard
│   ├── Graficos
│   └── Exportacao PDF
│
└── Modulo de Integracao
    ├── Binance API
    ├── Mercado Bitcoin API
    └── Importacao CSV
```

### 6.3 Modelo de Dados (Principais Entidades)

```
users
├── id
├── name
├── email
├── password
├── created_at
└── updated_at

wallets
├── id
├── user_id (FK)
├── name
├── type (exchange, manual)
├── exchange_name
├── api_key (encrypted)
├── api_secret (encrypted)
├── last_sync_at
├── created_at
└── updated_at

operations
├── id
├── user_id (FK)
├── wallet_id (FK)
├── type (deposit, withdraw, buy, sell, transfer)
├── crypto_symbol
├── amount
├── price_brl
├── total_brl
├── fee_brl
├── average_price
├── profit_loss
├── executed_at
├── created_at
└── updated_at

declarations
├── id
├── user_id (FK)
├── year
├── month
├── total_operated
├── total_alienation
├── total_fees
├── total_transactions
├── in1888_status
├── gcap_status
├── irpf_status
├── created_at
└── updated_at

assets
├── id
├── user_id (FK)
├── crypto_symbol
├── total_amount
├── average_price
├── total_invested
├── current_value
├── profit_loss
├── updated_at
└── created_at
```

---

## 7. Fluxos de Usuario

### 7.1 Fluxo de Onboarding

```
1. Usuario acessa a plataforma
2. Clica em "Criar conta"
3. Preenche dados (nome, email, senha)
4. Confirma email
5. Faz login
6. Tela de boas-vindas
7. Seleciona exchange para conectar
8. Insere API Key e Secret
9. Sistema sincroniza operacoes
10. Redirecionado para Dashboard
```

### 7.2 Fluxo de Sincronizacao

```
1. Usuario acessa "Carteiras"
2. Clica em "Sincronizar"
3. Sistema conecta na API da exchange
4. Busca novas operacoes
5. Processa e calcula ganho de capital
6. Atualiza Dashboard
7. Notifica usuario do resultado
```

### 7.3 Fluxo de Geracao de Relatorio

```
1. Usuario acessa "Relatorios"
2. Clica em "Exportar relatorio"
3. Modal abre
4. Seleciona periodo
5. Adiciona descricao (opcional)
6. Clica em "Gerar"
7. Sistema processa (mostra progresso)
8. Botao "Baixar relatorio" aparece
9. Usuario faz download do PDF
```

---

## 8. Metricas de Sucesso

### 8.1 KPIs do Produto

| Metrica | Meta MVP | Meta 6 meses |
|---------|----------|--------------|
| Usuarios cadastrados | 100 | 1.000 |
| Usuarios ativos mensais | 50 | 500 |
| Carteiras conectadas | 150 | 2.000 |
| Operacoes processadas | 10.000 | 500.000 |
| NPS | > 40 | > 60 |
| Churn mensal | < 10% | < 5% |

### 8.2 KPIs Tecnicos

| Metrica | Meta |
|---------|------|
| Tempo medio de sincronizacao | < 30s |
| Taxa de erro de API | < 1% |
| Disponibilidade | > 99.5% |
| Tempo de resposta P95 | < 500ms |

---

## 9. Roadmap

### Fase 1: MVP (Mes 1-2)
- [x] Design System definido
- [x] Wireframes das telas
- [ ] Setup do projeto Laravel
- [ ] Autenticacao basica
- [ ] CRUD de carteiras
- [ ] Integracao Binance
- [ ] Dashboard basico
- [ ] Listagem de operacoes

### Fase 2: Core Features (Mes 3-4)
- [ ] Integracao Mercado Bitcoin
- [ ] Calculo de ganho de capital
- [ ] Tela de declaracoes
- [ ] Geracao de relatorios
- [ ] Importacao CSV

### Fase 3: Polish (Mes 5-6)
- [ ] Responsividade mobile
- [ ] Otimizacoes de performance
- [ ] Testes automatizados
- [ ] Documentacao
- [ ] Beta testing

### Fase 4: Lancamento (Mes 7)
- [ ] Correcao de bugs do beta
- [ ] Landing page
- [ ] Lancamento publico

---

## 10. Riscos e Mitigacoes

| Risco | Probabilidade | Impacto | Mitigacao |
|-------|---------------|---------|-----------|
| APIs de exchanges mudarem | Media | Alto | Monitoramento, abstração de integrações |
| Mudanca na legislacao fiscal | Media | Alto | Arquitetura flexivel, acompanhar noticias |
| Problema de seguranca | Baixa | Critico | Auditorias, criptografia, boas praticas |
| Baixa adesao de usuarios | Media | Alto | Marketing, freemium, parcerias |
| Escalabilidade | Baixa | Medio | Arquitetura cloud-native desde o inicio |

---

## 11. Glossario

| Termo | Definicao |
|-------|-----------|
| **Criptoativo** | Ativo digital baseado em blockchain (Bitcoin, Ethereum, etc.) |
| **Exchange** | Plataforma de compra e venda de criptoativos |
| **Ganho de Capital** | Lucro obtido na venda de um ativo |
| **IN 1888** | Instrucao Normativa da Receita Federal sobre criptoativos |
| **GCAP** | Programa de Ganhos de Capital da Receita Federal |
| **IRPF** | Imposto de Renda Pessoa Fisica |
| **DARF** | Documento de Arrecadacao de Receitas Federais |
| **API Key** | Chave de acesso para integracao com exchanges |
| **Wallet** | Carteira digital para armazenar criptoativos |

---

*Documento criado em Dezembro 2025*
*Fiscal Wallet - Plataforma de Gestao Fiscal para Criptomoedas*
