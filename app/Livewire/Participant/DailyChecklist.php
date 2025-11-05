<?php

namespace App\Livewire\Participant;

use Livewire\Component;
use App\Models\Task;
use App\Models\Checkin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DailyChecklist extends Component
{
    public $tasks;
    public $checkedTasks = []; // Menyimpan ID tugas yang sudah dicek hari ini
    public $today;
    public $totalPointsToday = 0;  

    /**
     * Method 'mount' berjalan saat komponen pertama kali dimuat.
     */
    public function mount()
    {
        $this->today = Carbon::today()->toDateString();
        $this->loadChecklist();
        $this->calculateTotalPoints();
    }

    /**
     * Mengambil daftar tugas dan data checkin hari ini.
     */
    public function loadChecklist()
    {
        // 1. Ambil semua tugas yang tersedia
        $this->tasks = Task::orderBy('name', 'asc')->get();

        // 2. Ambil data checkin user hari ini
        $userId = Auth::id();
        $this->checkedTasks = Checkin::where('user_id', $userId)
                                     ->where('date', $this->today)
                                     ->pluck('task_id') // Ambil ID tugasnya saja
                                     ->toArray(); // Konversi ke array
    }


    public function calculateTotalPoints()
{
    // Kita cukup menjumlahkan poin dari tugas yang ID-nya 
    // ada di dalam array $this->checkedTasks kita.
    $this->totalPointsToday = \App\Models\Task::whereIn('id', $this->checkedTasks)->sum('points');
}
    /**
     * Dipanggil saat user mencentang/membatalkan centang checkbox.
     */
    public function toggleTask($taskId)
    {
        $userId = Auth::id();

        if (in_array($taskId, $this->checkedTasks)) {
            // --- FUNGSI UNCHECK ---
            Checkin::where('user_id', $userId)
                   ->where('task_id', $taskId)
                   ->where('date', $this->today)
                   ->delete();
            
            $this->checkedTasks = array_diff($this->checkedTasks, [$taskId]);

        } else {
            // --- FUNGSI CHECK ---
            Checkin::create([
                'user_id' => $userId,
                'task_id' => $taskId,
                'date' => $this->today,
                'checked_at' => now(),
            ]);

            $this->checkedTasks[] = $taskId;

            // ⛔️ JANGAN TARUH $this->calculateTotalPoints(); DI SINI
            // ⛔️ JANGAN TARUH $this->dispatch('data-updated'); DI SINI
        }

        // --- PINDAHKAN KEDUANYA KE SINI ---
        // (Di luar if/else, tapi tetap di dalam fungsi toggleTask)
        
        // 1. Hitung ulang poin (baik itu menambah atau mengurangi)
        $this->calculateTotalPoints();
        
        // 2. "Teriak" ke komponen lain bahwa data berubah
        $this->dispatch('data-updated');
    }

    /**
     * Merender tampilan.
     */
    public function render()
    {
        return view('livewire.participant.daily-checklist')
               ->layout('layouts.app'); // Asumsi menggunakan layout app
    }
}