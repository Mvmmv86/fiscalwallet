<x-layouts.dashboard title="Operações">
    <div x-data="{
        showAddModal: false,
        showEditModal: false,
        showDetailsModal: false,
        showFilterModal: false,
        showActionsMenu: null,
        currentOperation: null,
    }" @click.away="showActionsMenu = null">

        <!-- Header com botões de ação -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition-colors">
                    <x-icons.arrow-left class="w-4 h-4 text-gray-600" />
                </a>
                <div class="text-sm text-gray-500">
                    Total: <span class="font-medium text-gray-900">{{ number_format($summary['total_operations']) }}</span> operações
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-ui.button variant="primary" size="md" @click="showAddModal = true">
                    Adicionar operação
                </x-ui.button>
                <x-ui.button variant="secondary" size="md" onclick="window.location.href='{{ route('carteiras') }}'">
                    Sincronizar operações
                </x-ui.button>
            </div>
        </div>

        <!-- Barra de filtros -->
        <form method="GET" class="flex flex-col lg:flex-row lg:items-center gap-4 mb-6">
            <!-- Campo de pesquisa -->
            <div class="relative flex-1 max-w-xs">
                <input
                    type="text"
                    name="asset"
                    value="{{ request('asset') }}"
                    placeholder="Pesquisar por ativo..."
                    class="w-full pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100"
                />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <x-icons.search class="w-4 h-4 text-gray-400" />
                </div>
            </div>

            <!-- Dropdown de carteiras -->
            <div class="relative">
                <select name="wallet_id" onchange="this.form.submit()" class="appearance-none px-4 py-2.5 pr-10 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 cursor-pointer">
                    <option value="">Todas as carteiras</option>
                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet->id }}" {{ request('wallet_id') == $wallet->id ? 'selected' : '' }}>{{ $wallet->name }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <x-icons.chevron-down class="w-4 h-4 text-gray-400" />
                </div>
            </div>

            <!-- Dropdown de tipos -->
            <div class="relative">
                <select name="type" onchange="this.form.submit()" class="appearance-none px-4 py-2.5 pr-10 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 cursor-pointer">
                    <option value="">Todos os tipos</option>
                    <option value="buy" {{ request('type') == 'buy' ? 'selected' : '' }}>Compra</option>
                    <option value="sell" {{ request('type') == 'sell' ? 'selected' : '' }}>Venda</option>
                    <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Depósito</option>
                    <option value="withdrawal" {{ request('type') == 'withdrawal' ? 'selected' : '' }}>Saque</option>
                    <option value="transfer_in" {{ request('type') == 'transfer_in' ? 'selected' : '' }}>Transf. Entrada</option>
                    <option value="transfer_out" {{ request('type') == 'transfer_out' ? 'selected' : '' }}>Transf. Saída</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <x-icons.chevron-down class="w-4 h-4 text-gray-400" />
                </div>
            </div>

            <button type="submit" class="px-4 py-2.5 bg-primary-600 text-white rounded-lg text-sm hover:bg-primary-700 transition-colors">
                Filtrar
            </button>

            @if(request()->hasAny(['wallet_id', 'type', 'asset']))
                <a href="{{ route('operacoes') }}" class="px-4 py-2.5 text-gray-600 text-sm hover:text-gray-900 transition-colors">
                    Limpar filtros
                </a>
            @endif
        </form>

        <!-- Tabela de operações -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'executed_at', 'dir' => request('dir') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-1 hover:text-gray-700">
                                    Data
                                    @if(request('sort', 'executed_at') == 'executed_at')
                                        <svg class="w-3 h-3 {{ request('dir', 'desc') == 'asc' ? 'rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cripto</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carteira</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrada</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saída</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total BRL</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taxa</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lucro/Prejuízo</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($operations as $operation)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3">
                                    @switch($operation->type)
                                        @case('buy')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Compra</span>
                                            @break
                                        @case('sell')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">Venda</span>
                                            @break
                                        @case('deposit')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">Depósito</span>
                                            @break
                                        @case('withdrawal')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">Saque</span>
                                            @break
                                        @case('transfer_in')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">Transf. Entrada</span>
                                            @break
                                        @case('transfer_out')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-700">Transf. Saída</span>
                                            @break
                                        @default
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">{{ $operation->type }}</span>
                                    @endswitch
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $operation->executed_at?->format('d/m/Y H:i') ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700 font-medium">
                                    @if($operation->to_asset && $operation->to_asset !== 'BRL')
                                        {{ $operation->to_asset }}
                                    @elseif($operation->from_asset && $operation->from_asset !== 'BRL')
                                        {{ $operation->from_asset }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $operation->wallet?->name ?? 'Binance' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    @if($operation->to_amount)
                                        <span class="text-green-600">+{{ number_format($operation->to_amount, 8) }}</span>
                                        <span class="text-gray-400 text-xs">{{ $operation->to_asset }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    @if($operation->from_amount)
                                        <span class="text-red-600">-{{ number_format($operation->from_amount, 8) }}</span>
                                        <span class="text-gray-400 text-xs">{{ $operation->from_asset }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700 font-medium">
                                    R$ {{ number_format($operation->total_brl ?? 0, 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    R$ {{ number_format($operation->fee_brl ?? 0, 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm font-medium">
                                    @if($operation->gain_loss_brl !== null)
                                        <span class="{{ $operation->gain_loss_brl >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $operation->gain_loss_brl >= 0 ? '+' : '' }}R$ {{ number_format($operation->gain_loss_brl, 2, ',', '.') }}
                                        </span>
                                    @elseif($operation->type === 'sell')
                                        <span class="text-amber-500 text-xs">Calculando...</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <x-icons.list class="w-12 h-12 text-gray-300" />
                                        <p class="text-lg font-medium">Nenhuma operação encontrada</p>
                                        <p class="text-sm">Conecte uma carteira e sincronize suas operações</p>
                                        <a href="{{ route('carteiras') }}" class="mt-2 text-primary-600 hover:text-primary-700">
                                            Ir para Carteiras
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            @if($operations->hasPages())
                <div class="flex items-center justify-end gap-4 px-4 py-4 border-t border-gray-100">
                    <span class="text-sm text-gray-600">
                        {{ $operations->firstItem() }}-{{ $operations->lastItem() }} de {{ $operations->total() }}
                    </span>

                    <div class="flex items-center gap-1">
                        {{-- Botão Anterior --}}
                        @if($operations->onFirstPage())
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed">
                                <x-icons.chevron-left class="w-4 h-4" />
                            </span>
                        @else
                            <a href="{{ $operations->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                                <x-icons.chevron-left class="w-4 h-4" />
                            </a>
                        @endif

                        {{-- Números de Página --}}
                        @php
                            $currentPage = $operations->currentPage();
                            $lastPage = $operations->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);

                            // Ajustar para mostrar sempre 5 números quando possível
                            if ($end - $start < 4) {
                                if ($start == 1) {
                                    $end = min($lastPage, 5);
                                } elseif ($end == $lastPage) {
                                    $start = max(1, $lastPage - 4);
                                }
                            }
                        @endphp

                        @if($start > 1)
                            <a href="{{ $operations->url(1) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                                1
                            </a>
                            @if($start > 2)
                                <span class="w-8 h-8 flex items-center justify-center text-gray-400">...</span>
                            @endif
                        @endif

                        @for($page = $start; $page <= $end; $page++)
                            @if($page == $currentPage)
                                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm font-medium bg-primary-600 text-white">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $operations->url($page) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="w-8 h-8 flex items-center justify-center text-gray-400">...</span>
                            @endif
                            <a href="{{ $operations->url($lastPage) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                                {{ $lastPage }}
                            </a>
                        @endif

                        {{-- Botão Próximo --}}
                        @if($operations->hasMorePages())
                            <a href="{{ $operations->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                                <x-icons.chevron-right class="w-4 h-4" />
                            </a>
                        @else
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed">
                                <x-icons.chevron-right class="w-4 h-4" />
                            </span>
                        @endif
                    </div>
                </div>
            @elseif($operations->count() > 0)
                <div class="flex items-center justify-end gap-4 px-4 py-4 border-t border-gray-100">
                    <span class="text-sm text-gray-600">
                        Total: {{ $operations->count() }} operações
                    </span>
                </div>
            @endif
        </div>

        <!-- Modal Adicionar Transação (mantido para futuro uso) -->
        <div
            x-show="showAddModal"
            x-cloak
            class="fixed inset-0 z-50 overflow-hidden"
            aria-labelledby="slide-over-title"
            role="dialog"
            aria-modal="true"
        >
            <div
                x-show="showAddModal"
                x-transition:enter="ease-in-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in-out duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/30 transition-opacity"
                @click="showAddModal = false"
            ></div>

            <div class="fixed inset-y-0 right-0 flex max-w-full">
                <div
                    x-show="showAddModal"
                    x-transition:enter="transform transition ease-in-out duration-300"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-300"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="w-screen max-w-md"
                >
                    <div class="flex h-full flex-col bg-white shadow-xl">
                        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-900">Adicionar Transação</h2>
                            <button
                                type="button"
                                @click="showAddModal = false"
                                class="p-1 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition-colors"
                            >
                                <x-icons.x class="w-5 h-5" />
                            </button>
                        </div>

                        <div class="flex-1 overflow-y-auto px-6 py-6">
                            <div class="text-center text-gray-500 py-8">
                                <p>Funcionalidade em desenvolvimento</p>
                                <p class="text-sm mt-2">Por enquanto, use a sincronização automática via Carteiras</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 px-6 py-4">
                            <x-ui.button variant="secondary" size="lg" class="w-full rounded-full" @click="showAddModal = false">
                                Fechar
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.dashboard>
