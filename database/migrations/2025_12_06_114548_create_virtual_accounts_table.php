<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('virtual_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('va_code')->unique();
            $table->enum('type', ['topup', 'purchase']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // transaksi hanya ada untuk VA pembelian
            $table->foreignId('transaction_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->integer('amount');
            $table->enum('status', ['pending', 'paid'])->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('virtual_accounts');
    }
};
