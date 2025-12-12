<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('logo')->nullable()->change();
            $table->text('about')->nullable()->change();
            $table->string('address_id')->nullable()->change();
            $table->string('postal_code')->nullable()->change();
            $table->string('bank_name')->nullable()->change();
            $table->string('bank_account_name')->nullable()->change();
            $table->string('bank_account_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            //
        });
    }
};
