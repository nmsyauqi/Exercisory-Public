<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Checkin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Leaderboard extends Component
{
    public $participants = [];      public $isAdmin = false;   
    public function mount()
    {
        if (Auth::check()) {
        $this->isAdmin = Auth::user()->role === 'admin';
    } else {
        // Kalau Guest, anggap saja bukan admin
        $this->isAdmin = false;
    }
        $this->loadLeaderboard();
    }

    public function loadLeaderboard()
    {
        $this->participants = []; 
        // logika leaderboard
        if ($this->isAdmin) {
            // query admin
            $this->participants = User::where('role', 'participant')
                ->leftJoin('checkins', 'users.id', '=', 'checkins.user_id')
                ->leftJoin('tasks', 'checkins.task_id', '=', 'tasks.id')
                ->select(
                    'users.name', 
                    'users.email', 
                    'users.id as user_id',
                    DB::raw('COALESCE(SUM(tasks.points), 0) as total_score') 
                )
                ->groupBy('users.id', 'users.name', 'users.email')
                ->orderBy('total_score', 'desc')
                ->get();

        } else {
            $scores = Checkin::join('tasks', 'checkins.task_id', '=', 'tasks.id')

                ->join('users', 'checkins.user_id', '=', 'users.id')
                ->select(
                    'checkins.user_id',
                    'users.name', 
                    DB::raw('SUM(tasks.points) as total_score')
                )
                
                ->groupBy('checkins.user_id', 'users.name')
                ->orderBy('total_score', 'desc')
                ->take(10)
                ->get();

            $rank = 1;
            foreach ($scores as $score) {
                // 4. SEKARANG KITA MASUKKAN NAMA ASLINYA
                $this->participants[] = [
                    'rank' => $rank,
                    'name' => $score->name, // <-- SEKARANG SUDAH ADA NAMA ASLI
                    'email' => null,
                    'total_score' => $score->total_score
                ];
                $rank++;
            }
        }
    }

    public function render()
    {
        return view('livewire.leaderboard')
            ->layout('layouts.app');
    }
    
    public function refreshLeaderboard()
{
    $this->loadLeaderboard();
}
}

