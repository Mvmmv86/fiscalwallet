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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['buy', 'sell', 'transfer_in', 'transfer_out', 'swap', 'staking', 'airdrop']);
            $table->timestamp('executed_at');

            // Ativo de origem
            $table->string('from_asset')->nullable();
            $table->decimal('from_amount', 24, 8)->nullable();
            $table->decimal('from_price_brl', 18, 2)->nullable();

            // Ativo de destino
            $table->string('to_asset')->nullable();
            $table->decimal('to_amount', 24, 8)->nullable();
            $table->decimal('to_price_brl', 18, 2)->nullable();

            // Valores em BRL
            $table->decimal('total_brl', 18, 2)->default(0);
            $table->decimal('fee_brl', 18, 2)->default(0);

            // Cálculo de ganho/prejuízo
            $table->decimal('cost_basis_brl', 18, 2)->nullable();
            $table->decimal('gain_loss_brl', 18, 2)->nullable();

            // Referência externa
            $table->string('external_id')->nullable();
            $table->string('tx_hash')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'executed_at']);
            $table->index(['wallet_id', 'type']);
            $table->index('to_asset');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
