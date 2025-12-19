<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'slug' => 'starter',
                'description' => 'Para investidores iniciantes',
                'price_monthly' => 299.00,
                'price_yearly' => 2990.00,
                'max_wallets' => 3,
                'max_operations' => 500,
                'features' => json_encode([
                    'Até 500 operações/mês',
                    '3 carteiras conectadas',
                    'Dashboard completo',
                    'Relatórios fiscais básicos',
                    'Exportação CSV/PDF',
                    'Suporte por email',
                ]),
                'is_active' => true,
                'is_popular' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'description' => 'Para traders ativos',
                'price_monthly' => 699.00,
                'price_yearly' => 6990.00,
                'max_wallets' => 10,
                'max_operations' => 999999, // Ilimitado
                'features' => json_encode([
                    'Operações ilimitadas',
                    '10 carteiras conectadas',
                    'Relatórios fiscais completos',
                    'GCAP automático',
                    'IN 1888 automática',
                    'DARF automático',
                    'Exportação CSV/PDF/Excel',
                    'Suporte prioritário por chat',
                ]),
                'is_active' => true,
                'is_popular' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'description' => 'Para escritórios e grandes investidores',
                'price_monthly' => 1500.00,
                'price_yearly' => 15000.00,
                'max_wallets' => 999, // Ilimitado
                'max_operations' => 999999, // Ilimitado
                'features' => json_encode([
                    'Tudo do plano Pro',
                    'Carteiras ilimitadas',
                    'Multi-usuários (até 10)',
                    'API de integração',
                    'Relatórios personalizados',
                    'Gerente de conta dedicado',
                    'SLA garantido 99.9%',
                    'Treinamento personalizado',
                ]),
                'is_active' => true,
                'is_popular' => false,
                'sort_order' => 3,
            ],
        ];

        // Remove planos antigos que não existem mais
        Plan::whereNotIn('slug', ['starter', 'pro', 'enterprise'])->delete();

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }
    }
}
