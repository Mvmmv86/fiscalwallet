# Plano de Acao - Integracao com Exchanges

**VERSAO 2.0 - ATUALIZADO COM PESQUISA APROFUNDADA**

## Resumo Executivo

Este documento apresenta o plano de implementacao das integracoes com Binance e Coinbase para a Fiscal Wallet, baseado em pesquisa das documentacoes oficiais, **analise de problemas reais enfrentados por Koinly/CoinTracker**, e melhores praticas do mercado.

---

## ALERTAS CRITICOS (Descobertos na Pesquisa)

### Limites Temporais EXATOS da Binance API

| Endpoint | Limite de Tempo | O que Conseguimos Via API |
|----------|-----------------|---------------------------|
| `myTrades` (Spot) | **Desde 01/01/2017** ate Set/2022 (descontinuado Nov/2024) | Apenas trades **apos Setembro/2022** |
| `/fapi/v1/userTrades` (Futuros USDT-M) | **Apenas 6 meses** (desde Out/2024) | Ultimos 6 meses, janelas de 7 dias |
| `/dapi/v1/userTrades` (Futuros COIN-M) | **Apenas 6 meses** (desde Out/2024) | Ultimos 6 meses, janelas de 7 dias |
| `deposit/hisrec` | **90 dias por request** (sem limite total) | Todo historico, mas em janelas de 90 dias |
| `withdraw/history` | **90 dias por request** (sem limite total) | Todo historico, mas em janelas de 90 dias |
| `convert/tradeFlow` | **Desde 2021** | Conversoes a partir de 2021 |

