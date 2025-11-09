<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public $confirmingDeactivationId = null;
    public $confirmingUser = null;

    public function askToDeactivate($userId)
    {
        $this->confirmingDeactivationId = $userId;
        $this->confirmingUser = User::find($userId);
    }
    

    /**
     * Mengambil daftar pengguna dari database.
     */
    public function loadUsers()
    {
        // Ambil semua user, diurutkan berdasarkan nama
        $this->users = User::orderBy('name', 'asc')->get();
    }

    /**
     * Mengubah peran pengguna (Admin <-> Participant).
     */
    public function toggleRole($userId)
    {
        // 1. Keamanan: Cek apakah user mencoba mengubah rolenya sendiri.
        if ($userId == Auth::id()) {
            // Kirim pesan error (kita akan tangani di view nanti, atau biarkan saja)
            session()->flash('error', 'Anda tidak dapat mengubah peran Anda sendiri.');
            return;
        }

        // 2. Temukan user
        $user = User::find($userId);

        if ($user) {
            // 3. Ubah rolenya
            if (strtolower($user->role) === 'admin') {
                $user->role = 'participant';
            } else {
                $user->role = 'admin';
            }
            
            $user->save();
            
            // // 4. Muat ulang daftar pengguna
            // $this->loadUsers();
            // session()->flash('message', 'Peran ' . $user->name . ' berhasil diubah.');
        }
    }

    // deaktivasi user
    public function deactivateUser($userId)
    {
        // Keamanan: Cek apakah user mencoba menonaktifkan diri sendiri
        if ($userId == Auth::id()) {
            session()->flash('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
            return;
        }

        $user = User::find($userId);
        if ($user) {
            $user->delete(); // soft delete
            session()->flash('message', 'Pengguna ' . $user->name . ' berhasil dinonaktifkan.');
            $this->confirmingDeactivationId = null;
        }
        
    }

    // reaktivasi user
    public function reactivateUser($userId)
    {
        // find all user
        $user = User::withTrashed()->find($userId);
        if ($user) {
            $user->restore(); // command reaktivasi
            session()->flash('message', 'Pengguna ' . $user->name . ' berhasil diaktifkan kembali.');
        }
    }
    public function render()
    {
        // TAMBAHKAN withTrashed() DI SINI
        $users = User::withTrashed() 
            ->orderBy('name', 'asc')
            ->paginate(10);
        
        return view('livewire.admin.user-management', [
            'users' => $users 
        ])->layout('layouts.app');
    }
}