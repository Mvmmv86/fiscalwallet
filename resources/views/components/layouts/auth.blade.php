@props(['title' => 'Login', 'banner' => 'banner2login.png'])

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

        /* Transição do logo */
        .logo-transition {
            animation: logoFade 0.8s ease-out;
        }

        @keyframes logoFade {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#F5F2F8]">
    <div class="min-h-screen flex items-center justify-center">
        <!-- Container com tamanho máximo do Figma -->
        <div class="w-full max-w-[1440px] max-h-screen flex flex-row shadow-lg">
            <!-- Left Panel - Banner Background (68%) -->
            <div class="min-h-screen" style="width: 68%; background-image: url('{{ asset('assets/images/' . $banner) }}'); background-size: cover; background-position: center;">
            </div>

            <!-- Right Panel - Form (32%) -->
            <div class="min-h-screen bg-[#F5F2F8] flex items-center justify-center" style="width: 32%;">
                <div class="page-transition" style="width: 350px;">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
