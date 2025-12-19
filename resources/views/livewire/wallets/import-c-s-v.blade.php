<div>
    <div class="space-y-4">
        {{-- Mensagem de Sucesso --}}
        @if($successMessage)
            <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-green-800">{{ $successMessage }}</p>
                        <p class="text-xs text-green-600 mt-0.5">{{ $importedCount }} operações importadas com sucesso!</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Erros de Validação --}}
        @if(count($validationErrors) > 0)
            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-red-800">Erro na validação do arquivo</p>
                        <ul class="text-xs text-red-600 mt-1 list-disc list-inside">
                            @foreach($validationErrors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Área de Upload --}}
        <div>
            <label class="block text-xs font-normal text-gray-500 mb-2">Upload do arquivo CSV</label>
            <div
                x-data="{
                    isDragging: false,
                    handleDrop(e) {
                        this.isDragging = false;
                        const files = e.dataTransfer.files;
                        if (files.length > 0) {
                            $wire.upload('file', files[0]);
                        }
                    }
                }"
                x-on:dragover.prevent="isDragging = true"
                x-on:dragleave.prevent="isDragging = false"
                x-on:drop.prevent="handleDrop($event)"
                :class="isDragging ? 'border-primary-500 bg-primary-50' : 'border-gray-300 bg-gray-50/50'"
                class="relative border-2 border-dashed rounded-xl p-6 text-center hover:border-primary-400 transition-colors cursor-pointer"
            >
                <input
                    type="file"
                    wire:model="file"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                    accept=".csv,.xlsx,.xls"
                />

                @if($file)
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ $file->getClientOriginalName() }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ number_format($file->getSize() / 1024, 1) }} KB</p>
                        </div>
                        <button
                            type="button"
                            wire:click="resetForm"
                            class="text-xs text-primary-600 hover:text-primary-700"
                        >
                            Trocar arquivo
                        </button>
                    </div>
                @else
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Clique para selecionar</p>
                            <p class="text-xs text-gray-400 mt-1">ou arraste e solte seu arquivo aqui</p>
                        </div>
                    </div>
                @endif

                {{-- Loading --}}
                <div wire:loading wire:target="file" class="absolute inset-0 bg-white/80 rounded-xl flex items-center justify-center">
                    <div class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-sm text-gray-600">Processando...</span>
                    </div>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3 text-center">Formatos aceitos: CSV, XLS, XLSX (máx. 10MB)</p>
        </div>

        {{-- Preview do Arquivo --}}
        @if($showPreview && count($preview) > 0)
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                    <p class="text-xs font-medium text-gray-600">Preview do arquivo (primeiras 5 linhas)</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach($preview['header'] ?? [] as $column)
                                    <th class="px-3 py-2 text-left font-medium text-gray-600 whitespace-nowrap">{{ $column }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($preview['rows'] ?? [] as $row)
                                <tr class="hover:bg-gray-50">
                                    @foreach($preview['header'] ?? [] as $column)
                                        <td class="px-3 py-2 text-gray-700 whitespace-nowrap">{{ $row[$column] ?? '-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- Instruções --}}
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-blue-800">Como exportar seu CSV da Binance</p>
                    <ol class="text-xs text-blue-700 mt-2 space-y-1 list-decimal list-inside">
                        <li>Acesse sua conta Binance</li>
                        <li>Vá em Carteira > Histórico de Transações</li>
                        <li>Clique em "Exportar" no canto superior direito</li>
                        <li>Selecione o período desejado e baixe o CSV</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Botão de Importar --}}
    <div class="mt-6 flex justify-end">
        <button
            type="button"
            wire:click="import"
            wire:loading.attr="disabled"
            @if(!$file) disabled @endif
            class="px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-full hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center gap-2"
        >
            <span wire:loading.remove wire:target="import">Importar Operações</span>
            <span wire:loading wire:target="import" class="inline-flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processando...
            </span>
        </button>
    </div>
</div>
