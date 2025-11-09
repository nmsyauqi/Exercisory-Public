<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'zero',
            'email' => '0@0.0',
            'password' => ('fufufafa'),
            'role' => 'admin',
        ]);

        $this->call([
            // Panggil seeder Anda di sini
            PenggunaSeeder::class, 
            TugasSeeder::class,
        ]);
        
        
    }
}
