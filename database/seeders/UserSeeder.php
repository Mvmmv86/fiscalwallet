<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuário de teste
        $user = User::updateOrCreate(
            ['email' => 'teste@fiscalwallet.com.br'],
            [
                'name' => 'Usuário Teste',
                'password' => Hash::make('password123'),
                'phone' => '11999999999',
                'document' => '12345678901',
                'birth_date' => '1990-01-15',
                'address_cep' => '01310-100',
                'address_street' => 'Avenida Paulista',
                'address_number' => '1000',
                'address_complement' => 'Sala 101',
                'address_neighborhood' => 'Bela Vista',
                'address_city' => 'São Paulo',
                'address_state' => 'SP',
                'two_factor_enabled' => false,
                'notification_email_pendencias' => true,
                'notification_email_declaracoes' => true,
                'notification_email_operacoes' => true,
                'notification_email_marketing' => false,
                'notification_push_pendencias' => true,
                'notification_push_declaracoes' => true,
                'notification_push_operacoes' => false,
                'onboarding_completed' => true,
                'email_verified_at' => now(),
            ]
        );

        // Criar assinatura Pro para o usuário de teste
        $proPlan = Plan::where('slug', 'pro')->first();

        if ($proPlan) {
            Subscription::updateOrCreate(
                ['user_id' => $user->id, 'status' => 'active'],
                [
                    'plan_id' => $proPlan->id,
                    'status' => 'active',
                    'billing_cycle' => 'monthly',
                    'payment_method' => 'credit_card',
                    'starts_at' => now()->startOfMonth(),
                    'ends_at' => now()->addMonth()->startOfMonth(),
                ]
            );
        }

        // Usuário admin
        User::updateOrCreate(
            ['email' => 'admin@fiscalwallet.com.br'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'phone' => '11988888888',
                'onboarding_completed' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
