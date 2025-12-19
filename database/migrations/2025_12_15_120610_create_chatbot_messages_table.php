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
        Schema::create('chatbot_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Mensagem
            $table->enum('role', ['user', 'assistant'])->default('user');
            $table->text('content');

            // Contexto
            $table->string('intent')->nullable(); // darf, in1888, isencao, gcap, multas, etc
            $table->json('context')->nullable(); // Dados de contexto da conversa

            // Feedback
            $table->boolean('was_helpful')->nullable();
            $table->text('feedback')->nullable();

            // Sessão
            $table->string('session_id')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'session_id']);
            $table->index('intent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_messages');
    }
};
