@props([
    'showSearch' => true,
    'showDateFilter' => true,
    'showWalletFilter' => true,
    'showOrderFilter' => false,
    'year' => null,
    'month' => null,
])

<div class="flex flex-wrap items-center gap-3 mb-6">
    @if($showDateFilter)
        <div class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg">
            <span class="text-sm text-gray-900 font-medium">
                {{ $year ?? date('Y') }}{{ $month ? '/' . $month : '' }}
            </span>
            <x-icons.calendar class="w-4 h-4 text-gray-500" />
        </div>
    @endif

    @if($showSearch)
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <input
                type="text"
                placeholder="Pesquisar"
                class="w-full pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100"
                wire:model.live.debounce.300ms="search"
            />
            <x-icons.search class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
        </div>
    @endif

    @if($showWalletFilter)
        <div class="relative">
            <select
                class="appearance-none pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 cursor-pointer"
                wire:model.live="walletFilter"
            >
                <option value="">Todas as carteiras</option>
                {{ $slot }}
            </select>
            <x-icons.chevron-down class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" />
        </div>
    @endif

    @if($showOrderFilter)
        <div class="relative">
            <select
                class="appearance-none pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 cursor-pointer"
                wire:model.live="orderBy"
            >
                <option value="desc">Ordem: crescente</option>
                <option value="asc">Ordem: decrescente</option>
            </select>
            <x-icons.chevron-down class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" />
        </div>
    @endif

    <button
        type="button"
        class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors"
    >
        Filtro
        <x-icons.filter class="w-4 h-4" />
    </button>
</div>
