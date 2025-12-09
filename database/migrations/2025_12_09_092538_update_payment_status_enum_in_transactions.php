<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class UpdatePaymentStatusEnumInTransactions extends Migration
{
    public function up()
    {
        DB::statement("
            ALTER TABLE transactions 
            MODIFY payment_status ENUM(
                'pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'
            ) NOT NULL DEFAULT 'pending';
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE transactions 
            MODIFY payment_status ENUM(
                'pending', 'paid', 'processing', 'shipped', 'completed'
            ) NOT NULL DEFAULT 'pending';
        ");
    }
}
