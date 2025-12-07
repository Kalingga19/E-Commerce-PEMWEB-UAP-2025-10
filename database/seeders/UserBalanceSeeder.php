<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserBalance;
use Illuminate\Database\Seeder;

class UserBalanceSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::all() as $user) {
            UserBalance::create([
                'user_id' => $user->id,
                'balance' => 0,
            ]);
        }
    }
}
