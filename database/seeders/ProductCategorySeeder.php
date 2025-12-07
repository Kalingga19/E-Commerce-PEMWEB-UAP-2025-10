<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris'],
            ['name' => 'Makanan', 'slug' => 'makanan'],
            ['name' => 'Peralatan', 'slug' => 'peralatan'],
        ];

        foreach ($categories as $cat) {
            ProductCategory::create($cat);
        }
    }
}
