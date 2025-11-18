<?php

namespace App\Livewire\Participant;

use Livewire\Component;
use App\Models\Task;
use App\Models\Checkin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\Attributes\On; // Jangan lupa import ini jika menggunakan atribut #[On]

class DailyChecklist extends Component
{
    use WithPagination;

    public $tasks;
    public $checkedTasks = [];
    public $today;
    public $totalPointsToday = 0;
    public $isAdmin = false; // Tambahkan properti ini agar tidak error di view jika dipanggil

    public function mount()
    {
        // Cek Status Login & Role
        if (Auth::check()) {
            $this->isAdmin = Auth::user()->role === 'admin';
        } else {
            $this->isAdmin = false;
        }

        $this->today = Carbon::today()->toDateString();
        $this->loadChecklist();
        $this->calculateTotalPoints();
    }

    public function loadChecklist()
    {
        // 1. Load Tugas (Semua orang bisa lihat)
        $this->tasks = Task::orderBy('created_at', 'asc')->get();

        // 2. Load Data Checkin (Hanya untuk Member)
        if (Auth::check()) {
            $userId = Auth::id();
            $this->checkedTasks = Checkin::where('user_id', $userId)
                ->where('date', $this->today)
                ->pluck('task_id')
                ->toArray();
        } else {
            // Guest tidak punya checklist yang selesai
            $this->checkedTasks = [];
        }
    }

    public function calculateTotalPoints()
    {
        // Hitung poin hanya jika ada task yang diceklis
        if (!empty($this->checkedTasks)) {
            $this->totalPointsToday = Task::whereIn('id', $this->checkedTasks)->sum('points');
        } else {
            $this->totalPointsToday = 0;
        }
    }

    #[On('data-updated')]
    public function toggleTask($taskId)
    {
        // PROTEKSI: Jika Guest mencoba klik, lempar ke halaman login
        if (!Auth::check()) {
            return redirect()->route('sign-in');
        }

        $userId = Auth::id();

        if (in_array($taskId, $this->checkedTasks)) {
            // Uncheck
            Checkin::where('user_id', $userId)
                ->where('task_id', $taskId)
                ->where('date', $this->today)
                ->delete();

            $this->checkedTasks = array_diff($this->checkedTasks, [$taskId]);
        } else {
            // Check
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

    public function render()
    {
        return view('livewire.participant.daily-checklist')
               ->layout('layouts.app');
    }
}