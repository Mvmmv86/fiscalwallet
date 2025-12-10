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
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
        <!-- Mobile Sidebar Overlay -->
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-black/50 lg:hidden"
            @click="sidebarOpen = false"
            x-cloak
        ></div>

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-60 bg-sidebar-bg border-r border-border transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
        >
            <!-- Logo -->
            <div class="h-header flex items-center px-6 border-b border-border">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-600 to-success-500 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">FW</span>
                    </div>
                    <span class="text-lg font-semibold text-gray-900">Fiscal <span class="text-gray-400 font-normal">Wallet</span></span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <x-layouts.sidebar-item
                    href="{{ route('dashboard') }}"
                    icon="grid"
                    :active="request()->routeIs('dashboard')"
                >
                    Dashboard
                </x-layouts.sidebar-item>

                <x-layouts.sidebar-item
                    href="{{ route('portfolio') }}"
                    icon="wallet"
                    :active="request()->routeIs('portfolio')"
                >
                    Portfólio
                </x-layouts.sidebar-item>

                <x-layouts.sidebar-item
                    href="{{ route('carteiras') }}"
                    icon="credit-card"
                    :active="request()->routeIs('carteiras*')"
                >
                    Carteiras
                </x-layouts.sidebar-item>

                <x-layouts.sidebar-item
                    href="{{ route('operacoes') }}"
                    icon="list"
                    :active="request()->routeIs('operacoes*')"
                >
                    Operações
                </x-layouts.sidebar-item>

                <x-layouts.sidebar-item
                    href="{{ route('declaracoes') }}"
                    icon="file-text"
                    :active="request()->routeIs('declaracoes*')"
                >
                    Declarações
                </x-layouts.sidebar-item>

                <div class="pt-4 mt-4 border-t border-border">
                    <x-layouts.sidebar-item
                        href="#"
                        icon="book"
                        :active="false"
                    >
                        Blog
                    </x-layouts.sidebar-item>

                    <x-layouts.sidebar-item
                        href="#"
                        icon="help-circle"
                        :active="false"
                    >
                        Central de ajuda
                    </x-layouts.sidebar-item>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Header -->
            <header class="h-header bg-white border-b border-border flex items-center justify-between px-4 lg:px-8">
                <!-- Mobile Menu Button -->
                <button
                    @click="sidebarOpen = true"
                    class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100"
                >
                    <x-icons.menu class="w-6 h-6" />
                </button>

                <!-- Page Title -->
                <h1 class="text-xl font-semibold text-gray-900 hidden lg:block">
                    {{ $title ?? 'Dashboard' }}
                </h1>

                <!-- Mobile Logo (centered) -->
                <div class="lg:hidden flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-600 to-success-500 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">FW</span>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 relative">
                        <x-icons.bell class="w-5 h-5" />
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-danger-500 rounded-full"></span>
                    </button>

                    <!-- User Menu -->
                    <x-ui.dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                                <x-ui.avatar
                                    src="https://ui-avatars.com/api/?name=Alonso+Rodrigues&background=9333EA&color=fff"
                                    alt="Alonso Rodrigues"
                                    size="md"
                                />
                                <span class="hidden lg:block text-sm font-medium text-gray-700">Alonso Rodrigues</span>
                                <x-icons.chevron-down class="hidden lg:block w-4 h-4 text-gray-400" />
                            </button>
                        </x-slot>

                        <x-ui.dropdown-item href="#">
                            <x-icons.wallet class="w-4 h-4" />
                            Minha conta
                        </x-ui.dropdown-item>
                        <x-ui.dropdown-item href="#">
                            <x-icons.help-circle class="w-4 h-4" />
                            Ajuda
                        </x-ui.dropdown-item>
                        <div class="border-t border-gray-100 my-1"></div>
                        <x-ui.dropdown-item href="#" danger>
                            <x-icons.arrow-left class="w-4 h-4" />
                            Sair
                        </x-ui.dropdown-item>
                    </x-ui.dropdown>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-8 overflow-auto">
                <div class="max-w-content mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
