<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public $unreadNotifications;
    public $showDropdown = false;

    public function mount()
    {
        $this->loadNotifications();
    }

    // unread notifications
    public function loadNotifications()
    {
        // method unreadNotifications()
        $this->unreadNotifications = Auth::user()->unreadNotifications;
    }

    // dropdown toggle
    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    // mark as read
    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        
        if ($notification) {
            $notification->markAsRead();
        }

        // url data notifikasi
        $url = $notification->data['url'] ?? '#';

        // refresh daftar notifikasi
        $this->loadNotifications();

        // url notifikasi
        return redirect($url);
    }
    // mark all as read
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->loadNotifications();
    }

    // render
    public function render()
    {
        return view('livewire.notification-bell');
    }
}