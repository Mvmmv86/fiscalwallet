<x-layouts.dashboard title="Visao geral">
    {{-- Dados vêm do DashboardController --}}

    <!-- Linha 1: 4 Cards de Metricas -->
    <div class="flex flex-wrap gap-3 mb-3">
        <!-- Card 1: Resultado do Mes (Roxo) -->
        <div class="flex-1 min-w-[200px] rounded-xl p-4 text-white" style="background: linear-gradient(to right, #9333EA, #A855F7);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="background: rgba(255,255,255,0.2); padding: 8px; border-radius: 8px;">
                    <x-icons.chart class="w-4 h-4 text-white" />
                </div>
                <div class="relative" x-data="{ showTooltip: false }">
                    <button @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" class="cursor-pointer">
                        <x-icons.info class="w-4 h-4 text-white/70 hover:text-white transition-colors" />
                    </button>
                    <div x-cloak x-show="showTooltip" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 top-6 z-50 w-48 p-3 bg-white rounded-lg shadow-lg" style="border: 1px solid rgba(147, 51, 234, 0.3);">
                        <p class="text-xs text-gray-600">Diferenca entre ganhos e perdas no periodo selecionado.</p>
                    </div>
                </div>
            </div>
            <div style="margin-top: 12px;">
                <p style="font-size: 12px; opacity: 0.8;">Resultado do mes</p>
                <p style="font-size: 18px; font-weight: bold; margin-top: 4px;">R$ {{ number_format($dashboardData['resultado_mes'], 2, ',', '.') }}</p>
            </div>
        </div>

        <!-- Card 2: Total de Ganhos -->
        <div class="flex-1 min-w-[200px] bg-white rounded-xl p-4 border border-gray-100">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="background: #f3f4f6; padding: 8px; border-radius: 8px;">
                    <x-icons.trending-up class="w-4 h-4 text-gray-600" />
                </div>
                <div class="relative" x-data="{ showTooltip: false }">
                    <button @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" class="cursor-pointer">
                        <x-icons.info class="w-4 h-4 text-gray-400 hover:text-primary-500 transition-colors" />
                    </button>
                    <div x-cloak x-show="showTooltip" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 top-6 z-50 w-48 p-3 bg-white rounded-lg shadow-lg" style="border: 1px solid rgba(147, 51, 234, 0.3);">
                        <p class="text-xs text-gray-600">Soma de todas as operacoes com lucro realizadas no periodo.</p>
                    </div>
                </div>
            </div>
            <div style="margin-top: 12px;">
                <p style="font-size: 12px; color: #6b7280;">Total de ganhos</p>
                <p style="font-size: 18px; font-weight: bold; color: #111827; margin-top: 4px;">R$ {{ number_format($dashboardData['total_ganhos'], 2, ',', '.') }}</p>
            </div>
        </div>

        <!-- Card 3: Total de Perdas -->
        <div class="flex-1 min-w-[200px] bg-white rounded-xl p-4 border border-gray-100">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="background: #f3f4f6; padding: 8px; border-radius: 8px;">
                    <x-icons.trending-down class="w-4 h-4 text-gray-600" />
                </div>
                <div class="relative" x-data="{ showTooltip: false }">
                    <button @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" class="cursor-pointer">
                        <x-icons.info class="w-4 h-4 text-gray-400 hover:text-primary-500 transition-colors" />
                    </button>
                    <div x-cloak x-show="showTooltip" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 top-6 z-50 w-48 p-3 bg-white rounded-lg shadow-lg" style="border: 1px solid rgba(147, 51, 234, 0.3);">
                        <p class="text-xs text-gray-600">Soma de todas as operacoes com prejuizo realizadas no periodo.</p>
                    </div>
                </div>
            </div>
            <div style="margin-top: 12px;">
                <p style="font-size: 12px; color: #6b7280;">Total de perdas</p>
                <p style="font-size: 18px; font-weight: bold; color: #111827; margin-top: 4px;">R$ {{ number_format($dashboardData['total_perdas'], 2, ',', '.') }}</p>
            </div>
        </div>

        <!-- Card 4: Operacoes Realizadas -->
        <div class="flex-1 min-w-[200px] bg-white rounded-xl p-4 border border-gray-100">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="background: #f3f4f6; padding: 8px; border-radius: 8px;">
                    <x-icons.list class="w-4 h-4 text-gray-600" />
                </div>
                <div class="relative" x-data="{ showTooltip: false }">
                    <button @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" class="cursor-pointer">
                        <x-icons.info class="w-4 h-4 text-gray-400 hover:text-primary-500 transition-colors" />
                    </button>
                    <div x-cloak x-show="showTooltip" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 top-6 z-50 w-48 p-3 bg-white rounded-lg shadow-lg" style="border: 1px solid rgba(147, 51, 234, 0.3);">
                        <p class="text-xs text-gray-600">Quantidade total de operacoes (compra, venda, troca) realizadas no periodo.</p>
                    </div>
                </div>
            </div>
            <div style="margin-top: 12px;">
                <p style="font-size: 12px; color: #6b7280;">Operacoes realizadas</p>
                <p style="font-size: 18px; font-weight: bold; color: #111827; margin-top: 4px;">{{ $dashboardData['operacoes_realizadas'] }}</p>
            </div>
        </div>
    </div>

    <!-- Linha 2: Desempenho + Resumo + Banner -->
    <div class="flex flex-wrap gap-3 mb-3" style="min-height: 320px;">
        <!-- Card Desempenho Consolidado -->
        <div class="bg-white rounded-xl p-4 border border-gray-100 flex flex-col" style="flex: 5 1 400px; min-width: 300px;">
            <div style="margin-bottom: 4px;">
                <h3 style="font-size: 14px; font-weight: 600; color: #111827;">Desempenho consolidado</h3>
            </div>
            <div style="display: flex; align-items: center; gap: 4px; margin-bottom: 2px;">
                <span style="font-size: 11px; color: #6b7280;">Total movimentado</span>
                <div class="relative" x-data="{ showTooltip: false }">
                    <button @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" class="cursor-pointer">
                        <x-icons.info class="w-3 h-3 text-gray-400 hover:text-primary-500 transition-colors" />
                    </button>
                    <div x-cloak x-show="showTooltip" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute left-0 top-5 z-50 w-56 p-3 bg-white rounded-lg shadow-lg" style="border: 1px solid rgba(147, 51, 234, 0.3);">
                        <p class="text-xs text-gray-600">Total de compras e depósitos que entraram na sua conta até o momento.</p>
                    </div>
                </div>
            </div>
            <p style="font-size: 20px; font-weight: bold; color: #111827; margin-bottom: 4px;">R$ {{ number_format($dashboardData['valor_consolidado'], 2, ',', '.') }}</p>

            <!-- Subtítulo do gráfico -->
            <div style="display: flex; align-items: center; gap: 4px; margin-bottom: 8px;">
                <span style="font-size: 10px; color: #9ca3af;">Evolução: Entradas - Perdas - Saques</span>
            </div>

            <!-- Grafico - ocupa todo o espaço restante -->
            <div class="flex-1" style="min-height: 180px;">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <!-- Card Resumo Mes Atual -->
        <div class="bg-white rounded-xl p-4 border border-gray-100 flex flex-col" style="flex: 4 1 280px; min-width: 250px;">
            <h3 style="font-size: 14px; font-weight: 600; color: #111827; text-align: center; margin-bottom: 16px;">Resumo mes atual</h3>

            <div style="text-align: center; padding-bottom: 12px; border-bottom: 1px solid #f0f0f0; margin-bottom: 12px;">
                <p style="font-size: 10px; color: #6b7280; margin-bottom: 4px;">Limite de isencao mensal/Limite tributavel aplicado:</p>
                <p style="font-size: 14px; font-weight: 600; color: #111827;">R${{ number_format($dashboardData['limite_isencao_usado'], 0, ',', '.') }}/R$ {{ number_format($dashboardData['limite_isencao_total'], 0, ',', '.') }}</p>
            </div>

            <div style="text-align: center; padding-bottom: 12px; border-bottom: 1px solid #f0f0f0; margin-bottom: 12px;">
                <p style="font-size: 10px; color: #6b7280; margin-bottom: 4px;">Imposto devido:</p>
                <p style="font-size: 14px; font-weight: 600; color: #111827;">R${{ number_format($dashboardData['imposto_devido'], 2, ',', '.') }}</p>
            </div>

            <div style="text-align: center; padding-bottom: 12px; border-bottom: 1px solid #f0f0f0; margin-bottom: 12px;">
                <p style="font-size: 10px; color: #6b7280; margin-bottom: 4px;">Proxima data para envio de declaracao:</p>
                <p style="font-size: 14px; font-weight: 600; color: #111827;">{{ $dashboardData['proxima_declaracao'] }}</p>
            </div>

            <div style="text-align: center; margin-bottom: 12px;">
                <p style="font-size: 10px; color: #6b7280; margin-bottom: 4px;">Operacoes no periodo</p>
                <p style="font-size: 14px; font-weight: 600; color: #111827;">R$ {{ number_format($dashboardData['operacoes_periodo'], 2, ',', '.') }}</p>
            </div>

            <div class="mt-auto flex justify-center">
                <a href="#" style="display: inline-block; padding: 8px 20px; font-size: 12px; font-weight: 500; text-align: center; color: #374151; background: #f3f4f6; border-radius: 20px; text-decoration: none;">Acessar declaracoes</a>
            </div>
        </div>

        <!-- Card Banner MBR -->
        <div
            class="rounded-xl"
            style="width: 200px; align-self: stretch; background-image: url('{{ asset('assets/images/Banner_invest_dashboar.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"
        ></div>
    </div>

    <!-- Linha 3: Distribuicao + Operacoes -->
    <div class="flex flex-wrap gap-3">
        <!-- Card Distribuicao por Ativo -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 flex flex-col" style="flex: 1 1 400px; min-width: 350px; min-height: 320px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-size: 14px; font-weight: 600; color: #111827;">Distribuicao total por ativo</h3>
                <a href="#" style="padding: 6px 12px; font-size: 11px; font-weight: 500; color: #6b7280; border: 1px solid #e5e7eb; border-radius: 20px; text-decoration: none;">Ver todas</a>
            </div>
            <div style="display: flex; gap: 32px; align-items: center; flex: 1;">
                <div style="width: 180px; height: 180px;">
                    <canvas id="donutChart"></canvas>
                </div>
                <div style="flex: 1; display: flex; flex-direction: column; justify-content: center; gap: 18px;">
                    @foreach($distribuicaoAtivos as $ativo)
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <span style="width: 10px; height: 10px; border-radius: 50%; background: {{ $ativo['cor'] }};"></span>
                                <span style="font-size: 13px; color: #6b7280;">{{ $ativo['nome'] }}</span>
                            </div>
                            <span style="font-size: 13px; font-weight: 500; color: #111827;">R$ {{ number_format($ativo['valor'], 2, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Card Ultimas Operacoes -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 overflow-hidden flex flex-col" style="flex: 1 1 500px; min-width: 400px; min-height: 320px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-size: 14px; font-weight: 600; color: #111827;">Ultimas operacoes registradas</h3>
                <a href="#" style="padding: 6px 12px; font-size: 11px; font-weight: 500; color: #6b7280; border: 1px solid #e5e7eb; border-radius: 20px; text-decoration: none;">Ver todas</a>
            </div>
            <div style="overflow-x: auto; flex: 1; display: flex; flex-direction: column;">
                <table style="width: 100%; border-collapse: collapse; min-width: 450px;">
                    <thead>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <th style="text-align: left; font-size: 10px; color: #6b7280; font-weight: 500; padding-bottom: 12px;">Valor</th>
                            <th style="text-align: left; font-size: 10px; color: #6b7280; font-weight: 500; padding-bottom: 12px;">Moeda</th>
                            <th style="text-align: left; font-size: 10px; color: #6b7280; font-weight: 500; padding-bottom: 12px;">Taxa</th>
                            <th style="text-align: left; font-size: 10px; color: #6b7280; font-weight: 500; padding-bottom: 12px;">Data/Hora</th>
                            <th style="text-align: left; font-size: 10px; color: #6b7280; font-weight: 500; padding-bottom: 12px;">Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasOperacoes as $operacao)
                            @php
                                // Calcular valor para exibição
                                $valorExibir = $operacao->total_brl ?? 0;

                                // Para depósitos/saques sem total_brl, calcular baseado na quantidade e preço
                                if ($valorExibir == 0 && in_array($operacao->type, ['transfer_in', 'transfer_out', 'deposit', 'withdraw'])) {
                                    $stablecoins = ['USDT', 'USDC', 'BUSD', 'TUSD', 'FDUSD', 'DAI'];
                                    $asset = $operacao->to_asset ?? $operacao->from_asset;
                                    $amount = $operacao->to_amount ?? $operacao->from_amount ?? 0;
                                    $price = $operacao->to_price_brl ?? $operacao->from_price_brl ?? 0;

                                    if ($price > 0) {
                                        $valorExibir = $amount * $price;
                                    } elseif (in_array($asset, $stablecoins)) {
                                        // Stablecoins: 1 USD ≈ R$ 6.10 (cotação aproximada)
                                        $valorExibir = $amount * 6.10;
                                    }
                                }

                                // Determinar o ativo principal para exibir
                                $moedaExibir = '-';
                                if ($operacao->to_asset && $operacao->to_asset !== 'BRL') {
                                    $moedaExibir = $operacao->to_asset;
                                } elseif ($operacao->from_asset && $operacao->from_asset !== 'BRL') {
                                    $moedaExibir = $operacao->from_asset;
                                } elseif ($operacao->to_asset === 'BRL' || $operacao->from_asset === 'BRL') {
                                    // Para depósitos/saques FIAT (PIX), mostrar BRL
                                    $moedaExibir = 'BRL';
                                }
                            @endphp
                            <tr style="border-bottom: 1px solid #f9fafb;">
                                <td style="font-size: 12px; color: #111827; padding: 18px 0;">R$ {{ number_format($valorExibir, 2, ',', '.') }}</td>
                                <td style="font-size: 12px; color: #6b7280; padding: 18px 0;">{{ $moedaExibir }}</td>
                                <td style="font-size: 12px; color: #6b7280; padding: 18px 0;">R$ {{ number_format($operacao->fee_brl ?? 0, 2, ',', '.') }}</td>
                                <td style="font-size: 12px; color: #6b7280; padding: 18px 0;">{{ $operacao->executed_at?->format('d/m/Y - H:i:s') ?? '-' }}</td>
                                <td style="padding: 18px 0;">
                                    @if(in_array($operacao->type, ['buy', 'deposit', 'transfer_in']))
                                        <span style="padding: 4px 10px; font-size: 10px; font-weight: 500; color: #15803d; background: #dcfce7; border-radius: 20px; border: 1px solid #bbf7d0;">Entrada</span>
                                    @else
                                        <span style="padding: 4px 10px; font-size: 10px; font-weight: 500; color: #dc2626; background: #fef2f2; border-radius: 20px; border: 1px solid #fecaca;">Saida</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px; color: #6b7280;">Nenhuma operação registrada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts dos Graficos -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Grafico de Linha - Evolução patrimonial
            const lineCtx = document.getElementById('lineChart').getContext('2d');
            const chartData = @json($chartData);

            // Cor roxa (padrão do sistema)
            const lineColor = '#9333EA';
            const bgColor = 'rgba(147, 51, 234, 0.1)';

            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    datasets: [{
                        data: chartData,
                        borderColor: lineColor,
                        backgroundColor: bgColor,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: lineColor,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    const formatted = new Intl.NumberFormat('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL'
                                    }).format(value);
                                    return value >= 0 ? formatted : formatted;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 10 }, color: '#9CA3AF' }
                        },
                        y: {
                            grid: { color: '#F3F4F6' },
                            ticks: {
                                font: { size: 10 },
                                color: '#9CA3AF',
                                callback: function(v) {
                                    const absV = Math.abs(v);
                                    const prefix = v < 0 ? '-' : '';
                                    if (absV >= 1000000) return prefix + (absV/1000000).toFixed(1) + 'M';
                                    if (absV >= 1000) return prefix + (absV/1000).toFixed(1) + 'K';
                                    return prefix + absV;
                                }
                            }
                        }
                    }
                }
            });

            // Grafico Donut
            const donutCtx = document.getElementById('donutChart').getContext('2d');
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: @json(collect($distribuicaoAtivos)->pluck('nome')->toArray()),
                    datasets: [{
                        data: @json(collect($distribuicaoAtivos)->pluck('valor')->toArray()),
                        backgroundColor: @json(collect($distribuicaoAtivos)->pluck('cor')->toArray()),
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '65%',
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
</x-layouts.dashboard>
