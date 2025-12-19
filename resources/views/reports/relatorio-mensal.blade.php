<x-reports.layouts.print title="Relatorio Mensal - {{ $mes }}/{{ $ano }}">

    {{-- ==================== PAGINA 1: CAPA ==================== --}}
    <div class="page">
        <div class="page-content flex flex-col justify-center items-center text-center" style="min-height: calc(297mm - 80mm);">
            <!-- Logo Grande -->
            <div class="mb-8">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #9333EA, #22C55E); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white" opacity="0.9"/>
                        <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-2">Fiscal Wallet</h1>
            <p class="text-gray-500 mb-12">Gestao Fiscal de Criptoativos</p>

            <div class="border-t border-b border-gray-200 py-8 mb-8 w-full" style="max-width: 400px;">
                <h2 class="text-2xl font-semibold text-gray-900 mb-2">Relatorio Fiscal Mensal</h2>
                <p class="text-xl text-primary font-medium">{{ $mes }}/{{ $ano }}</p>
            </div>

            <!-- Dados do Usuario -->
            <div class="text-left bg-gray-50 rounded-xl p-6 w-full" style="max-width: 400px;">
                <div class="mb-4">
                    <p class="text-xs text-gray-500">Nome do Contribuinte</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $usuario['nome'] }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-xs text-gray-500">CPF</p>
                    <p class="text-base font-medium text-gray-700">{{ $usuario['cpf'] }}</p>
                </div>
                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <p class="text-xs text-gray-500">Periodo</p>
                        <p class="text-sm font-medium text-gray-700">01/{{ $mes }}/{{ $ano }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Ate</p>
                        <p class="text-sm font-medium text-gray-700">{{ $dataFim }}</p>
                    </div>
                </div>
            </div>

            <!-- Resumo Executivo -->
            <div class="mt-8 grid gap-4 w-full" style="max-width: 500px; grid-template-columns: repeat(3, 1fr);">
                <div class="kpi-card text-center">
                    <p class="kpi-value text-primary">{{ $formatCurrency($resumo['patrimonioFinal']) }}</p>
                    <p class="kpi-label">Patrimonio Final</p>
                </div>
                <div class="kpi-card text-center">
                    <p class="kpi-value {{ $resumo['lucroRealizado'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $formatCurrency($resumo['lucroRealizado']) }}</p>
                    <p class="kpi-label">Lucro Realizado</p>
                </div>
                <div class="kpi-card text-center">
                    <p class="kpi-value">{{ $resumo['totalOperacoes'] }}</p>
                    <p class="kpi-label">Operacoes</p>
                </div>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 1, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 2: SUMARIO ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Sumario',
                'subtitle' => 'Indice do relatorio',
                'usuario' => $usuario,
                'periodo' => null
            ])

            <div class="border rounded-xl overflow-hidden">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60px;">Pag.</th>
                            <th>Secao</th>
                            <th style="width: 200px;">Descricao</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center font-medium">1</td>
                            <td class="font-medium">Capa</td>
                            <td class="text-gray-500">Identificacao e resumo executivo</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">2</td>
                            <td class="font-medium">Sumario</td>
                            <td class="text-gray-500">Indice do documento</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">3</td>
                            <td class="font-medium">Resumo Fiscal</td>
                            <td class="text-gray-500">KPIs e metricas principais</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">4</td>
                            <td class="font-medium">Evolucao Patrimonial</td>
                            <td class="text-gray-500">Variacao ao longo do periodo</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">5</td>
                            <td class="font-medium">Distribuicao por Ativo</td>
                            <td class="text-gray-500">Composicao do portfolio</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">6</td>
                            <td class="font-medium">Carteiras e Plataformas</td>
                            <td class="text-gray-500">Exchanges e wallets conectadas</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">7</td>
                            <td class="font-medium">Calculo de Lucro/Prejuizo</td>
                            <td class="text-gray-500">Detalhamento dos ganhos</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">8</td>
                            <td class="font-medium">Movimentacoes Nao Tributaveis</td>
                            <td class="text-gray-500">Transferencias e depositos</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">9</td>
                            <td class="font-medium">Lista de Operacoes</td>
                            <td class="text-gray-500">Principais transacoes do periodo</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">10</td>
                            <td class="font-medium">Saldo por Ativo</td>
                            <td class="text-gray-500">Posicao final consolidada</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">11</td>
                            <td class="font-medium">DARFs do Periodo</td>
                            <td class="text-gray-500">Impostos devidos e pagos</td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">12</td>
                            <td class="font-medium">Guia para IRPF</td>
                            <td class="text-gray-500">Orientacoes para declaracao</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Informacoes Legais -->
            <div class="mt-8 bg-gray-50 rounded-xl p-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Informacoes Importantes</h3>
                <ul class="text-xs text-gray-600 space-y-2">
                    <li>• Este relatorio foi gerado automaticamente com base nas operacoes importadas para a plataforma Fiscal Wallet.</li>
                    <li>• Os calculos seguem a metodologia de preco medio ponderado (PEPS) conforme orientacao da Receita Federal.</li>
                    <li>• Operacoes de venda de criptoativos com valor total mensal inferior a R$ 35.000,00 sao isentas de imposto de renda.</li>
                    <li>• Este documento nao substitui a orientacao de um profissional contabil ou tributario.</li>
                </ul>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 2, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 3: RESUMO FISCAL ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Resumo Fiscal',
                'subtitle' => 'Visao geral das metricas do periodo',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/{$mes}/{$ano}", 'fim' => $dataFim]
            ])

            <!-- KPIs Principais -->
            <div class="grid gap-4 mb-6" style="grid-template-columns: repeat(4, 1fr);">
                <div class="kpi-card">
                    <div class="flex items-center gap-2 mb-2">
                        <span style="width: 8px; height: 8px; background: #9333EA; border-radius: 50%;"></span>
                        <span class="text-xs text-gray-500">Patrimonio Inicial</span>
                    </div>
                    <p class="kpi-value">{{ $formatCurrency($resumo['patrimonioInicial']) }}</p>
                </div>
                <div class="kpi-card">
                    <div class="flex items-center gap-2 mb-2">
                        <span style="width: 8px; height: 8px; background: #22C55E; border-radius: 50%;"></span>
                        <span class="text-xs text-gray-500">Patrimonio Final</span>
                    </div>
                    <p class="kpi-value">{{ $formatCurrency($resumo['patrimonioFinal']) }}</p>
                </div>
                <div class="kpi-card">
                    <div class="flex items-center gap-2 mb-2">
                        <span style="width: 8px; height: 8px; background: {{ $resumo['variacaoPatrimonio'] >= 0 ? '#22C55E' : '#EF4444' }}; border-radius: 50%;"></span>
                        <span class="text-xs text-gray-500">Variacao</span>
                    </div>
                    <p class="kpi-value {{ $resumo['variacaoPatrimonio'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $resumo['variacaoPatrimonio'] >= 0 ? '+' : '' }}{{ number_format($resumo['variacaoPatrimonio'], 2, ',', '.') }}%</p>
                </div>
                <div class="kpi-card">
                    <div class="flex items-center gap-2 mb-2">
                        <span style="width: 8px; height: 8px; background: #6B7280; border-radius: 50%;"></span>
                        <span class="text-xs text-gray-500">Total Operacoes</span>
                    </div>
                    <p class="kpi-value">{{ $resumo['totalOperacoes'] }}</p>
                </div>
            </div>

            <!-- Detalhamento Financeiro -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Detalhamento Financeiro</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Descricao</th>
                            <th class="text-right">Valor (R$)</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total de Compras</td>
                            <td class="text-right font-medium">{{ $formatCurrency($detalhamento['totalCompras']) }}</td>
                            <td class="text-center"><span class="badge badge-gray">Aquisicao</span></td>
                        </tr>
                        <tr>
                            <td>Total de Vendas</td>
                            <td class="text-right font-medium">{{ $formatCurrency($detalhamento['totalVendas']) }}</td>
                            <td class="text-center"><span class="badge badge-primary">Alienacao</span></td>
                        </tr>
                        <tr>
                            <td>Custo de Aquisicao (vendas)</td>
                            <td class="text-right font-medium">{{ $formatCurrency($detalhamento['custoAquisicao']) }}</td>
                            <td class="text-center"><span class="badge badge-gray">Base</span></td>
                        </tr>
                        <tr>
                            <td>Lucro Realizado</td>
                            <td class="text-right font-medium {{ $detalhamento['lucroRealizado'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $formatCurrency($detalhamento['lucroRealizado']) }}</td>
                            <td class="text-center"><span class="badge {{ $detalhamento['lucroRealizado'] >= 0 ? 'badge-success' : 'badge-danger' }}">{{ $detalhamento['lucroRealizado'] >= 0 ? 'Lucro' : 'Prejuizo' }}</span></td>
                        </tr>
                        <tr>
                            <td>Taxas e Custos Operacionais</td>
                            <td class="text-right font-medium text-danger">-{{ $formatCurrency($detalhamento['taxas']) }}</td>
                            <td class="text-center"><span class="badge badge-warning">Despesa</span></td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="font-semibold">Lucro Liquido</td>
                            <td class="text-right font-bold text-lg {{ $detalhamento['lucroLiquido'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $formatCurrency($detalhamento['lucroLiquido']) }}</td>
                            <td class="text-center"><span class="badge {{ $detalhamento['lucroLiquido'] >= 0 ? 'badge-success' : 'badge-danger' }}">Final</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Situacao Tributaria -->
            <div class="border rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Situacao Tributaria</h3>
                </div>
                <div class="p-6">
                    <div class="grid gap-6" style="grid-template-columns: repeat(3, 1fr);">
                        <div class="text-center p-4 bg-{{ $tributacao['isento'] ? 'success' : 'danger' }}-light rounded-lg">
                            <p class="text-xs text-gray-600 mb-1">Total Vendido no Mes</p>
                            <p class="text-xl font-bold {{ $tributacao['isento'] ? 'text-success' : 'text-danger' }}">{{ $formatCurrency($tributacao['totalVendido']) }}</p>
                            <p class="text-xs {{ $tributacao['isento'] ? 'text-success' : 'text-danger' }} mt-1">{{ $tributacao['isento'] ? 'Abaixo do limite' : 'Acima do limite' }}</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-600 mb-1">Limite de Isencao</p>
                            <p class="text-xl font-bold text-gray-900">R$ 35.000,00</p>
                            <p class="text-xs text-gray-500 mt-1">Por mes</p>
                        </div>
                        <div class="text-center p-4 bg-{{ $tributacao['impostoDevido'] > 0 ? 'warning' : 'success' }}-light rounded-lg">
                            <p class="text-xs text-gray-600 mb-1">Imposto Devido</p>
                            <p class="text-xl font-bold {{ $tributacao['impostoDevido'] > 0 ? 'text-warning' : 'text-success' }}">{{ $formatCurrency($tributacao['impostoDevido']) }}</p>
                            <p class="text-xs {{ $tributacao['impostoDevido'] > 0 ? 'text-warning' : 'text-success' }} mt-1">{{ $tributacao['impostoDevido'] > 0 ? 'DARF necessario' : 'Isento' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 3, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 4: EVOLUCAO PATRIMONIAL ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Evolucao Patrimonial',
                'subtitle' => 'Variacao do patrimonio ao longo do periodo',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/{$mes}/{$ano}", 'fim' => $dataFim]
            ])

            <!-- Tabela de Evolucao -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <table>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th class="text-right">Valor (R$)</th>
                            <th class="text-right">Variacao</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evolucao as $item)
                        <tr>
                            <td class="font-medium">{{ $item['data'] }}</td>
                            <td class="text-right">{{ $formatCurrency($item['valor']) }}</td>
                            <td class="text-right {{ $item['variacao'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $item['variacao'] >= 0 ? '+' : '' }}{{ number_format($item['variacao'], 2, ',', '.') }}%</td>
                            <td class="text-center">
                                @if($item['variacao'] > 5)
                                    <span class="badge badge-success">Alta</span>
                                @elseif($item['variacao'] < -5)
                                    <span class="badge badge-danger">Queda</span>
                                @else
                                    <span class="badge badge-gray">Estavel</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Analise -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Analise do Periodo</h3>
                <div class="grid gap-4" style="grid-template-columns: repeat(2, 1fr);">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Maior Alta</p>
                        <p class="text-lg font-semibold text-success">+{{ number_format($analise['maiorAlta'], 2, ',', '.') }}%</p>
                        <p class="text-xs text-gray-500">em {{ $analise['dataMaiorAlta'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Maior Queda</p>
                        <p class="text-lg font-semibold text-danger">{{ number_format($analise['maiorQueda'], 2, ',', '.') }}%</p>
                        <p class="text-xs text-gray-500">em {{ $analise['dataMaiorQueda'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 4, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 5: DISTRIBUICAO POR ATIVO ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Distribuicao por Ativo',
                'subtitle' => 'Composicao do portfolio em {{ $dataFim }}',
                'usuario' => $usuario,
                'periodo' => null
            ])

            <!-- Tabela de Ativos -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <table>
                    <thead>
                        <tr>
                            <th>Ativo</th>
                            <th class="text-right">Quantidade</th>
                            <th class="text-right">Preco Medio</th>
                            <th class="text-right">Valor Total (R$)</th>
                            <th class="text-right">Participacao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ativos as $ativo)
                        <tr>
                            <td>
                                <div class="flex items-center gap-2">
                                    <span style="width: 10px; height: 10px; background: {{ $ativo['cor'] }}; border-radius: 50%;"></span>
                                    <span class="font-medium">{{ $ativo['simbolo'] }}</span>
                                    <span class="text-gray-400 text-xs">{{ $ativo['nome'] }}</span>
                                </div>
                            </td>
                            <td class="text-right">{{ number_format($ativo['quantidade'], 8, ',', '.') }}</td>
                            <td class="text-right">{{ $formatCurrency($ativo['precoMedio']) }}</td>
                            <td class="text-right font-medium">{{ $formatCurrency($ativo['valorTotal']) }}</td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <div style="width: 60px; height: 6px; background: #E5E7EB; border-radius: 3px; overflow: hidden;">
                                        <div style="width: {{ $ativo['participacao'] }}%; height: 100%; background: {{ $ativo['cor'] }};"></div>
                                    </div>
                                    <span class="text-sm">{{ number_format($ativo['participacao'], 1, ',', '.') }}%</span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td class="font-semibold">Total</td>
                            <td></td>
                            <td></td>
                            <td class="text-right font-bold">{{ $formatCurrency($totalAtivos) }}</td>
                            <td class="text-right font-semibold">100%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Legenda de Cores -->
            <div class="flex flex-wrap gap-4">
                @foreach($ativos as $ativo)
                <div class="flex items-center gap-2">
                    <span style="width: 12px; height: 12px; background: {{ $ativo['cor'] }}; border-radius: 3px;"></span>
                    <span class="text-xs text-gray-600">{{ $ativo['simbolo'] }} ({{ number_format($ativo['participacao'], 1, ',', '.') }}%)</span>
                </div>
                @endforeach
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 5, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 6: CARTEIRAS E PLATAFORMAS ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Carteiras e Plataformas',
                'subtitle' => 'Exchanges e wallets conectadas',
                'usuario' => $usuario,
                'periodo' => null
            ])

            <!-- Tabela de Carteiras -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <table>
                    <thead>
                        <tr>
                            <th>Plataforma</th>
                            <th>Tipo</th>
                            <th class="text-center">Status</th>
                            <th class="text-right">N° Transacoes</th>
                            <th class="text-right">Saldo (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carteiras as $carteira)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div style="width: 32px; height: 32px; background: {{ $carteira['cor'] }}; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <span class="text-white text-xs font-bold">{{ substr($carteira['nome'], 0, 2) }}</span>
                                    </div>
                                    <span class="font-medium">{{ $carteira['nome'] }}</span>
                                </div>
                            </td>
                            <td class="text-gray-600">{{ $carteira['tipo'] }}</td>
                            <td class="text-center">
                                <span class="badge badge-{{ $carteira['status'] === 'conectada' ? 'success' : ($carteira['status'] === 'pendente' ? 'warning' : 'gray') }}">
                                    {{ ucfirst($carteira['status']) }}
                                </span>
                            </td>
                            <td class="text-right">{{ $carteira['transacoes'] }}</td>
                            <td class="text-right font-medium">{{ $formatCurrency($carteira['saldo']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td class="font-semibold" colspan="3">Total</td>
                            <td class="text-right font-semibold">{{ array_sum(array_column($carteiras, 'transacoes')) }}</td>
                            <td class="text-right font-bold">{{ $formatCurrency(array_sum(array_column($carteiras, 'saldo'))) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @if(count($alertas) > 0)
            <!-- Alertas -->
            <div class="bg-warning-light rounded-xl p-4">
                <h3 class="text-sm font-semibold text-warning mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Alertas de Sincronizacao
                </h3>
                <ul class="text-xs text-gray-600 space-y-1">
                    @foreach($alertas as $alerta)
                    <li>• {{ $alerta }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        @include('reports.partials.footer', ['page' => 6, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 7: CALCULO DE LUCRO/PREJUIZO ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Calculo de Lucro/Prejuizo',
                'subtitle' => 'Detalhamento dos ganhos realizados',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/{$mes}/{$ano}", 'fim' => $dataFim]
            ])

            <!-- Resumo -->
            <div class="grid gap-4 mb-6" style="grid-template-columns: repeat(4, 1fr);">
                <div class="kpi-card">
                    <p class="text-xs text-gray-500 mb-1">Total Vendido</p>
                    <p class="text-lg font-bold">{{ $formatCurrency($lucros['totalVendido']) }}</p>
                </div>
                <div class="kpi-card">
                    <p class="text-xs text-gray-500 mb-1">Lucro Bruto</p>
                    <p class="text-lg font-bold {{ $lucros['lucroBruto'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $formatCurrency($lucros['lucroBruto']) }}</p>
                </div>
                <div class="kpi-card">
                    <p class="text-xs text-gray-500 mb-1">Tributavel</p>
                    <p class="text-lg font-bold text-primary">{{ $formatCurrency($lucros['tributavel']) }}</p>
                </div>
                <div class="kpi-card">
                    <p class="text-xs text-gray-500 mb-1">Isento</p>
                    <p class="text-lg font-bold text-success">{{ $formatCurrency($lucros['isento']) }}</p>
                </div>
            </div>

            <!-- Detalhamento por Operacao -->
            <div class="border rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Principais Realizacoes</h3>
                </div>
                <table class="text-xs">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Ativo</th>
                            <th class="text-right">Qtd</th>
                            <th class="text-right">Preco Venda</th>
                            <th class="text-right">Custo Medio</th>
                            <th class="text-right">Lucro/Prej.</th>
                            <th class="text-center">Tributacao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($realizacoes as $op)
                        <tr>
                            <td>{{ $op['data'] }}</td>
                            <td class="font-medium">{{ $op['ativo'] }}</td>
                            <td class="text-right">{{ number_format($op['quantidade'], 6, ',', '.') }}</td>
                            <td class="text-right">{{ $formatCurrency($op['precoVenda']) }}</td>
                            <td class="text-right">{{ $formatCurrency($op['custoMedio']) }}</td>
                            <td class="text-right font-medium {{ $op['lucro'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $formatCurrency($op['lucro']) }}</td>
                            <td class="text-center">
                                <span class="badge badge-{{ $op['tributavel'] ? 'warning' : 'success' }}">
                                    {{ $op['tributavel'] ? 'Tributavel' : 'Isento' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 7, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 8: MOVIMENTACOES NAO TRIBUTAVEIS ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Movimentacoes Nao Tributaveis',
                'subtitle' => 'Transferencias, depositos e saques',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/{$mes}/{$ano}", 'fim' => $dataFim]
            ])

            <!-- Tabela -->
            <div class="border rounded-xl overflow-hidden">
                <table class="text-xs">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Moeda</th>
                            <th class="text-right">Quantidade</th>
                            <th>Origem</th>
                            <th>Destino</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movimentacoes as $mov)
                        <tr>
                            <td>{{ $mov['data'] }}</td>
                            <td>
                                <span class="badge badge-{{ $mov['tipo'] === 'deposito' ? 'success' : ($mov['tipo'] === 'saque' ? 'danger' : 'gray') }}">
                                    {{ ucfirst($mov['tipo']) }}
                                </span>
                            </td>
                            <td class="font-medium">{{ $mov['moeda'] }}</td>
                            <td class="text-right">{{ number_format($mov['quantidade'], 8, ',', '.') }}</td>
                            <td class="text-gray-600">{{ $mov['origem'] }}</td>
                            <td class="text-gray-600">{{ $mov['destino'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Nota -->
            <div class="mt-6 bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-600">
                    <strong>Nota:</strong> Transferencias entre carteiras proprias, depositos e saques nao sao fatos geradores de imposto de renda. Porem, devem ser declarados na ficha de Bens e Direitos do IRPF quando o saldo total em criptoativos ultrapassar R$ 5.000,00.
                </p>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 8, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 9: LISTA DE OPERACOES ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Lista de Operacoes',
                'subtitle' => 'Principais transacoes do periodo',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/{$mes}/{$ano}", 'fim' => $dataFim]
            ])

            <!-- Tabela -->
            <div class="border rounded-xl overflow-hidden">
                <table class="text-xs">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Moeda</th>
                            <th class="text-right">Qtd</th>
                            <th class="text-right">Preco Unit.</th>
                            <th class="text-right">Total</th>
                            <th class="text-right">Lucro/Prej.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($operacoes as $op)
                        <tr>
                            <td class="text-gray-500">#{{ $op['id'] }}</td>
                            <td>{{ $op['data'] }}</td>
                            <td>
                                <span class="badge badge-{{ $op['tipo'] === 'compra' ? 'success' : 'danger' }}">
                                    {{ ucfirst($op['tipo']) }}
                                </span>
                            </td>
                            <td class="font-medium">{{ $op['moeda'] }}</td>
                            <td class="text-right">{{ number_format($op['quantidade'], 6, ',', '.') }}</td>
                            <td class="text-right">{{ $formatCurrency($op['precoUnitario']) }}</td>
                            <td class="text-right font-medium">{{ $formatCurrency($op['total']) }}</td>
                            <td class="text-right {{ $op['lucro'] >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $op['tipo'] === 'venda' ? $formatCurrency($op['lucro']) : '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="text-xs text-gray-500 mt-4 text-center">
                Exibindo as {{ count($operacoes) }} principais operacoes. Total de operacoes no periodo: {{ $totalOperacoesPeriodo }}
            </p>
        </div>

        @include('reports.partials.footer', ['page' => 9, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 10: SALDO POR ATIVO ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Saldo por Ativo',
                'subtitle' => 'Posicao final consolidada em ' . $dataFim,
                'usuario' => $usuario,
                'periodo' => null
            ])

            <!-- Tabela -->
            <div class="border rounded-xl overflow-hidden">
                <table>
                    <thead>
                        <tr>
                            <th>Ativo</th>
                            <th class="text-right">Quantidade</th>
                            <th class="text-right">Custo Medio</th>
                            <th class="text-right">Valor Mercado</th>
                            <th class="text-right">Valor Total</th>
                            <th class="text-right">Var.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($saldos as $saldo)
                        <tr>
                            <td>
                                <div class="flex items-center gap-2">
                                    <span style="width: 10px; height: 10px; background: {{ $saldo['cor'] }}; border-radius: 50%;"></span>
                                    <span class="font-medium">{{ $saldo['simbolo'] }}</span>
                                </div>
                            </td>
                            <td class="text-right">{{ number_format($saldo['quantidade'], 8, ',', '.') }}</td>
                            <td class="text-right">{{ $formatCurrency($saldo['custoMedio']) }}</td>
                            <td class="text-right">{{ $formatCurrency($saldo['valorMercado']) }}</td>
                            <td class="text-right font-medium">{{ $formatCurrency($saldo['valorTotal']) }}</td>
                            <td class="text-right {{ $saldo['variacao'] >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $saldo['variacao'] >= 0 ? '+' : '' }}{{ number_format($saldo['variacao'], 2, ',', '.') }}%
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td class="font-semibold" colspan="4">Total</td>
                            <td class="text-right font-bold">{{ $formatCurrency($totalSaldos) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 10, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 11: DARFS DO PERIODO ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'DARFs do Periodo',
                'subtitle' => 'Impostos devidos e pagos',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/01/{$ano}", 'fim' => "31/12/{$ano}"]
            ])

            <!-- Tabela -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <table>
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th class="text-right">Total Vendido</th>
                            <th class="text-right">Ganho Capital</th>
                            <th class="text-right">Imposto Devido</th>
                            <th class="text-center">Situacao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($darfs as $darf)
                        <tr>
                            <td class="font-medium">{{ $darf['mes'] }}/{{ $ano }}</td>
                            <td class="text-right">{{ $formatCurrency($darf['totalVendido']) }}</td>
                            <td class="text-right {{ $darf['ganhoCapital'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $formatCurrency($darf['ganhoCapital']) }}</td>
                            <td class="text-right font-medium">{{ $formatCurrency($darf['impostoDevido']) }}</td>
                            <td class="text-center">
                                <span class="badge badge-{{ $darf['situacao'] === 'pago' ? 'success' : ($darf['situacao'] === 'isento' ? 'gray' : 'warning') }}">
                                    {{ ucfirst($darf['situacao']) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td class="font-semibold">Total</td>
                            <td class="text-right font-semibold">{{ $formatCurrency(array_sum(array_column($darfs, 'totalVendido'))) }}</td>
                            <td class="text-right font-semibold">{{ $formatCurrency(array_sum(array_column($darfs, 'ganhoCapital'))) }}</td>
                            <td class="text-right font-bold text-primary">{{ $formatCurrency(array_sum(array_column($darfs, 'impostoDevido'))) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Legenda -->
            <div class="flex gap-6">
                <div class="flex items-center gap-2">
                    <span class="badge badge-success">Pago</span>
                    <span class="text-xs text-gray-600">DARF quitado</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="badge badge-warning">Pendente</span>
                    <span class="text-xs text-gray-600">Aguardando pagamento</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="badge badge-gray">Isento</span>
                    <span class="text-xs text-gray-600">Vendas abaixo de R$ 35k</span>
                </div>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 11, 'totalPages' => $totalPages])
    </div>

    {{-- ==================== PAGINA 12: GUIA PARA IRPF ==================== --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Guia para IRPF',
                'subtitle' => 'Orientacoes para declaracao anual',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/01/{$ano}", 'fim' => "31/12/{$ano}"]
            ])

            <!-- Bens e Direitos -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Ficha 4 - Bens e Direitos</h3>
                    <p class="text-xs text-gray-500">Grupo 08 - Criptoativos</p>
                </div>
                <table class="text-xs">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Discriminacao</th>
                            <th class="text-right">Saldo em 31/12/{{ $ano - 1 }}</th>
                            <th class="text-right">Saldo em 31/12/{{ $ano }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($irpf['bensEDireitos'] as $bem)
                        <tr>
                            <td class="font-medium">{{ $bem['codigo'] }}</td>
                            <td class="text-gray-600">{{ $bem['discriminacao'] }}</td>
                            <td class="text-right">{{ $formatCurrency($bem['saldoAnterior']) }}</td>
                            <td class="text-right font-medium">{{ $formatCurrency($bem['saldoAtual']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Rendimentos Isentos -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Rendimentos Isentos e Nao Tributaveis</h3>
                    <p class="text-xs text-gray-500">Alienacao de bens de pequeno valor</p>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Total de vendas em meses com alienacao inferior a R$ 35.000,00</p>
                            <p class="text-xs text-gray-400 mt-1">Codigo 05 - Ganho de capital na alienacao de bem de pequeno valor</p>
                        </div>
                        <p class="text-xl font-bold text-success">{{ $formatCurrency($irpf['rendimentosIsentos']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Ganhos de Capital -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Ganhos de Capital</h3>
                    <p class="text-xs text-gray-500">Para preenchimento no programa GCAP</p>
                </div>
                <div class="p-6">
                    <div class="grid gap-4" style="grid-template-columns: repeat(3, 1fr);">
                        <div>
                            <p class="text-xs text-gray-500">Total de Ganhos Tributaveis</p>
                            <p class="text-lg font-bold text-primary">{{ $formatCurrency($irpf['ganhosTributaveis']) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Imposto Devido (15%)</p>
                            <p class="text-lg font-bold text-warning">{{ $formatCurrency($irpf['impostoDevido']) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Imposto Pago</p>
                            <p class="text-lg font-bold text-success">{{ $formatCurrency($irpf['impostoPago']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Avisos -->
            <div class="bg-warning-light rounded-xl p-4">
                <h3 class="text-sm font-semibold text-warning mb-2">Avisos Legais</h3>
                <ul class="text-xs text-gray-600 space-y-1">
                    <li>• Este documento e meramente informativo e nao substitui orientacao profissional.</li>
                    <li>• Os valores apresentados sao baseados nas operacoes importadas para a plataforma.</li>
                    <li>• Recomenda-se a conferencia com um contador antes da declaracao oficial.</li>
                    <li>• A Fiscal Wallet nao se responsabiliza por erros na declaracao.</li>
                </ul>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 12, 'totalPages' => $totalPages, 'showDisclaimer' => false])
    </div>

</x-reports.layouts.print>
