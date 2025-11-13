<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class MagicEntry extends Component
{
    public $email = '';
    public $password = '';
    public $name = '';
    public $remember = false;

    // status tampilan
    public $step = 1; // 1 = input email, 2 = input password/nama
    public $isRegistering = false;

    // pesan sambutan dinamis
    public $greeting = 'Selamat datang!';

    // langkah 1: cek email
    public function checkEmail()
    {
        $this->validate(['email' => 'required|email']);

        // 1. UBAH QUERY: Cari SEMUA user, termasuk yang dinonaktifkan
        $user = User::where('email', $this->email)->withTrashed()->first();

        if ($user) {
            
            // 2. TAMBAHKAN PENGECEKAN BARU: Apakah user ini dinonaktifkan?
            if ($user->trashed()) {
                // JIKA YA: Hentikan proses dan beri pesan error
                $this->addError('email', 'Akun ini telah dinonaktifkan. Silakan hubungi administrator.');
                return;
            }

            // Jika user ada dan AKTIF (Mode LOGIN)
            $this->isRegistering = false;
            $this->greeting = "Halo lagi, {$user->name}!";

        } else {
            // Jika user BENAR-BENAR tidak ada (Mode REGISTER)
            $this->isRegistering = true;
            $this->greeting = "Sepertinya Anda baru di sini. Mari berkenalan!";
        }

        $this->step = 2; // Pindah ke langkah berikutnya
    }

    // langkah 2: submit (login atau register)
    public function submit()
    {
        // validasi berdasarkan mode
        if ($this->isRegistering) {
            // --- LOGIKA REGISTER ---
            $this->validate([
                'name' => 'required|min:3',
                'password' => [
                    'required',
                    'min:8',
                    
                    // jokes.exe
                    // HAPUS 'use ($user)' DARI BARIS DI BAWAH INI
                    function (string $attribute, mixed $value, \Closure $fail) {
                        
                        // Cek apakah "flag file" ada?
                        if (\Illuminate\Support\Facades\Storage::disk('local')->exists('jokes.exe.enabled')) {
                            
                            // UBAH QUERY DI BAWAH INI
                            // Ganti 'User::where(...' dengan 'User::all()'
                            $otherUsers = \App\Models\User::all(); 
                            
                            foreach ($otherUsers as $otherUser) {
                                if (\Illuminate\Support\Facades\Hash::check($value, $otherUser->password)) {
                                    $fail("Password ini telah digunakan oleh '{$otherUser->email}'. Gunakan password lain!");
                                    return;
                                }
                            }
                        }
                    },
                    // end jokes.exe
                ],
            ]);

            // buat user baru
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            event(new Registered($user));
            Auth::login($user, $this->remember);

        } else {
            // --- LOGIKA LOGIN ---
            $this->validate(['password' => 'required']);

            if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                $this->addError('password', 'Password yang Anda masukkan salah.');
                return;
            }
        }

        // redirect ke dashboard setelah sukses
        return redirect()->intended(route('dashboard'));
    }

    // tombol "kembali" untuk ganti email
    public function resetStep()
    {
        $this->step = 1;
        $this->password = '';
        $this->name = '';
    }

    public function render()
    {
        // pastikan file view ini ada di resources/views/livewire/auth/magic-entry.blade.php
        return view('livewire.auth.magic-entry')->layout('layouts.app');
    }
}