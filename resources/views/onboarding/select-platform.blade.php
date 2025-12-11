<x-layouts.onboarding title="Selecione a plataforma" :step="2">
    <style>
        .exchange-btn {
            width: 80px !important;
            height: 80px !important;
            min-width: 80px !important;
            min-height: 80px !important;
            display: flex !important;
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

    <div class="flex flex-col items-center gap-6" x-data="{ selectedExchange: null, activeFilter: 'todos' }">
        <!-- Título -->
        <div class="text-center">
            <h1 class="text-2xl font-semibold text-gray-900">Selecione a plataforma</h1>
            <p class="text-sm text-gray-500 mt-2">
                Mesmo você integrando suas carteiras ou operações, isso não será enviado a receita federal.
            </p>
        </div>

        <!-- Campo de Pesquisa -->
        <div class="w-full max-w-md">
            <x-ui.input
                type="text"
                name="search"
                placeholder="Pesquisar"
                iconRight="search"
                rounded="full"
            />
        </div>

        <!-- Filtros/Tabs -->
        <div class="flex flex-wrap justify-center gap-2">
            <button
                type="button"
                @click="activeFilter = 'todos'"
                :class="activeFilter === 'todos' ? 'bg-primary-100 text-primary-700 border-primary-300' : 'bg-gray-100 text-gray-600 border-gray-200'"
                class="px-4 py-1.5 text-sm font-medium rounded-full border transition-all cursor-pointer hover:bg-primary-50"
            >
                Todos
            </button>
            <button
                type="button"
                @click="activeFilter = 'blockchain'"
                :class="activeFilter === 'blockchain' ? 'bg-primary-100 text-primary-700 border-primary-300' : 'bg-gray-100 text-gray-600 border-gray-200'"
                class="px-4 py-1.5 text-sm font-medium rounded-full border transition-all cursor-pointer hover:bg-primary-50"
            >
                Blockchain
            </button>
            <button
                type="button"
                @click="activeFilter = 'exchange'"
                :class="activeFilter === 'exchange' ? 'bg-primary-100 text-primary-700 border-primary-300' : 'bg-gray-100 text-gray-600 border-gray-200'"
                class="px-4 py-1.5 text-sm font-medium rounded-full border transition-all cursor-pointer hover:bg-primary-50"
            >
                Exchange
            </button>
            <button
                type="button"
                @click="activeFilter = 'wallet'"
                :class="activeFilter === 'wallet' ? 'bg-primary-100 text-primary-700 border-primary-300' : 'bg-gray-100 text-gray-600 border-gray-200'"
                class="px-4 py-1.5 text-sm font-medium rounded-full border transition-all cursor-pointer hover:bg-primary-50"
            >
                Wallet
            </button>
        </div>

        <!-- Grid de Exchanges -->
        <div class="flex flex-wrap justify-center gap-3">
            <!-- Binance -->
            <button
                type="button"
                @click="selectedExchange = 'binance'"
                x-show="activeFilter === 'todos' || activeFilter === 'blockchain' || activeFilter === 'exchange'"
                :class="selectedExchange === 'binance' ? 'selected' : ''"
                class="exchange-btn"
            >
                <img src="{{ asset('assets/images/exchanges/binance.png') }}" alt="Binance">
            </button>

            <!-- Coinbase -->
            <button
                type="button"
                @click="selectedExchange = 'coinbase'"
                x-show="activeFilter === 'todos' || activeFilter === 'blockchain' || activeFilter === 'exchange'"
                :class="selectedExchange === 'coinbase' ? 'selected' : ''"
                class="exchange-btn"
            >
                <img src="{{ asset('assets/images/exchanges/coinbase.png') }}" alt="Coinbase">
            </button>

            <!-- MetaMask -->
            <button
                type="button"
                @click="selectedExchange = 'metamask'"
                x-show="activeFilter === 'todos' || activeFilter === 'wallet'"
                :class="selectedExchange === 'metamask' ? 'selected' : ''"
                class="exchange-btn"
            >
                <img src="{{ asset('assets/images/exchanges/metamask.png') }}" alt="MetaMask">
            </button>
        </div>

        <!-- Botão Continuar -->
        <div class="flex justify-end w-full max-w-md">
            <a
                x-show="selectedExchange"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                :href="`{{ url('onboarding/connect') }}/` + selectedExchange"
                class="inline-flex items-center justify-center font-medium rounded-full px-6 py-2 text-sm bg-gradient-to-r from-primary-600 to-primary-500 text-white hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm"
            >
                Continuar
            </a>
            <span
                x-show="!selectedExchange"
                class="inline-flex items-center justify-center font-medium rounded-full px-6 py-2 text-sm bg-gray-300 text-gray-500 cursor-not-allowed"
            >
                Continuar
            </span>
        </div>
    </div>
</x-layouts.onboarding>
