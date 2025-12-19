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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exchange_id')->constrained()->onDelete('restrict');
            $table->string('name');
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->enum('import_type', ['api', 'csv', 'manual'])->default('manual');
            $table->date('import_start_date')->nullable();
            $table->enum('status', ['pending', 'syncing', 'active', 'error'])->default('pending');
            $table->timestamp('last_sync_at')->nullable();
            $table->text('sync_error')->nullable();
            $table->decimal('total_balance_brl', 18, 2)->default(0);
            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
