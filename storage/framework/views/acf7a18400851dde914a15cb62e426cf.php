<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'Dashboard']));

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

foreach (array_filter((['title' => 'Dashboard']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title); ?> - Fiscal Wallet</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:200,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <style>
        [x-cloak] { display: none !important; }
        .sidebar-transition {
            transition: width 0.3s ease, transform 0.3s ease;
        }
        .main-transition {
            transition: margin-left 0.3s ease;
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#F8F8FA]" x-data="{ sidebarOpen: true }">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside
            class="bg-white border-r border-gray-100 flex flex-col fixed h-full z-20 left-0 top-0 sidebar-transition"
            :class="sidebarOpen ? 'w-[180px]' : 'w-[60px]'"
        >
            <!-- Logo -->
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <div :class="sidebarOpen ? '' : 'hidden'">
                    <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => ['size' => 'sm','showText' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','showText' => true]); ?>
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
                </div>
                <div :class="sidebarOpen ? 'hidden' : ''" class="mx-auto">
                    <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => ['size' => 'sm','showText' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','showText' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
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
                </div>
            </div>

            <!-- Toggle Button - Na borda direita do sidebar -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-6 h-6 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-sm hover:bg-gray-50 transition-colors z-30"
            >
                <svg
                    class="w-3 h-3 text-gray-600 transition-transform duration-300"
                    :class="sidebarOpen ? '' : 'rotate-180'"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Navigation -->
            <nav class="flex-1 p-3 space-y-1">
                <a
                    href="<?php echo e(route('dashboard')); ?>"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo e(request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50'); ?> transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <?php if (isset($component)) { $__componentOriginalb4401e35ea9e0a95612797af5833e0a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb4401e35ea9e0a95612797af5833e0a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.grid','data' => ['class' => 'w-5 h-5 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb4401e35ea9e0a95612797af5833e0a0)): ?>
<?php $attributes = $__attributesOriginalb4401e35ea9e0a95612797af5833e0a0; ?>
<?php unset($__attributesOriginalb4401e35ea9e0a95612797af5833e0a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb4401e35ea9e0a95612797af5833e0a0)): ?>
<?php $component = $__componentOriginalb4401e35ea9e0a95612797af5833e0a0; ?>
<?php unset($__componentOriginalb4401e35ea9e0a95612797af5833e0a0); ?>
<?php endif; ?>
                    <span :class="sidebarOpen ? '' : 'hidden'">Visao geral</span>
                </a>

                <a
                    href="<?php echo e(route('carteiras')); ?>"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo e(request()->routeIs('carteiras') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50'); ?> transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <?php if (isset($component)) { $__componentOriginal5a6b4d1d251c59913fae8edd35183a23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a6b4d1d251c59913fae8edd35183a23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.wallet','data' => ['class' => 'w-5 h-5 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.wallet'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a6b4d1d251c59913fae8edd35183a23)): ?>
<?php $attributes = $__attributesOriginal5a6b4d1d251c59913fae8edd35183a23; ?>
<?php unset($__attributesOriginal5a6b4d1d251c59913fae8edd35183a23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a6b4d1d251c59913fae8edd35183a23)): ?>
<?php $component = $__componentOriginal5a6b4d1d251c59913fae8edd35183a23; ?>
<?php unset($__componentOriginal5a6b4d1d251c59913fae8edd35183a23); ?>
<?php endif; ?>
                    <span :class="sidebarOpen ? '' : 'hidden'">Carteiras</span>
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <?php if (isset($component)) { $__componentOriginalfda9c33bba3cbf6c8c18ef880c16f8c0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfda9c33bba3cbf6c8c18ef880c16f8c0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.list','data' => ['class' => 'w-5 h-5 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfda9c33bba3cbf6c8c18ef880c16f8c0)): ?>
<?php $attributes = $__attributesOriginalfda9c33bba3cbf6c8c18ef880c16f8c0; ?>
<?php unset($__attributesOriginalfda9c33bba3cbf6c8c18ef880c16f8c0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfda9c33bba3cbf6c8c18ef880c16f8c0)): ?>
<?php $component = $__componentOriginalfda9c33bba3cbf6c8c18ef880c16f8c0; ?>
<?php unset($__componentOriginalfda9c33bba3cbf6c8c18ef880c16f8c0); ?>
<?php endif; ?>
                    <span :class="sidebarOpen ? '' : 'hidden'">Operacoes</span>
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <?php if (isset($component)) { $__componentOriginal5afabaa79d8670ed137791ca10ba54aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5afabaa79d8670ed137791ca10ba54aa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chart','data' => ['class' => 'w-5 h-5 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5afabaa79d8670ed137791ca10ba54aa)): ?>
<?php $attributes = $__attributesOriginal5afabaa79d8670ed137791ca10ba54aa; ?>
<?php unset($__attributesOriginal5afabaa79d8670ed137791ca10ba54aa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5afabaa79d8670ed137791ca10ba54aa)): ?>
<?php $component = $__componentOriginal5afabaa79d8670ed137791ca10ba54aa; ?>
<?php unset($__componentOriginal5afabaa79d8670ed137791ca10ba54aa); ?>
<?php endif; ?>
                    <span :class="sidebarOpen ? '' : 'hidden'">Relatorios</span>
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >
                    <?php if (isset($component)) { $__componentOriginal881f5ac4e47c0c198e5178ad5ad39289 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal881f5ac4e47c0c198e5178ad5ad39289 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.file-text','data' => ['class' => 'w-5 h-5 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.file-text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal881f5ac4e47c0c198e5178ad5ad39289)): ?>
