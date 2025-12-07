<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VirtualAccount;

class VirtualAccountSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'member')->first();

        VirtualAccount::create([
            'user_id' => $user->id,
            'amount' => 100000,
            'va_code' => 'VA-TOPUP-0001',
            'type' => 'topup',
            'is_paid' => false,
        ]);
    }
}
