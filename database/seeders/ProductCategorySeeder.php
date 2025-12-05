<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik',
            'Fashion',
            'Peralatan Rumah',
            'Aksesoris',
            'Gaming',
        ];

        foreach ($categories as $cat) {
            ProductCategory::create([
                'name' => $cat,
                'slug' => strtolower(str_replace(' ', '-', $cat)),
            ]);
        }
    }
}
