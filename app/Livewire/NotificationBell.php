<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    // Properti ini akan di-refresh otomatis oleh Livewire
    public $unreadNotifications;
    public $showDropdown = false;

    // 'mount' berjalan saat komponen pertama kali dimuat
    public function mount()
    {
        $this->loadNotifications();
    }

    // Mengambil notifikasi yang belum dibaca
    public function loadNotifications()
    {
        // Trait Notifiable memberi kita method unreadNotifications()
        $this->unreadNotifications = Auth::user()->unreadNotifications;
    }

    // Membuka atau menutup dropdown
    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    // Menandai notifikasi sebagai sudah dibaca
    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        
        if ($notification) {
            $notification->markAsRead();
        }

        // Ambil URL dari data notifikasi
        $url = $notification->data['url'] ?? '#';

        // Refresh daftar notifikasi setelah dibaca
        $this->loadNotifications();

        // Arahkan pengguna ke URL notifikasi
        return redirect($url);
    }

    // Merender tampilan
    public function render()
    {
        return view('livewire.notification-bell');
    }
}