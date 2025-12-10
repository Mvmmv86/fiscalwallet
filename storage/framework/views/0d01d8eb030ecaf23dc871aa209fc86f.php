<?php extract((new \Illuminate\Support\Collection($attributes->getAttributes()))->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class']));

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

foreach (array_filter((['class']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<?php if (isset($component)) { $__componentOriginalfda9c33bba3cbf6c8c18ef880c16f8c0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfda9c33bba3cbf6c8c18ef880c16f8c0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.list','data' => ['class' => $class]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($class)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfda9c33bba3cbf6c8c18ef880c16f8c0)): ?>
<?php $attributes = $__attributesOriginalfda9c33bba3cbf6c8c18ef880c16f8c0; ?>
<?php unset($__attributesOriginalfda9c33bba3cbf6c8c18ef880c16f8c0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfda9c33bba3cbf6c8c18ef880c16f8c0)): ?>
<?php $component = $__componentOriginalfda9c33bba3cbf6c8c18ef880c16f8c0; ?>
<?php unset($__componentOriginalfda9c33bba3cbf6c8c18ef880c16f8c0); ?>
<?php endif; ?><?php /**PATH C:\Users\marcu\fiscalwallet\storage\framework\views/f0ed13dd1d22b7814daa49c1e75a5bf4.blade.php ENDPATH**/ ?>