<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\Checkin;
use Carbon\Carbon; // <-- Penting untuk manajemen tanggal

class CheckinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil semua peserta (bukan admin)
        $participants = User::where('role', 'participant')->get();

        // 2. Ambil semua tugas yang tersedia
        $tasks = Task::all();

        // Jika tidak ada peserta atau tugas, hentikan seeder
        if ($participants->isEmpty() || $tasks->isEmpty()) {
            $this->command->info('Tidak ada participant atau task untuk di-seed ke checkins.');
            return;
        }

        // 3. Loop untuk setiap peserta
        foreach ($participants as $participant) {
            
            // 4. Loop untuk 30 hari terakhir
            for ($i = 0; $i < 30; $i++) {
                $date = Carbon::today()->subDays($i); // Mulai dari hari ini, mundur 30 hari

                // 5. Untuk setiap hari, tentukan berapa tugas yang "diselesaikan"
                // Kita acak antara 0 s/d semua tugas
                $completedTasks = $tasks->random(rand(0, $tasks->count()));

                // 6. Buat data checkin palsu untuk tugas-tugas tersebut
                foreach ($completedTasks as $task) {
                    
                    // Pastikan tidak ada duplikat untuk user, task, dan tanggal yang sama
                    Checkin::firstOrCreate(
                        [
                            'user_id' => $participant->id,
                            'task_id' => $task->id,
                            'date' => $date->toDateString(),
                        ],
                        [
                            'checked_at' => $date->setHour(rand(7, 20))->setMinute(rand(0, 59)), // Waktu checkin acak
                        ]
                    );
                }
            }
        }
    }
}