@props([
    'page' => 1,
    'totalPages' => 1,
    'showDisclaimer' => true
])

<div class="document-footer">
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
            <div style="width: 20px; height: 20px; background: linear-gradient(135deg, #9333EA, #22C55E); border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white" opacity="0.9"/>
                </svg>
            </div>
            <span class="font-medium">Fiscal Wallet</span>
        </div>
        @if($showDisclaimer)
            <span class="text-gray-400">|</span>
            <span class="text-gray-400">Este documento e meramente informativo</span>
        @endif
    </div>

    <div class="flex items-center gap-4">
        <span>www.fiscalwallet.com.br</span>
        <span class="text-gray-400">|</span>
        <span>Pagina {{ $page }} de {{ $totalPages }}</span>
    </div>
</div>
