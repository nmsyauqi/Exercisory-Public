<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function mount()
{
    if (Auth::check()) {
        // logika user terautentikasi
        $user = Auth::user();
        $this->userName = $user->name;
        $this->totalPoints = $user->checkins()->sum('points');
        // load data user
    } else {
        // logika user tamu
        $this->userName = "Tamu";
        $this->totalPoints = 0;
        $this->ranking = "-";
        }
}

    public function render()
    {
        return view('livewire.dashboard');
    }
}
