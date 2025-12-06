<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {

            // Rename kolom agar sesuai format terbaru (opsional tergantung struktur awal)
            if (Schema::hasColumn('transactions', 'total_price')) {
                $table->renameColumn('total_price', 'grand_total');
            }

            // Tambahan kolom status pesanan
            if (!Schema::hasColumn('transactions', 'status')) {
                $table->enum('status', [
                    'pending',
                    'processing',
                    'shipped',
                    'completed',
                    'cancelled'
                ])->default('pending')->after('payment_status');
            }

            // Metode pembayaran
            if (!Schema::hasColumn('transactions', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('payment_status');
            }

            // Tanggal terkait lifecycle pesanan
            if (!Schema::hasColumn('transactions', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('transactions', 'shipped_at')) {
                $table->timestamp('shipped_at')->nullable()->after('paid_at');
            }
            if (!Schema::hasColumn('transactions', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('shipped_at');
            }

            // Pengiriman
            if (!Schema::hasColumn('transactions', 'courier')) {
                $table->string('courier')->nullable()->after('shipping_cost');
            }

            if (!Schema::hasColumn('transactions', 'tracking_number')) {
                $table->string('tracking_number')->nullable()->after('courier');
            }

            // Receiver name & phone (untuk checkout)
            if (!Schema::hasColumn('transactions', 'receiver_name')) {
                $table->string('receiver_name')->nullable()->after('store_id');
            }

            if (!Schema::hasColumn('transactions', 'phone')) {
                $table->string('phone')->nullable()->after('postal_code');
            }

            // cancel reason
            if (!Schema::hasColumn('transactions', 'cancel_reason')) {
                $table->string('cancel_reason')->nullable()->after('completed_at');
            }

            if (!Schema::hasColumn('transactions', 'cancel_note')) {
                $table->text('cancel_note')->nullable()->after('cancel_reason');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Hapus kolom jika rollback
            $table->dropColumn([
                'status',
                'payment_method',
                'paid_at',
                'shipped_at',
                'completed_at',
                'courier',
                'tracking_number',
                'receiver_name',
                'phone',
                'cancel_reason',
                'cancel_note'
            ]);
        });
    }
};
