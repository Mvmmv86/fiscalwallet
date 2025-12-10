<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => '',
    'value' => '',
    'label' => '',
    'checked' => false,
    'variant' => 'default',
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
    'name' => '',
    'value' => '',
    'label' => '',
    'checked' => false,
    'variant' => 'default',
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
        'default' => 'bg-gray-100 hover:bg-gray-200 text-gray-700',
        'selected' => 'bg-gray-200 text-gray-900',
    ];

    $variantClass = $checked ? $variants['selected'] : $variants['default'];
?>

<label <?php echo e($attributes->merge(['class' => 'block cursor-pointer'])); ?>>
    <input
        type="radio"
        name="<?php echo e($name); ?>"
        value="<?php echo e($value); ?>"
        <?php echo e($checked ? 'checked' : ''); ?>

        class="sr-only peer"
    />
    <div class="w-full px-4 py-3 rounded-lg text-sm text-center font-medium transition-colors <?php echo e($variantClass); ?> peer-checked:bg-gray-200 peer-checked:text-gray-900">
        <?php echo e($label); ?>

    </div>
</label>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/radio-button.blade.php ENDPATH**/ ?>