**Fontes:**
- [Binance Changelog Dez/2024](https://developers.binance.com/docs/binance-spot-api-docs) - Timestamps rejeitados se antes de 2017-01-01
- [Binance Futures Account Trade List](https://developers.binance.com/docs/derivatives/usds-margined-futures/trade/rest-api/Account-Trade-List)
- [Binance Derivatives Changelog](https://developers.binance.com/docs/derivatives/change-log)

### Limitacoes Conhecidas da Binance API

| Problema | Impacto | Solucao |
|----------|---------|---------|
| `myTrades` requer symbol | Nao tem endpoint "get all trades" | Iterar por cada par de trading |
| **Trades Spot antes de Set/2022** | **DESCONTINUADO via API (Nov/2024)** | **CSV OBRIGATORIO** |
| **Trades Futuros alem de 6 meses** | **Limite de 6 meses (Out/2024)** | **CSV OBRIGATORIO** |
| Futuros: Janela maxima 7 dias | Cada request so retorna 7 dias | Loop de 7 em 7 dias |
| Depositos/Saques | Janela maxima de 90 dias por request | Loop com janelas de 90 dias |
| Dust conversions | Apenas ultimas 100 via API | CSV para historico completo |
| Convert trades | Apenas a partir de 2021 | CSV para anteriores |
| Moedas delisted | API nao retorna trades | CSV obrigatorio |

### O QUE CONSEGUIMOS PUXAR VIA API (MAXIMO)

```
TRADES SPOT (myTrades):
├── Desde Setembro/2022 ate HOJE ✓
├── Antes de Set/2022: NAO DISPONIVEL ✗ → Precisa CSV
└── Estrategia: Iterar por cada par de trading

TRADES FUTUROS (/fapi/v1/userTrades):
├── Apenas ULTIMOS 6 MESES ✓ (mudou em Out/2024)
├── Maximo 7 dias por request
├── Estrategia: Loop de 7 em 7 dias (ultimos 6 meses = ~26 requests)
├── Antes de 6 meses: NAO DISPONIVEL ✗ → Precisa CSV
└── USDT-M e COIN-M sao endpoints separados!

DEPOSITOS/SAQUES:
├── Historico COMPLETO disponivel ✓
├── Mas: Apenas 90 dias por request
└── Estrategia: Loop de 90 em 90 dias ate 2017

CONVERSOES (Convert):
├── Desde 2021 ate HOJE ✓
└── Antes de 2021: NAO DISPONIVEL ✗ → Precisa CSV
```

### Estrategia Recomendada (Baseada em Koinly/CoinTracker)

> **"Para resultados completos, use API + CSV: API para atualizacoes em tempo real, CSV para dados historicos faltantes."**

**Fontes:**
- [CoinTracking - Binance Import Restrictions](https://cointracking.freshdesk.com/en/support/solutions/articles/29000039887-binance-import-restrictions)
- [Binance Developer Forum - Historical Data](https://dev.binance.vision/t/how-far-back-does-the-historical-data-go/5835)
- [Binance Deposit History API](https://developers.binance.com/docs/wallet/capital/deposite-history)

---

## 1. Visao Geral das APIs

### 1.1 Binance API

**Base URL:** `https://api.binance.com`

**Endpoints Necessarios:**

| Endpoint | Funcao | Weight | Limite |
|----------|--------|--------|--------|
| `GET /api/v3/account` | Saldos da conta | 20 | - |
| `GET /api/v3/myTrades` | Historico de trades (por symbol) | 20 | 1000/req |
| `GET /sapi/v1/capital/deposit/hisrec` | Historico de depositos | 1 | 1000/req |
| `GET /sapi/v1/capital/withdraw/history` | Historico de saques | 18000 | 1000/req |
| `GET /sapi/v1/convert/tradeFlow` | Historico de conversoes (swaps) | 3000 | 1000/req |

**Rate Limits:**
- REQUEST_WEIGHT: 6.000/minuto
- RAW_REQUESTS: 61.000/5 minutos

**Autenticacao:**
- HMAC SHA256
- Headers: `X-MBX-APIKEY`
- Parametros: `timestamp`, `signature`, `recvWindow`

### 1.2 Coinbase API v2

**Base URL:** `https://api.coinbase.com/v2`

**Endpoints Necessarios:**

| Endpoint | Funcao |
|----------|--------|
| `GET /v2/accounts` | Lista todas as carteiras/contas |
| `GET /v2/accounts/:id/transactions` | Transacoes de uma conta |
| `GET /v2/accounts/:id/buys` | Compras |
| `GET /v2/accounts/:id/sells` | Vendas |
| `GET /v2/accounts/:id/deposits` | Depositos |
| `GET /v2/accounts/:id/withdrawals` | Saques |

**Autenticacao:**
- HMAC SHA256
- Headers: `CB-ACCESS-KEY`, `CB-ACCESS-SIGN`, `CB-ACCESS-TIMESTAMP`, `CB-VERSION`
- Signature: `timestamp + method + requestPath + body`

---

## 2. Arquitetura Proposta

### 2.1 Estrutura de Classes

```
app/
├── Integrations/
│   ├── Contracts/
│   │   └── ExchangeIntegrationInterface.php
│   ├── BaseExchangeIntegration.php
│   ├── BinanceIntegration.php
│   └── CoinbaseIntegration.php
├── Services/
│   ├── WalletSyncService.php (ja existe)
│   └── DataNormalizationService.php (novo)
├── Jobs/
│   ├── SyncWalletJob.php
│   └── ProcessOperationsJob.php
└── DTOs/
    └── NormalizedOperation.php
```

### 2.2 Interface Base

```php
interface ExchangeIntegrationInterface
{
    public function validateCredentials(): bool;
    public function getAccount(): array;
    public function getTrades(Carbon $startTime, Carbon $endTime): Collection;
    public function getDeposits(Carbon $startTime, Carbon $endTime): Collection;
    public function getWithdrawals(Carbon $startTime, Carbon $endTime): Collection;
    public function getConversions(Carbon $startTime, Carbon $endTime): Collection;
}
```

---

## 3. Normalizacao de Dados

### 3.1 Problema

Cada exchange retorna dados em formatos diferentes:

**Binance Trade:**
```json
{
  "symbol": "BTCUSDT",
  "id": 28457,
  "orderId": 100234,
  "price": "4.00000100",
  "qty": "12.00000000",
  "quoteQty": "48.000012",
  "commission": "10.10000000",
  "commissionAsset": "BNB",
  "time": 1499865549590,
  "isBuyer": true,
  "isMaker": false,
  "isBestMatch": true
}
```

**Coinbase Transaction:**
```json
{
  "id": "57ffb4ae-0c59-5430-bcd3-3f98f797a66c",
  "type": "buy",
  "status": "completed",
  "amount": {
    "amount": "1.00000000",
    "currency": "BTC"
  },
  "native_amount": {
    "amount": "10.00",
    "currency": "USD"
  },
  "created_at": "2015-03-26T13:42:00-07:00"
}
```

### 3.2 Solucao: DTO Normalizado

```php
class NormalizedOperation
{
    public string $externalId;       // ID unico da exchange
    public string $type;             // buy, sell, deposit, withdrawal, swap_in, swap_out
    public string $symbol;           // BTC, ETH, etc
    public string $baseAsset;        // Ativo base (ex: BTC em BTCUSDT)
    public string $quoteAsset;       // Ativo cotacao (ex: USDT em BTCUSDT)
    public float $quantity;          // Quantidade do ativo
    public float $pricePerUnit;      // Preco por unidade em BRL
    public float $totalBrl;          // Valor total em BRL
    public float $feeBrl;            // Taxa em BRL
    public string $feeAsset;         // Ativo da taxa
    public Carbon $executedAt;       // Data/hora da execucao
    public string $exchange;         // binance, coinbase
    public array $rawData;           // Dados originais para auditoria
}
```

### 3.3 Mapeamento de Tipos

| Exchange | Tipo Original | Tipo Normalizado |
|----------|---------------|------------------|
| Binance | isBuyer=true | buy |
| Binance | isBuyer=false | sell |
| Binance | deposit | deposit |
| Binance | withdraw | withdrawal |
| Binance | convert (fromAsset) | swap_out |
| Binance | convert (toAsset) | swap_in |
| Coinbase | buy | buy |
| Coinbase | sell | sell |
| Coinbase | send | transfer_out |
| Coinbase | receive | transfer_in |
| Coinbase | fiat_deposit | deposit |
| Coinbase | fiat_withdrawal | withdrawal |

---

## 4. Conversao de Moedas para BRL

### 4.1 Problema

APIs retornam valores em diferentes moedas (USD, USDT, BTC, etc).
Precisamos converter tudo para BRL para calculo fiscal.

### 4.2 Solucao: CoinMarketCap API

**Por que CoinMarketCap?**
- Dados historicos desde 2013
- Cotacoes em 93 moedas fiat (incluindo BRL)
- API confiavel e usada pela industria
- Atualizacao a cada 1 minuto

**Planos CoinMarketCap:**

| Plano | Preco | Chamadas/mes | Dados Historicos |
|-------|-------|--------------|------------------|
| Free | $0 | 10.000 | Nao |
| Hobbyist | $29/mes | 50.000 | Limitado |
| **Startup** | **$79/mes** | 120.000 | **Sim (OHLCV)** |
| Standard | $199/mes | 500.000 | Completo |

**Recomendacao: Plano Startup ($79/mes)** - necessario para cotacoes historicas.

Fonte: [CoinMarketCap API Pricing](https://pro.coinmarketcap.com/api/pricing)

### 4.3 Estrategia de Conversao

**Ordem de prioridade:**

1. **Par direto em BRL** (ex: BTCBRL na Binance)
   - Usar valor da propria operacao

2. **Par em USDT/USD**
   - Cotacao USDT/BRL do CoinMarketCap no momento da operacao

3. **Par em outra cripto** (ex: ETH/BTC)
   - Converter: Cripto → USD (CoinMarketCap) → BRL (CoinMarketCap)

**Implementacao:**

```php
class CurrencyConverterService
{
    private CoinMarketCapClient $cmcClient;

    // Busca cotacao historica do CoinMarketCap
    public function getCryptoPrice(string $symbol, Carbon $date, string $convert = 'BRL'): float;

    // Converte qualquer moeda para BRL
    public function toBrl(float $amount, string $fromCurrency, Carbon $date): float;

    // Cache de cotacoes (evitar chamadas repetidas)
    private function getCachedPrice(string $key): ?float;
    private function setCachedPrice(string $key, float $price): void;
}
```

### 4.4 Endpoints CoinMarketCap Necessarios

| Endpoint | Funcao | Plano Minimo |
|----------|--------|--------------|
| `/v2/cryptocurrency/quotes/historical` | Cotacao em data especifica | Startup |
| `/v2/tools/price-conversion` | Conversao entre moedas | Free |
| `/v1/cryptocurrency/map` | Mapeamento de simbolos | Free |

### 4.5 Cache de Cotacoes

Para economizar chamadas da API:

```php
// Tabela: price_cache
Schema::create('price_cache', function (Blueprint $table) {
    $table->id();
    $table->string('symbol', 20);
    $table->string('currency', 10)->default('BRL');
    $table->date('date');
    $table->decimal('price', 20, 8);
    $table->timestamps();

    $table->unique(['symbol', 'currency', 'date']);
});
```

**Estrategia:**
1. Antes de chamar API, verificar cache
2. Se nao existe, buscar no CoinMarketCap
3. Salvar no cache para futuras consultas
4. Cotacoes do dia atual: cache de 5 minutos

---

## 5. Fluxo de Sincronizacao

### 5.1 Fluxo Completo

```
1. Usuario conecta API Key
   └── Validar credenciais com getAccount()

2. Job de sincronizacao inicial
   ├── Buscar depositos (ultimos 2 anos)
   ├── Buscar saques (ultimos 2 anos)
   ├── Buscar trades (por cada symbol com saldo)
   ├── Buscar conversoes (ultimos 2 anos)
   └── Normalizar e salvar tudo

3. Sincronizacao incremental (diaria/sob demanda)
   └── Buscar apenas desde last_sync_at

4. Pos-processamento
   ├── Calcular custo medio por ativo
   ├── Calcular ganho de capital
   └── Atualizar posicoes consolidadas
```

### 5.2 Estrategia para MAXIMIZAR Dados via API

**DEPOSITOS E SAQUES - Loop de 90 dias (HISTORICO COMPLETO)**

```php
/**
 * Busca TODO o historico de depositos/saques desde 2017
 * API permite apenas 90 dias por request, entao fazemos loop
 */
public function fetchAllDeposits(string $apiKey, string $apiSecret): Collection
{
    $allDeposits = collect();

    // Comecar de 01/01/2017 (limite minimo da Binance)
    $startDate = Carbon::create(2017, 1, 1);
    $endDate = now();

    // Loop de 90 em 90 dias
    while ($startDate < $endDate) {
        $windowEnd = $startDate->copy()->addDays(89); // 90 dias de janela
        if ($windowEnd > $endDate) {
            $windowEnd = $endDate;
        }

        $deposits = $this->fetchDeposits(
            $apiKey,
            $apiSecret,
            $startDate->getTimestampMs(),
            $windowEnd->getTimestampMs()
        );

        $allDeposits = $allDeposits->merge($deposits);

        // Avancar para proxima janela
        $startDate = $windowEnd->addDay();

        // Respeitar rate limit (1 request por segundo)
        usleep(500000); // 500ms entre requests
    }

    return $allDeposits;
}

// Mesma logica para Withdrawals
```

**Estimativa de requests para historico completo (2017-2025):**
- 8 anos = ~2920 dias
- 2920 / 90 = ~33 requests para depositos
- ~33 requests para saques
- Total: ~66 requests (menos de 2 minutos)

### 5.3 Tratamento de Paginacao

**Binance:**
- Usa `startTime/endTime` e `fromId`
- Maximo 1000 registros por request
- Para trades: iterar por cada symbol

```php
// Pseudo-codigo para trades
do {
    $trades = $api->getTrades($symbol, $fromId, $limit);
    foreach ($trades as $trade) {
        // processar
    }
    $fromId = $trades->last()->id ?? null;
} while (count($trades) === $limit);
```

**TRADES - Iterar por todos os pares desde Set/2022:**

```php
/**
 * Busca trades de TODOS os pares ativos
 * API so permite por symbol, entao iteramos
 */
public function fetchAllTrades(string $apiKey, string $apiSecret): Collection
{
    $allTrades = collect();

    // 1. Buscar todos os pares que o usuario ja operou
    $symbols = $this->getActiveSymbols($apiKey, $apiSecret);

    // 2. Para cada par, buscar trades desde Set/2022
    $startTime = Carbon::create(2022, 9, 1)->getTimestampMs();
    $endTime = now()->getTimestampMs();

    foreach ($symbols as $symbol) {
        try {
            $trades = $this->fetchTradesForSymbol(
                $apiKey,
                $apiSecret,
                $symbol,
                $startTime,
                $endTime
            );
            $allTrades = $allTrades->merge($trades);

            // Rate limit: 20 weight por request
            usleep(100000); // 100ms entre symbols
        } catch (\Exception $e) {
            // Symbol pode nao existir mais - ignorar
            Log::warning("Nao foi possivel buscar trades para {$symbol}: {$e->getMessage()}");
        }
    }

    return $allTrades;
}

/**
 * Determina quais symbols buscar
 */
private function getActiveSymbols(): array
{
    // 1. Pegar todos os ativos com saldo atual
    $account = $this->getAccount();
    $symbols = [];

    foreach ($account['balances'] as $balance) {
        $asset = $balance['asset'];
        if ($balance['free'] > 0 || $balance['locked'] > 0) {
            // Pares mais comuns
            $symbols[] = $asset . 'USDT';
            $symbols[] = $asset . 'BRL';
            $symbols[] = $asset . 'BTC';
            $symbols[] = $asset . 'BUSD'; // Descontinuado mas pode ter historico
        }
    }

    // 2. Adicionar pares de depositos/saques historicos
    $deposits = $this->fetchAllDeposits();
    foreach ($deposits as $deposit) {
        $asset = $deposit['coin'];
        $symbols[] = $asset . 'USDT';
        $symbols[] = $asset . 'BRL';
    }

    // 3. Filtrar apenas pares validos no exchangeInfo
    $validSymbols = $this->getValidSymbols();

    return array_unique(array_filter($symbols, fn($s) => in_array($s, $validSymbols)));
}
```

**TRADES FUTUROS - Loop de 7 dias (ULTIMOS 6 MESES):**

```php
/**
 * Busca trades de Futuros USDT-M (ultimos 6 meses)
 * API permite apenas 7 dias por request, entao fazemos loop
 * Endpoint: GET /fapi/v1/userTrades
 */
public function fetchAllFuturesTrades(string $apiKey, string $apiSecret): Collection
{
    $allTrades = collect();

    // Limite: apenas ultimos 6 meses (180 dias)
    $startDate = now()->subMonths(6);
    $endDate = now();

    // Loop de 7 em 7 dias
    while ($startDate < $endDate) {
        $windowEnd = $startDate->copy()->addDays(6); // 7 dias de janela
        if ($windowEnd > $endDate) {
            $windowEnd = $endDate;
        }

        // Buscar trades USDT-M
        $trades = $this->fetchFuturesTrades(
            $apiKey,
            $apiSecret,
            $startDate->getTimestampMs(),
            $windowEnd->getTimestampMs(),
            'usdt-m' // ou 'coin-m' para Futuros COIN-M
        );

        $allTrades = $allTrades->merge($trades);

        // Avancar para proxima janela
        $startDate = $windowEnd->addDay();

        // Rate limit
        usleep(200000); // 200ms entre requests
    }

    return $allTrades;
}

/**
 * Fetch de uma janela de 7 dias
 */
private function fetchFuturesTrades(
    string $apiKey,
    string $apiSecret,
    int $startTime,
    int $endTime,
    string $type = 'usdt-m'
): array {
    $baseUrl = $type === 'usdt-m'
        ? 'https://fapi.binance.com'  // USDT-M Futures
        : 'https://dapi.binance.com'; // COIN-M Futures

    $endpoint = '/fapi/v1/userTrades';

    return $this->signedRequest($baseUrl . $endpoint, [
        'startTime' => $startTime,
        'endTime' => $endTime,
        'limit' => 1000,
    ], $apiKey, $apiSecret);
}
```

**Estimativa de requests para Futuros (6 meses):**
- 180 dias / 7 = ~26 requests para USDT-M
- ~26 requests para COIN-M (se usar)
- Total: ~52 requests (~15 segundos)

**Coinbase:**
- Usa paginacao com cursores
- Parametros: `starting_after`, `ending_before`

```php
// Pseudo-codigo
do {
    $response = $api->getTransactions($accountId, $cursor);
    foreach ($response['data'] as $tx) {
        // processar
    }
    $cursor = $response['pagination']['next_uri'] ?? null;
} while ($cursor);
```

---

## 6. Tratamento de Erros

### 6.1 Erros Comuns

| Codigo | Causa | Acao |
|--------|-------|------|
| 401 | API Key invalida | Solicitar reconexao |
| 429 | Rate limit | Aguardar e retry com backoff |
| 418 | IP banido (Binance) | Alertar usuario |
| -1021 | Timestamp fora de sync | Sincronizar relogio do servidor |
| -2015 | Permissoes insuficientes | Solicitar nova API Key |

### 6.2 Estrategia de Retry

```php
$maxRetries = 3;
$baseDelay = 1000; // ms

for ($i = 0; $i < $maxRetries; $i++) {
    try {
        return $this->makeRequest($endpoint, $params);
    } catch (RateLimitException $e) {
        $delay = $baseDelay * pow(2, $i); // Exponential backoff
        usleep($delay * 1000);
    }
}
throw new SyncFailedException();
```

---

## 7. Seguranca

### 7.1 Armazenamento de Credenciais

- API Keys criptografadas com `Crypt::encryptString()`
- Nunca logar API secrets
- Rotacao de chaves de criptografia periodica

### 7.2 Permissoes Minimas

**Binance - Apenas leitura:**
- [x] Enable Reading
- [ ] Enable Spot & Margin Trading
- [ ] Enable Withdrawals
- [x] Restrict access to trusted IPs only (recomendado)

**Coinbase:**
- wallet:accounts:read
- wallet:transactions:read
- wallet:buys:read
- wallet:sells:read
- wallet:deposits:read
- wallet:withdrawals:read

### 7.3 Validacao de API Keys

Antes de salvar, validar:
1. Formato correto
2. Permissoes adequadas (apenas leitura)
3. Conexao bem-sucedida

---

## 8. Cronograma de Implementacao

### Fase 1: Infraestrutura (2-3 dias)
- [ ] Interface `ExchangeIntegrationInterface`
- [ ] Classe base `BaseExchangeIntegration`
- [ ] DTO `NormalizedOperation`
- [ ] Service `DataNormalizationService`
- [ ] Service `CurrencyConverterService`
- [ ] Testes unitarios base

### Fase 2: Binance (3-4 dias)
- [ ] `BinanceIntegration` - autenticacao
- [ ] Endpoint getAccount
- [ ] Endpoint getTrades (com paginacao)
- [ ] Endpoint getDeposits
- [ ] Endpoint getWithdrawals
- [ ] Endpoint getConversions
- [ ] Normalizacao de dados Binance
- [ ] Testes de integracao

### Fase 3: Coinbase (3-4 dias)
- [ ] `CoinbaseIntegration` - autenticacao
- [ ] Endpoint getAccounts
- [ ] Endpoint getTransactions (com paginacao)
- [ ] Normalizacao de dados Coinbase
- [ ] Testes de integracao

### Fase 4: Jobs e Sincronizacao (2-3 dias)
- [ ] Job `SyncWalletJob`
- [ ] Job `ProcessOperationsJob`
- [ ] Integracao com `WalletSyncService`
- [ ] Queue configuration
- [ ] Testes end-to-end

### Fase 5: Conversao de Moedas (2 dias)
- [ ] Integracao API BCB (USD/BRL)
- [ ] Cache de cotacoes
- [ ] Conversao historica de criptos
- [ ] Fallbacks para cotacoes indisponiveis

---

## 9. Consideracoes Finais

### 9.1 Pontos Criticos

1. **Rate Limits**: Implementar controle rigido para evitar bloqueios
2. **Dados Historicos**: Binance limita alguns endpoints a 90 dias - precisamos de multiplas requisicoes
3. **Conversao BRL**: Essencial para calculo fiscal - deve ser precisa
4. **Auditoria**: Manter dados originais para eventuais verificacoes

### 9.2 Melhorias Futuras

- Webhook para atualizacoes em tempo real
- Suporte a mais exchanges (Kraken, KuCoin, Mercado Bitcoin)
- Deteccao automatica de arbitragem
- Alerta de operacoes suspeitas

### 9.3 Fontes Consultadas

- [Binance Spot API Documentation](https://developers.binance.com/docs/binance-spot-api-docs)
- [Binance Wallet API](https://developers.binance.com/docs/wallet/capital)
- [Binance Convert API](https://developers.binance.com/docs/convert/trade/Get-Convert-Trade-History)
- [Coinbase API v2](https://docs.cdp.coinbase.com/coinbase-app/docs/welcome)
- [Coinbase Authentication](https://docs.cdp.coinbase.com/api-reference/v2/authentication)
- [Vezgo - Crypto Tax API Best Practices](https://vezgo.com/blog/crypto-tax-software-apis-the-complete-guide/)
- [CoinAPI - Data Normalization](https://www.coinapi.io/blog/the-ultimate-crypto-api-tool-guide-for-tax-and-accounting-software)

---

## 10. Tratamento Detalhado dos Dados Binance

### 10.1 Processamento de Trades (`myTrades`)

**Problema Principal**: Endpoint requer `symbol` - nao existe "get all trades".

**Solucao Implementada:**

```php
// 1. Primeiro, buscar todos os pares com saldo ou historico
$symbols = $this->getActiveSymbols($apiKey, $apiSecret);

// 2. Para cada par, buscar trades
foreach ($symbols as $symbol) {
    $trades = $this->fetchAllTrades($symbol, $startTime, $endTime);
    // Processar cada trade
}

// 3. Determinar simbolos ativos
private function getActiveSymbols(): array
{
    // Opcao 1: Buscar do endpoint exchangeInfo
    // Opcao 2: Usar lista predefinida dos pares mais comuns
    // Opcao 3: Pegar pares com saldo atual + historico de depositos

    $account = $this->getAccount();
    $symbols = [];

    foreach ($account['balances'] as $balance) {
        if ($balance['free'] > 0 || $balance['locked'] > 0) {
            // Adicionar pares comuns: XXXUSDT, XXXBTC, XXXBRL
            $asset = $balance['asset'];
            $symbols[] = $asset . 'USDT';
            $symbols[] = $asset . 'BTC';
            $symbols[] = $asset . 'BRL';
        }
    }

    return array_unique($symbols);
}
```

**Campos do Trade e Como Processar:**

```php
// Trade raw da Binance
{
    "symbol": "BTCUSDT",      // Par de trading
    "id": 28457,             // ID unico do trade
    "orderId": 100234,       // ID da ordem
    "price": "42000.50",     // Preco por unidade em quote asset (USDT)
    "qty": "0.05",           // Quantidade do base asset (BTC)
    "quoteQty": "2100.025",  // Valor total em quote asset (USDT)
    "commission": "0.001",   // Taxa cobrada
    "commissionAsset": "BNB",// Moeda da taxa
    "time": 1499865549590,   // Timestamp em ms
    "isBuyer": true,         // true = compra, false = venda
    "isMaker": false,        // maker ou taker
    "isBestMatch": true
}

// Transformacao para NormalizedOperation
$normalized = new NormalizedOperation(
    externalId: "binance_trade_{$trade['id']}",
    type: $trade['isBuyer'] ? 'buy' : 'sell',
    symbol: $this->extractBaseAsset($trade['symbol']), // BTC
    baseAsset: $this->extractBaseAsset($trade['symbol']),
    quoteAsset: $this->extractQuoteAsset($trade['symbol']), // USDT
    quantity: (float) $trade['qty'],
    pricePerUnit: $this->convertToBrl(
        (float) $trade['price'],
        $this->extractQuoteAsset($trade['symbol']),
        Carbon::createFromTimestampMs($trade['time'])
    ),
    totalBrl: $this->convertToBrl(
        (float) $trade['quoteQty'],
        $this->extractQuoteAsset($trade['symbol']),
        Carbon::createFromTimestampMs($trade['time'])
    ),
    feeBrl: $this->convertToBrl(
        (float) $trade['commission'],
        $trade['commissionAsset'],
        Carbon::createFromTimestampMs($trade['time'])
    ),
    feeAsset: $trade['commissionAsset'],
    executedAt: Carbon::createFromTimestampMs($trade['time']),
    exchange: 'binance',
    rawData: $trade
);
```

### 10.2 Processamento de Depositos

```php
// Deposito raw da Binance
{
    "id": "d_769800519366885376",
    "amount": "0.001",
    "coin": "BTC",
    "network": "BTC",
    "status": 1,  // 0=pending, 1=success
    "address": "1HPn8Rx2y6nNSfagQBKy27GB99Vbzg89wv",
    "txId": "b3c6219639c8ae...",
    "insertTime": 1566791463000,
    "confirmTimes": "3/3"
}

// Normalizacao
if ($deposit['status'] === 1) { // Apenas depositos confirmados
    $normalized = new NormalizedOperation(
        externalId: "binance_deposit_{$deposit['id']}",
        type: 'deposit',
        symbol: $deposit['coin'],
        quantity: (float) $deposit['amount'],
        // Deposito: buscar cotacao do momento para registro
        totalBrl: $this->convertToBrl(
            (float) $deposit['amount'],
            $deposit['coin'],
            Carbon::createFromTimestampMs($deposit['insertTime'])
        ),
        feeBrl: 0, // Depositos geralmente sem taxa
        executedAt: Carbon::createFromTimestampMs($deposit['insertTime']),
        // ...
    );
}
```

### 10.3 Processamento de Saques

```php
// Saque raw da Binance
{
    "id": "b6ae22b3aa844210a7041aee...",
    "amount": "0.1",
    "transactionFee": "0.0005",
    "coin": "BTC",
    "status": 6,  // 6=completed
    "address": "1HPn8Rx2y6nNSfagQBKy...",
    "txId": "0x...",
    "applyTime": "2019-08-26 03:52:16",
    "network": "BTC",
    "completeTime": "2019-08-26 05:22:16"
}

// Normalizacao
if ($withdrawal['status'] === 6) { // Apenas saques completados
    $normalized = new NormalizedOperation(
        externalId: "binance_withdrawal_{$withdrawal['id']}",
        type: 'withdrawal',
        symbol: $withdrawal['coin'],
        quantity: (float) $withdrawal['amount'],
        totalBrl: $this->convertToBrl(
            (float) $withdrawal['amount'],
            $withdrawal['coin'],
            Carbon::parse($withdrawal['completeTime'])
        ),
        feeBrl: $this->convertToBrl(
            (float) $withdrawal['transactionFee'],
            $withdrawal['coin'],
            Carbon::parse($withdrawal['completeTime'])
        ),
        executedAt: Carbon::parse($withdrawal['completeTime']),
        // ...
    );
}
```

### 10.4 Processamento de Conversoes (Convert/Swap)

```php
// Conversao raw da Binance (Convert Trade Flow)
{
    "quoteId": "f3b91c14d9...",
    "orderId": 134848,
    "orderStatus": "SUCCESS",
    "fromAsset": "USDT",
    "fromAmount": "1000",
    "toAsset": "BTC",
    "toAmount": "0.024",
    "ratio": "0.000024",
    "inverseRatio": "41666.66",
    "createTime": 1623381330000
}

// IMPORTANTE: Conversao gera DUAS operacoes
// 1. Saida do ativo de origem (swap_out)
$swapOut = new NormalizedOperation(
    externalId: "binance_convert_{$convert['orderId']}_out",
    type: 'swap_out',
    symbol: $convert['fromAsset'],
    quantity: (float) $convert['fromAmount'],
    totalBrl: $this->convertToBrl(
        (float) $convert['fromAmount'],
        $convert['fromAsset'],
        Carbon::createFromTimestampMs($convert['createTime'])
    ),
    executedAt: Carbon::createFromTimestampMs($convert['createTime']),
    // ...
);

// 2. Entrada do ativo de destino (swap_in)
$swapIn = new NormalizedOperation(
    externalId: "binance_convert_{$convert['orderId']}_in",
    type: 'swap_in',
    symbol: $convert['toAsset'],
    quantity: (float) $convert['toAmount'],
    totalBrl: $this->convertToBrl(
        (float) $convert['toAmount'],
        $convert['toAsset'],
        Carbon::createFromTimestampMs($convert['createTime'])
    ),
    executedAt: Carbon::createFromTimestampMs($convert['createTime']),
    // ...
);
```

### 10.5 Logica de Conversao para BRL

```php
class CurrencyConverterService
{
    private CoinMarketCapClient $cmc;

    public function convertToBrl(
        float $amount,
        string $fromCurrency,
        Carbon $date
    ): float {
        // 1. Se ja e BRL, retornar diretamente
        if (strtoupper($fromCurrency) === 'BRL') {
            return $amount;
        }

        // 2. Verificar cache
        $cacheKey = "{$fromCurrency}_BRL_{$date->format('Y-m-d')}";
        if ($cached = $this->getCache($cacheKey)) {
            return $amount * $cached;
        }

        // 3. Stablecoins USD: converter via USD/BRL
        if (in_array(strtoupper($fromCurrency), ['USDT', 'USDC', 'BUSD', 'DAI'])) {
            $usdBrlRate = $this->getUsdBrlRate($date);
            $rate = $usdBrlRate;
        }
        // 4. Criptomoedas: buscar cotacao do CoinMarketCap
        else {
            $rate = $this->cmc->getHistoricalPrice(
                symbol: $fromCurrency,
                convert: 'BRL',
                date: $date
            );
        }

        // 5. Salvar no cache
        $this->setCache($cacheKey, $rate);

        return $amount * $rate;
    }

    private function getUsdBrlRate(Carbon $date): float
    {
        // Cotacao USD/BRL do proprio CoinMarketCap
        // (mais preciso que BCB para operacoes 24/7)
        return $this->cmc->getHistoricalPrice(
            symbol: 'USDT', // Usar USDT como proxy para USD
            convert: 'BRL',
            date: $date
        );
    }
}
```

---

## 11. Importacao de CSV (Fallback Obrigatorio)

### 11.1 Por que CSV e Obrigatorio?

Conforme descoberto na pesquisa:
- Trades antes de **Setembro/2022** nao estao mais disponiveis via API
- **Dust conversions**: apenas ultimas 100 via API
- **Convert trades**: apenas a partir de 2021
- **Moedas delisted**: impossivel via API

**Conclusao**: Para dados completos, DEVEMOS suportar importacao de CSV.

### 11.2 Formatos de CSV da Binance

**Opcao 1: Trade History (Download da UI)**
```csv
Date(UTC),Market,Type,Price,Amount,Total,Fee,Fee Coin
2022-01-15 10:30:45,BTCUSDT,BUY,42000.50,0.05,2100.025,0.001,BNB
2022-01-16 14:22:11,BTCUSDT,SELL,43500.00,0.05,2175.00,0.001,BNB
```

**Opcao 2: Statement Export**
```csv
UTC_Time,Account,Operation,Coin,Change,Remark
2022-01-15 10:30:45,Spot,Buy,BTC,0.05,"Trade ID: 12345"
2022-01-15 10:30:45,Spot,Fee,BNB,-0.001,"Trade ID: 12345"
```

### 11.3 Parser de CSV Binance

```php
class BinanceCSVParser
{
    public function parse(string $filePath): Collection
    {
        $operations = collect();
        $handle = fopen($filePath, 'r');

        // Detectar formato pelo header
        $header = fgetcsv($handle);
        $format = $this->detectFormat($header);

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            $normalized = match($format) {
                'trade_history' => $this->parseTradeHistory($data),
                'statement' => $this->parseStatement($data),
                default => throw new \Exception('Formato de CSV nao reconhecido')
            };

            if ($normalized) {
                $operations->push($normalized);
            }
        }

        fclose($handle);
        return $operations;
    }

    private function detectFormat(array $header): string
    {
        if (in_array('Market', $header)) {
            return 'trade_history';
        }
        if (in_array('Operation', $header)) {
            return 'statement';
        }
        throw new \Exception('Formato de CSV nao reconhecido');
    }

    private function parseTradeHistory(array $data): NormalizedOperation
    {
        $date = Carbon::parse($data['Date(UTC)']);
        [$base, $quote] = $this->splitSymbol($data['Market']);

        return new NormalizedOperation(
            externalId: md5(implode('|', $data)),
            type: strtolower($data['Type']),
            symbol: $base,
            baseAsset: $base,
            quoteAsset: $quote,
            quantity: (float) $data['Amount'],
            pricePerUnit: $this->convertToBrl((float) $data['Price'], $quote, $date),
            totalBrl: $this->convertToBrl((float) $data['Total'], $quote, $date),
            feeBrl: $this->convertToBrl((float) $data['Fee'], $data['Fee Coin'], $date),
            feeAsset: $data['Fee Coin'],
            executedAt: $date,
            exchange: 'binance',
            rawData: $data
        );
    }
}
```

### 11.4 Fluxo de Importacao Hibrido

```
1. Usuario conecta API Key
   ├── Sincronizar dados via API (dados recentes)
   └── Alertar: "Para dados completos, importe seu historico CSV"

2. Usuario faz upload do CSV
   ├── Detectar formato automaticamente
   ├── Parsear operacoes
   ├── Detectar duplicatas (verificar external_id + data)
   └── Importar apenas operacoes novas

3. Resultado
   └── Dados completos: API (real-time) + CSV (historico)
```

### 11.5 Deteccao de Duplicatas

```php
public function importOperations(Collection $operations): array
{
    $imported = 0;
    $duplicates = 0;

    foreach ($operations as $op) {
        // Verificar se ja existe
        $exists = Operation::where('wallet_id', $this->wallet->id)
            ->where(function ($query) use ($op) {
                $query->where('external_id', $op->externalId)
                    ->orWhere(function ($q) use ($op) {
                        // Fallback: mesma data + tipo + valor + quantidade
                        $q->where('executed_at', $op->executedAt)
                          ->where('type', $op->type)
                          ->where('quantity', $op->quantity)
                          ->where('total_brl', $op->totalBrl);
                    });
            })
            ->exists();

        if ($exists) {
            $duplicates++;
            continue;
        }

        // Criar operacao
        $this->createOperation($op);
        $imported++;
    }

    return [
        'imported' => $imported,
        'duplicates' => $duplicates,
        'total' => $operations->count(),
    ];
}
```

---

## 12. Integracao CoinMarketCap

### 12.1 Configuracao

```php
// config/services.php
'coinmarketcap' => [
    'api_key' => env('COINMARKETCAP_API_KEY'),
    'base_url' => 'https://pro-api.coinmarketcap.com',
    'sandbox_url' => 'https://sandbox-api.coinmarketcap.com',
    'environment' => env('COINMARKETCAP_ENV', 'sandbox'),
],

// .env
COINMARKETCAP_API_KEY=sua-api-key-aqui
COINMARKETCAP_ENV=production
```

### 12.2 Client CoinMarketCap

```php
class CoinMarketCapClient
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.coinmarketcap.api_key');
        $this->baseUrl = config('services.coinmarketcap.environment') === 'production'
            ? config('services.coinmarketcap.base_url')
            : config('services.coinmarketcap.sandbox_url');
    }

    /**
     * Busca cotacao historica de uma cripto
     * Endpoint: /v2/cryptocurrency/quotes/historical
     * Plano minimo: Startup ($79/mes)
     */
    public function getHistoricalPrice(
        string $symbol,
        string $convert,
        Carbon $date
    ): float {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->apiKey,
            'Accept' => 'application/json',
        ])->get("{$this->baseUrl}/v2/cryptocurrency/quotes/historical", [
            'symbol' => strtoupper($symbol),
            'convert' => strtoupper($convert),
            'time_start' => $date->startOfDay()->toIso8601String(),
            'time_end' => $date->endOfDay()->toIso8601String(),
            'count' => 1,
        ]);

        if ($response->failed()) {
            throw new \Exception("CoinMarketCap API error: " . $response->body());
        }

        $data = $response->json();
        $quotes = $data['data']['quotes'] ?? [];

        if (empty($quotes)) {
            throw new \Exception("No price data for {$symbol} on {$date->format('Y-m-d')}");
        }

        return (float) $quotes[0]['quote'][$convert]['price'];
    }

    /**
     * Converte valor entre moedas (tempo real)
     * Endpoint: /v2/tools/price-conversion
     * Plano minimo: Free
     */
    public function convert(
        float $amount,
        string $from,
        string $to
    ): float {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->apiKey,
        ])->get("{$this->baseUrl}/v2/tools/price-conversion", [
            'amount' => $amount,
            'symbol' => strtoupper($from),
            'convert' => strtoupper($to),
        ]);

        $data = $response->json();
        return (float) $data['data']['quote'][$to]['price'];
    }
}
```

### 12.3 Sistema de Cache de Cotacoes

```php
// Migration
Schema::create('price_cache', function (Blueprint $table) {
    $table->id();
    $table->string('symbol', 20)->index();
    $table->string('convert', 10)->default('BRL');
    $table->date('date')->index();
    $table->decimal('price', 24, 8);
    $table->string('source', 20)->default('coinmarketcap');
    $table->timestamps();

    $table->unique(['symbol', 'convert', 'date']);
});

// Service
class PriceCacheService
{
    public function get(string $symbol, string $convert, Carbon $date): ?float
    {
        $cache = PriceCache::where('symbol', strtoupper($symbol))
            ->where('convert', strtoupper($convert))
            ->where('date', $date->format('Y-m-d'))
            ->first();

        return $cache?->price;
    }

    public function set(
        string $symbol,
        string $convert,
        Carbon $date,
        float $price,
        string $source = 'coinmarketcap'
    ): void {
        PriceCache::updateOrCreate(
            [
                'symbol' => strtoupper($symbol),
                'convert' => strtoupper($convert),
                'date' => $date->format('Y-m-d'),
            ],
            [
                'price' => $price,
                'source' => $source,
            ]
        );
    }

    /**
     * Pre-carrega cotacoes de um periodo
     * Util para importacoes em lote
     */
    public function preloadPrices(
        array $symbols,
        Carbon $startDate,
        Carbon $endDate
    ): void {
        // Implementar busca em lote do CoinMarketCap
        // para minimizar chamadas de API
    }
}
```

---

## 13. Resumo do Plano Aprovado

### O Que Sera Implementado

1. **BinanceIntegration**
   - Autenticacao HMAC SHA256
   - Endpoints: account, myTrades, deposits, withdrawals, convert
   - Paginacao completa
   - Tratamento de rate limits

2. **BinanceCSVParser**
   - Suporte a Trade History CSV
   - Suporte a Statement Export
   - Deteccao automatica de formato
   - Deteccao de duplicatas

3. **CoinMarketCapClient**
   - Cotacoes historicas (plano Startup)
   - Conversao em tempo real
   - Sistema de cache

4. **CurrencyConverterService**
   - Conversao para BRL de qualquer moeda
   - Logica de fallback
   - Integracao com cache

5. **DataNormalizationService**
   - DTO NormalizedOperation
   - Mapeamento de tipos
   - Validacao de dados

### Pre-requisitos

- [ ] API Key do CoinMarketCap (plano Startup: $79/mes)
- [ ] API Key de teste da Binance
- [ ] Conta Sandbox da Binance para testes

### Proximos Passos

1. Aprovar este plano
2. Criar migration `price_cache`
3. Implementar `CoinMarketCapClient`
4. Implementar `BinanceIntegration`
5. Implementar `BinanceCSVParser`
6. Testes de integracao
7. Documentar fluxo para usuario final

---

**Aguardando aprovacao para iniciar implementacao.**
