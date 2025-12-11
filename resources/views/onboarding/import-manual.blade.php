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

    <title>Importação Manual - Fiscal Wallet</title>

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
                        <h1 class="text-2xl font-semibold text-gray-900">Importação Manual</h1>
                        <p class="text-sm text-gray-500 mt-2">
                            Baixe seus arquivos de transação para todos os anos de negociação e carregue-os aqui.
                        </p>
                    </div>

                    <p class="text-sm text-gray-600">
                        Cada depósito, retirada e negociação devem ser adicionados.
                    </p>

                    <!-- Upload de Arquivo -->
                    <div x-data="{ fileName: 'transacoes_2024.csv' }">
                        <label class="block text-xs text-gray-500 mb-1">Upload dos arquivos</label>
                        <div class="relative">
                            <input
                                type="text"
                                :value="fileName"
                                readonly
                                placeholder="Arraste ou solte seus arquivos aqui"
                                class="w-full px-4 py-3 text-sm border border-gray-200 rounded-full bg-white focus:outline-none cursor-pointer"
                            />
                            <input type="file" class="absolute inset-0 opacity-0 cursor-pointer" accept=".csv,.xlsx,.xls" multiple @change="fileName = $event.target.files[0]?.name || 'transacoes_2024.csv'">
                        </div>
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
                        <li>Selecione carteira no menu de navegação superior.</li>
                        <li>No menu suspenso, selecione histórico de transações.</li>
                        <li>Agora selecione Exportar registros de transações.</li>
                        <li>Em tempo, selecione personalizado. Insira seu intervalo de datas (máximo 12 meses).</li>
                        <li>Selecione gerar. Sua declaração pode demorar um pouco para ser gerada.</li>
                        <li>Repita até exportar todo o seu histórico de transações de todos os anos anteriores.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
