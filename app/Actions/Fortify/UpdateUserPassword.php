<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use App\Models\User; // Pastikan ini ada

class UpdateUserPassword implements UpdatesUserPasswords
{
    /**
     * Validate and update the user's password.
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            
            'password' => [
                'required', 
                'string', 
                Password::defaults(), 
                'confirmed',
                
                // --- ATURAN BARU (CEK PASSWORD LAMA) ---
                // (Dijalankan sebelum jokes.exe sesuai permintaan Anda)
                function (string $attribute, mixed $value, \Closure $fail) use ($user) {
                    if (Hash::check($value, $user->password)) {
                        $fail('Password baru tidak boleh sama dengan password Anda saat ini.');
                    }
                },
                // --- AKHIR ATURAN BARU ---
                
                // --- MULAI JOKES.EXE ---
                function (string $attribute, mixed $value, \Closure $fail) use ($user) {
                    // Ambil semua user LAIN (selain diri sendiri)
                    $otherUsers = User::where('id', '!=', $user->id)->get();
                    
                    foreach ($otherUsers as $otherUser) {
                        // Cek apakah password baru cocok dengan password user lain
                        if (Hash::check($value, $otherUser->password)) {
                            $fail("Password ini sudah digunakan oleh {$otherUser->name} dengan email '{$otherUser->email}', 
                            dan password '{$otherUser->password}'.
                            Gunakan password lain!");
                            return;
                        }
                    }
                },
                // --- AKHIR JOKES.EXE ---
            ],

        ], [
            'current_password.current_password' => __('Password yang Anda masukkan tidak cocok dengan password Anda saat ini.'),
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}