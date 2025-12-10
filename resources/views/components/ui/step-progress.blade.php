@props([
    'steps' => [],
])

{{--
    Usage:
    <x-ui.step-progress :steps="[
        ['label' => 'Consultando transacoes', 'status' => 'completed'],
        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
        ['label' => 'Calculando lucros', 'status' => 'loading'],
        ['label' => 'Aplicando regras fiscais', 'status' => 'pending'],
        ['label' => 'Gerando documento', 'status' => 'pending'],
    ]" />

    Status options: 'completed', 'loading', 'pending', 'error'
--}}

<div {{ $attributes->merge(['class' => 'space-y-3']) }}>
    @foreach($steps as $step)
        @php
            $status = $step['status'] ?? 'pending';
            $label = $step['label'] ?? '';
        @endphp

        <div class="flex items-center gap-3">
            {{-- Status Icon --}}
            @if($status === 'completed')
                <div class="flex-shrink-0 w-5 h-5 rounded-full bg-success-500 flex items-center justify-center">
                    <x-icons.check class="w-3 h-3 text-white" />
                </div>
                <span class="text-sm text-gray-900">{{ $label }}</span>
            @elseif($status === 'loading')
                <div class="flex-shrink-0">
                    <x-ui.spinner size="md" color="primary" />
                </div>
                <span class="text-sm text-gray-900">{{ $label }}</span>
            @elseif($status === 'error')
                <div class="flex-shrink-0 w-5 h-5 rounded-full bg-danger-500 flex items-center justify-center">
                    <x-icons.x class="w-3 h-3 text-white" />
                </div>
                <span class="text-sm text-danger-600">{{ $label }}</span>
            @else
                {{-- pending --}}
                <div class="flex-shrink-0 w-5 h-5 rounded-full border-2 border-gray-300"></div>
                <span class="text-sm text-gray-400">{{ $label }}</span>
            @endif
        </div>
    @endforeach
</div>
