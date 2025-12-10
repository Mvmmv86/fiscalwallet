<?php
    $exchange = request()->route('exchange') ?? 'binance';
    $exchangeNames = [
        'binance' => 'Binance',
        'coinbase' => 'Coinbase',
        'metamask' => 'MetaMask',
        'mercado-bitcoin' => 'Mercado Bitcoin',
    ];
    $exchangeName = $exchangeNames[$exchange] ?? 'Exchange';
?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Importação Automática - Fiscal Wallet</title>

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
            <a href="<?php echo e(route('dashboard')); ?>" class="px-4 py-2 text-sm font-medium text-primary-600 bg-white border border-primary-300 rounded-full hover:bg-primary-50 transition-all">
                Pular
            </a>
        </header>

        <!-- Content -->
        <div class="flex-1 flex">
            <!-- Coluna Esquerda - Formulário (50%) -->
            <div class="bg-[#F5F2F8] flex items-center justify-center p-8" style="width: 50%;">
                <div style="width: 280px;" class="flex flex-col gap-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">Importação</h1>
                        <h2 class="text-2xl font-semibold text-gray-900">Automática</h2>
                    </div>

                    <!-- Campo API Key -->
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">API KEY</label>
                        <input
                            type="text"
                            name="api_key"
                            value="vGhj7K9mNpQrStUv2WxYz3AbCdEfGh"
                            placeholder="Digite a chave API"
                            class="w-full px-4 py-3 text-sm border border-gray-200 rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        />
                    </div>

                    <!-- Campo API Secret -->
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">API SECRET</label>
                        <input
                            type="password"
                            name="api_secret"
                            value="xK8pL2mN5qR9sT3vW7yZ1bC4dE6fG"
                            placeholder="Digite o segredo API"
                            class="w-full px-4 py-3 text-sm border border-gray-200 rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        />
                    </div>

                    <!-- Campo Data -->
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Data</label>
                        <input
                            type="date"
                            name="date"
                            value="2024-01-01"
                            class="w-full px-4 py-3 text-sm border border-gray-200 rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        />
                    </div>

                    <!-- Botão Importar -->
                    <a href="<?php echo e(route('onboarding.processing', ['exchange' => $exchange])); ?>" class="w-full px-6 py-3 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-colors text-center mt-2">
                        Importar
                    </a>
                </div>
            </div>

            <!-- Coluna Direita - Instruções (50%) -->
            <div class="bg-white flex items-center justify-center p-12 overflow-y-auto" style="width: 50%;">
                <div style="width: 500px;" class="flex flex-col gap-4">
                    <h3 class="text-xl font-semibold text-gray-900 text-center">Instruções</h3>

                    <ol class="list-decimal list-inside text-sm text-gray-600 space-y-2">
                        <li>Faça login na <?php echo e($exchangeName); ?>.</li>
                        <li>Vá para a página de gerenciamento da API <?php echo e($exchangeName); ?>.</li>
                        <li>Selecione Criar API</li>
                        <li>Conclua o 2FA.</li>
                        <li>Por padrão, apenas a permissão de leitura será concedida. Certifique-se de que nenhuma outra permissão foi concedida às chaves de API.</li>
                        <li>Copie a chave da API e o segredo da API para Koinly.</li>
                    </ol>

                    <div class="mt-2">
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">Observação:</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            <?php echo e($exchangeName); ?> também possui uma API especial de relatório de impostos, que também funcionará com Koinly. No entanto, a API Tax Report não permitirá acesso total ao histórico de transações de futuros, por isso recomendamos a criação de chaves API regulares.
                        </p>
                    </div>

                    <div class="mt-2">
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">Subcontas</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Se você usa subcontas com <?php echo e($exchangeName); ?>, também precisará importar esses dados.</li>
                            <li>• Se estiver usando API, crie chaves de API separadas para cada subconta.</li>
                            <li>• Adicione-as a carteiras <?php echo e($exchangeName); ?> separadas no Koinly.</li>
                            <li>• Verifique suas transferências entre a conta principal e suas subcontas, pois pode ser necessário adicioná-las manualmente.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/onboarding/import-automatic.blade.php ENDPATH**/ ?>