<?php $attributes = $__attributesOriginal881f5ac4e47c0c198e5178ad5ad39289; ?>
<?php unset($__attributesOriginal881f5ac4e47c0c198e5178ad5ad39289); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal881f5ac4e47c0c198e5178ad5ad39289)): ?>
<?php $component = $__componentOriginal881f5ac4e47c0c198e5178ad5ad39289; ?>
<?php unset($__componentOriginal881f5ac4e47c0c198e5178ad5ad39289); ?>
<?php endif; ?>
                    <span :class="sidebarOpen ? '' : 'hidden'">Declaracoes</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div
            class="min-h-screen transition-all duration-300 ease-in-out"
            x-bind:style="'margin-left: ' + (sidebarOpen ? '192px' : '72px')"
        >
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-100 px-6 py-3 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold text-gray-900"><?php echo e($title); ?></h1>
                </div>

                <div class="flex items-center gap-3">
                    <!-- Notifications -->
                    <button class="p-1.5 rounded-lg hover:bg-gray-100 transition-colors relative">
                        <?php if (isset($component)) { $__componentOriginal4525404018e5b2e94f2d1e4dc53d4ad7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4525404018e5b2e94f2d1e4dc53d4ad7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.bell','data' => ['class' => 'w-4 h-4 text-gray-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.bell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 text-gray-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4525404018e5b2e94f2d1e4dc53d4ad7)): ?>
<?php $attributes = $__attributesOriginal4525404018e5b2e94f2d1e4dc53d4ad7; ?>
<?php unset($__attributesOriginal4525404018e5b2e94f2d1e4dc53d4ad7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4525404018e5b2e94f2d1e4dc53d4ad7)): ?>
<?php $component = $__componentOriginal4525404018e5b2e94f2d1e4dc53d4ad7; ?>
<?php unset($__componentOriginal4525404018e5b2e94f2d1e4dc53d4ad7); ?>
<?php endif; ?>
                        <span class="absolute top-0.5 right-0.5 w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center gap-2" x-data="{ open: false }">
                        <img
                            src="https://ui-avatars.com/api/?name=Alonso+Rodrigues&background=9333EA&color=fff&size=32"
                            alt="Avatar"
                            class="w-8 h-8 rounded-full"
                        />
                        <div class="text-xs">
                            <p class="font-medium text-gray-900">Alonso Rodrigues</p>
                        </div>
                        <button @click="open = !open" class="p-0.5 rounded hover:bg-gray-100">
                            <?php if (isset($component)) { $__componentOriginalfb5ab559e4014313073efeb5cdff727a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5ab559e4014313073efeb5cdff727a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-down','data' => ['class' => 'w-3 h-3 text-gray-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3 h-3 text-gray-500']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $attributes = $__attributesOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $component = $__componentOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__componentOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="py-4 px-6">
                <?php echo e($slot); ?>

            </main>
        </div>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/layouts/dashboard.blade.php ENDPATH**/ ?>