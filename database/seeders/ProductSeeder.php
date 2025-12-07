<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $store = Store::first();
        $categories = ProductCategory::pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'store_id' => $store->id,
                'product_category_id' => $categories[array_rand($categories)],
                'name' => "Produk Contoh $i",
                'slug' => "produk-contoh-$i",
                'description' => "Deskripsi produk contoh ke-$i",
                'condition' => 'new',
                'price' => rand(10000, 200000),
                'weight' => rand(200, 2000),
                'stock' => rand(5, 50),
            ]);
        }
    }
}
