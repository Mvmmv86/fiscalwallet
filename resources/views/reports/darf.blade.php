<x-reports.layouts.print title="DARF - {{ $mes }}/{{ $ano }}">
    <div class="page">
        <div class="page-content">
            <!-- Header do documento -->
            @include('reports.partials.header', [
                'title' => 'DARF - Documento de Arrecadacao de Receitas Federais',
                'subtitle' => 'Ganho de Capital - Alienacao de Bens e Direitos',
                'usuario' => $usuario,
                'periodo' => ['inicio' => "01/{$mes}/{$ano}", 'fim' => $dataFim]
            ])

            <!-- Alerta informativo -->
            <div class="bg-warning-light rounded-lg p-4 mb-6 flex items-start gap-3">
                <svg class="w-5 h-5 text-warning flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-warning">Atencao</p>
                    <p class="text-xs text-gray-600 mt-1">Este documento e apenas uma previa para conferencia. Para efetuar o pagamento, acesse o sistema Sicalc da Receita Federal ou utilize o codigo de barras gerado oficialmente.</p>
                </div>
            </div>

            <!-- Card Principal do DARF -->
            <div class="border rounded-xl overflow-hidden mb-6">
                <!-- Header do Card -->
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">DARF - Receita Federal do Brasil</h2>
                            <p class="text-xs text-gray-500">Documento de Arrecadacao de Receitas Federais</p>
                        </div>
                        <div class="text-right">
                            <span class="badge badge-{{ $dados['situacao'] === 'devido' ? 'danger' : ($dados['situacao'] === 'pago' ? 'success' : 'gray') }}">
                                {{ ucfirst($dados['situacao']) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Dados do Contribuinte -->
                <div class="px-6 py-4 border-b">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Dados do Contribuinte</h3>
                    <div class="grid" style="grid-template-columns: 2fr 1fr;">
                        <div>
                            <p class="text-xs text-gray-500">Nome</p>
                            <p class="text-sm font-medium text-gray-900">{{ $usuario['nome'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">CPF</p>
                            <p class="text-sm font-medium text-gray-900">{{ $usuario['cpf'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dados do Pagamento -->
                <div class="px-6 py-4 border-b">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Dados do Pagamento</h3>
                    <div class="grid gap-4" style="grid-template-columns: repeat(3, 1fr);">
                        <div>
                            <p class="text-xs text-gray-500">Codigo da Receita</p>
                            <p class="text-sm font-medium text-gray-900">4600</p>
                            <p class="text-xs text-gray-400">Ganho de Capital - Alienacao</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Periodo de Apuracao</p>
                            <p class="text-sm font-medium text-gray-900">{{ $mes }}/{{ $ano }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Data de Vencimento</p>
                            <p class="text-sm font-medium text-gray-900">{{ $dataVencimento }}</p>
                        </div>
                    </div>
                </div>

                <!-- Valores -->
                <div class="px-6 py-4 border-b">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Valores</h3>
                    <table class="w-full">
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 text-sm text-gray-600">Base de Calculo (Ganho de Capital)</td>
                                <td class="py-3 text-sm font-medium text-gray-900 text-right">{{ $formatCurrency($dados['baseCalculo']) }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 text-sm text-gray-600">Aliquota Aplicada</td>
                                <td class="py-3 text-sm font-medium text-gray-900 text-right">{{ $dados['aliquota'] }}%</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 text-sm text-gray-600">Valor Principal</td>
                                <td class="py-3 text-sm font-medium text-gray-900 text-right">{{ $formatCurrency($dados['valorPrincipal']) }}</td>
                            </tr>
                            @if($dados['multa'] > 0)
                            <tr class="border-b border-gray-100">
                                <td class="py-3 text-sm text-danger">Multa (atraso)</td>
                                <td class="py-3 text-sm font-medium text-danger text-right">{{ $formatCurrency($dados['multa']) }}</td>
                            </tr>
                            @endif
                            @if($dados['juros'] > 0)
                            <tr class="border-b border-gray-100">
                                <td class="py-3 text-sm text-danger">Juros SELIC</td>
                                <td class="py-3 text-sm font-medium text-danger text-right">{{ $formatCurrency($dados['juros']) }}</td>
                            </tr>
                            @endif
                            <tr class="bg-gray-50">
                                <td class="py-4 text-base font-semibold text-gray-900">VALOR TOTAL</td>
                                <td class="py-4 text-xl font-bold text-primary text-right">{{ $formatCurrency($dados['valorTotal']) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Codigo de Barras (simulado) -->
                <div class="px-6 py-4 border-b bg-gray-50">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Codigo de Barras</h3>
                    <div class="bg-white border rounded-lg p-4 text-center">
                        <!-- Barras simuladas -->
                        <div class="flex justify-center gap-px mb-3">
                            @for($i = 0; $i < 60; $i++)
                                <div style="width: {{ rand(1, 3) }}px; height: 40px; background: black;"></div>
                                <div style="width: {{ rand(1, 2) }}px; height: 40px; background: white;"></div>
                            @endfor
                        </div>
                        <p class="text-xs font-mono text-gray-600">{{ $dados['codigoBarras'] ?? '85890000000-0 00000000000-0 00000000000-0 00000000000-0' }}</p>
                        <p class="text-xs text-gray-400 mt-2">* Codigo ilustrativo - Gere o codigo oficial no Sicalc</p>
                    </div>
                </div>

                <!-- Instrucoes -->
                <div class="px-6 py-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Instrucoes de Pagamento</h3>
                    <div class="grid gap-4" style="grid-template-columns: 1fr 1fr;">
                        <div>
                            <p class="text-xs font-medium text-gray-700 mb-2">Como pagar:</p>
                            <ul class="text-xs text-gray-600 space-y-1">
                                <li>1. Acesse o Sicalc da Receita Federal</li>
                                <li>2. Selecione "DARF Comum"</li>
                                <li>3. Informe o codigo 4600</li>
                                <li>4. Preencha os dados e emita</li>
                            </ul>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-700 mb-2">Onde pagar:</p>
                            <ul class="text-xs text-gray-600 space-y-1">
                                <li>- Internet Banking</li>
                                <li>- Aplicativo do banco</li>
                                <li>- Agencias bancarias</li>
                                <li>- Casas lotericas (ate R$ 1.000)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumo das Operacoes -->
            <div class="border rounded-xl overflow-hidden avoid-break">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h3 class="text-sm font-semibold text-gray-900">Resumo das Operacoes - {{ $mes }}/{{ $ano }}</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="grid gap-6" style="grid-template-columns: repeat(4, 1fr);">
                        <div>
                            <p class="text-xs text-gray-500">Total Vendido</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $formatCurrency($resumo['totalVendido']) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Custo de Aquisicao</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $formatCurrency($resumo['custoAquisicao']) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Ganho de Capital</p>
                            <p class="text-lg font-semibold {{ $resumo['ganhoCapital'] >= 0 ? 'text-success' : 'text-danger' }}">{{ $formatCurrency($resumo['ganhoCapital']) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">N° de Operacoes</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $resumo['numOperacoes'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('reports.partials.footer', ['page' => 1, 'totalPages' => 1])
    </div>
</x-reports.layouts.print>
