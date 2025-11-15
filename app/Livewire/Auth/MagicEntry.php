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
    public $showForgotPasswordLink = false;

    // status tampilan
    public $step = 1; // 1 = input email, 2 = input password/nama
    public $isRegistering = false;

    // pesan sambutan dinamis
    public $greeting = 'Selamat datang!';

    // langkah 1: cek email
    public function checkEmail()
    {
        $this->validate(['email' => 'required|email']);

        // cari semua user 
        $user = User::where('email', $this->email)->withTrashed()->first();

        if ($user) {
            
            // user trashed?
            if ($user->trashed()) {
                // eror akun dinonaktifkan
                $this->addError('email', 'Akun ini telah dinonaktifkan. Silakan hubungi administrator.');
                return;
            }

            // aktif
            $this->isRegistering = false;
            $this->greeting = "Halo lagi, {$user->name}!";

        } else {
            // tidak ditemukan
            $this->isRegistering = true;
            $this->greeting = "Sepertinya Anda baru di sini. Mari berkenalan!";
        }

        $this->step = 2; 
    }

    // step 2
    public function submit()
    {
        // validasi berdasarkan mode
        if ($this->isRegistering) {
            // registrasi
            $this->validate([
                'name' => 'required|min:3',
                'password' => [
                    'required',
                    'min:8',
                    // jokes.exe
                    function (string $attribute, mixed $value, \Closure $fail) {
                        
                        // flag jokes.exe ada?
                        if (\Illuminate\Support\Facades\Storage::disk('local')->exists('jokes.exe.enabled')) {
                            
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
            // masuk
            $this->validate(['password' => 'required']);

            if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                $this->addError('password', 'Password yang Anda masukkan salah.');
                $this->showForgotPasswordLink = true; // link lupa password
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