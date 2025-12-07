<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            MemberSeeder::class,
            StoreSeeder::class,
            StoreBalanceSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            TransactionSeeder::class,
            TransactionDetailSeeder::class,
            ProductReviewSeeder::class,
            StoreBalanceHistorySeeder::class,
            WithdrawalSeeder::class,
        ]);
    }
}
