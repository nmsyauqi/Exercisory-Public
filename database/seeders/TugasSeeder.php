<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $tasks = [
            ['name' => 'Minum Obat Sesuai Jadwal', 'points' => 10],
            ['name' => 'Melakukan Fisioterapi 30 Menit', 'points' => 20],
            ['name' => 'Konsumsi Makanan Sehat 3x Sehari', 'points' => 15],
            ['name' => 'Mencatat Kondisi Tubuh Hari Ini', 'points' => 5],
            ['name' => 'Tidur Minimal 7 Jam', 'points' => 10],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
