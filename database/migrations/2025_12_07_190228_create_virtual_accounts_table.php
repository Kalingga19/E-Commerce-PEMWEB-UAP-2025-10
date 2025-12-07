<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('virtual_accounts', function (Blueprint $table) {
            $table->id();

            // Pemilik VA (user)
            $table->unsignedBigInteger('user_id');

            // Kalau VA untuk transaksi (checkout)
            $table->unsignedBigInteger('transaction_id')->nullable();

            // Nominal VA (untuk topup)
            $table->decimal('amount', 26, 2)->nullable();

            // Kode unik untuk VA
            $table->string('va_code')->unique();

            // Status pembayaran
            $table->boolean('is_paid')->default(false);

            // Jenis VA → topup / transaction
            $table->enum('type', ['topup', 'transaction']);

            $table->timestamps();

            // FK relations
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('virtual_accounts');
    }
}
