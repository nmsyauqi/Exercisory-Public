<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Checkin; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Notifications\ChecklistReminder;

class SendChecklistReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-checklist-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mulai memeriksa peserta yang belum ceklis...');
        
        $today = Carbon::today()->toDateString();

        // 1. Dapatkan ID semua peserta yang SUDAH ceklis hari ini
        $completedParticipantIds = Checkin::where('date', $today)
            ->distinct() // Ambil ID unik
            ->pluck('user_id') // Ambil kolom user_id
            ->toArray(); // Jadikan array

        // 2. Dapatkan semua peserta yang TIDAK ADA di daftar tadi
        $participantsToRemind = User::where('role', 'participant')
            ->whereNotIn('id', $completedParticipantIds) // <-- Kunci logikanya
            ->get();

        if ($participantsToRemind->isEmpty()) {
            $this->info('Semua peserta sudah menyelesaikan ceklis hari ini. Tidak ada notifikasi dikirim.');
            Log::info('Scheduler Check: Semua peserta sudah ceklis.');
            return;
        }

        // 3. Kirim notifikasi (Untuk saat ini, kita log saja)
        foreach ($participantsToRemind as $participant) {
            
            // Di sinilah nanti Anda akan menambahkan logika kirim email/WA
            // Contoh: Mail::to($participant->email)->send(new ReminderEmail());
            
            // MENGIRIM NOTIFIKASI KE DATABASE
    // Method notify() ada karena kita menambahkan trait Notifiable ke User
    $participant->notify(new ChecklistReminder());
        }

        $this->info('Selesai. ' . $participantsToRemind->count() . ' notifikasi pengingat dikirim ke database.');
    }

    
}
