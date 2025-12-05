<?php

namespace Database\Seeders;

use App\Models\UserBalance;
use Illuminate\Database\Seeder;

class UserBalanceSeeder extends Seeder
{
    public function run(): void
    {
        UserBalance::create(['user_id' => 1, 'balance' => 0]);
        UserBalance::create(['user_id' => 2, 'balance' => 0]);
        UserBalance::create(['user_id' => 3, 'balance' => 0]);
    }
}
