<x-reports.layouts.print title="Exportacao IRPF {{ $ano }}">
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Dados para Declaracao IRPF ' . $ano,
                'subtitle' => 'Copie os dados abaixo para sua declaracao',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/01/{$ano}", 'fim' => "31/12/{$ano}"]
            ])

            <!-- Instrucoes -->
            <div class="bg-primary-light rounded-xl p-4 mb-6">
                <h3 class="text-sm font-semibold text-primary mb-2">Como utilizar este documento</h3>
                <ol class="text-xs text-gray-700 space-y-1">
                    <li>1. Abra o programa IRPF {{ $ano + 1 }} da Receita Federal</li>
                    <li>2. Navegue ate a ficha correspondente (Bens e Direitos ou Rendimentos)</li>
                    <li>3. Copie os valores e discriminacoes abaixo para os campos corretos</li>
                    <li>4. Confira todos os valores antes de transmitir a declaracao</li>
                </ol>
            </div>

            <!-- Bens e Direitos -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-gray-900 px-6 py-4 text-white">
                    <h2 class="text-base font-semibold">FICHA 4 - BENS E DIREITOS</h2>
                    <p class="text-xs text-gray-300 mt-1">Grupo 08 - Criptoativos</p>
                </div>

                @foreach($bensEDireitos as $index => $bem)
                <div class="px-6 py-4 {{ $index > 0 ? 'border-t' : '' }}">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <span class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900">
                                <span class="bg-primary text-white text-xs px-2 py-0.5 rounded">{{ $bem['codigo'] }}</span>
                                {{ $bem['nome'] }}
                            </span>
                        </div>
                        <span class="text-xs text-gray-500">Item {{ $index + 1 }}</span>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 mb-3">
                        <p class="text-xs text-gray-500 mb-1">Discriminacao (copie este texto):</p>
                        <p class="text-sm text-gray-800 font-mono bg-white p-3 rounded border border-gray-200">{{ $bem['discriminacao'] }}</p>
                    </div>

                    <div class="grid gap-4" style="grid-template-columns: 1fr 1fr;">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">Situacao em 31/12/{{ $ano - 1 }}</p>
                            <p class="text-lg font-bold text-gray-900">{{ $formatCurrency($bem['saldoAnterior']) }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">Situacao em 31/12/{{ $ano }}</p>
                            <p class="text-lg font-bold text-primary">{{ $formatCurrency($bem['saldoAtual']) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Totais -->
                <div class="px-6 py-4 bg-gray-50 border-t">
                    <div class="grid gap-4" style="grid-template-columns: 1fr 1fr;">
                        <div>
                            <p class="text-xs text-gray-500">Total em 31/12/{{ $ano - 1 }}</p>
                            <p class="text-xl font-bold text-gray-900">{{ $formatCurrency($totalAnterior) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Total em 31/12/{{ $ano }}</p>
                            <p class="text-xl font-bold text-primary">{{ $formatCurrency($totalAtual) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rendimentos Isentos -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-success px-6 py-4 text-white">
                    <h2 class="text-base font-semibold">RENDIMENTOS ISENTOS E NAO TRIBUTAVEIS</h2>
                    <p class="text-xs text-green-100 mt-1">Codigo 05 - Ganho de capital na alienacao de bem de pequeno valor</p>
                </div>

                <div class="px-6 py-4">
                    <div class="bg-success-light rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-700">Lucros em meses com vendas inferiores a R$ 35.000,00</p>
                                <p class="text-xs text-gray-500 mt-1">Total de {{ $mesesIsentos }} mes(es) com isencao</p>
                            </div>
                            <p class="text-2xl font-bold text-success">{{ $formatCurrency($rendimentosIsentos) }}</p>
                        </div>
                    </div>

                    @if($rendimentosIsentos > 0)
                    <div class="mt-4 bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-500 mb-2">Detalhamento por mes:</p>
                        <div class="grid gap-2" style="grid-template-columns: repeat(4, 1fr);">
                            @foreach($detalhamentoIsentos as $item)
                            <div class="text-xs">
                                <span class="text-gray-600">{{ $item['mes'] }}:</span>
                                <span class="font-medium {{ $item['valor'] > 0 ? 'text-success' : 'text-gray-400' }}">{{ $formatCurrency($item['valor']) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Ganhos de Capital Tributaveis -->
            @if($ganhosTributaveis > 0)
            <div class="border rounded-xl overflow-hidden">
                <div class="bg-warning px-6 py-4 text-white">
                    <h2 class="text-base font-semibold">GANHOS DE CAPITAL TRIBUTAVEIS</h2>
                    <p class="text-xs text-yellow-100 mt-1">Preencher no programa GCAP da Receita Federal</p>
                </div>

                <div class="px-6 py-4">
                    <div class="bg-warning-light rounded-lg p-4 mb-4">
                        <div class="grid gap-4" style="grid-template-columns: repeat(3, 1fr);">
                            <div>
                                <p class="text-xs text-gray-600">Ganho Tributavel</p>
                                <p class="text-xl font-bold text-warning">{{ $formatCurrency($ganhosTributaveis) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Imposto Devido (15%)</p>
                                <p class="text-xl font-bold text-gray-900">{{ $formatCurrency($impostoDevido) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">DARFs Pagos</p>
                                <p class="text-xl font-bold text-success">{{ $formatCurrency($impostoPago) }}</p>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-gray-600 mb-3">Meses com ganhos tributaveis:</p>
                    <table class="text-xs">
                        <thead>
                            <tr>
                                <th>Mes</th>
                                <th class="text-right">Total Vendido</th>
                                <th class="text-right">Ganho</th>
                                <th class="text-right">Imposto</th>
                                <th class="text-center">DARF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mesesTributaveis as $mes)
                            <tr>
                                <td class="font-medium">{{ $mes['mes'] }}/{{ $ano }}</td>
                                <td class="text-right">{{ $formatCurrency($mes['totalVendido']) }}</td>
                                <td class="text-right text-warning">{{ $formatCurrency($mes['ganho']) }}</td>
                                <td class="text-right">{{ $formatCurrency($mes['imposto']) }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $mes['pago'] ? 'success' : 'warning' }}">
                                        {{ $mes['pago'] ? 'Pago' : 'Pendente' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        @include('reports.partials.footer', ['page' => 1, 'totalPages' => 2])
    </div>

    {{-- PAGINA 2: CODIGOS E INSTRUCOES --}}
    <div class="page">
        <div class="page-content">
            @include('reports.partials.header', [
                'title' => 'Codigos e Instrucoes',
                'subtitle' => 'Referencia rapida para o programa IRPF',
                'usuario' => $usuario,
                'periodo' => null
            ])

            <!-- Tabela de Codigos -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Codigos de Bens - Grupo 08 (Criptoativos)</h3>
                </div>
                <table class="text-xs">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Codigo</th>
                            <th>Descricao</th>
                            <th style="width: 200px;">Quando usar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge badge-primary">01</span></td>
                            <td>Bitcoin (BTC)</td>
                            <td class="text-gray-500">Exclusivo para Bitcoin</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-primary">02</span></td>
                            <td>Outras criptomoedas (Altcoins)</td>
                            <td class="text-gray-500">ETH, XRP, LTC, etc.</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-primary">03</span></td>
                            <td>Stablecoins</td>
                            <td class="text-gray-500">USDT, USDC, DAI, etc.</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-primary">10</span></td>
                            <td>NFTs (Tokens Nao Fungiveis)</td>
                            <td class="text-gray-500">Arte digital, colecionaveis</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-primary">99</span></td>
                            <td>Outros criptoativos</td>
                            <td class="text-gray-500">Tokens DeFi, utility tokens</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modelo de Discriminacao -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Modelo de Discriminacao</h3>
                </div>
                <div class="p-6">
                    <div class="bg-gray-100 rounded-lg p-4 font-mono text-xs text-gray-700">
                        <p>[QUANTIDADE] [SIMBOLO] ([NOME COMPLETO]) custodiado na exchange [NOME DA EXCHANGE] ou em carteira propria. Custo medio de aquisicao: R$ [VALOR]. Quantidade adquirida ao longo de [ANO].</p>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">
                        <strong>Exemplo:</strong> 0,5 BTC (Bitcoin) custodiado na exchange Binance. Custo medio de aquisicao: R$ 150.000,00. Quantidade adquirida ao longo de 2023.
                    </p>
                </div>
            </div>

            <!-- Aliquotas -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Aliquotas de Ganho de Capital</h3>
                </div>
                <table class="text-xs">
                    <thead>
                        <tr>
                            <th>Faixa de Ganho</th>
                            <th class="text-center">Aliquota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ate R$ 5.000.000,00</td>
                            <td class="text-center font-semibold">15%</td>
                        </tr>
                        <tr>
                            <td>De R$ 5.000.000,01 ate R$ 10.000.000,00</td>
                            <td class="text-center font-semibold">17,5%</td>
                        </tr>
                        <tr>
                            <td>De R$ 10.000.000,01 ate R$ 30.000.000,00</td>
                            <td class="text-center font-semibold">20%</td>
                        </tr>
                        <tr>
                            <td>Acima de R$ 30.000.000,00</td>
                            <td class="text-center font-semibold">22,5%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Lembretes -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Lembretes Importantes</h3>
                <ul class="text-xs text-gray-600 space-y-2">
                    <li class="flex items-start gap-2">
                        <span class="text-success">✓</span>
                        Vendas mensais ate R$ 35.000 sao isentas de imposto, mas os bens devem ser declarados.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-success">✓</span>
                        Patrimonio acima de R$ 5.000 em cripto deve ser declarado na ficha de Bens e Direitos.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-success">✓</span>
                        O imposto sobre ganho de capital deve ser pago ate o ultimo dia util do mes seguinte a venda.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-warning">!</span>
                        Prejuizos podem ser compensados com lucros futuros do mesmo tipo de ativo.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-danger">✗</span>
                        Nao declarar criptoativos pode resultar em multa de 1,5% ao mes sobre o valor nao declarado.
                    </li>
                </ul>
            </div>
        </div>

        @include('reports.partials.footer', ['page' => 2, 'totalPages' => 2])
    </div>
</x-reports.layouts.print>
