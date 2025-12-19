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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('symbol');
            $table->string('name')->nullable();
            $table->decimal('quantity', 24, 8)->default(0);
            $table->decimal('average_cost_brl', 18, 2)->default(0);
            $table->decimal('total_invested_brl', 18, 2)->default(0);
            $table->decimal('current_price_brl', 18, 2)->default(0);
            $table->decimal('current_value_brl', 18, 2)->default(0);
            $table->decimal('unrealized_gain_loss_brl', 18, 2)->default(0);
            $table->decimal('realized_gain_loss_brl', 18, 2)->default(0);
            $table->timestamp('price_updated_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'symbol']);
            $table->index('symbol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
