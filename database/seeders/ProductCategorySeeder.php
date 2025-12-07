<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'tagline' => 'Produk elektronik terbaik',
                'description' => 'Kategori produk elektronik seperti HP, laptop, dan aksesoris.'
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'tagline' => 'Pakaian terbaru',
                'description' => 'Kategori untuk pakaian pria dan wanita.'
            ],
            [
                'name' => 'Aksesoris',
                'slug' => 'aksesoris',
                'tagline' => 'Aksesoris gaya',
                'description' => 'Kategori untuk aksesoris tambahan.'
            ],
            [
                'name' => 'Makanan',
                'slug' => 'makanan',
                'tagline' => 'Makanan dan minuman',
                'description' => 'Kategori makanan ringan dan berat.'
            ],
            [
                'name' => 'Peralatan',
                'slug' => 'peralatan',
                'tagline' => 'Peralatan rumah tangga',
                'description' => 'Kategori perkakas dan alat rumah lainnya.'
            ],
        ];


        foreach ($categories as $cat) {
            ProductCategory::create($cat);
        }
    }
}
