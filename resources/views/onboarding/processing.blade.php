<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Processando - Fiscal Wallet</title>

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
        </header>

        <!-- Content -->
        <div class="flex-1 bg-[#F5F2F8] flex items-center justify-center p-8">
            <div class="flex flex-col items-center text-center gap-6" style="width: 320px;">
                <!-- Título -->
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">As operações estão sendo</h1>
                    <h2 class="text-2xl font-semibold text-gray-900">processadas</h2>
                </div>

                <!-- Descrição -->
                <p class="text-sm text-gray-500">
                    Aguarde enquanto estamos processando suas operações, assim que estiver pronto lhe enviaremos um e-mail avisando.
                </p>

                <!-- Botão Ir para Home -->
                <a href="{{ route('dashboard') }}" class="w-full px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-full hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm text-center">
                    Ir para Home
                </a>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
