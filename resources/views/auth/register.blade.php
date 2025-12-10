<x-layouts.auth title="Criar conta" banner="bannercriarconta.png">
    <div class="flex flex-col gap-4">
        <!-- Logo -->
        <div class="flex justify-center items-center logo-transition">
            <x-ui.logo size="lg" :showText="true" />
        </div>

        <!-- Title -->
        <h1 class="text-xl font-semibold text-gray-900">Criar conta</h1>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
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
                autocomplete="email"
                rounded="full"
                :error="$errors->first('email')"
            />

            <!-- Senha -->
            <div>
                <x-ui.input
                    type="password"
                    name="password"
                    label="Crie sua senha"
                    placeholder="Digite sua senha"
                    required
                    autocomplete="new-password"
                    rounded="full"
                    :error="$errors->first('password')"
                />
                <!-- Password Requirements -->
                <ul class="mt-2 text-xs text-gray-500 space-y-1">
                    <li class="flex items-start gap-1">
                        <span class="text-gray-400">•</span>
                        <span>Deve conter no mínimo 8 caractéres</span>
                    </li>
                    <li class="flex items-start gap-1">
                        <span class="text-gray-400">•</span>
                        <span>Deve incluir uma combinação de letras</span>
                    </li>
                    <li class="flex items-start gap-1">
                        <span class="text-gray-400">•</span>
                        <span>Maiúsculas e minúsculas</span>
                    </li>
                    <li class="flex items-start gap-1">
                        <span class="text-gray-400">•</span>
                        <span>Deve conter pelo menos um caractere especial, como: !,@,#, etc.</span>
                    </li>
                </ul>
            </div>

            <!-- Confirmar Senha -->
            <x-ui.input
                type="password"
                name="password_confirmation"
                label="Confirme sua senha"
                placeholder="Digite sua senha"
                required
                autocomplete="new-password"
                rounded="full"
                :error="$errors->first('password_confirmation')"
            />

            <!-- Criar conta Button (Primary) -->
            <x-ui.button type="submit" variant="primary" size="xl" class="w-full rounded-full">
                Criar conta
            </x-ui.button>
        </form>

        <!-- Login Link -->
        <div class="text-center text-sm">
            <span class="text-gray-600">Já tem conta?</span>
            <a href="{{ route('login') }}" class="text-primary-500 hover:text-primary-600 transition-colors font-medium">
                Faça o Login
            </a>
        </div>
    </div>
</x-layouts.auth>
