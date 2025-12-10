<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Fiscal Wallet' }} - Gestão Fiscal de Criptomoedas</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-background">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <!-- Logo -->
        <div class="mb-8">
            <a href="/" class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-600 to-success-500 flex items-center justify-center">
                    <span class="text-white font-bold text-xl">FW</span>
                </div>
                <span class="text-2xl font-semibold text-gray-900">Fiscal <span class="text-gray-400 font-normal">Wallet</span></span>
            </a>
        </div>

        <!-- Content -->
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
