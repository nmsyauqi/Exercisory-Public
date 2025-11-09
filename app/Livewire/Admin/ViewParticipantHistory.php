<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class ViewParticipantHistory extends Component
{
    public User $user;
    public function render()
    {
        return view('livewire.admin.view-participant-history')
            ->layout('layouts.app');
    }
}
