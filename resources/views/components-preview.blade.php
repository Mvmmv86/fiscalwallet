<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fiscal Wallet - Preview de Componentes</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-background min-h-screen p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-4">
                <x-ui.logo size="lg" />
            </div>
            <h1 class="text-display text-gray-900 mb-2">Fiscal Wallet</h1>
            <p class="text-body-lg text-gray-600">Preview de todos os componentes do Design System</p>
        </div>

        <!-- LOGO -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Logo</h2>

            <div class="flex flex-wrap items-center gap-8">
                <div class="flex flex-col items-center gap-2">
                    <x-ui.logo size="sm" />
                    <span class="text-xs text-gray-500">Small</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <x-ui.logo size="md" />
                    <span class="text-xs text-gray-500">Medium</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <x-ui.logo size="lg" />
                    <span class="text-xs text-gray-500">Large</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <x-ui.logo size="xl" />
                    <span class="text-xs text-gray-500">Extra Large</span>
                </div>
            </div>
        </section>

        <!-- BACK BUTTON & ICON BUTTON -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Back Button & Icon Buttons</h2>

            <div class="space-y-6">
                <!-- Back Button -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Back Button</h3>
                    <div class="flex items-center gap-4">
                        <x-ui.back-button />
                        <span class="text-gray-500 text-sm">Botão de voltar</span>
                    </div>
                </div>

                <!-- Icon Buttons -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Icon Buttons</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.icon-button icon="bell" variant="neutral" />
                            <span class="text-xs text-gray-500">Neutral</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.icon-button icon="bell" variant="neutral" badge />
                            <span class="text-xs text-gray-500">Com badge</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.icon-button icon="plus" variant="primary" />
                            <span class="text-xs text-gray-500">Primary</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.icon-button icon="more-vertical" variant="ghost" />
                            <span class="text-xs text-gray-500">Ghost</span>
                        </div>
                    </div>
                </div>

                <!-- Icon Button Sizes -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.icon-button icon="bell" size="sm" />
                            <span class="text-xs text-gray-500">Small</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.icon-button icon="bell" size="md" />
                            <span class="text-xs text-gray-500">Medium</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.icon-button icon="bell" size="lg" />
                            <span class="text-xs text-gray-500">Large</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DIVIDER -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Divider</h2>

            <div class="space-y-6 max-w-md">
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Simples</h3>
                    <x-ui.divider />
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Com texto</h3>
                    <x-ui.divider text="ou" />
                </div>
            </div>
        </section>

        <!-- RADIO BUTTON -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Radio Button</h2>

            <div class="max-w-sm space-y-2">
                <x-ui.radio-button
                    name="importacao"
                    value="automatica"
                    label="Importação automática"
                    :checked="true"
                />
                <x-ui.radio-button
                    name="importacao"
                    value="manual"
                    label="Importação manual"
                />
            </div>
        </section>

        <!-- BANNER CARD -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Banner Card</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Banner MBR Invest / Anuncio --}}
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Banner Anuncio (MBR Invest)</h3>
                    <div class="grid grid-cols-2 gap-4 items-start">
                        {{-- Versao Quadrada --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Quadrado</p>
                            <div class="rounded-xl overflow-hidden max-w-[180px]">
                                <img
                                    src="{{ asset('assets/images/source_banner anuncio.png') }}"
                                    alt="Banner Anuncio Quadrado"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>

                        {{-- Versao Retangular --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Retangular</p>
                            <div class="rounded-xl overflow-hidden">
                                <img
                                    src="{{ asset('assets/images/banner-anuncio-Rectangle 56.png') }}"
                                    alt="Banner Anuncio Retangular"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Banner Login --}}
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Banner Login</h3>
                    <div class="grid grid-cols-2 gap-4 items-start">
                        {{-- Versao Quadrada --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Quadrado</p>
                            <div class="rounded-xl overflow-hidden max-w-[180px]">
                                <img
                                    src="{{ asset('assets/images/banner-login.png') }}"
                                    alt="Banner Login Quadrado"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>

                        {{-- Versao Retangular --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Retangular</p>
                            <div class="rounded-xl overflow-hidden">
                                <img
                                    src="{{ asset('assets/images/banner-login-retangulo.png') }}"
                                    alt="Banner Login Retangular"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BUTTONS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Buttons</h2>

            <div class="space-y-6">
                <!-- Variants -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Variantes</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-ui.button variant="primary">Primary</x-ui.button>
                        <x-ui.button variant="secondary">Secondary</x-ui.button>
                        <x-ui.button variant="neutral">Neutral</x-ui.button>
                        <x-ui.button variant="danger">Danger</x-ui.button>
                        <x-ui.button variant="success">Success</x-ui.button>
                        <x-ui.button variant="ghost">Ghost</x-ui.button>
                    </div>
                </div>

                <!-- Sizes -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-ui.button variant="primary" size="sm">Small</x-ui.button>
                        <x-ui.button variant="primary" size="md">Medium</x-ui.button>
                        <x-ui.button variant="primary" size="lg">Large</x-ui.button>
                        <x-ui.button variant="primary" size="xl">Extra Large</x-ui.button>
                    </div>
                </div>

                <!-- With Icons -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Com Ícones</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-ui.button variant="primary" icon="plus">Adicionar</x-ui.button>
                        <x-ui.button variant="secondary" icon="download">Exportar</x-ui.button>
                        <x-ui.button variant="neutral" icon="refresh">Sincronizar</x-ui.button>
                    </div>
                </div>

                <!-- Disabled -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Desabilitado</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-ui.button variant="primary" disabled>Desabilitado</x-ui.button>
                    </div>
                </div>
            </div>
        </section>

        <!-- INPUTS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Inputs</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.input
                    label="Input padrão"
                    placeholder="Digite algo..."
                />

                <x-ui.input
                    label="Com ícone"
                    placeholder="Pesquisar..."
                    icon="search"
                />

                <x-ui.input
                    label="Com erro"
                    placeholder="Email inválido"
                    error="Este campo é obrigatório"
                />

                <x-ui.input
                    label="Com dica"
                    placeholder="Sua API Key"
                    hint="Encontre sua API Key nas configurações da Binance"
                />
            </div>
        </section>

        <!-- SELECT -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Select</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.select
                    label="Carteira"
                    placeholder="Selecione uma carteira"
                    :options="['binance' => 'Binance', 'mercado_bitcoin' => 'Mercado Bitcoin', 'ftx' => 'FTX']"
                />

                <x-ui.select
                    label="Com erro"
                    placeholder="Selecione..."
                    :options="['op1' => 'Opção 1', 'op2' => 'Opção 2']"
                    error="Selecione uma opção"
                />
            </div>
        </section>

        <!-- BADGES -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Badges</h2>

            <div class="space-y-6">
                <!-- Variants -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Variantes</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-ui.badge variant="primary">Primary</x-ui.badge>
                        <x-ui.badge variant="success">Success</x-ui.badge>
                        <x-ui.badge variant="danger">Danger</x-ui.badge>
                        <x-ui.badge variant="warning">Warning</x-ui.badge>
                        <x-ui.badge variant="neutral">Neutral</x-ui.badge>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Status Fiscais</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-ui.badge variant="entrada">Entrada</x-ui.badge>
                        <x-ui.badge variant="saida">Saída</x-ui.badge>
                        <x-ui.badge variant="saque">Saque</x-ui.badge>
                        <x-ui.badge variant="deposito">Depósito</x-ui.badge>
                        <x-ui.badge variant="pendente">Pendente</x-ui.badge>
                        <x-ui.badge variant="isento">Isento</x-ui.badge>
                    </div>
                </div>

                <!-- With dot -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Com indicador</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-ui.badge variant="success" dot>Ativo</x-ui.badge>
                        <x-ui.badge variant="danger" dot>Inativo</x-ui.badge>
                        <x-ui.badge variant="warning" dot>Pendente</x-ui.badge>
                    </div>
                </div>

                <!-- Sizes -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-ui.badge variant="primary" size="sm">Small</x-ui.badge>
                        <x-ui.badge variant="primary" size="md">Medium</x-ui.badge>
                        <x-ui.badge variant="primary" size="lg">Large</x-ui.badge>
                    </div>
                </div>
            </div>
        </section>

        <!-- CARDS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Cards</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-ui.card title="Card Simples">
                    <p class="text-gray-600">Conteúdo do card com texto simples.</p>
                </x-ui.card>

                <x-ui.card title="Card com Subtítulo" subtitle="Informação adicional">
                    <p class="text-gray-600">Card com título e subtítulo.</p>
                </x-ui.card>

                <x-ui.card title="Card com Footer">
                    <p class="text-gray-600">Card com área de footer.</p>
                    <x-slot name="footer">
                        <x-ui.button variant="primary" size="sm">Ação</x-ui.button>
                    </x-slot>
                </x-ui.card>
            </div>
        </section>

        <!-- METRIC CARDS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Metric Cards</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <x-ui.metric-card
                    title="Desempenho do mês"
                    value="R$ 34.000,00"
                    variant="primary"
                    icon="chart"
                    info="Desempenho total do mês"
                />

                <x-ui.metric-card
                    title="Ganhos"
                    value="R$ 50.000,00"
                    variant="success"
                    icon="trending-up"
                    info="Total de ganhos"
                />

                <x-ui.metric-card
                    title="Perdas"
                    value="R$ 16.000,00"
                    variant="danger"
                    icon="trending-down"
                    info="Total de perdas"
                />

                <x-ui.metric-card
                    title="Quantidade de operações"
                    value="58"
                    variant="default"
                    icon="list"
                    info="Número de operações"
                />
            </div>
        </section>

        <!-- PROGRESS BAR -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Progress Bar</h2>

            <div class="space-y-6 max-w-md">
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Cores</h3>
                    <div class="space-y-4">
                        <x-ui.progress-bar :value="70" :max="100" color="primary" />
                        <x-ui.progress-bar :value="50" :max="100" color="success" />
                        <x-ui.progress-bar :value="30" :max="100" color="warning" />
                        <x-ui.progress-bar :value="90" :max="100" color="danger" />
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="space-y-4">
                        <x-ui.progress-bar :value="60" :max="100" size="sm" />
                        <x-ui.progress-bar :value="60" :max="100" size="md" />
                        <x-ui.progress-bar :value="60" :max="100" size="lg" />
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Limite de Isenção (exemplo real)</h3>
                    <x-ui.progress-bar :value="34000" :max="35000" color="primary" :showLabel="true" />
                </div>
            </div>
        </section>

        <!-- PERIOD FILTER -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Period Filter</h2>

            <div class="space-y-4">
                <x-ui.period-filter :periods="['1D', '1S', '1M', '1A', 'Tudo']" selected="Tudo" />
                <x-ui.period-filter :periods="['7D', '30D', '90D', '1A']" selected="30D" />
            </div>
        </section>

        <!-- DATE PICKER -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Date Picker</h2>

            <div class="flex flex-wrap gap-6">
                <x-ui.date-picker :year="2023" />
                <x-ui.date-picker :year="2023" :month="'07'" :showMonth="true" />
            </div>
        </section>

        <!-- SUMMARY ITEM -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Summary Item</h2>

            <div class="max-w-sm">
                <x-ui.card title="Resumo">
                    <x-ui.summary-item
                        label="Limite de isenção"
                        value="R$34.000,00/R$ 35.000,00"
                        info="Limite mensal de isenção fiscal"
                    >
                        <x-ui.progress-bar :value="34000" :max="35000" color="primary" />
                    </x-ui.summary-item>

                    <x-ui.summary-item
                        label="Valor tributário a pagar"
                        value="R$0,00"
                    />

                    <x-ui.summary-item
                        label="Próxima data para envio de declaração:"
                        value="24/Abr"
                    />

                    <x-ui.summary-item
                        label="Quantidade de operações"
                        value="R$ 42,00"
                        :border="false"
                    />
                </x-ui.card>
            </div>
        </section>

        <!-- ASSET LIST ITEM -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Asset List Item</h2>

            <div class="max-w-sm">
                <x-ui.card title="Principais ativos">
                    <div class="space-y-2">
                        <x-ui.asset-list-item name="BTC" :value="1000000" color="#9333EA" />
                        <x-ui.asset-list-item name="ETH" :value="500000" color="#A855F7" />
                        <x-ui.asset-list-item name="USDT" :value="500000" color="#C084FC" />
                        <x-ui.asset-list-item name="XRP" :value="500000" color="#D8B4FE" />
                        <x-ui.asset-list-item name="Outros" :value="500000" color="#E9D5FF" />
                    </div>
                </x-ui.card>
            </div>
        </section>

        <!-- TABLE -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Table</h2>

            <x-ui.card padding="none">
                <x-ui.table>
                    <x-slot name="head">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mês</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Valor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                        </tr>
                    </x-slot>

                    <x-ui.table-row>
                        <x-ui.table-cell>DEZ</x-ui.table-cell>
                        <x-ui.table-cell>R$ 3.000.000,00</x-ui.table-cell>
                        <x-ui.table-cell><x-ui.badge variant="pendente">Pendente</x-ui.badge></x-ui.table-cell>
                        <x-ui.table-cell>
                            <x-ui.dropdown>
                                <x-slot name="trigger">
                                    <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100">
                                        <x-icons.more-vertical class="w-5 h-5" />
                                    </button>
                                </x-slot>
                                <x-ui.dropdown-item>Ver detalhes</x-ui.dropdown-item>
                                <x-ui.dropdown-item>Editar</x-ui.dropdown-item>
                                <x-ui.dropdown-item danger>Excluir</x-ui.dropdown-item>
                            </x-ui.dropdown>
                        </x-ui.table-cell>
                    </x-ui.table-row>

                    <x-ui.table-row>
                        <x-ui.table-cell>NOV</x-ui.table-cell>
                        <x-ui.table-cell>R$ 3.000.000,00</x-ui.table-cell>
                        <x-ui.table-cell><x-ui.badge variant="isento">Isento</x-ui.badge></x-ui.table-cell>
                        <x-ui.table-cell>
                            <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100">
                                <x-icons.more-vertical class="w-5 h-5" />
                            </button>
                        </x-ui.table-cell>
                    </x-ui.table-row>

                    <x-ui.table-row>
                        <x-ui.table-cell>OUT</x-ui.table-cell>
                        <x-ui.table-cell>R$ 3.000.000,00</x-ui.table-cell>
                        <x-ui.table-cell><x-ui.badge variant="isento">Isento</x-ui.badge></x-ui.table-cell>
                        <x-ui.table-cell>
                            <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100">
                                <x-icons.more-vertical class="w-5 h-5" />
                            </button>
                        </x-ui.table-cell>
                    </x-ui.table-row>
                </x-ui.table>
            </x-ui.card>
        </section>

        <!-- CHECKBOX -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Checkbox</h2>

            <div class="flex flex-wrap gap-6">
                <x-ui.checkbox label="Opção 1" />
                <x-ui.checkbox label="Opção 2" :checked="true" />
                <x-ui.checkbox label="Opção 3" />
            </div>
        </section>

        <!-- AVATAR -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Avatar</h2>

            <div class="flex flex-wrap items-center gap-6">
                <x-ui.avatar size="sm" alt="AR" />
                <x-ui.avatar size="md" alt="AR" />
                <x-ui.avatar size="lg" alt="AR" />
                <x-ui.avatar size="xl" alt="AR" />
                <x-ui.avatar
                    size="lg"
                    src="https://ui-avatars.com/api/?name=Alonso+Rodrigues&background=9333EA&color=fff"
                    alt="Alonso Rodrigues"
                />
            </div>
        </section>

        <!-- DROPDOWN -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Dropdown</h2>

            <div class="flex gap-6">
                <x-ui.dropdown>
                    <x-slot name="trigger">
                        <x-ui.button variant="neutral">
                            Menu de Ações
                            <x-icons.chevron-down class="w-4 h-4" />
                        </x-ui.button>
                    </x-slot>

                    <x-ui.dropdown-item href="#">
                        <x-icons.file-text class="w-4 h-4" />
                        Ver detalhes
                    </x-ui.dropdown-item>
                    <x-ui.dropdown-item href="#">
                        <x-icons.download class="w-4 h-4" />
                        Baixar
                    </x-ui.dropdown-item>
                    <x-ui.dropdown-item href="#">
                        <x-icons.refresh class="w-4 h-4" />
                        Sincronizar
                    </x-ui.dropdown-item>
                    <div class="border-t border-gray-100 my-1"></div>
                    <x-ui.dropdown-item href="#" danger>
                        <x-icons.x class="w-4 h-4" />
                        Excluir
                    </x-ui.dropdown-item>
                </x-ui.dropdown>
            </div>
        </section>

        <!-- TEXTAREA -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Textarea</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl">
                <x-ui.textarea
                    label="Descricao"
                    placeholder="Digite aqui a descricao..."
                />

                <x-ui.textarea
                    label="Com erro"
                    placeholder="Digite algo..."
                    error="Este campo e obrigatorio"
                />

                <x-ui.textarea
                    label="Com dica"
                    placeholder="Observacoes adicionais..."
                    hint="Maximo de 500 caracteres"
                    :rows="3"
                />
            </div>
        </section>

        <!-- SPINNER -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Spinner</h2>

            <div class="space-y-6">
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="flex items-center gap-6">
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.spinner size="sm" />
                            <span class="text-xs text-gray-500">Small</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.spinner size="md" />
                            <span class="text-xs text-gray-500">Medium</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.spinner size="lg" />
                            <span class="text-xs text-gray-500">Large</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.spinner size="xl" />
                            <span class="text-xs text-gray-500">Extra Large</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Cores</h3>
                    <div class="flex items-center gap-6">
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.spinner color="primary" />
                            <span class="text-xs text-gray-500">Primary</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.spinner color="gray" />
                            <span class="text-xs text-gray-500">Gray</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.spinner color="success" />
                            <span class="text-xs text-gray-500">Success</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <x-ui.spinner color="danger" />
                            <span class="text-xs text-gray-500">Danger</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 bg-gray-800 p-3 rounded-lg">
                            <x-ui.spinner color="white" />
                            <span class="text-xs text-gray-300">White</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- STEP PROGRESS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Step Progress</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-ui.card title="Processando...">
                    <x-ui.step-progress :steps="[
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'loading'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'pending'],
                        ['label' => 'Gerando documento', 'status' => 'pending'],
                    ]" />
                </x-ui.card>

                <x-ui.card title="Concluido">
                    <x-ui.step-progress :steps="[
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'completed'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'completed'],
                        ['label' => 'Gerando documento', 'status' => 'completed'],
                    ]" />
                </x-ui.card>

                <x-ui.card title="Com Erro">
                    <x-ui.step-progress :steps="[
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'error'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'pending'],
                        ['label' => 'Gerando documento', 'status' => 'pending'],
                    ]" />
                </x-ui.card>
            </div>
        </section>

        <!-- MODAL -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Modal</h2>

            <div x-data="{ showModal: false }">
                <x-ui.button variant="primary" @click="showModal = true">
                    Abrir Modal
                </x-ui.button>

                <div
                    x-show="showModal"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 overflow-y-auto"
                    x-cloak
                >
                    <div class="fixed inset-0 bg-black/50" @click="showModal = false"></div>

                    <div class="flex min-h-full items-center justify-center p-4">
                        <div
                            x-show="showModal"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="relative bg-white rounded-2xl shadow-modal w-full max-w-md overflow-hidden"
                            @click.stop
                        >
                            <div class="flex items-center justify-between p-6 pb-0">
                                <h2 class="text-xl font-semibold text-gray-900">Conectar com a Binance</h2>
                                <button @click="showModal = false" class="p-2 rounded-full text-gray-400 hover:bg-gray-100">
                                    <x-icons.x class="w-5 h-5" />
                                </button>
                            </div>

                            <div class="p-6 space-y-4">
                                <x-ui.input label="Digite o nome da carteira" placeholder="Pesquisar" icon="search" />

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-3">Importar operações</p>
                                    <div class="space-y-2">
                                        <x-ui.radio-button
                                            name="modal_importacao"
                                            value="automatica"
                                            label="Importação automática"
                                            :checked="true"
                                        />
                                        <x-ui.radio-button
                                            name="modal_importacao"
                                            value="manual"
                                            label="Importação manual"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end p-6 pt-0">
                                <x-ui.button variant="primary">Continuar</x-ui.button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PAGINATION -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Pagination</h2>

            <div class="flex items-center justify-end gap-4">
                <span class="text-sm text-gray-600">1-50 de 1000</span>
                <div class="flex items-center gap-2">
                    <button class="p-2 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50">
                        <x-icons.arrow-left class="w-4 h-4" />
                    </button>
                    <button class="p-2 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50">
                        <x-icons.arrow-right class="w-4 h-4" />
                    </button>
                </div>
            </div>
        </section>

        <!-- FILTER BAR -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Filter Bar</h2>

            <div class="flex flex-wrap items-center gap-3">
                <x-ui.date-picker :year="2023" :month="'07'" :showMonth="true" />

                <div class="relative flex-1 min-w-[200px] max-w-xs">
                    <input
                        type="text"
                        placeholder="Pesquisar"
                        class="w-full pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100"
                    />
                    <x-icons.search class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                </div>

                <div class="relative">
                    <select class="appearance-none pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 cursor-pointer">
                        <option>Todas as carteiras</option>
                        <option>Binance</option>
                        <option>Mercado Bitcoin</option>
                    </select>
                    <x-icons.chevron-down class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" />
                </div>

                <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                    Filtro
                    <x-icons.filter class="w-4 h-4" />
                </button>
            </div>
        </section>

        <!-- ICONS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Icons</h2>

            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-4">
                @php
                    $icons = [
                        'grid', 'wallet', 'credit-card', 'list', 'file-text',
                        'book', 'help-circle', 'bell', 'search', 'filter',
                        'calendar', 'chevron-down', 'chevron-right', 'arrow-left', 'arrow-right',
                        'x', 'more-vertical', 'check', 'info', 'plus',
                        'chart', 'trending-up', 'trending-down', 'refresh', 'download', 'menu',
                        'alert-circle'
                    ];
                @endphp

                @foreach($icons as $icon)
                    <div class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-100">
                        <x-dynamic-component :component="'icons.' . $icon" class="w-6 h-6 text-gray-700" />
                        <span class="text-xs text-gray-500">{{ $icon }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- SIDEBAR ITEM -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Sidebar Item</h2>

            <div class="max-w-xs bg-sidebar-bg p-4 rounded-lg space-y-1">
                <x-layouts.sidebar-item href="#" icon="grid" :active="true">
                    Dashboard
                </x-layouts.sidebar-item>
                <x-layouts.sidebar-item href="#" icon="wallet" :active="false">
                    Portfólio
                </x-layouts.sidebar-item>
                <x-layouts.sidebar-item href="#" icon="credit-card" :active="false">
                    Carteiras
                </x-layouts.sidebar-item>
                <x-layouts.sidebar-item href="#" icon="list" :active="false">
                    Operações
                </x-layouts.sidebar-item>
                <x-layouts.sidebar-item href="#" icon="file-text" :active="false">
                    Declarações
                </x-layouts.sidebar-item>
            </div>
        </section>

        <!-- COLORS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Cores do Design System</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <h3 class="text-h3 text-gray-700 mb-3">Primary</h3>
                    <div class="space-y-2">
                        <div class="h-10 rounded bg-primary-500 flex items-center justify-center text-white text-xs">#9333EA</div>
                        <div class="h-10 rounded bg-primary-600 flex items-center justify-center text-white text-xs">#7C3AED</div>
                        <div class="h-10 rounded bg-primary-100 flex items-center justify-center text-primary-700 text-xs">#F3E8FF</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-3">Success</h3>
                    <div class="space-y-2">
                        <div class="h-10 rounded bg-success-500 flex items-center justify-center text-white text-xs">#22C55E</div>
                        <div class="h-10 rounded bg-success-600 flex items-center justify-center text-white text-xs">#16A34A</div>
                        <div class="h-10 rounded bg-success-100 flex items-center justify-center text-success-700 text-xs">#DCFCE7</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-3">Danger</h3>
                    <div class="space-y-2">
                        <div class="h-10 rounded bg-danger-500 flex items-center justify-center text-white text-xs">#EF4444</div>
                        <div class="h-10 rounded bg-danger-600 flex items-center justify-center text-white text-xs">#DC2626</div>
                        <div class="h-10 rounded bg-danger-100 flex items-center justify-center text-danger-700 text-xs">#FEE2E2</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-3">Warning</h3>
                    <div class="space-y-2">
                        <div class="h-10 rounded bg-warning-500 flex items-center justify-center text-white text-xs">#F59E0B</div>
                        <div class="h-10 rounded bg-warning-600 flex items-center justify-center text-white text-xs">#D97706</div>
                        <div class="h-10 rounded bg-warning-100 flex items-center justify-center text-warning-700 text-xs">#FEF3C7</div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>
</html>
