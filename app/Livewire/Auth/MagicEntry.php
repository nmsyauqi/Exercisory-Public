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

    // Status tampilan
    public $step = 1; // 1 = Input Email, 2 = Input Password/Nama
    public $isRegistering = false; // Apakah kita sedang dalam mode register?

    // Pesan sambutan dinamis
    public $greeting = 'Selamat datang!';

    public function checkEmail()
    {
        $this->validate(['email' => 'required|email']);

        $user = User::where('email', $this->email)->first();

        if ($user) {
            // Mode LOGIN
            $this->isRegistering = false;
            $this->greeting = "Halo lagi, {$user->name}!";
        } else {
            // Mode REGISTER
            $this->isRegistering = true;
            $this->greeting = "Sepertinya Anda baru di sini. Mari berkenalan!";
        }

        $this->step = 2; // Pindah ke langkah berikutnya
    }

    public function submit()
    {
        // Validasi berdasarkan mode
        if ($this->isRegistering) {
            $this->validate([
                'name' => 'required|min:3',
                // PERHATIKAN KURUNG SIKU [ ] DI BAWAH INI
                'password' => [
                    'required',
                    'min:8',
                    // jokes.exe
                    function (string $attribute, mixed $value, \Closure $fail) {
                        $users = \App\Models\User::all();
                        foreach ($users as $user) {
                            if (\Illuminate\Support\Facades\Hash::check($value, $user->password)) {
                                $fail("Password ini telah digunakan oleh '{$user->name}' dengan email '{$user->email}'. Coba password lain!");
                                return;
                            }
                        }
                    },// end jokes.exe
                ], 
            ]);

            // Proses Register
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            event(new Registered($user));
            Auth::login($user, $this->remember);

        } else {
            // Proses Login
            $this->validate(['password' => 'required']);

            if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                $this->addError('password', 'Password yang Anda masukkan salah.');
                return;
            }
        }

        // Redirect setelah sukses (Login atau Register)
        return redirect()->intended(route('dashboard'));
    }

    // Tombol "Kembali" untuk ganti email
    public function resetStep()
    {
        $this->step = 1;
        $this->password = '';
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.auth.magic-entry')->layout('layouts.auth');
    }
}