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
        Schema::create('user_balances', function (Blueprint $table) {
            $table->id();

            // Relasi dengan user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // saldo dalam bentuk integer (misal dalam rupiah)
            $table->bigInteger('balance')->default(0);

            // untuk keperluan virtual account topup
            $table->string('latest_va')->nullable(); 
            $table->enum('va_status', ['unused', 'paid', 'expired'])->default('unused');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_balances');
    }
};
