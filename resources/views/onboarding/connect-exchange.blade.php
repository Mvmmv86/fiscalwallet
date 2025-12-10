@php
    $exchangeNames = [
        'binance' => 'Binance',
        'coinbase' => 'Coinbase',
        'metamask' => 'MetaMask',
        'mercado-bitcoin' => 'Mercado Bitcoin',
        'foxbit' => 'Foxbit',
        'kraken' => 'Kraken',
        'kucoin' => 'Kucoin',
    ];
    $exchangeName = $exchangeNames[$exchange ?? 'binance'] ?? 'Exchange';
@endphp

<x-layouts.onboarding title="Conectar com {{ $exchangeName }}" :step="3">
    <div class="flex flex-col items-center gap-6" x-data="{ importType: 'automatic' }">
        <!-- Título -->
        <div class="text-center">
            <h1 class="text-2xl font-semibold text-gray-900">Conectar com a {{ $exchangeName }}</h1>
        </div>

        <!-- Campo Nome da Carteira -->
        <div class="w-full max-w-md">
            <x-ui.input
                type="text"
                name="wallet_name"
                label="Digite o nome da carteira"
                placeholder="Pesquisar"
                iconRight="search"
                rounded="full"
            />
        </div>

        <!-- Seção Importar Operações -->
        <div class="flex flex-col gap-3 w-full max-w-md">
            <label class="text-sm font-medium text-gray-700">Importar operações</label>

            <!-- Opção Importação Automática -->
            <label
                @click="importType = 'automatic'"
                :class="importType === 'automatic' ? 'border-primary-500 bg-primary-50' : 'border-gray-200 bg-white'"
                class="flex items-center gap-3 p-4 rounded-xl border hover:border-primary-500 cursor-pointer transition-all"
            >
                <input type="radio" name="import_type" value="automatic" x-model="importType" class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                <span class="text-sm text-gray-700">Importação automática</span>
            </label>

            <!-- Opção Importação Manual -->
            <label
                @click="importType = 'manual'"
                :class="importType === 'manual' ? 'border-primary-500 bg-primary-50' : 'border-gray-200 bg-white'"
                class="flex items-center gap-3 p-4 rounded-xl border hover:border-primary-500 cursor-pointer transition-all"
            >
                <input type="radio" name="import_type" value="manual" x-model="importType" class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                <span class="text-sm text-gray-700">Importação manual</span>
            </label>
        </div>

        <!-- Botão Continuar -->
        <div class="flex justify-end w-full max-w-md">
            <a
                :href="importType === 'automatic' ? '{{ route('onboarding.import-automatic', ['exchange' => $exchange]) }}' : '{{ route('onboarding.import-manual', ['exchange' => $exchange]) }}'"
                class="inline-flex items-center justify-center font-medium rounded-full px-6 py-2 text-sm bg-primary-600 text-white hover:bg-primary-700 transition-colors"
            >
                Continuar
            </a>
        </div>
    </div>
</x-layouts.onboarding>
