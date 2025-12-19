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
        Schema::create('fiscal_laws', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();              // IN1888, GCAP, IRPF, etc
            $table->string('title');                        // Nome da lei/instrução
            $table->text('description');                    // Resumo em linguagem simples
            $table->longText('full_content');               // Conteúdo completo para a IA
            $table->date('effective_date');                 // Data de vigência
            $table->date('last_updated')->nullable();       // Última atualização
            $table->string('source_url')->nullable();       // Link oficial
            $table->json('keywords')->nullable();           // Palavras-chave para busca
            $table->json('metadata')->nullable();           // Dados extras (alíquotas, limites, etc)
            $table->boolean('is_active')->default(true);    // Se a lei está em vigor
            $table->timestamps();

            $table->index('code');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscal_laws');
    }
};
