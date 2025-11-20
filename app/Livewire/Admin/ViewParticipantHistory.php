<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class ViewParticipantHistory extends Component
{
    public User $user;

    public function mount(User $user)
    {
        // user dilihat harus bukan admin
        if ($user->role === 'admin') {
            // eror atau redirect
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat melihat riwayat akun Administrator.');
        }

        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.admin.view-participant-history')
            ->layout('layouts.app');
    }
}
