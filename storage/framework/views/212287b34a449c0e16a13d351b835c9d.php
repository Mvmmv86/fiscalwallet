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
<?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => $class]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($class)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $attributes = $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $component = $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?><?php /**PATH C:\Users\marcu\fiscalwallet\storage\framework\views/79587297685b4aa0380a059d354c3e76.blade.php ENDPATH**/ ?>