<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\TransactionDetail;

class TransactionDetailSeeder extends Seeder
{
    public function run(): void
    {
        $trx = Transaction::first();
        $products = Product::take(2)->get();

        foreach ($products as $p) {
            TransactionDetail::create([
                'transaction_id' => $trx->id,
                'product_id' => $p->id,
                'qty' => rand(1, 3),
                'subtotal' => $p->price * 1,
            ]);
        }
    }
}
