<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateProfile extends Component
{
    // Untuk form Update Profil
    public $state = [
        'name' => '',
        'email' => ''
    ];

    // Untuk form Update Password
    public $passwordState = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function mount()
    {
        // Isi form profil dengan data pengguna saat ini
        $user = Auth::user();
        $this->state['name'] = $user->name;
        $this->state['email'] = $user->email;
    }

    /**
     * Memperbarui informasi profil (nama & email).
     */
    public function updateProfile(UpdatesUserProfileInformation $updater)
    {
        // Kita "lempar" tugas ini ke Fortify (bawaan Laravel)
        // Dia akan otomatis menangani validasi (email unik, dll)
        $updater->update(Auth::user(), $this->state);

        session()->flash('message_profile', 'Profil berhasil diperbarui.');
        
        // Penting: Refresh taskbar agar "Hi, [NamaBaru]" muncul
        return $this->redirect(route('profile.edit'), navigate: true);
    }

    /**
     * Memperbarui password.
     */
    public function updatePassword(UpdatesUserPasswords $updater)
    {
        // Reset error sebelumnya (jika ada)
        $this->resetErrorBag();

        // Kita "lempar" tugas ini ke Fortify
        // Dia akan menangani validasi (password saat ini benar, konfirmasi cocok, dll)
        $updater->update(Auth::user(), [
            'current_password' => $this->passwordState['current_password'],
            'password' => $this->passwordState['password'],
            'password_confirmation' => $this->passwordState['password_confirmation'],
        ]);

        // Jika berhasil, bersihkan form password
        $this->passwordState = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        session()->flash('message_password', 'Password berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.profile.update-profile')
            ->layout('layouts.app');
    }
}