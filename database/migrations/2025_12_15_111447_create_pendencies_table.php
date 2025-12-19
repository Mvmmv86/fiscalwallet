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
        Schema::create('pendencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['darf', 'in1888', 'gcap', 'operacao', 'carteira']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', ['critica', 'atencao', 'pendente'])->default('pendente');
            $table->enum('status', ['pending', 'resolved', 'ignored'])->default('pending');

            // Valores financeiros
            $table->decimal('original_value_brl', 18, 2)->nullable();
            $table->decimal('fine_brl', 18, 2)->nullable();
            $table->decimal('interest_brl', 18, 2)->nullable();
            $table->decimal('updated_value_brl', 18, 2)->nullable();

            // Prazo
            $table->date('due_date')->nullable();

            // Instruções de como resolver
            $table->text('instructions')->nullable();

            // Referência
            $table->integer('reference_year')->nullable();
            $table->integer('reference_month')->nullable();
            $table->string('reference_wallet')->nullable();

            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['type', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendencies');
    }
};
