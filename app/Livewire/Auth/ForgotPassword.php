<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $email = '';
    public $status = null; // Untuk pesan sukses
    public $emailSent = false; // Untuk ganti tampilan

    // Validasi input
    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    protected $messages = [
        'email.exists' => 'Email ini tidak terdaftar di database Exercisory.',
    ];

    public function sendResetLink()
    {
        $this->validate();

        try {
            // Kirim link reset password
            $response = Password::broker()->sendResetLink(['email' => $this->email]);

            if ($response == Password::RESET_LINK_SENT) {
                $this->emailSent = true;
                $this->status = trans($response);
            } else {
                $this->addError('email', trans($response));
            }
        } catch (\Exception $e) {
            // Tangkap error jika koneksi SMTP gagal dan tampilkan ke user
            \Illuminate\Support\Facades\Log::error("Mail Error: " . $e->getMessage()); // Catat ke log
            $this->addError('email', 'Gagal mengirim email. Server email sedang bermasalah. Silakan coba lagi nanti.');
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')
            ->layout('layouts.app'); // Pastikan pakai layout app
    }
}