<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'value' => 0,
    'max' => 100,
    'color' => 'primary',
    'size' => 'md',
    'showLabel' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'value' => 0,
    'max' => 100,
    'color' => 'primary',
    'size' => 'md',
    'showLabel' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $percentage = $max > 0 ? min(($value / $max) * 100, 100) : 0;

    $colors = [
        'primary' => 'bg-primary-500',
        'success' => 'bg-success-500',
        'danger' => 'bg-danger-500',
        'warning' => 'bg-warning-500',
    ];

    $sizes = [
        'sm' => 'h-1',
        'md' => 'h-2',
        'lg' => 'h-3',
    ];

    $colorClass = $colors[$color] ?? $colors['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
?>

<div <?php echo e($attributes->merge(['class' => 'w-full'])); ?>>
    <div class="w-full bg-gray-100 rounded-full overflow-hidden <?php echo e($sizeClass); ?>">
        <div
            class="h-full rounded-full transition-all duration-300 <?php echo e($colorClass); ?>"
            style="width: <?php echo e($percentage); ?>%"
        ></div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showLabel): ?>
        <div class="flex justify-between mt-1">
            <span class="text-xs text-gray-500"><?php echo e(number_format($value, 2, ',', '.')); ?></span>
            <span class="text-xs text-gray-500"><?php echo e(number_format($max, 2, ',', '.')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/progress-bar.blade.php ENDPATH**/ ?>