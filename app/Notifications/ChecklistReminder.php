<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChecklistReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Kita hanya ingin menyimpannya ke database
        return ['database']; 
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // Ini adalah data yang akan disimpan di kolom 'data'
        // di tabel 'notifications' sebagai JSON.
        return [
            'message' => 'Anda belum menyelesaikan ceklis harian Anda. Selesaikan sebelum tengah malam!',
            'url' => route('checklist'), // Link saat notifikasi diklik
            'icon' => 'bell', // Ikon opsional
        ];
    }
}