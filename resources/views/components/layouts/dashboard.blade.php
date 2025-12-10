@props(['title' => 'Dashboard'])

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

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
        .sidebar-transition {
            transition: width 0.3s ease, transform 0.3s ease;
        }
        .main-transition {
            transition: margin-left 0.3s ease;
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#F8F8FA]" x-data="{ sidebarOpen: true }">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside
            class="bg-white border-r border-gray-100 flex flex-col fixed h-full z-20 left-0 top-0 sidebar-transition"
            :class="sidebarOpen ? 'w-[180px]' : 'w-[60px]'"
        >
            <!-- Logo -->
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <div :class="sidebarOpen ? '' : 'hidden'">
                    <x-ui.logo size="sm" :showText="true" />
                </div>
                <div :class="sidebarOpen ? 'hidden' : ''" class="mx-auto">
                    <x-ui.logo size="sm" :showText="false" />
                </div>
            </div>

            <!-- Toggle Button - Na borda direita do sidebar -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-6 h-6 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-sm hover:bg-gray-50 transition-colors z-30"
            >
                <svg
                    class="w-3 h-3 text-gray-600 transition-transform duration-300"
                    :class="sidebarOpen ? '' : 'rotate-180'"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Navigation -->
            <nav class="flex-1 p-3 space-y-1">
                <a
                    href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }} transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <x-icons.grid class="w-5 h-5 flex-shrink-0" />
                    <span :class="sidebarOpen ? '' : 'hidden'">Visao geral</span>
                </a>

                <a
                    href="{{ route('carteiras') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('carteiras') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }} transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <x-icons.wallet class="w-5 h-5 flex-shrink-0" />
                    <span :class="sidebarOpen ? '' : 'hidden'">Carteiras</span>
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <x-icons.list class="w-5 h-5 flex-shrink-0" />
                    <span :class="sidebarOpen ? '' : 'hidden'">Operacoes</span>
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <x-icons.chart class="w-5 h-5 flex-shrink-0" />
                    <span :class="sidebarOpen ? '' : 'hidden'">Relatorios</span>
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <x-icons.file-text class="w-5 h-5 flex-shrink-0" />
                    <span :class="sidebarOpen ? '' : 'hidden'">Declaracoes</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div
            class="min-h-screen transition-all duration-300 ease-in-out"
            x-bind:style="'margin-left: ' + (sidebarOpen ? '192px' : '72px')"
        >
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-100 px-6 py-3 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold text-gray-900">{{ $title }}</h1>
                </div>

                <div class="flex items-center gap-3">
                    <!-- Notifications -->
                    <button class="p-1.5 rounded-lg hover:bg-gray-100 transition-colors relative">
                        <x-icons.bell class="w-4 h-4 text-gray-600" />
                        <span class="absolute top-0.5 right-0.5 w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center gap-2" x-data="{ open: false }">
                        <img
                            src="https://ui-avatars.com/api/?name=Alonso+Rodrigues&background=9333EA&color=fff&size=32"
                            alt="Avatar"
                            class="w-8 h-8 rounded-full"
                        />
                        <div class="text-xs">
                            <p class="font-medium text-gray-900">Alonso Rodrigues</p>
                        </div>
                        <button @click="open = !open" class="p-0.5 rounded hover:bg-gray-100">
                            <x-icons.chevron-down class="w-3 h-3 text-gray-500" />
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="py-4 px-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
