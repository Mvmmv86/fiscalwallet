<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // Dados pessoais
            $table->string('phone')->nullable();
            $table->string('document')->nullable(); // CPF
            $table->date('birth_date')->nullable();
            $table->string('avatar_url')->nullable();

            // Endereço
            $table->string('address_cep')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_number')->nullable();
            $table->string('address_complement')->nullable();
            $table->string('address_neighborhood')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_state', 2)->nullable();

            // Segurança
            $table->boolean('two_factor_enabled')->default(false);
            $table->string('two_factor_secret')->nullable();

            // Preferências de notificação - Email
            $table->boolean('notification_email_pendencias')->default(true);
            $table->boolean('notification_email_declaracoes')->default(true);
            $table->boolean('notification_email_operacoes')->default(true);
            $table->boolean('notification_email_marketing')->default(false);

            // Preferências de notificação - Push
            $table->boolean('notification_push_pendencias')->default(true);
            $table->boolean('notification_push_declaracoes')->default(true);
            $table->boolean('notification_push_operacoes')->default(false);

            // Onboarding
            $table->boolean('onboarding_completed')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
