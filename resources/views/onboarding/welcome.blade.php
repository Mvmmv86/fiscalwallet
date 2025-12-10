<x-layouts.onboarding title="Bem-vindo" :step="1">
    <div class="flex flex-col items-center text-center gap-6">
        <!-- Título -->
        <h1 class="text-2xl font-semibold text-gray-900">Seja bem-vindo!</h1>

        <!-- Descrição -->
        <p class="text-sm text-gray-600 max-w-md">
            Mesmo você integrando suas carteiras ou operações, isso não será enviado a receita federal.
        </p>

        <!-- Botão -->
        <x-ui.button href="{{ route('onboarding.select-platform') }}" variant="primary" size="lg" class="rounded-full px-8">
            Entendi!
        </x-ui.button>
    </div>
</x-layouts.onboarding>
