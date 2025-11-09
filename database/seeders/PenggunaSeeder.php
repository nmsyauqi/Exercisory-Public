<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. (role: admin)
        User::create([
            'name' => 'satu',
            'email' => '1@1.1',
            'password' => Hash::make('fufufafa'), 
            'role' => 'participant',
        ]);

        // 2. (role: participant)
        User::create([
            'name' => 'dua',
            'email' => '2@2.2',
            'password' => Hash::make('fufufafa'), 
            'role' => 'participant',
        ]);

        // 3. (role: admin)
        // User::create([
        //     'name' => 'zero',
        //     'email' => '0@0.0',
        //     'password' => Hash::make('fufufafa'), 
        //     'role' => 'admin',
        // ]);

        // dummy
        User::factory()->count(0)->create([
            'role' => 'participant'
        ]);
    }
}
