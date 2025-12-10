<x-layouts.auth title="Login">
    <div class="flex flex-col gap-4">
        <!-- Logo -->
        <div class="flex justify-center items-center logo-transition">
            <x-ui.logo size="lg" :showText="true" />
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
            @csrf

            <!-- Email -->
            <x-ui.input
                type="email"
                name="email"
                label="E-mail"
                placeholder="Digite seu e-mail"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                rounded="full"
                :error="$errors->first('email')"
            />

            <!-- Senha -->
            <x-ui.input
                type="password"
                name="password"
                label="Senha"
                placeholder="Digite sua senha"
                required
                autocomplete="current-password"
                rounded="full"
                :error="$errors->first('password')"
            />

            <!-- Forgot Password Link -->
            <div class="text-left">
                <a href="{{ route('password.request') }}" class="text-xs text-primary-500 hover:text-primary-600 transition-colors">
                    Esqueceu a senha?
                </a>
            </div>

            <!-- Login Button (Secondary/Outline) -->
            <x-ui.button type="submit" variant="secondary" size="xl" class="w-full rounded-full">
                Login
            </x-ui.button>

            <!-- Cadastre-se Button (Primary) -->
            <x-ui.button href="{{ route('register') }}" variant="primary" size="xl" class="w-full rounded-full">
                Cadastre-se
            </x-ui.button>
        </form>
    </div>
</x-layouts.auth>
