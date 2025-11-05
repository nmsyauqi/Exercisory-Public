<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin (role: admin)
        User::create([
            'name' => 'Admin Proyek',
            'email' => 'admin@proyek.com',
            'password' => Hash::make('password'), 
            'role' => 'admin',
        ]);

        // 2. Akun Peserta (role: participant)
        User::create([
            'name' => 'Peserta Uji Coba',
            'email' => 'peserta@proyek.com',
            'password' => Hash::make('password'), 
            'role' => 'participant',
        ]);

        // Tambahkan 8 peserta dummy lagi
        User::factory()->count(8)->create([
            'role' => 'participant'
        ]);
    }
}
