<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'size' => 'md',
    'showText' => false,
    'href' => null,
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
    'size' => 'md',
    'showText' => false,
    'href' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $sizes = [
        'sm' => ['icon' => 'h-6', 'text' => 'text-base'],
        'md' => ['icon' => 'h-8', 'text' => 'text-lg'],
        'lg' => ['icon' => 'h-10', 'text' => 'text-xl'],
        'xl' => ['icon' => 'h-12', 'text' => 'text-2xl'],
    ];

    $sizeConfig = $sizes[$size] ?? $sizes['md'];
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($href): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => 'inline-flex items-center'])); ?>>
<?php else: ?>
    <div <?php echo e($attributes->merge(['class' => 'inline-flex items-center'])); ?>>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <img
            src="<?php echo e(asset('assets/images/logo/imageslogo.svg.svg')); ?>"
            alt="Fiscal Wallet"
            class="<?php echo e($sizeConfig['icon']); ?> w-auto"
        />
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showText): ?>
            <span class="<?php echo e($sizeConfig['text']); ?> font-semibold text-gray-900 ml-2">Fiscal <span class="font-normal text-gray-400">Wallet</span></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($href): ?>
    </a>
<?php else: ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/logo.blade.php ENDPATH**/ ?>