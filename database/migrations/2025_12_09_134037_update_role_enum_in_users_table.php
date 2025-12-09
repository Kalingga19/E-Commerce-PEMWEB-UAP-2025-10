<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            \DB::statement("ALTER TABLE users MODIFY role ENUM('admin','seller','customer') NOT NULL DEFAULT 'customer'");
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            \DB::statement("ALTER TABLE users MODIFY role ENUM('admin','seller') NOT NULL DEFAULT 'seller'");
        });
    }
};
