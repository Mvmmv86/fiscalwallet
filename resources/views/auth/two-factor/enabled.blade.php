<x-layouts.dashboard title="2FA Ativado">
    <div class="max-w-xl mx-auto">
        <x-ui.card>
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <x-icons.check class="w-8 h-8 text-success-600" />
                </div>
                <h1 class="text-xl font-semibold text-gray-900">2FA ja esta ativado</h1>
                <p class="text-sm text-gray-500 mt-2">
                    Sua conta esta protegida com autenticacao de dois fatores.
                </p>
            </div>

            <div class="bg-success-50 border border-success-200 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                    <x-icons.shield class="w-5 h-5 text-success-600 mt-0.5" />
                    <div>
                        <p class="text-sm font-medium text-success-800">Protecao ativa</p>
                        <p class="text-xs text-success-600 mt-0.5">
                            Toda vez que voce fizer login, sera necessario informar o codigo do seu aplicativo autenticador.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a
                    href="{{ route('perfil.seguranca') }}"
                    class="flex-1 px-4 py-3 text-sm font-medium text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors text-center"
                >
                    Voltar
                </a>
            </div>
        </x-ui.card>
    </div>
</x-layouts.dashboard>
