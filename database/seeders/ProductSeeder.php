<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Headphone Bass Boost',
                'category_id' => 1,
                'price' => 250000,
                'stock' => 50,
                'weight' => 500,
                'thumbnail' => 'https://images.unsplash.com/photo-1511376777868-611b54f68947',
                'description' => 'Headphone dengan bass kuat dan suara jernih.',
                'images' => [
                    'https://images.unsplash.com/photo-1580894894513-5413625f63ed',
                    'https://images.unsplash.com/photo-1580894908361-59eaeed0064e',
                ]
            ],
            [
                'name' => 'Kemeja Casual Pria',
                'category_id' => 2,
                'price' => 120000,
                'stock' => 80,
                'weight' => 500,
                'thumbnail' => 'https://images.unsplash.com/photo-1520975918318-3e48e6e8d8d3',
                'description' => 'Kemeja pria casual yang nyaman untuk sehari-hari.',
                'images' => [
                    'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f',
                ]
            ],
            [
                'name' => 'Set Pisau Dapur Premium',
                'category_id' => 3,
                'price' => 180000,
                'stock' => 100,
                'weight' => 500,
                'thumbnail' => 'https://images.unsplash.com/photo-1601050694286-c0d1a7ad6ecb',
                'description' => 'Set pisau dapur lengkap dengan kualitas premium.',
                'images' => [
                    'https://images.unsplash.com/photo-1556912998-6302a335d9ef',
                ]
            ],
            [
                'name' => 'Keyboard Mechanical RGB',
                'category_id' => 5,
                'price' => 450000,
                'stock' => 40,
                'weight' => 500,
                'thumbnail' => 'https://images.unsplash.com/photo-1616576681690-408ed30347c6',
                'description' => 'Keyboard mechanical RGB dengan switch tactile.',
                'images' => [
                    'https://images.unsplash.com/photo-1555617981-30e9c2c41f26',
                ]
            ],
            [
                'name' => 'Mouse Wireless Silent',
                'category_id' => 5,
                'price' => 90000,
                'stock' => 100,
                'weight' => 500,
                'thumbnail' => 'https://images.unsplash.com/photo-1587825140708-5f3eeea72d9a',
                'description' => 'Mouse wireless dengan klik senyap.',
                'images' => [
                    'https://images.unsplash.com/photo-1587825140708-5f3eeea72d9a',
                ]
            ],
        ];

        foreach ($products as $item) {

            $product = Product::create([
                'store_id' => 1,
                'product_category_id' => $item['category_id'],
                'name' => $item['name'],
                'slug' => strtolower(str_replace(' ', '-', $item['name'])),
                'price' => $item['price'],
                'stock' => $item['stock'],
                'weight' => $item['weight'],
                'description' => $item['description'], // WAJIB
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $item['thumbnail'],
                'is_thumbnail' => true,
            ]);

            foreach ($item['images'] as $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $img,
                    'is_thumbnail' => false,
                ]);
            }
        }
    }
}
