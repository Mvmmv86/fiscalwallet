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
        Schema::create('declarations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('year');
            $table->integer('month');

            // Totais do mês
            $table->decimal('total_operado_brl', 18, 2)->default(0);
            $table->decimal('total_alienacao_brl', 18, 2)->default(0);
            $table->decimal('total_taxas_brl', 18, 2)->default(0);
            $table->integer('num_operacoes')->default(0);

            // Status das obrigações
            $table->enum('in1888_status', ['pendente', 'isento', 'enviado'])->default('pendente');
            $table->enum('gcap_status', ['pendente', 'isento', 'enviado'])->default('pendente');
            $table->enum('irpf_status', ['pendente', 'isento', 'enviado'])->default('pendente');

            // Ganho de capital
            $table->decimal('ganho_capital_brl', 18, 2)->default(0);
            $table->decimal('imposto_devido_brl', 18, 2)->default(0);
            $table->boolean('is_exempt')->default(false); // Se vendas <= R$ 35k

            // Arquivos gerados
            $table->string('darf_pdf_path')->nullable();
            $table->string('in1888_file_path')->nullable();
            $table->string('gcap_file_path')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'year', 'month']);
            $table->index(['year', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declarations');
    }
};
