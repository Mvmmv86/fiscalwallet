<div>
    <!-- Header com botões de ação -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition-colors">
                <x-icons.arrow-left class="w-4 h-4 text-gray-600" />
            </a>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <x-ui.button variant="primary" size="md">
                Adicionar operação
            </x-ui.button>
            <x-ui.button variant="secondary" size="md">
                Sincronizar operações
            </x-ui.button>
        </div>
    </div>

    <!-- Barra de filtros -->
    <div class="flex flex-col lg:flex-row lg:items-center gap-4 mb-6">
        <!-- Campo de pesquisa -->
        <div class="relative flex-1 max-w-xs">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Pesquisar por ativo..."
                class="w-full pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100"
            />
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <x-icons.search class="w-4 h-4 text-gray-400" />
            </div>
        </div>

        <!-- Dropdown de carteiras -->
        <div class="relative">
            <select
                wire:model.live="filterWallet"
                class="appearance-none px-4 py-2.5 pr-10 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 cursor-pointer"
            >
                <option value="">Todas as carteiras</option>
                @foreach($wallets as $wallet)
                    <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <x-icons.chevron-down class="w-4 h-4 text-gray-400" />
            </div>
        </div>

        <!-- Dropdown de tipos -->
        <div class="relative">
            <select
                wire:model.live="filterType"
                class="appearance-none px-4 py-2.5 pr-10 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 cursor-pointer"
            >
                <option value="">Todos os tipos</option>
                @foreach($operationTypes as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <x-icons.chevron-down class="w-4 h-4 text-gray-400" />
            </div>
        </div>
    </div>

    <!-- Tabela de operações -->
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700" wire:click="sortBy('executed_at')">
                            <div class="flex items-center gap-1">
                                Data
                                @if($sortField === 'executed_at')
                                    <svg class="w-3 h-3 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                @endif
                            </div>
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
                            <td class="px-4 py-3 text-sm">
                                @if($operation->gain_loss_brl !== null)
                                    <span class="{{ $operation->gain_loss_brl >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        R$ {{ number_format($operation->gain_loss_brl, 2, ',', '.') }}
                                    </span>
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
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        @if($operations->hasPages())
            <div class="flex items-center justify-between gap-4 px-4 py-4 border-t border-gray-100">
                <span class="text-sm text-gray-600">
                    Mostrando {{ $operations->firstItem() }}-{{ $operations->lastItem() }} de {{ $operations->total() }}
                </span>
                <div class="flex items-center gap-2">
                    {{ $operations->links() }}
                </div>
            </div>
        @else
            <div class="flex items-center justify-end gap-4 px-4 py-4 border-t border-gray-100">
                <span class="text-sm text-gray-600">
                    Total: {{ $operations->count() }} operações
                </span>
            </div>
        @endif
    </div>
</div>
