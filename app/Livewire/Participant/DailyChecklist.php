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
    public $checkedTasks = []; // simpan id task yang sudah dikerjakan
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

    // ambil daftar tugas hari ini
    public function loadChecklist()
    {
        // 1. semua tugas tersedia
        $this->tasks = Task::orderBy('created_at', 'asc')->get();

        // 2. data checkin user hari ini
        $userId = Auth::id();
        $this->checkedTasks = Checkin::where('user_id', $userId)
                                     ->where('date', $this->today)
                                     ->pluck('task_id') // id tugas
                                     ->toArray(); // convert to array
    }


    public function calculateTotalPoints()
{
    // jumlahkan poin yang tugas id nya ada di $this->checkedTasks
    $this->totalPointsToday = \App\Models\Task::whereIn('id', $this->checkedTasks)->sum('points');
}
    // dipanggil saat checklist

    #[On('data-updated')]
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
        }

        // --- PINDAHKAN KEDUANYA KE SINI (DI LUAR IF/ELSE) ---
        
        // 1. Hitung ulang skor (untuk view peserta sendiri)
        $this->calculateTotalPoints();
        
        // 2. "TERIAK" ke komponen lain bahwa data telah berubah
        // $this->dispatch('data-updated');
    }

    // render tampilan
    public function render()
    {
        return view('livewire.participant.daily-checklist')
               ->layout('layouts.app'); // view layout.app
    }
}