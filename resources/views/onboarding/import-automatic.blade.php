@php
    $exchange = request()->route('exchange') ?? 'binance';
    $exchangeNames = [
        'binance' => 'Binance',
        'coinbase' => 'Coinbase',
        'metamask' => 'MetaMask',
        'mercado-bitcoin' => 'Mercado Bitcoin',
    ];
    $exchangeName = $exchangeNames[$exchange] ?? 'Exchange';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Importação Automática - Fiscal Wallet</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:200,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="w-full px-8 py-4 flex items-center justify-between bg-white border-b border-gray-100">
            <x-ui.logo size="md" :showText="true" />
            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-primary-600 bg-white border border-primary-300 rounded-full hover:bg-primary-50 transition-all">
                Pular
            </a>
        </header>

        <!-- Content -->
        <div class="flex-1 flex">
            <!-- Coluna Esquerda - Formulário (50%) -->
            <div class="bg-[#F5F2F8] flex items-center justify-center p-8" style="width: 50%;">
                <div style="width: 280px;" class="flex flex-col gap-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">Importação</h1>
                        <h2 class="text-2xl font-semibold text-gray-900">Automática</h2>
                    </div>

                    <!-- Campo API Key -->
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">API KEY</label>
                        <input
                            type="text"
                            name="api_key"
                            value="vGhj7K9mNpQrStUv2WxYz3AbCdEfGh"
                            placeholder="Digite a chave API"
                            class="w-full px-4 py-3 text-sm border border-gray-200 rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        />
                    </div>

                    <!-- Campo API Secret -->
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">API SECRET</label>
                        <input
                            type="password"
                            name="api_secret"
                            value="xK8pL2mN5qR9sT3vW7yZ1bC4dE6fG"
                            placeholder="Digite o segredo API"
                            class="w-full px-4 py-3 text-sm border border-gray-200 rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        />
                    </div>

                    <!-- Campo Data -->
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Data</label>
                        <input
                            type="date"
                            name="date"
                            value="2024-01-01"
                            class="w-full px-4 py-3 text-sm border border-gray-200 rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        />
                    </div>

                    <!-- Botão Importar -->
                    <a href="{{ route('onboarding.processing', ['exchange' => $exchange]) }}" class="w-full px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-full hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm text-center mt-2">
                        Importar
                    </a>
                </div>
            </div>

            <!-- Coluna Direita - Instruções (50%) -->
            <div class="bg-white flex items-center justify-center p-12 overflow-y-auto" style="width: 50%;">
                <div style="width: 500px;" class="flex flex-col gap-4">
                    <h3 class="text-xl font-semibold text-gray-900 text-center">Instruções</h3>

                    <ol class="list-decimal list-inside text-sm text-gray-600 space-y-2">
                        <li>Faça login na {{ $exchangeName }}.</li>
                        <li>Vá para a página de gerenciamento da API {{ $exchangeName }}.</li>
                        <li>Selecione Criar API</li>
                        <li>Conclua o 2FA.</li>
                        <li>Por padrão, apenas a permissão de leitura será concedida. Certifique-se de que nenhuma outra permissão foi concedida às chaves de API.</li>
                        <li>Copie a chave da API e o segredo da API para Koinly.</li>
                    </ol>

                    <div class="mt-2">
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">Observação:</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $exchangeName }} também possui uma API especial de relatório de impostos, que também funcionará com Koinly. No entanto, a API Tax Report não permitirá acesso total ao histórico de transações de futuros, por isso recomendamos a criação de chaves API regulares.
                        </p>
                    </div>

                    <div class="mt-2">
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">Subcontas</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Se você usa subcontas com {{ $exchangeName }}, também precisará importar esses dados.</li>
                            <li>• Se estiver usando API, crie chaves de API separadas para cada subconta.</li>
                            <li>• Adicione-as a carteiras {{ $exchangeName }} separadas no Koinly.</li>
                            <li>• Verifique suas transferências entre a conta principal e suas subcontas, pois pode ser necessário adicioná-las manualmente.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
