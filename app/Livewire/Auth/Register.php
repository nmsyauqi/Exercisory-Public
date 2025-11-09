<?php

namespace App\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => [
                'required', 
                'min:8', 
                'same:passwordConfirmation',
                // jokes.exe
                function (string $attribute, mixed $value, \Closure $fail) {
                    $users = \App\Models\User::all(); // Pastikan model User di-import atau gunakan full namespace
                    foreach ($users as $user) {
                        if (\Illuminate\Support\Facades\Hash::check($value, $user->password)) {
                            $fail("Password ini telah digunakan oleh '{$user->name}' dengan email '{$user->email}'. Gunakan password lain.");
                            return;
                        }
                    }
                },
                // end jokes.exe
            ],
        ]);

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.auth');
    }
}
