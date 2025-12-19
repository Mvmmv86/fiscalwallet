<x-layouts.auth title="Criar Conta" banner="banner2login.png">
    <!-- Logo -->
    <div class="text-center mb-8">
        <x-ui.logo class="h-10 mx-auto logo-transition" />
    </div>

    <!-- Titulo -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Criar sua conta</h1>
        <p class="text-sm text-gray-500 mt-1">Comece a organizar suas criptos hoje</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nome -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition-all text-sm"
                placeholder="Seu nome"
                required
                autofocus
                autocomplete="name"
            >
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

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
                autocomplete="username"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Senha -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition-all text-sm"
                placeholder="Minimo 8 caracteres"
                required
                autocomplete="new-password"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirmar Senha -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar senha</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition-all text-sm"
                placeholder="Repita sua senha"
                required
                autocomplete="new-password"
            >
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Termos -->
        <div class="flex items-start">
            <input
                type="checkbox"
                id="terms"
                name="terms"
                class="w-4 h-4 mt-0.5 rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                required
            >
            <label for="terms" class="ml-2 text-sm text-gray-600">
                Concordo com os <a href="#" class="text-primary-600 hover:text-primary-700">Termos de Uso</a> e a <a href="#" class="text-primary-600 hover:text-primary-700">Politica de Privacidade</a>
            </label>
        </div>

        <!-- Botao Criar Conta -->
        <button
            type="submit"
            class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium rounded-xl hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm"
        >
            Criar conta
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

    <!-- Link para login -->
    <p class="text-center text-sm text-gray-600">
        Ja tem uma conta?
        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-medium">
            Entrar
        </a>
    </p>
</x-layouts.auth>
