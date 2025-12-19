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
        Schema::create('price_cache', function (Blueprint $table) {
            $table->id();
            $table->string('symbol', 20)->index();
            $table->string('base_currency', 10)->default('USD');
            $table->string('quote_currency', 10)->default('BRL');
            $table->date('price_date')->index();
            $table->decimal('price_open', 20, 8)->nullable();
            $table->decimal('price_high', 20, 8)->nullable();
            $table->decimal('price_low', 20, 8)->nullable();
            $table->decimal('price_close', 20, 8);
            $table->decimal('volume', 30, 8)->nullable();
            $table->string('source', 50)->default('coinmarketcap');
            $table->timestamps();

            $table->unique(['symbol', 'price_date', 'quote_currency'], 'price_cache_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_cache');
    }
};
