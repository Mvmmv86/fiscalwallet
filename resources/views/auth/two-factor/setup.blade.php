<x-layouts.dashboard title="Configurar 2FA">
    <div class="max-w-xl mx-auto">
        <x-ui.card>
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <x-icons.shield class="w-8 h-8 text-primary-600" />
                </div>
                <h1 class="text-xl font-semibold text-gray-900">Configurar Autenticacao de Dois Fatores</h1>
                <p class="text-sm text-gray-500 mt-2">
                    Adicione uma camada extra de seguranca a sua conta usando o Google Authenticator.
                </p>
            </div>

            <!-- Passo 1: Baixar App -->
            <div class="mb-6">
                <h2 class="text-sm font-medium text-gray-900 mb-2">1. Baixe o aplicativo</h2>
                <p class="text-sm text-gray-500">
                    Baixe o Google Authenticator ou outro app de autenticacao no seu celular.
                </p>
            </div>

            <!-- Passo 2: Escanear QR Code -->
            <div class="mb-6">
                <h2 class="text-sm font-medium text-gray-900 mb-2">2. Escaneie o QR Code</h2>
                <div class="flex justify-center p-4 bg-white border border-gray-200 rounded-xl">
                    {!! $qrCodeSvg !!}
                </div>
                <div class="mt-3">
                    <p class="text-xs text-gray-500 text-center mb-2">Ou insira a chave manualmente:</p>
                    <div class="flex items-center justify-center gap-2">
                        <code class="px-3 py-2 bg-gray-100 rounded-lg text-sm font-mono text-gray-700">
                            {{ $secretKey }}
                        </code>
                        <button
                            onclick="navigator.clipboard.writeText('{{ $secretKey }}')"
                            class="p-2 text-gray-400 hover:text-gray-600"
                            title="Copiar"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Passo 3: Confirmar codigo -->
            <div class="mb-6">
                <h2 class="text-sm font-medium text-gray-900 mb-2">3. Confirme o codigo</h2>
                <p class="text-sm text-gray-500 mb-3">
                    Digite o codigo de 6 digitos gerado pelo aplicativo.
                </p>

                <form method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf

                    <div class="mb-4">
                        <input
                            type="text"
                            name="code"
                            maxlength="6"
                            pattern="[0-9]{6}"
                            inputmode="numeric"
                            autocomplete="one-time-code"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition-all text-center text-2xl tracking-widest font-mono"
                            placeholder="000000"
                            required
                        >
                        @error('code')
                            <p class="text-sm text-danger-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <a
                            href="{{ route('perfil.seguranca') }}"
                            class="flex-1 px-4 py-3 text-sm font-medium text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors text-center"
                        >
                            Cancelar
                        </a>
                        <button
                            type="submit"
                            class="flex-1 px-4 py-3 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-xl hover:from-primary-700 hover:to-primary-600 transition-all"
                        >
                            Ativar 2FA
                        </button>
                    </div>
                </form>
            </div>
        </x-ui.card>
    </div>
</x-layouts.dashboard>
