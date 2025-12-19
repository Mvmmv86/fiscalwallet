<x-layouts.auth title="Login" banner="banner2login.png">
    <!-- Logo -->
    <div class="text-center mb-8">
        <x-ui.logo class="h-10 mx-auto logo-transition" />
    </div>

    <!-- Titulo -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Bem-vindo de volta</h1>
        <p class="text-sm text-gray-500 mt-1">Entre na sua conta para continuar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition-all text-sm"
                placeholder="seu@email.com"
                required
                autofocus
                autocomplete="username"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Senha -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-primary-600 hover:text-primary-700 font-medium">
                        Esqueceu a senha?
                    </a>
                @endif
            </div>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition-all text-sm"
                placeholder="Digite sua senha"
                required
                autocomplete="current-password"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Lembrar-me -->
        <div class="flex items-center">
            <input
                type="checkbox"
                id="remember_me"
                name="remember"
                class="w-4 h-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500"
            >
            <label for="remember_me" class="ml-2 text-sm text-gray-600">
                Manter conectado
            </label>
        </div>

        <!-- Botao Login -->
        <button
            type="submit"
            class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium rounded-xl hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm"
        >
            Entrar
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-3 bg-[#F5F2F8] text-gray-500">ou</span>
        </div>
    </div>

    <!-- Link para registro -->
    <p class="text-center text-sm text-gray-600">
        Nao tem uma conta?
        <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-700 font-medium">
            Criar conta
        </a>
    </p>
</x-layouts.auth>
