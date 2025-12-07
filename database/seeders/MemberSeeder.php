<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        // Member 1 (nanti punya toko)
        $member1 = User::create([
            'name' => 'Member Satu',
            'email' => 'member1@example.com',
            'password' => 'member1',
            'role' => 'member',
        ]);

        // Member 2
        User::create([
            'name' => 'Member Dua',
            'email' => 'member2@example.com',
            'password' => 'member2',
            'role' => 'member',
        ]);

        // simpan id untuk StoreSeeder
        config(['seed.owner_id' => $member1->id]);
    }
}
