<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Processando - Fiscal Wallet</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:200,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="w-full px-8 py-4 flex items-center justify-between bg-white border-b border-gray-100">
            <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => ['size' => 'md','showText' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md','showText' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $attributes = $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $component = $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
        </header>

        <!-- Content -->
        <div class="flex-1 bg-[#F5F2F8] flex items-center justify-center p-8">
            <div class="flex flex-col items-center text-center gap-6" style="width: 320px;">
                <!-- Título -->
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">As operações estão sendo</h1>
                    <h2 class="text-2xl font-semibold text-gray-900">processadas</h2>
                </div>

                <!-- Descrição -->
                <p class="text-sm text-gray-500">
                    Aguarde enquanto estamos processando suas operações, assim que estiver pronto lhe enviaremos um e-mail avisando.
                </p>

                <!-- Botão Ir para Home -->
                <a href="<?php echo e(route('dashboard')); ?>" class="w-full px-6 py-3 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-colors text-center">
                    Ir para Home
                </a>
            </div>
        </div>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/onboarding/processing.blade.php ENDPATH**/ ?>