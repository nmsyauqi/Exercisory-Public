<?php

namespace App\Livewire\Participant;

use Livewire\Component;
use App\Models\Task;
use App\Models\Checkin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithPagination;


class DailyChecklist extends Component
{
    use WithPagination;

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
        $this->tasks = Task::orderBy('created_at', 'asc')->paginate(15);

        // 2. data checkin user hari ini
        $userId = Auth::id();
        $this->checkedTasks = Checkin::where('user_id', $userId)
                                     ->where('date', $this->today)
                                     ->pluck('task_id') 
                                     ->toArray(); 
    }


    public function calculateTotalPoints()
{
    $this->totalPointsToday = \App\Models\Task::whereIn('id', $this->checkedTasks)->sum('points');
}

    #[On('data-updated')]
    public function toggleTask($taskId)
    {
        $userId = Auth::id();

        if (in_array($taskId, $this->checkedTasks)) {
            Checkin::where('user_id', $userId)
                   ->where('task_id', $taskId)
                   ->where('date', $this->today)
                   ->delete();
            
            $this->checkedTasks = array_diff($this->checkedTasks, [$taskId]);

        } else {
            Checkin::create([
                'user_id' => $userId,
                'task_id' => $taskId,
                'date' => $this->today,
                'checked_at' => now(),
            ]);

            $this->checkedTasks[] = $taskId;
        }

        $this->calculateTotalPoints();
        
    }

    // render tampilan
    public function render()
    {
        return view('livewire.participant.daily-checklist')
               ->layout('layouts.app'); // view layout.app
    }
}