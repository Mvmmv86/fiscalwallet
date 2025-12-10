<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
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
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $variants = [
        'success' => 'bg-success-100 text-success-700',
        'danger' => 'bg-danger-100 text-danger-700',
        'warning' => 'bg-warning-100 text-warning-700',
        'primary' => 'bg-primary-100 text-primary-700',
        'neutral' => 'bg-gray-100 text-gray-700',
        'entrada' => 'bg-success-100 text-success-700',
        'saida' => 'bg-danger-100 text-danger-700',
        'saque' => 'bg-primary-100 text-primary-700',
        'deposito' => 'bg-success-100 text-success-700',
        'pendente' => 'bg-warning-100 text-warning-700',
        'isento' => 'bg-success-100 text-success-700',
    ];

    $dotColors = [
        'success' => 'bg-success-500',
        'danger' => 'bg-danger-500',
        'warning' => 'bg-warning-500',
        'primary' => 'bg-primary-500',
        'neutral' => 'bg-gray-500',
        'entrada' => 'bg-success-500',
        'saida' => 'bg-danger-500',
        'saque' => 'bg-primary-500',
        'deposito' => 'bg-success-500',
        'pendente' => 'bg-warning-500',
        'isento' => 'bg-success-500',
    ];

    $sizes = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-3 py-1 text-xs',
        'lg' => 'px-4 py-1.5 text-sm',
    ];

    $variantClass = $variants[$variant] ?? $variants['neutral'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $dotColor = $dotColors[$variant] ?? $dotColors['neutral'];
?>

<span <?php echo e($attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full font-medium {$variantClass} {$sizeClass}"])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dot): ?>
        <span class="w-1.5 h-1.5 rounded-full <?php echo e($dotColor); ?>"></span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo e($slot); ?>

</span>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/badge.blade.php ENDPATH**/ ?>