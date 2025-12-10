@props([
    'title' => null,
    'maxWidth' => 'md',
    'show' => false,
])

@php
    $maxWidths = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ];

    $maxWidthClass = $maxWidths[$maxWidth] ?? $maxWidths['md'];
@endphp

<div
    x-data="{ show: @js($show) }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail === '{{ $attributes->get('name', 'modal') }}') show = true"
    x-on:close-modal.window="if ($event.detail === '{{ $attributes->get('name', 'modal') }}') show = false"
    x-on:keydown.escape.window="show = false"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
    <!-- Overlay -->
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 transition-opacity"
        x-on:click="show = false"
    ></div>

    <!-- Modal Panel -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-2xl shadow-modal w-full {{ $maxWidthClass }} mx-4 overflow-hidden"
            x-on:click.stop
        >
            <!-- Header -->
            @if($title)
                <div class="flex items-center justify-between p-6 pb-0">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $title }}</h2>
                    <button
                        type="button"
                        x-on:click="show = false"
                        class="p-2 rounded-full text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition-colors"
                    >
                        <x-icons.x class="w-5 h-5" />
                    </button>
                </div>
            @endif

            <!-- Content -->
            <div class="p-6">
                {{ $slot }}
            </div>

            <!-- Footer -->
            @if(isset($footer))
                <div class="flex items-center justify-end gap-3 px-6 pb-6">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
