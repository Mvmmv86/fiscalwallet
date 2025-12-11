<x-layouts.dashboard title="Pendências">
    <div x-data="{
        selectedYear: '2023',
        selectedStatus: 'todas',
        showResolveModal: false,
        selectedPendencia: null,
        pendencias: [
            {
                id: 1,
                tipo: 'DARF',
                mes: 'NOV',
                ano: '2023',
                descricao: 'DARF de ganho de capital não pago',
                dataLimite: '29/12/2023',
                diasAtraso: 15,
                valorOriginal: 2250.00,
                multa: 450.00,
                juros: 67.50,
                valorAtualizado: 2767.50,
                status: 'critico',
                comoResolver: 'Acesse o Sicalc da Receita Federal, gere o DARF com os valores atualizados incluindo multa e juros, e efetue o pagamento.'
            },
            {
                id: 2,
                tipo: 'IN1888',
                mes: 'OUT',
                ano: '2023',
                descricao: 'Declaração IN1888 não enviada',
                dataLimite: '30/11/2023',
                diasAtraso: 45,
                valorOriginal: 0,
                multa: 500.00,
                juros: 0,
                valorAtualizado: 500.00,
                status: 'critico',
                comoResolver: 'Acesse o e-CAC, preencha a declaração IN1888 referente ao mês de outubro e envie. A multa por atraso será gerada automaticamente.'
            },
            {
                id: 3,
                tipo: 'DARF',
                mes: 'DEZ',
                ano: '2023',
                descricao: 'DARF de ganho de capital pendente',
                dataLimite: '31/01/2024',
                diasAtraso: 0,
                valorOriginal: 5250.00,
                multa: 0,
                juros: 0,
                valorAtualizado: 5250.00,
                status: 'atencao',
                comoResolver: 'O prazo ainda não venceu. Gere o DARF no Sicalc e efetue o pagamento até a data limite para evitar multas.'
            },
            {
                id: 4,
                tipo: 'GCAP',
                mes: 'SET',
                ano: '2023',
                descricao: 'Programa GCAP não preenchido',
                dataLimite: '31/10/2023',
                diasAtraso: 75,
                valorOriginal: 0,
                multa: 165.74,
                juros: 0,
                valorAtualizado: 165.74,
                status: 'critico',
                comoResolver: 'Baixe o programa GCAP no site da Receita Federal, preencha os ganhos de capital do mês e transmita. Uma DARF de multa será gerada.'
            },
            {
                id: 5,
                tipo: 'Operação',
                mes: 'AGO',
                ano: '2023',
                descricao: 'Operação sem classificação fiscal',
                dataLimite: '-',
                diasAtraso: 0,
                valorOriginal: 0,
                multa: 0,
                juros: 0,
                valorAtualizado: 0,
                status: 'pendente',
                comoResolver: 'Acesse a página de Operações, localize a transação e classifique-a corretamente (compra, venda, permuta, etc.).'
            },
            {
                id: 6,
                tipo: 'Carteira',
                mes: '-',
                ano: '2023',
                descricao: 'Sincronização da Binance desatualizada',
                dataLimite: '-',
                diasAtraso: 0,
                valorOriginal: 0,
                multa: 0,
                juros: 0,
                valorAtualizado: 0,
                status: 'pendente',
                comoResolver: 'Acesse Carteiras, clique em sincronizar na carteira Binance para importar as operações mais recentes.'
            }
        ],
        get filteredPendencias() {
            return this.pendencias.filter(p => {
                if (this.selectedStatus === 'todas') return true;
                return p.status === this.selectedStatus;
            });
        },
        get totalPendencias() {
            return this.pendencias.length;
        },
        get pendenciasCriticas() {
            return this.pendencias.filter(p => p.status === 'critico').length;
        },
        get totalMultas() {
            return this.pendencias.reduce((acc, p) => acc + p.multa + p.juros, 0);
        },
        get totalDevido() {
            return this.pendencias.reduce((acc, p) => acc + p.valorAtualizado, 0);
        },
        formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
        },
        getStatusClass(status) {
            switch(status) {
                case 'critico': return 'bg-danger-100 text-danger-700';
                case 'atencao': return 'bg-warning-100 text-warning-700';
                case 'pendente': return 'bg-gray-100 text-gray-700';
                default: return 'bg-gray-100 text-gray-700';
            }
        },
        getStatusLabel(status) {
            switch(status) {
                case 'critico': return 'Crítico';
                case 'atencao': return 'Atenção';
                case 'pendente': return 'Pendente';
                default: return status;
            }
        },
        getTipoClass(tipo) {
            switch(tipo) {
                case 'DARF': return 'bg-primary-100 text-primary-700';
                case 'IN1888': return 'bg-blue-100 text-blue-700';
                case 'GCAP': return 'bg-purple-100 text-purple-700';
                case 'Operação': return 'bg-orange-100 text-orange-700';
                case 'Carteira': return 'bg-cyan-100 text-cyan-700';
                default: return 'bg-gray-100 text-gray-700';
            }
        },
        openResolveModal(pendencia) {
            this.selectedPendencia = pendencia;
            this.showResolveModal = true;
        },
        closeResolveModal() {
            this.showResolveModal = false;
            this.selectedPendencia = null;
        }
    }">

        <!-- Header com descrição -->
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">
            <div class="flex items-start gap-3">
                <a href="{{ route('dashboard') }}" class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition-colors mt-1">
                    <x-icons.arrow-left class="w-4 h-4 text-gray-600" />
                </a>
                <div>
                    <p class="text-sm text-gray-500 mt-1">Visualize e resolva pendências fiscais para evitar multas e problemas com a Receita Federal.</p>
                </div>
            </div>

            <div class="flex-shrink-0">
                <x-ui.button variant="primary" size="md">
                    Resolver todas
                </x-ui.button>
            </div>
        </div>

        <!-- Cards de Resumo (KPIs) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
            <!-- Total de Pendências -->
            <div class="bg-white rounded-xl border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Total de Pendências</p>
                        <p class="text-lg font-bold text-gray-900" x-text="totalPendencias"></p>
                    </div>
                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                        <x-icons.file-text class="w-4 h-4 text-gray-600" />
                    </div>
                </div>
            </div>

            <!-- Pendências Críticas -->
            <div class="bg-white rounded-xl border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Pendências Críticas</p>
                        <p class="text-lg font-bold text-danger-600" x-text="pendenciasCriticas"></p>
                    </div>
                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                        <x-icons.alert-triangle class="w-4 h-4 text-gray-600" />
                    </div>
                </div>
            </div>

            <!-- Total em Multas -->
            <div class="bg-white rounded-xl border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Total em Multas/Juros</p>
                        <p class="text-lg font-bold text-gray-900" x-text="formatCurrency(totalMultas)"></p>
                    </div>
                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                        <x-icons.trending-up class="w-4 h-4 text-gray-600" />
                    </div>
                </div>
            </div>

            <!-- Valor Total Devido -->
            <div class="bg-white rounded-xl border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Valor Total Devido</p>
                        <p class="text-lg font-bold text-gray-900" x-text="formatCurrency(totalDevido)"></p>
                    </div>
                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                        <x-icons.wallet class="w-4 h-4 text-gray-600" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="flex flex-col lg:flex-row lg:items-center gap-4 mb-6">
            <!-- Filtro de Ano -->
            <div class="relative">
                <button class="flex items-center gap-2 px-4 py-2.5 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-800 transition-colors">
                    <span x-text="selectedYear"></span>
                    <x-icons.calendar class="w-4 h-4" />
                </button>
            </div>

            <!-- Filtro de Status -->
            <div class="flex items-center gap-2">
                <button
                    @click="selectedStatus = 'todas'"
                    :class="selectedStatus === 'todas' ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white shadow-sm' : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all"
                >
                    Todas
                </button>
                <button
                    @click="selectedStatus = 'critico'"
                    :class="selectedStatus === 'critico' ? 'bg-danger-600 text-white' : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                >
                    Críticas
                </button>
                <button
                    @click="selectedStatus = 'atencao'"
                    :class="selectedStatus === 'atencao' ? 'bg-warning-600 text-white' : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                >
                    Atenção
                </button>
                <button
                    @click="selectedStatus = 'pendente'"
                    :class="selectedStatus === 'pendente' ? 'bg-gray-600 text-white' : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                >
                    Pendentes
                </button>
            </div>
        </div>

        <!-- Tabela de Pendências -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Período</th>
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                            <th class="text-left px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Data Limite</th>
                            <th class="text-right px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Multa/Juros</th>
                            <th class="text-right px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Valor Atual</th>
                            <th class="text-center px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="text-center px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <template x-for="pendencia in filteredPendencias" :key="pendencia.id">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Tipo -->
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium"
                                        :class="getTipoClass(pendencia.tipo)"
                                        x-text="pendencia.tipo"
                                    ></span>
                                </td>

                                <!-- Período -->
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900" x-text="pendencia.mes !== '-' ? pendencia.mes + '/' + pendencia.ano : '-'"></span>
                                </td>

                                <!-- Descrição -->
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700" x-text="pendencia.descricao"></span>
                                    <template x-if="pendencia.diasAtraso > 0">
                                        <span class="block text-xs text-danger-600 mt-1">
                                            <span x-text="pendencia.diasAtraso"></span> dias em atraso
                                        </span>
                                    </template>
                                </td>

                                <!-- Data Limite -->
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700" x-text="pendencia.dataLimite"></span>
                                </td>

                                <!-- Multa/Juros -->
                                <td class="px-6 py-4 text-right">
                                    <span
                                        class="text-sm font-medium"
                                        :class="pendencia.multa + pendencia.juros > 0 ? 'text-danger-600' : 'text-gray-400'"
                                        x-text="pendencia.multa + pendencia.juros > 0 ? formatCurrency(pendencia.multa + pendencia.juros) : '-'"
                                    ></span>
                                </td>

                                <!-- Valor Atual -->
                                <td class="px-6 py-4 text-right">
                                    <span
                                        class="text-sm font-semibold"
                                        :class="pendencia.valorAtualizado > 0 ? 'text-gray-900' : 'text-gray-400'"
                                        x-text="pendencia.valorAtualizado > 0 ? formatCurrency(pendencia.valorAtualizado) : '-'"
                                    ></span>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium"
                                        :class="getStatusClass(pendencia.status)"
                                        x-text="getStatusLabel(pendencia.status)"
                                    ></span>
                                </td>

                                <!-- Ação -->
                                <td class="px-6 py-4 text-center">
                                    <button
                                        @click="openResolveModal(pendencia)"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-primary-600 to-primary-500 text-white text-xs font-medium rounded-lg hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm"
                                    >
                                        <x-icons.check class="w-3.5 h-3.5" />
                                        Resolver
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Seção: Como Evitar Pendências -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Como evitar pendências</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Dica 1 -->
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <x-icons.calendar class="w-5 h-5 text-primary-600" />
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Fique atento aos prazos</h3>
                            <p class="text-xs text-gray-500">O DARF deve ser pago até o último dia útil do mês seguinte à operação com ganho de capital.</p>
                        </div>
                    </div>

                    <!-- Dica 2 -->
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-success-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <x-icons.refresh class="w-5 h-5 text-success-600" />
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Sincronize regularmente</h3>
                            <p class="text-xs text-gray-500">Mantenha suas carteiras sincronizadas para ter dados sempre atualizados e evitar surpresas.</p>
                        </div>
                    </div>

                    <!-- Dica 3 -->
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-warning-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <x-icons.bell class="w-5 h-5 text-warning-600" />
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Ative as notificações</h3>
                            <p class="text-xs text-gray-500">Receba alertas por e-mail quando houver prazos próximos ou novas obrigações fiscais.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Como Resolver -->
        <div
            x-show="showResolveModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto"
            style="display: none;"
        >
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" @click="closeResolveModal"></div>

                <div
                    x-show="showResolveModal"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative bg-white rounded-2xl shadow-xl transform transition-all sm:max-w-lg sm:w-full mx-auto z-10"
                >
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Como resolver</h3>
                            <p class="text-sm text-gray-500" x-text="selectedPendencia?.tipo + ' - ' + (selectedPendencia?.mes !== '-' ? selectedPendencia?.mes + '/' + selectedPendencia?.ano : 'Geral')"></p>
                        </div>
                        <button @click="closeResolveModal" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <x-icons.x class="w-5 h-5 text-gray-500" />
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="px-6 py-5">
                        <!-- Resumo da Pendência -->
                        <div class="bg-gray-50 rounded-xl p-4 mb-5">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0"
                                     :class="selectedPendencia?.status === 'critico' ? 'bg-danger-100' : (selectedPendencia?.status === 'atencao' ? 'bg-warning-100' : 'bg-gray-200')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        :class="selectedPendencia?.status === 'critico' ? 'text-danger-600' : (selectedPendencia?.status === 'atencao' ? 'text-warning-600' : 'text-gray-600')">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900" x-text="selectedPendencia?.descricao"></p>
                                    <div class="flex items-center gap-4 mt-2 text-xs text-gray-500">
                                        <span>Data limite: <strong x-text="selectedPendencia?.dataLimite"></strong></span>
                                        <template x-if="selectedPendencia?.diasAtraso > 0">
                                            <span class="text-danger-600"><strong x-text="selectedPendencia?.diasAtraso"></strong> dias em atraso</span>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Valores -->
                        <template x-if="selectedPendencia?.valorAtualizado > 0">
                            <div class="mb-5">
                                <h4 class="text-sm font-semibold text-gray-900 mb-3">Valores</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Valor original</span>
                                        <span class="text-gray-900" x-text="formatCurrency(selectedPendencia?.valorOriginal)"></span>
                                    </div>
                                    <template x-if="selectedPendencia?.multa > 0">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Multa</span>
                                            <span class="text-danger-600" x-text="formatCurrency(selectedPendencia?.multa)"></span>
                                        </div>
                                    </template>
                                    <template x-if="selectedPendencia?.juros > 0">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Juros SELIC</span>
                                            <span class="text-danger-600" x-text="formatCurrency(selectedPendencia?.juros)"></span>
                                        </div>
                                    </template>
                                    <div class="flex justify-between text-sm pt-2 border-t border-gray-200">
                                        <span class="font-semibold text-gray-900">Valor atualizado</span>
                                        <span class="font-bold text-primary-600" x-text="formatCurrency(selectedPendencia?.valorAtualizado)"></span>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Instruções -->
                        <div class="mb-5">
                            <h4 class="text-sm font-semibold text-gray-900 mb-3">Passo a passo</h4>
                            <div class="bg-primary-50 rounded-xl p-4">
                                <p class="text-sm text-gray-700" x-text="selectedPendencia?.comoResolver"></p>
                            </div>
                        </div>

                        <!-- Links Úteis -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 mb-3">Links úteis</h4>
                            <div class="space-y-2">
                                <a href="https://www.gov.br/receitafederal/pt-br" target="_blank" class="flex items-center gap-2 text-sm text-primary-600 hover:text-primary-700">
                                    <x-icons.external-link class="w-4 h-4" />
                                    Portal da Receita Federal
                                </a>
                                <a href="https://sicalc.receita.economia.gov.br/sicalc/principal" target="_blank" class="flex items-center gap-2 text-sm text-primary-600 hover:text-primary-700">
                                    <x-icons.external-link class="w-4 h-4" />
                                    Sicalc - Gerar DARF
                                </a>
                                <a href="https://cav.receita.fazenda.gov.br/" target="_blank" class="flex items-center gap-2 text-sm text-primary-600 hover:text-primary-700">
                                    <x-icons.external-link class="w-4 h-4" />
                                    e-CAC - Centro de Atendimento Virtual
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between rounded-b-2xl">
                        <button
                            @click="closeResolveModal"
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors"
                        >
                            Fechar
                        </button>
                        <div class="flex items-center gap-3">
                            <button class="px-4 py-2 text-sm font-medium text-primary-600 border border-primary-600 rounded-lg hover:bg-primary-50 transition-colors">
                                Falar com contador
                            </button>
                            <button class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-lg hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm">
                                Marcar como resolvido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.dashboard>
