<x-layouts.dashboard title="Relatórios">
    <div x-data="{
        selectedYear: '2023',
        selectedWallet: 'todas',
        wallets: [
            { id: 'todas', name: 'Todas as carteiras' },
            { id: 'binance', name: 'Binance' },
            { id: 'coinbase', name: 'Coinbase' },
            { id: 'metamask', name: 'MetaMask' }
        ],
        // Dados por carteira
        walletsData: {
            todas: {
                valorConsolidado: 3232786.93,
                operacoes: 1000,
                lucroPrejuizo: 3232786.93,
                ativos: [
                    { nome: 'BTC', valor: 1000000.00, cor: '#9333EA' },
                    { nome: 'ETH', valor: 500000.00, cor: '#22C55E' },
                    { nome: 'USDT', valor: 500000.00, cor: '#3B82F6' },
                    { nome: 'XRP', valor: 500000.00, cor: '#F59E0B' },
                    { nome: 'Outros', valor: 500000.00, cor: '#6B7280' }
                ],
                chartData: {
                    valorConsolidado: [800000, 1200000, 1800000, 2200000, 2000000, 1500000, 1600000, 1800000, 2000000, 2200000, 2800000, 3232786],
                    operacoes: [50, 80, 120, 150, 130, 100, 110, 130, 150, 170, 200, 1000],
                    lucroPrejuizo: [100000, 300000, 600000, 900000, 700000, 400000, 500000, 700000, 900000, 1200000, 2000000, 3232786]
                }
            },
            binance: {
                valorConsolidado: 1800000.00,
                operacoes: 600,
                lucroPrejuizo: 1800000.00,
                ativos: [
                    { nome: 'BTC', valor: 600000.00, cor: '#9333EA' },
                    { nome: 'ETH', valor: 300000.00, cor: '#22C55E' },
                    { nome: 'USDT', valor: 300000.00, cor: '#3B82F6' },
                    { nome: 'BNB', valor: 400000.00, cor: '#F59E0B' },
                    { nome: 'Outros', valor: 200000.00, cor: '#6B7280' }
                ],
                chartData: {
                    valorConsolidado: [400000, 600000, 900000, 1100000, 1000000, 800000, 850000, 950000, 1100000, 1300000, 1600000, 1800000],
                    operacoes: [30, 50, 70, 90, 80, 60, 65, 75, 90, 100, 120, 600],
                    lucroPrejuizo: [50000, 150000, 300000, 450000, 350000, 200000, 250000, 350000, 450000, 600000, 1000000, 1800000]
                }
            },
            coinbase: {
                valorConsolidado: 900000.00,
                operacoes: 250,
                lucroPrejuizo: 900000.00,
                ativos: [
                    { nome: 'BTC', valor: 300000.00, cor: '#9333EA' },
                    { nome: 'ETH', valor: 150000.00, cor: '#22C55E' },
                    { nome: 'USDT', valor: 150000.00, cor: '#3B82F6' },
                    { nome: 'SOL', valor: 200000.00, cor: '#F59E0B' },
                    { nome: 'Outros', valor: 100000.00, cor: '#6B7280' }
                ],
                chartData: {
                    valorConsolidado: [200000, 300000, 450000, 550000, 500000, 400000, 425000, 475000, 550000, 650000, 800000, 900000],
                    operacoes: [15, 25, 35, 45, 40, 30, 33, 38, 45, 50, 60, 250],
                    lucroPrejuizo: [25000, 75000, 150000, 225000, 175000, 100000, 125000, 175000, 225000, 300000, 500000, 900000]
                }
            },
            metamask: {
                valorConsolidado: 532786.93,
                operacoes: 150,
                lucroPrejuizo: 532786.93,
                ativos: [
                    { nome: 'ETH', valor: 200000.00, cor: '#22C55E' },
                    { nome: 'MATIC', valor: 150000.00, cor: '#9333EA' },
                    { nome: 'LINK', valor: 100000.00, cor: '#3B82F6' },
                    { nome: 'UNI', valor: 82786.93, cor: '#F59E0B' }
                ],
                chartData: {
                    valorConsolidado: [100000, 150000, 225000, 275000, 250000, 200000, 212000, 237000, 275000, 325000, 400000, 532786],
                    operacoes: [10, 15, 22, 28, 25, 20, 21, 23, 28, 32, 40, 150],
                    lucroPrejuizo: [12500, 37500, 75000, 112500, 87500, 50000, 62500, 87500, 112500, 150000, 250000, 532786]
                }
            }
        },
        chart: null,
        get currentData() {
            return this.walletsData[this.selectedWallet] || this.walletsData.todas;
        },
        formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
        },
        initChart() {
            const ctx = document.getElementById('relatoriosChart').getContext('2d');

            if (this.chart) {
                this.chart.destroy();
            }

            const data = this.currentData.chartData;

            this.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abril', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    datasets: [
                        {
                            label: 'Valor consolidado',
                            data: data.valorConsolidado,
                            borderColor: '#9333EA',
                            backgroundColor: 'rgba(147, 51, 234, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#9333EA',
                            pointHoverBorderColor: '#fff',
                            pointHoverBorderWidth: 2,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Operações',
                            data: data.operacoes,
                            borderColor: '#9CA3AF',
                            backgroundColor: 'transparent',
                            fill: false,
                            tension: 0.4,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#9CA3AF',
                            pointHoverBorderColor: '#fff',
                            pointHoverBorderWidth: 2,
                            yAxisID: 'y1'
                        },
                        {
                            label: 'Lucro/Prejuízo',
                            data: data.lucroPrejuizo,
                            borderColor: '#22C55E',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#22C55E',
                            pointHoverBorderColor: '#fff',
                            pointHoverBorderWidth: 2,
                            yAxisID: 'y'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#1F1F1F',
                            bodyColor: '#6B7280',
                            borderColor: '#E5E7EB',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#9CA3AF',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        y: {
                            display: true,
                            position: 'left',
                            ticks: {
                                display: false
                            },
                            border: {
                                display: false
                            },
                            grid: {
                                display: true,
                                color: '#E5E7EB',
                                lineWidth: 1,
                                drawTicks: false,
                                borderDash: [5, 5]
                            }
                        },
                        y1: {
                            display: false,
                            position: 'right',
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        },
        updateChart() {
            if (this.chart) {
                const data = this.currentData.chartData;
                this.chart.data.datasets[0].data = data.valorConsolidado;
                this.chart.data.datasets[1].data = data.operacoes;
                this.chart.data.datasets[2].data = data.lucroPrejuizo;
                this.chart.update();
            }
        }
    }" x-init="$nextTick(() => initChart()); $watch('selectedWallet', () => updateChart())">

        <!-- Header com botões de ação -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition-colors">
                    <x-icons.arrow-left class="w-4 h-4 text-gray-600" />
                </a>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-ui.button variant="primary" size="md">
                    Exportar relatório
                </x-ui.button>
            </div>
        </div>

        <!-- Barra de filtros -->
        <div class="flex flex-col lg:flex-row lg:items-center gap-4 mb-6">
            <!-- Seletor de ano -->
            <div class="relative">
                <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <span x-text="selectedYear"></span>
                    <x-icons.calendar class="w-4 h-4 text-gray-500" />
                </button>
            </div>

            <!-- Dropdown de carteiras -->
            <div class="relative">
                <select
                    x-model="selectedWallet"
                    class="appearance-none px-4 py-2.5 pr-10 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 cursor-pointer"
                >
                    <template x-for="wallet in wallets" :key="wallet.id">
                        <option :value="wallet.id" x-text="wallet.name"></option>
                    </template>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <x-icons.chevron-down class="w-4 h-4 text-gray-400" />
                </div>
            </div>
        </div>

        <!-- Card Visão Geral -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-6">
            <!-- Header do Card -->
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Visão geral</h2>
            </div>

            <!-- Métricas -->
            <div class="px-6 py-5 border-b border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Valor consolidado -->
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-primary-600 mt-1.5 flex-shrink-0"></span>
                        <div>
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-xs text-gray-500">Valor consolidado</span>
                                <button class="text-gray-400 hover:text-gray-500">
                                    <x-icons.info class="w-3.5 h-3.5" />
                                </button>
                            </div>
                            <p class="text-xl font-semibold text-gray-900" x-text="formatCurrency(currentData.valorConsolidado)"></p>
                        </div>
                    </div>

                    <!-- Operações -->
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-gray-400 mt-1.5 flex-shrink-0"></span>
                        <div>
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-xs text-gray-500">Operações</span>
                                <button class="text-gray-400 hover:text-gray-500">
                                    <x-icons.info class="w-3.5 h-3.5" />
                                </button>
                            </div>
                            <p class="text-xl font-semibold text-gray-900" x-text="currentData.operacoes"></p>
                        </div>
                    </div>

                    <!-- Lucro/Prejuízo -->
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-green-500 mt-1.5 flex-shrink-0"></span>
                        <div>
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-xs text-gray-500">Lucro/Prejuízo</span>
                                <button class="text-gray-400 hover:text-gray-500">
                                    <x-icons.info class="w-3.5 h-3.5" />
                                </button>
                            </div>
                            <p class="text-xl font-semibold text-gray-900" x-text="formatCurrency(currentData.lucroPrejuizo)"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico -->
            <div class="px-6 py-5">
                <div class="h-64">
                    <canvas id="relatoriosChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Card Ativos -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <!-- Header do Card -->
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Ativos</h2>
            </div>

            <!-- Lista de Ativos -->
            <div class="px-6 py-4">
                <div class="space-y-3">
                    <template x-for="(ativo, index) in currentData.ativos" :key="index">
                        <div class="flex items-center justify-between py-2">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full flex-shrink-0" :style="'background-color: ' + ativo.cor"></span>
                                <span class="text-sm text-gray-700" x-text="ativo.nome"></span>
                            </div>
                            <span class="text-sm font-medium text-gray-900" x-text="formatCurrency(ativo.valor)"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
</x-layouts.dashboard>
