<div>
    {{-- Step 1: Formulário de credenciais --}}
    @if($step === 1)
        <div class="space-y-4">
            {{-- Mensagem de Sucesso (credenciais válidas) --}}
            @if($successMessage && $credentialsValid)
                <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-green-800">{{ $successMessage }}</p>
                    </div>
                </div>
            @endif

            {{-- Erros --}}
            @if(count($validationErrors) > 0)
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-red-800">Erro na validação</p>
                            <ul class="text-xs text-red-600 mt-1 list-disc list-inside">
                                @foreach($validationErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Nome da Carteira --}}
            <div>
                <label class="block text-xs font-normal text-gray-500 mb-2">Nome da carteira</label>
                <input
                    type="text"
                    wire:model="walletName"
                    placeholder="Ex: Minha Binance Principal"
                    class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                />
                @error('walletName') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- API Key --}}
            <div>
                <label class="block text-xs font-normal text-gray-500 mb-2">API KEY</label>
                <input
                    type="text"
                    wire:model="apiKey"
                    placeholder="Digite a chave API"
                    class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 font-mono"
                />
                @error('apiKey') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- API Secret --}}
            <div>
                <label class="block text-xs font-normal text-gray-500 mb-2">API SECRET</label>
                <input
                    type="password"
                    wire:model="apiSecret"
                    placeholder="Digite a chave secreta"
                    class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 font-mono"
                />
                @error('apiSecret') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Data Inicial --}}
            <div>
                <label class="block text-xs font-normal text-gray-500 mb-2">Data inicial (opcional)</label>
                <input
                    type="date"
                    wire:model="startDate"
                    class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                />
                <p class="text-xs text-gray-400 mt-1">Deixe em branco para importar todo o histórico disponível</p>
            </div>

            {{-- Instruções --}}
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-amber-800">Importante sobre a API da Binance</p>
                        <ul class="text-xs text-amber-700 mt-2 space-y-1 list-disc list-inside">
                            <li>Trades: disponíveis apenas desde Set/2022</li>
                            <li>Depósitos/Saques: histórico completo desde 2017</li>
                            <li>Para dados mais antigos, use importação via CSV</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Botões --}}
            <div class="flex justify-between pt-2">
                <button
                    type="button"
                    wire:click="validateCredentials"
                    wire:loading.attr="disabled"
                    wire:target="validateCredentials"
                    class="px-5 py-2.5 text-sm font-medium text-primary-600 bg-primary-50 rounded-full hover:bg-primary-100 transition-colors disabled:opacity-50 inline-flex items-center gap-2"
                >
                    <span wire:loading.remove wire:target="validateCredentials">Validar Credenciais</span>
                    <span wire:loading wire:target="validateCredentials" class="inline-flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Validando...
                    </span>
                </button>

                <button
                    type="button"
                    wire:click="import"
                    wire:loading.attr="disabled"
                    wire:target="import"
                    @if(!$credentialsValid) disabled @endif
                    class="px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-full hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center gap-2"
                >
                    <span wire:loading.remove wire:target="import">Importar</span>
                    <span wire:loading wire:target="import" class="inline-flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Importando...
                    </span>
                </button>
            </div>
        </div>
    @endif

    {{-- Step 2: Importando --}}
    @if($step === 2)
        <div class="py-10 text-center">
            <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="animate-spin h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Importando operações...</h3>
            <p class="text-sm text-gray-500">
                Estamos buscando suas operações na {{ ucfirst($exchange) }}.<br>
                Isso pode levar alguns minutos.
            </p>
        </div>
    @endif

    {{-- Step 3: Sucesso --}}
    @if($step === 3)
        <div class="py-10 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Importação concluída!</h3>
            <p class="text-sm text-gray-500 mb-6">
                {{ $importedCount }} operações foram importadas com sucesso.
            </p>
            <button
                type="button"
                wire:click="$dispatch('closeModal')"
                class="px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-full hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm"
            >
                Fechar
            </button>
        </div>
    @endif
</div>
