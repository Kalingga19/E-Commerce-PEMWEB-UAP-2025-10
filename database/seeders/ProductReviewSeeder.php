<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\ProductReview;
use App\Models\Product;

class ProductReviewSeeder extends Seeder
{
    public function run(): void
    {
        $transaction = Transaction::first();

        ProductReview::create([
            'transaction_id' => $transaction->id,
            'product_id' => Product::first()->id,
            'rating' => 5,
            'review' => 'Produk sangat bagus dan original!',
        ]);
    }
}
