<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => "images/products/produk-{$product->id}.jpg",
                'is_thumbnail' => 1,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => "images/products/produk-{$product->id}.jpg",
                'is_thumbnail' => 0,
            ]);
        }
    }
}
