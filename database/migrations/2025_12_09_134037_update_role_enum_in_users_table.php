<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'member', 'seller') NOT NULL DEFAULT 'member'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'seller', 'customer') NOT NULL DEFAULT 'customer'");
    }

};
