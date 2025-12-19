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
        Schema::create('sync_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');

            // Tipo de sincronização
            $table->enum('type', ['full', 'incremental', 'manual'])->default('incremental');
            $table->enum('status', ['pending', 'running', 'completed', 'failed'])->default('pending');

            // Progresso
            $table->integer('total_operations')->default(0);
            $table->integer('processed_operations')->default(0);
            $table->integer('new_operations')->default(0);
            $table->integer('updated_operations')->default(0);
            $table->integer('failed_operations')->default(0);

            // Timing
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('duration_seconds')->nullable();

            // Erro
            $table->text('error_message')->nullable();
            $table->json('error_details')->nullable();

            // Metadados
            $table->json('metadata')->nullable();

            $table->timestamps();

            $table->index(['wallet_id', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync_logs');
    }
};
