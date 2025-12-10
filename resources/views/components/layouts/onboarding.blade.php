@props(['title' => 'Onboarding', 'step' => 1])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - Fiscal Wallet</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:200,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }

        /* Efeito de transição da página */
        .page-transition {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#F5F2F8]">
    <div class="min-h-screen flex flex-col">
        <!-- Header com fundo mais claro -->
        <header class="w-full px-8 py-4 flex items-center justify-between bg-white/60 border-b border-gray-100">
            <!-- Logo -->
            <x-ui.logo size="md" :showText="true" />

            <!-- Botão Pular com borda -->
            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:border-primary-500 hover:text-primary-600 transition-all">
                Pular
            </a>
        </header>

        <!-- Content -->
        <main class="flex-1 flex items-center justify-center">
            <div class="w-full max-w-[900px] px-4 page-transition">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
