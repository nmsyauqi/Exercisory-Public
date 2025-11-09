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
        // cek role
        $this->isAdmin = Auth::user()->role === 'admin';
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
            // query peserta biasa
            $scores = Checkin::join('tasks', 'checkins.task_id', '=', 'tasks.id')
                ->select('checkins.user_id', DB::raw('SUM(tasks.points) as total_score'))
                ->groupBy('checkins.user_id')
                ->orderBy('total_score', 'desc')
                ->take(10)
                ->get();
            
            $rank = 1;
            foreach ($scores as $score) {
                $this->participants[] = [
                    'rank' => $rank,
                    'name' => 'Peserta #' . $score->user_id, // Anonim
                    'email' => null, // tidak ditampilkan
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

