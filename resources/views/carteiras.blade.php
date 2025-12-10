<x-layouts.dashboard title="Carteiras">
    <style>
        .exchange-btn {
            width: 80px !important;
            height: 80px !important;
            min-width: 80px !important;
            min-height: 80px !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            background-color: white !important;
            border-radius: 12px !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
        }
        .exchange-btn:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
        }
        .exchange-btn.selected {
            border: 2px solid #9333EA !important;
            box-shadow: 0 0 12px rgba(147, 51, 234, 0.4) !important;
        }
        .exchange-btn:not(.selected) {
            border: 1px solid #e5e7eb !important;
        }
        .exchange-btn img {
            width: 32px !important;
            height: 32px !important;
            object-fit: contain !important;
        }
    </style>

    @php
        // Dados mock para as carteiras
        $carteiras = [
            [
                'nome' => 'Binance',
                'tipo' => 'Exchange',
                'operacoes' => 64,
                'ultima_sync' => '51 dias atrás',
                'status' => 'Sincronizado',
                'status_tempo' => '6 dias atrás',
                'saldo' => 0.00,
            ],
            [
                'nome' => 'Mercado Bitcoin',
                'tipo' => 'Exchange',
                'operacoes' => 128,
                'ultima_sync' => '2 dias atrás',
                'status' => 'Sincronizado',
                'status_tempo' => '2 dias atrás',
                'saldo' => 15420.50,
            ],
            [
                'nome' => 'MetaMask',
                'tipo' => 'Wallet',
                'operacoes' => 23,
                'ultima_sync' => '15 dias atrás',
                'status' => 'Pendente',
                'status_tempo' => '15 dias atrás',
                'saldo' => 8750.00,
            ],
        ];

        $plataformas = [
            ['nome' => 'Binance', 'tipo' => 'Exchange', 'logo' => 'binance'],
            ['nome' => 'Coinbase', 'tipo' => 'Exchange', 'logo' => 'coinbase'],
            ['nome' => 'MetaMask', 'tipo' => 'Wallet', 'logo' => 'metamask'],
        ];
    @endphp

    <!-- Container principal com Alpine.js para gerenciar modais -->
    <div x-data="{
        modalStep: 0,
        selectedPlatform: null,
        selectedFilter: 'Todos',
        importType: null,
        openModal() { this.modalStep = 1; },
        closeModal() { this.modalStep = 0; this.selectedPlatform = null; this.importType = null; },
        selectPlatform(platform) { this.selectedPlatform = platform; },
        goToConnect() { if(this.selectedPlatform) this.modalStep = 2; },
        goToImportAuto() { this.importType = 'auto'; this.modalStep = 3; },
        goToImportManual() { this.importType = 'manual'; this.modalStep = 4; },
        goToProcessing() { this.modalStep = 5; },
        goBack() { if(this.modalStep > 1) this.modalStep--; }
    }">

        <!-- Header com botões -->
        <div class="flex items-center justify-end gap-3 mb-4">
            <button
                @click="openModal()"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-colors whitespace-nowrap"
            >
                Adicionar carteira
            </button>
            <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-primary-600 bg-white border border-primary-600 rounded-full hover:bg-primary-50 transition-colors whitespace-nowrap">
                Sincronizar tudo
            </button>
        </div>

        <!-- Card principal -->
        <div class="bg-white rounded-xl border border-gray-100">
            <!-- Filtros -->
            <div class="p-4 border-b border-gray-100">
                <div class="flex items-center gap-3 flex-wrap">
                    <!-- Campo de pesquisa -->
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Pesquisar"
                            class="px-4 py-2 text-sm border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                            style="width: 160px;"
                        />
                    </div>

                    <!-- Filtro: Todas as carteiras -->
                    <div class="relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 whitespace-nowrap"
                        >
                            <span>Todas as carteiras</span>
                            <x-icons.chevron-down class="w-4 h-4 text-gray-400" />
                        </button>
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute top-full left-0 mt-1 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-20"
                        >
                            <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-t-lg">Todas as carteiras</a>
                            <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">Exchanges</a>
                            <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-b-lg">Wallets</a>
                        </div>
                    </div>

                    <!-- Filtro: Ordem -->
                    <div class="relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 whitespace-nowrap"
                        >
                            <span>Ordem: crescente</span>
                            <x-icons.chevron-down class="w-4 h-4 text-gray-400" />
                        </button>
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute top-full left-0 mt-1 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-20"
                        >
                            <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-t-lg">Ordem: crescente</a>
                            <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-b-lg">Ordem: decrescente</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabela de carteiras -->
            <div class="overflow-visible" style="min-height: 200px;">
                <table class="w-full">
                    <tbody>
                        @forelse($carteiras as $carteira)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4" style="width: 20%;">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $carteira['nome'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $carteira['tipo'] }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4" style="width: 25%;">
                                    <div>
                                        <p class="text-sm text-gray-900">{{ $carteira['operacoes'] }} operações</p>
                                        <p class="text-xs text-gray-500">{{ $carteira['ultima_sync'] }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4" style="width: 25%;">
                                    <div>
                                        <p class="text-sm text-gray-900">{{ $carteira['status'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $carteira['status_tempo'] }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4" style="width: 20%;">
                                    <p class="text-sm text-gray-900">R$ {{ number_format($carteira['saldo'], 2, ',', '.') }}</p>
                                </td>
                                <td class="px-6 py-4 text-right overflow-visible" style="width: 10%;">
                                    <div class="relative inline-block" x-data="{ open: false }">
                                        <button @click="open = !open" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <circle cx="12" cy="5" r="2"></circle>
                                                <circle cx="12" cy="12" r="2"></circle>
                                                <circle cx="12" cy="19" r="2"></circle>
                                            </svg>
                                        </button>
                                        <div
                                            x-show="open"
                                            x-cloak
                                            @click.away="open = false"
                                            x-transition
                                            class="absolute right-full top-0 mr-2 w-36 bg-white rounded-lg shadow-lg z-50 py-1 border border-gray-200"
                                        >
                                            <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Ver operações</a>
                                            <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Sincronizar</a>
                                            <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Excluir carteira</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <p class="text-gray-500">Nenhuma carteira cadastrada</p>
                                    <button @click="openModal()" class="text-primary-600 hover:underline text-sm mt-2">Adicionar sua primeira carteira</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <span class="text-sm text-gray-500">1-10 de 1</span>
                <div class="flex items-center gap-1">
                    <button class="p-1.5 rounded-full border border-gray-200 hover:bg-gray-50 disabled:opacity-50" disabled>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="p-1.5 rounded-full border border-gray-200 hover:bg-gray-50 disabled:opacity-50" disabled>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL 1: Selecione a plataforma -->
        <div
            x-show="modalStep === 1"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            @keydown.escape.window="closeModal()"
        >
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

            <!-- Modal Content -->
            <div
                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Selecione a plataforma</h2>
                    <button @click="closeModal()" class="p-1.5 rounded-full hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="px-6 pt-8 pb-6">
                    <!-- Pesquisar com estilo do design system -->
                    <div class="mb-8">
                        <x-ui.input
                            type="text"
                            name="search_platform"
                            placeholder="Pesquisar"
                            iconRight="search"
                            rounded="full"
                        />
                    </div>

                    <!-- Filtros de tipo com estilo do onboarding -->
                    <div class="flex flex-wrap justify-center gap-2 mb-8">
                        <template x-for="filter in ['Todos', 'Blockchain', 'Exchange', 'Wallet']" :key="filter">
                            <button
                                type="button"
                                @click="selectedFilter = filter"
                                :class="selectedFilter === filter ? 'bg-primary-100 text-primary-700 border-primary-300' : 'bg-gray-100 text-gray-600 border-gray-200 hover:bg-primary-50'"
                                class="px-4 py-1.5 text-sm font-medium rounded-full border transition-all cursor-pointer"
                                x-text="filter"
                            ></button>
                        </template>
                    </div>

                    <!-- Grid de plataformas com estilo do onboarding -->
                    <div class="flex justify-center items-center gap-6 py-4">
                        @foreach($plataformas as $plataforma)
                            <button
                                type="button"
                                @click="selectPlatform('{{ $plataforma['nome'] }}')"
                                :class="selectedPlatform === '{{ $plataforma['nome'] }}' ? 'selected' : ''"
                                class="exchange-btn"
                            >
                                <img src="{{ asset('assets/images/exchanges/' . $plataforma['logo'] . '.png') }}" alt="{{ $plataforma['nome'] }}">
                                <span class="text-[10px] text-gray-600 text-center leading-tight mt-1">{{ $plataforma['nome'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end">
                    <button
                        @click="goToConnect()"
                        x-show="selectedPlatform"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-colors"
                    >
                        Continuar
                    </button>
                    <span
                        x-show="!selectedPlatform"
                        class="px-6 py-2.5 text-sm font-medium text-gray-500 bg-gray-200 rounded-full cursor-not-allowed"
                    >
                        Continuar
                    </span>
                </div>
            </div>
        </div>

        <!-- MODAL 2: Conectar com a Exchange -->
        <div
            x-show="modalStep === 2"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            @keydown.escape.window="closeModal()"
        >
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

            <div
                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Conectar com a <span x-text="selectedPlatform"></span></h2>
                    <button @click="closeModal()" class="p-1.5 rounded-full hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="px-6 py-5">
                    <!-- Nome da carteira -->
                    <div class="mb-5">
                        <label class="block text-xs font-normal text-gray-500 mb-2">Digite o nome da carteira</label>
                        <x-ui.input
                            type="text"
                            name="wallet_name"
                            placeholder="Ex: Minha Binance Principal"
                            rounded="full"
                        />
                    </div>

                    <!-- Importar operações -->
                    <div class="mb-4">
                        <label class="block text-xs font-normal text-gray-500 mb-3">Importar operações</label>
                        <div class="space-y-3">
                            <button
                                type="button"
                                @click="goToImportAuto()"
                                class="w-full px-4 py-3.5 text-sm text-gray-700 bg-[#DDD8E1] rounded-full hover:bg-gray-300 transition-colors font-medium flex items-center justify-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Importação automática
                            </button>
                            <button
                                type="button"
                                @click="goToImportManual()"
                                class="w-full px-4 py-3.5 text-sm text-gray-700 bg-[#DDD8E1] rounded-full hover:bg-gray-300 transition-colors font-medium flex items-center justify-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Importação manual
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-100 flex justify-between">
                    <button
                        type="button"
                        @click="goBack()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors"
                    >
                        Voltar
                    </button>
                    <button
                        type="button"
                        @click="goToProcessing()"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-colors"
                    >
                        Continuar
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL 3: Importação Automática -->
        <div
            x-show="modalStep === 3"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            @keydown.escape.window="closeModal()"
        >
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

            <div
                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Importação Automática</h2>
                    <button type="button" @click="closeModal()" class="p-1.5 rounded-full hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="px-6 py-5 space-y-4">
                    <!-- API Key -->
                    <x-ui.input
                        type="text"
                        name="api_key"
                        label="API KEY"
                        placeholder="Digite a chave API"
                        rounded="lg"
                    />

                    <!-- API Secret -->
                    <x-ui.input
                        type="password"
                        name="api_secret"
                        label="API SECRET"
                        placeholder="Digite a chave secreta"
                        rounded="lg"
                    />

                    <!-- Data -->
                    <x-ui.input
                        type="date"
                        name="start_date"
                        label="Data inicial"
                        placeholder="Selecione a data"
                        rounded="lg"
                    />
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-100 flex justify-between">
                    <button
                        type="button"
                        @click="goBack()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors"
                    >
                        Voltar
                    </button>
                    <button
                        type="button"
                        @click="goToProcessing()"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-colors"
                    >
                        Importar
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL 4: Importação Manual -->
        <div
            x-show="modalStep === 4"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            @keydown.escape.window="closeModal()"
        >
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

            <div
                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Importação Manual</h2>
                    <button type="button" @click="closeModal()" class="p-1.5 rounded-full hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="px-6 py-5 space-y-4" x-data="{ fileName: '' }">
                    <!-- Upload de arquivo -->
                    <div>
                        <label class="block text-xs font-normal text-gray-500 mb-2">Upload dos arquivos</label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 transition-colors bg-gray-50/50">
                            <input
                                type="file"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                accept=".csv,.xlsx,.xls"
                                @change="fileName = $event.target.files[0]?.name || ''"
                            />
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700" x-text="fileName || 'Clique para selecionar'"></p>
                                    <p class="text-xs text-gray-400 mt-1">ou arraste e solte seus arquivos aqui</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-3 text-center">Formatos aceitos: CSV, XLS, XLSX</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-100 flex justify-between">
                    <button
                        type="button"
                        @click="goBack()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors"
                    >
                        Voltar
                    </button>
                    <button
                        type="button"
                        @click="goToProcessing()"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-colors"
                    >
                        Importar
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL 5: Processando -->
        <div
            x-show="modalStep === 5"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            @keydown.escape.window="closeModal()"
        >
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

            <div
                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
            >
                <!-- Body -->
                <div class="px-6 py-10 text-center">
                    <!-- Ícone de sucesso -->
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-900 mb-3">As operações estão sendo processadas</h2>
                    <p class="text-sm text-gray-500 mb-8 leading-relaxed">
                        Aguarde enquanto estamos processando suas operações, assim que estiver pronto lhe enviaremos um e-mail avisando.
                    </p>
                    <button
                        type="button"
                        @click="closeModal()"
                        class="w-full px-6 py-3 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-colors"
                    >
                        Entendi
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-layouts.dashboard>
