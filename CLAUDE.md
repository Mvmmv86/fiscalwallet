# CLAUDE.md - Fiscal Wallet

## Sobre o Projeto

**Fiscal Wallet** e uma plataforma de gestao fiscal para criptomoedas no Brasil.
- **Stack:** PHP 8.2+ / Laravel 11 / Livewire 3 / TailwindCSS
- **Banco:** MySQL 8 ou PostgreSQL 15
- **Documentacao:** `/docs` (PRD, Business Model, Frontend Documentation)

---

## Regras de Desenvolvimento

### Estrutura de Pastas

```
fiscalwallet/
├── app/
│   ├── Http/Controllers/
│   ├── Livewire/           # Componentes Livewire
│   ├── Models/
│   ├── Services/           # Logica de negocio
│   └── Integrations/       # APIs externas (Binance, etc)
├── resources/
│   ├── views/
│   │   ├── components/     # Componentes Blade reutilizaveis
│   │   ├── layouts/
│   │   └── livewire/
│   └── css/
├── docs/                   # Documentacao do projeto
│   ├── PRD.md
│   ├── BUSINESS_MODEL.md
│   ├── FRONTEND_DOCUMENTATION.md
│   └── images/
└── tests/
```

### Convencoes de Codigo

#### Nomenclatura
- **Models:** Singular, PascalCase (`User`, `Wallet`, `Operation`)
- **Controllers:** PascalCase + Controller (`WalletController`)
- **Livewire:** PascalCase, pasta por modulo (`Dashboard/Index`, `Wallets/Card`)
- **Views:** kebab-case (`wallet-card.blade.php`)
- **Tabelas:** Plural, snake_case (`users`, `wallets`, `operations`)
- **Colunas:** snake_case (`created_at`, `api_key`, `total_brl`)

#### PHP/Laravel
- Usar PHP 8.2+ features (typed properties, enums, match)
- Sempre tipar parametros e retornos de metodos
- Usar Form Requests para validacao
- Usar Resources para transformar dados de API
- Usar Services para logica de negocio complexa
- Usar Events/Listeners para acoes assincronas

#### Livewire
- Um componente por arquivo
- Usar wire:model.live apenas quando necessario (preferir wire:model.blur)
- Extrair logica complexa para Services
- Usar eventos para comunicacao entre componentes

#### Blade/Frontend
- Usar componentes Blade para elementos reutilizaveis
- Seguir o Design System documentado em `/docs/FRONTEND_DOCUMENTATION.md`
- Mobile-first: sempre comecar pelo mobile
- Usar classes Tailwind, evitar CSS customizado

### Design System

#### Cores Principais
```
Primary:    #9333EA (roxo)
Success:    #22C55E (verde)
Danger:     #EF4444 (vermelho)
Warning:    #F59E0B (amarelo)
Background: #F8F8FA
Surface:    #FFFFFF
Border:     #DDD8E1
Text:       #1F1F1F
```

#### Componentes Base
Sempre usar os componentes documentados:
- `<x-button>` - Botoes
- `<x-input>` - Campos de texto
- `<x-card>` - Cards
- `<x-badge>` - Tags/status
- `<x-modal>` - Modais
- `<x-table>` - Tabelas

### Seguranca

- **NUNCA** commitar API keys, secrets ou credenciais
- Usar `.env` para configuracoes sensiveis
- Criptografar dados sensiveis no banco (api_key, api_secret)
- Validar TODAS as entradas do usuario
- Usar prepared statements (Eloquent ja faz isso)
- Implementar rate limiting em endpoints criticos

### Testes

- Escrever testes para logica de negocio critica
- Testar calculos de ganho de capital
- Testar integracoes com exchanges (usar mocks)
- Rodar `php artisan test` antes de commits

---

## Contexto de Negocio

### O que a Fiscal Wallet faz
1. Conecta com exchanges de criptomoedas (Binance, Mercado Bitcoin)
2. Importa todas as operacoes do usuario
3. Calcula ganho de capital automaticamente
4. Gera relatorios para declaracao fiscal (IN 1888, GCAP, IRPF)

### Regras Fiscais Brasileiras
- **Isencao:** Vendas ate R$ 35.000/mes sao isentas
- **Declaracao obrigatoria:** Patrimonio acima de R$ 5.000
- **Aliquotas:** 15% a 22,5% sobre ganho de capital

### Entidades Principais
- **User:** Usuario da plataforma
- **Wallet:** Carteira/exchange conectada
- **Operation:** Transacao de cripto (compra, venda, deposito, saque)
- **Declaration:** Consolidacao fiscal mensal
- **Asset:** Posicao consolidada por criptoativo

---

## Comandos Uteis

```bash
# Desenvolvimento
php artisan serve
npm run dev

# Testes
php artisan test
php artisan test --filter=NomeDaClasse

# Banco de dados
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed

# Cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Livewire
php artisan livewire:make NomeComponente
php artisan livewire:move Origem Destino

# Producao
php artisan optimize
npm run build
```

---

## Fluxos Importantes

### Sincronizacao de Exchange
```
1. Usuario conecta API key
2. Sistema valida credenciais
3. Job em background busca operacoes
4. Processa e calcula ganho de capital
5. Atualiza posicoes e dashboard
```

### Calculo de Ganho de Capital
```
1. Buscar todas operacoes de compra do ativo
2. Calcular preco medio ponderado
3. Na venda: (preco_venda - preco_medio) * quantidade
4. Se positivo = lucro tributavel (se > R$ 35k/mes)
5. Se negativo = prejuizo (pode compensar)
```

---

## Lembretes para o Claude

1. **Sempre consultar** `/docs/FRONTEND_DOCUMENTATION.md` para design
2. **Sempre consultar** `/docs/PRD.md` para requisitos
3. **Dashboard** = tela principal com cards e graficos
4. **Relatorios** = tela com grafico em tela inteira (NAO e o dashboard)
5. Usar Livewire para interatividade, nao Vue/React
6. Mobile-first sempre
7. Validar inputs do usuario SEMPRE
8. Nunca expor API keys em logs ou responses

---

## Links Importantes

- [Laravel Docs](https://laravel.com/docs)
- [Livewire Docs](https://livewire.laravel.com/docs)
- [TailwindCSS Docs](https://tailwindcss.com/docs)
- [Binance API](https://binance-docs.github.io/apidocs/)
- [Mercado Bitcoin API](https://www.mercadobitcoin.com.br/api-doc/)

---

*Atualizado em Dezembro 2025*
