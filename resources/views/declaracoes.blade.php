<x-layouts.dashboard title="Declarações">
    <div x-data="{
        selectedYear: '2023',
        showActionsMenu: null,
        declarations: [
            { mes: 'DEZ', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'pendente', gcap: 'pendente', irpf: 'pendente' },
            { mes: 'NOV', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'OUT', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'SET', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'AGO', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'JUL', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'JUN', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'MAI', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'ABR', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'MAR', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'FEV', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' },
            { mes: 'JAN', totalOperado: 3000000.00, totalAlienacao: 3000000.00, taxas: 3000000.00, numOperacoes: 50, in1888: 'isento', gcap: 'isento', irpf: 'isento' }
        ],
        formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
        },
        gerarDarf(declaration) {
            window.open('/reports/darf/' + declaration.mes + '/' + this.selectedYear, '_blank');
            this.showActionsMenu = null;
        },
        baixarRelatorio(declaration) {
            window.open('/reports/mensal/' + declaration.mes + '/' + this.selectedYear, '_blank');
            this.showActionsMenu = null;
        },
        gerarArquivoIRPF(declaration) {
            window.open('/reports/irpf/' + this.selectedYear, '_blank');
            this.showActionsMenu = null;
        }
    }" @click.away="showActionsMenu = null">

        <!-- Header com descrição e botão -->
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">
            <div class="flex items-start gap-3">
                <a href="{{ route('dashboard') }}" class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition-colors mt-1">
                    <x-icons.arrow-left class="w-4 h-4 text-gray-600" />
                </a>
                <div>
                    <p class="text-sm text-gray-500 mt-1">Aqui você visualiza todas as suas obrigações fiscais por mês e gera os documentos necessários para sua declaração.</p>
                </div>
            </div>

            <div class="flex-shrink-0">
                <x-ui.button variant="secondary" size="md" class="border-primary-600 text-primary-600 hover:bg-primary-50">
                    Validar operações
                </x-ui.button>
            </div>
        </div>

        <!-- Filtro de Ano -->
        <div class="mb-6">
            <div class="relative inline-block">
                <button class="flex items-center gap-2 px-4 py-2.5 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-800 transition-colors">
                    <span x-text="selectedYear"></span>
                    <x-icons.calendar class="w-4 h-4" />
                </button>
            </div>
        </div>

        <!-- Card com Tabela -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <!-- Tabela -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Mês</th>
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Total operado</th>
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Total de alienação</th>
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Taxas</th>
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">N° de operações</th>
                            <th class="text-center px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">IN 1888</th>
                            <th class="text-center px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">GCAP</th>
                            <th class="text-center px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">IRPF</th>
                            <th class="text-center px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <template x-for="(declaration, index) in declarations" :key="index">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Mês -->
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900" x-text="declaration.mes"></span>
                                </td>

                                <!-- Total Operado -->
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700" x-text="formatCurrency(declaration.totalOperado)"></span>
                                </td>

                                <!-- Total de Alienação -->
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700" x-text="formatCurrency(declaration.totalAlienacao)"></span>
                                </td>

                                <!-- Taxas -->
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700" x-text="formatCurrency(declaration.taxas)"></span>
                                </td>

                                <!-- Nº de Operações -->
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700" x-text="declaration.numOperacoes"></span>
                                </td>

                                <!-- IN 1888 -->
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium"
                                        :class="declaration.in1888 === 'pendente' ? 'bg-primary-100 text-primary-700' : 'bg-success-100 text-success-700'"
                                        x-text="declaration.in1888 === 'pendente' ? 'Pendente' : 'Isento'"
                                    ></span>
                                </td>

                                <!-- GCAP -->
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium"
                                        :class="declaration.gcap === 'pendente' ? 'bg-warning-100 text-warning-700' : 'bg-success-100 text-success-700'"
                                        x-text="declaration.gcap === 'pendente' ? 'Pendente' : 'Isento'"
                                    ></span>
                                </td>

                                <!-- IRPF -->
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium"
                                        :class="declaration.irpf === 'pendente' ? 'bg-danger-100 text-danger-700' : 'bg-success-100 text-success-700'"
                                        x-text="declaration.irpf === 'pendente' ? 'Pendente' : 'Isento'"
                                    ></span>
                                </td>

                                <!-- Ações -->
                                <td class="px-6 py-4 text-center relative">
                                    <button
                                        @click.stop="showActionsMenu = showActionsMenu === index ? null : index"
                                        class="p-2 rounded-lg hover:bg-gray-100 transition-colors inline-flex items-center justify-center"
                                    >
                                        <x-icons.dots-vertical class="w-5 h-5 text-gray-500" />
                                    </button>

                                    <!-- Menu de Ações -->
                                    <div
                                        x-show="showActionsMenu === index"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        @click.away="showActionsMenu = null"
                                        class="absolute right-6 mt-2 w-52 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-10"
                                        style="top: 100%;"
                                    >
                                        <button
                                            @click="gerarDarf(declaration)"
                                            class="w-full px-4 py-2.5 text-left text-sm text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-3"
                                        >
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Gerar Darf
                                        </button>
                                        <button
                                            @click="baixarRelatorio(declaration)"
                                            class="w-full px-4 py-2.5 text-left text-sm text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-3"
                                        >
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Baixar relatório mensal
                                        </button>
                                        <button
                                            @click="gerarArquivoIRPF(declaration)"
                                            class="w-full px-4 py-2.5 text-left text-sm text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-3"
                                        >
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                            </svg>
                                            Gerar arquivo para IRPF
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.dashboard>
