<x-layouts.dashboard title="Planos e Assinatura">
    <div x-data="{
        currentPlan: 'pro',
        billingCycle: 'monthly',
        showUpgradeModal: false,
        selectedPlan: null,
        showCancelModal: false,
        plans: [
            {
                id: 'starter',
                name: 'Starter',
                description: 'Para investidores iniciantes',
                priceMonthly: 299,
                priceYearly: 2990,
                popular: false,
                features: [
                    'Até 500 operações/mês',
                    '3 carteiras conectadas',
                    'Dashboard completo',
                    'Relatórios fiscais básicos',
                    'Exportação CSV/PDF',
                    'Suporte por email'
                ],
                limitations: []
            },
            {
                id: 'pro',
                name: 'Pro',
                description: 'Para traders ativos',
                priceMonthly: 699,
                priceYearly: 6990,
                popular: true,
                features: [
                    'Operações ilimitadas',
                    '10 carteiras conectadas',
                    'Relatórios fiscais completos',
                    'GCAP automático',
                    'IN 1888 automática',
                    'DARF automático',
                    'Exportação CSV/PDF/Excel',
                    'Suporte prioritário por chat'
                ],
                limitations: []
            },
            {
                id: 'enterprise',
                name: 'Enterprise',
                description: 'Para escritórios e grandes investidores',
                priceMonthly: 1500,
                priceYearly: 15000,
                popular: false,
                features: [
                    'Tudo do plano Pro',
                    'Carteiras ilimitadas',
                    'Multi-usuários (até 10)',
                    'API de integração',
                    'Relatórios personalizados',
                    'Gerente de conta dedicado',
                    'SLA garantido 99.9%',
                    'Treinamento personalizado'
                ],
                limitations: []
            }
        ],
        invoices: [
            { id: 'INV-2024-001', date: '01/01/2024', amount: 699.00, status: 'paid' },
            { id: 'INV-2023-012', date: '01/12/2023', amount: 699.00, status: 'paid' },
            { id: 'INV-2023-011', date: '01/11/2023', amount: 699.00, status: 'paid' },
            { id: 'INV-2023-010', date: '01/10/2023', amount: 699.00, status: 'paid' }
        ],
        getPrice(plan) {
            const price = this.billingCycle === 'monthly' ? plan.priceMonthly : plan.priceYearly;
            return 'R$ ' + price.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        },
        getPeriod(plan) {
            return this.billingCycle === 'monthly' ? '/mês' : '/ano';
        },
        openUpgradeModal(plan) {
            this.selectedPlan = plan;
            this.showUpgradeModal = true;
        }
    }">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('perfil') }}" class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition-colors">
                    <x-icons.arrow-left class="w-4 h-4 text-gray-600" />
                </a>
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">Planos e Assinatura</h1>
                    <p class="text-sm text-gray-500">Gerencie seu plano e método de pagamento</p>
                </div>
            </div>
        </div>

        <!-- Plano Atual -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-500 rounded-xl p-6 mb-6 text-white">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <p class="text-sm text-white/80 mb-1">Seu plano atual</p>
                    <h2 class="text-2xl font-bold">Plano Pro</h2>
                    <p class="text-sm text-white/80 mt-1">Próxima cobrança: 01/02/2024 • R$ 699,00</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        @click="showCancelModal = true"
                        class="px-4 py-2 text-sm font-medium text-white/90 border border-white/30 rounded-lg hover:bg-white/10 transition-colors"
                    >
                        Cancelar plano
                    </button>
                    <a
                        href="#"
                        class="px-4 py-2 text-sm font-medium text-primary-600 bg-white rounded-lg hover:bg-white/90 transition-colors"
                    >
                        Gerenciar pagamento
                    </a>
                </div>
            </div>

            <!-- Uso do plano -->
            <div class="mt-6 pt-6 border-t border-white/20">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs text-white/70 mb-1">Operações este mês</p>
                        <div class="flex items-end gap-2">
                            <span class="text-2xl font-bold">247</span>
                            <span class="text-sm text-white/70 mb-1">/ ilimitado</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-white/70 mb-1">Carteiras conectadas</p>
                        <div class="flex items-end gap-2">
                            <span class="text-2xl font-bold">4</span>
                            <span class="text-sm text-white/70 mb-1">/ ilimitado</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-white/70 mb-1">Membro desde</p>
                        <div class="flex items-end gap-2">
                            <span class="text-2xl font-bold">Jan/2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toggle Mensal/Anual -->
        <div class="flex items-center justify-center gap-4 mb-6">
            <span :class="billingCycle === 'monthly' ? 'text-gray-900 font-medium' : 'text-gray-500'" class="text-sm">Mensal</span>
            <button
                @click="billingCycle = billingCycle === 'monthly' ? 'yearly' : 'monthly'"
                :class="billingCycle === 'yearly' ? 'bg-primary-600' : 'bg-gray-300'"
                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full transition-colors duration-200 ease-in-out"
            >
                <span
                    :class="billingCycle === 'yearly' ? 'translate-x-5' : 'translate-x-0'"
                    class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out mt-0.5 ml-0.5"
                ></span>
            </button>
            <span :class="billingCycle === 'yearly' ? 'text-gray-900 font-medium' : 'text-gray-500'" class="text-sm">
                Anual <span class="text-success-600 text-xs font-medium">(2 meses grátis)</span>
            </span>
        </div>

        <!-- Cards de Planos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <template x-for="plan in plans" :key="plan.id">
                <div
                    :class="plan.id === currentPlan ? 'border-primary-500 ring-2 ring-primary-500' : 'border-gray-200'"
                    class="bg-white rounded-xl border p-5 relative"
                >
                    <!-- Badge Popular -->
                    <div x-show="plan.popular" class="absolute -top-3 left-1/2 -translate-x-1/2">
                        <span class="px-3 py-1 bg-gradient-to-r from-primary-600 to-primary-500 text-white text-xs font-medium rounded-full">
                            Mais popular
                        </span>
                    </div>

                    <!-- Badge Plano Atual -->
                    <div x-show="plan.id === currentPlan" class="absolute -top-3 right-4">
                        <span class="px-3 py-1 bg-success-500 text-white text-xs font-medium rounded-full">
                            Atual
                        </span>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-900" x-text="plan.name"></h3>
                        <p class="text-xs text-gray-500 mt-0.5" x-text="plan.description"></p>
                    </div>

                    <div class="mb-4">
                        <span class="text-3xl font-bold text-gray-900" x-text="getPrice(plan)"></span>
                        <span class="text-sm text-gray-500" x-text="getPeriod(plan)"></span>
                    </div>

                    <ul class="space-y-2 mb-6">
                        <template x-for="feature in plan.features" :key="feature">
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <x-icons.check class="w-4 h-4 text-success-500 mt-0.5 flex-shrink-0" />
                                <span x-text="feature"></span>
                            </li>
                        </template>
                        <template x-for="limitation in plan.limitations" :key="limitation">
                            <li class="flex items-start gap-2 text-sm text-gray-400">
                                <x-icons.x class="w-4 h-4 text-gray-300 mt-0.5 flex-shrink-0" />
                                <span x-text="limitation"></span>
                            </li>
                        </template>
                    </ul>

                    <button
                        x-show="plan.id !== currentPlan"
                        @click="openUpgradeModal(plan)"
                        :class="plan.popular ? 'bg-gradient-to-r from-primary-600 to-primary-500 text-white hover:from-primary-700 hover:to-primary-600' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50'"
                        class="w-full py-2 text-sm font-medium rounded-lg transition-all"
                    >
                        <span x-text="plan.priceMonthly === null ? 'Falar com vendas' : (plans.findIndex(p => p.id === plan.id) < plans.findIndex(p => p.id === currentPlan) ? 'Fazer downgrade' : 'Fazer upgrade')"></span>
                    </button>
                    <button
                        x-show="plan.id === currentPlan"
                        disabled
                        class="w-full py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed"
                    >
                        Plano atual
                    </button>
                </div>
            </template>
        </div>

        <!-- Histórico de Faturas -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900">Histórico de faturas</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fatura</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="invoice in invoices" :key="invoice.id">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900" x-text="invoice.id"></td>
                                <td class="px-6 py-4 text-sm text-gray-500" x-text="invoice.date"></td>
                                <td class="px-6 py-4 text-sm text-gray-900" x-text="'R$ ' + invoice.amount.toFixed(2).replace('.', ',')"></td>
                                <td class="px-6 py-4">
                                    <span
                                        :class="invoice.status === 'paid' ? 'bg-success-100 text-success-700' : 'bg-warning-100 text-warning-700'"
                                        class="px-2 py-1 text-xs font-medium rounded-full"
                                        x-text="invoice.status === 'paid' ? 'Pago' : 'Pendente'"
                                    ></span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                        Baixar PDF
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal de Upgrade -->
        <div
            x-show="showUpgradeModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
            @click.self="showUpgradeModal = false"
            style="display: none;"
        >
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md">
                <div class="p-6">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <x-icons.credit-card class="w-6 h-6 text-primary-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">
                        Mudar para <span x-text="selectedPlan?.name"></span>
                    </h3>
                    <p class="text-sm text-gray-500 text-center mb-6">
                        Você será cobrado <strong x-text="getPrice(selectedPlan)"></strong><span x-text="getPeriod(selectedPlan)"></span>.
                        A alteração entrará em vigor imediatamente.
                    </p>
                    <div class="flex gap-3">
                        <button
                            @click="showUpgradeModal = false"
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Cancelar
                        </button>
                        <button
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-lg hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm"
                        >
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Cancelamento -->
        <div
            x-show="showCancelModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
            @click.self="showCancelModal = false"
            style="display: none;"
        >
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md">
                <div class="p-6">
                    <div class="w-12 h-12 bg-warning-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <x-icons.alert-triangle class="w-6 h-6 text-warning-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Cancelar assinatura</h3>
                    <p class="text-sm text-gray-500 text-center mb-4">
                        Tem certeza que deseja cancelar sua assinatura Pro? Você perderá acesso a:
                    </p>
                    <ul class="mb-6 space-y-2">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <x-icons.x class="w-4 h-4 text-danger-500" />
                            Operações ilimitadas
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <x-icons.x class="w-4 h-4 text-danger-500" />
                            Carteiras ilimitadas
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <x-icons.x class="w-4 h-4 text-danger-500" />
                            Relatórios fiscais completos
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <x-icons.x class="w-4 h-4 text-danger-500" />
                            Suporte prioritário
                        </li>
                    </ul>
                    <div class="flex gap-3">
                        <button
                            @click="showCancelModal = false"
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-lg hover:from-primary-700 hover:to-primary-600 transition-all"
                        >
                            Manter plano
                        </button>
                        <button
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-danger-600 border border-danger-300 rounded-lg hover:bg-danger-50 transition-colors"
                        >
                            Cancelar mesmo assim
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
