<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    // properti untuk modal konfirmasi
    public $confirmingDeactivationId = null;
    public $confirmingUser = null;

    public function boot()
    {
        // ambil data terbaru
        $user = User::find(Auth::id());

        // satpam internal: cek peran dan status setiap request
        if (strtolower($user->role) !== 'admin' || $user->trashed()) {
            abort(403, 'Akses Ditolak.');
        }
    }

    // siapkan data untuk modal deaktivasi
    public function askToDeactivate($userId)
    {
        $this->confirmingDeactivationId = $userId;
        $this->confirmingUser = User::find($userId);
    }

    // ubah peran pengguna
    public function toggleRole($userId)
    {
        // keamanan: jangan ubah diri sendiri
        if ($userId == Auth::id()) {
            session()->flash('error', 'Anda tidak dapat mengubah peran Anda sendiri.');
            return;
        }

        $user = User::find($userId);

        if ($user) {
            if (strtolower($user->role) === 'admin') {
                $user->role = 'participant';
            } else {
                $user->role = 'admin';
            }
            $user->save();
            session()->flash('message', 'Peran ' . $user->name . ' berhasil diubah.');
        }
    }

    // nonaktifkan pengguna (soft delete)
    public function deactivateUser($userId)
    {
        // keamanan: jangan nonaktifkan diri sendiri
        if ($userId == Auth::id()) {
            session()->flash('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
            return;
        }

        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'Pengguna ' . $user->name . ' berhasil dinonaktifkan.');
            $this->confirmingDeactivationId = null;
        }
    }

    // aktifkan kembali pengguna
    public function reactivateUser($userId)
    {
        $user = User::withTrashed()->find($userId);
        if ($user) {
            $user->restore();
            session()->flash('message', 'Pengguna ' . $user->name . ' berhasil diaktifkan kembali.');
        }
    }

    public function render()
    {
        // satpam render: cek lagi saat refresh halaman
        $currentUser = User::find(Auth::id());
        if (strtolower($currentUser->role) !== 'admin' || $currentUser->trashed()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses dicabut.'); 
        }
        
        // ambil semua user termasuk yang nonaktif
        $users = User::withTrashed() 
            ->orderBy('name', 'asc')
            ->paginate(10);
        
        return view('livewire.admin.user-management', [
            'users' => $users 
        ])->layout('layouts.app');
    }
}