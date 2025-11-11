<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use App\Models\User; 

class UpdateUserPassword implements UpdatesUserPasswords
{
    // validasi dan update password user
    public function update($user, array $input)
    {
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            
            'password' => [
                'required', 
                'string', 
                Password::defaults(), 
                'confirmed',
                
                // aturan: password baru tidak boleh sama dengan yang lama
                function (string $attribute, mixed $value, \Closure $fail) use ($user) {
                    if (Hash::check($value, $user->password)) {
                        $fail('Password baru tidak boleh sama dengan password Anda saat ini.');
                    }
                },
                
                // fitur jokes.exe (validasi unik antar user) - dinonaktifkan sementara
                /*
                function (string $attribute, mixed $value, \Closure $fail) use ($user) {
                    // ambil semua user lain
                    $otherUsers = User::where('id', '!=', $user->id)->get();
                    
                    foreach ($otherUsers as $otherUser) {
                        // cek jika password sama dengan user lain
                        if (Hash::check($value, $otherUser->password)) {
                            $fail("Password ini sudah digunakan oleh {$otherUser->name} (email: {$otherUser->email}). Silakan gunakan password lain!");
                            return;
                        }
                    }
                },
                */
                // akhir fitur jokes.exe
            ],

        ], [
            'current_password.current_password' => __('Password yang Anda masukkan tidak cocok dengan password Anda saat ini.'),
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}