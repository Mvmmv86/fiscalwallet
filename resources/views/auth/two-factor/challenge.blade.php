<x-layouts.auth title="Verificacao 2FA" banner="banner2login.png">
    <!-- Logo -->
    <div class="text-center mb-8">
        <x-ui.logo class="h-10 mx-auto logo-transition" />
    </div>

    <!-- Titulo -->
    <div class="text-center mb-6">
        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <x-icons.shield class="w-8 h-8 text-primary-600" />
        </div>
        <h1 class="text-2xl font-semibold text-gray-900">Verificacao de Seguranca</h1>
        <p class="text-sm text-gray-500 mt-1">
            Digite o codigo de 6 digitos do seu aplicativo autenticador.
        </p>
    </div>

    <form method="POST" action="{{ route('two-factor.verify') }}" class="space-y-4">
        @csrf

        <!-- Codigo -->
        <div>
            <input
                type="text"
                name="code"
                maxlength="6"
                pattern="[0-9]{6}"
                inputmode="numeric"
                autocomplete="one-time-code"
                class="w-full px-4 py-4 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition-all text-center text-3xl tracking-widest font-mono"
                placeholder="000000"
                required
                autofocus
            >
            @error('code')
                <p class="text-sm text-danger-600 mt-2 text-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botao Verificar -->
        <button
            type="submit"
            class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium rounded-xl hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm"
        >
            Verificar
        </button>
    </form>

    <!-- Link para voltar -->
    <div class="mt-6 text-center">
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                Usar outra conta
            </button>
        </form>
    </div>
</x-layouts.auth>
