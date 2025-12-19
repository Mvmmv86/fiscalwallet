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
        Schema::create('fiscal_law_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_law_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');                        // Título da mudança
            $table->text('change_summary');                 // Resumo em linguagem simples
            $table->enum('change_type', [
                'new_law',          // Nova lei/instrução
                'amendment',        // Alteração de lei existente
                'clarification',    // Esclarecimento/interpretação
                'revocation',       // Revogação
                'deadline',         // Mudança de prazo
                'rate_change',      // Mudança de alíquota/valor
            ]);
            $table->enum('impact_level', ['high', 'medium', 'low']);
            $table->json('affected_areas');                 // ['IN1888', 'GCAP', 'IRPF']
            $table->longText('full_content')->nullable();   // Conteúdo completo
            $table->string('source_url');                   // Link da fonte oficial
            $table->string('source_name')->nullable();      // Nome da fonte (DOU, Receita, etc)
            $table->timestamp('published_at')->nullable();  // Data de publicação oficial
            $table->timestamp('discovered_at');             // Quando o sistema detectou
            $table->boolean('users_notified')->default(false);
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();

            $table->index('change_type');
            $table->index('impact_level');
            $table->index('discovered_at');
            $table->index('users_notified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscal_law_updates');
    }
};
