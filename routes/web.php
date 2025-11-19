<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Participant\Checklist;
use App\Livewire\Participant\DailyChecklist;
use App\Livewire\Leaderboard;
use App\Livewire\Admin\TaskManager;
use App\Livewire\Participant\HistoryCalendar;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Profile\UpdateProfile;
use App\Livewire\Admin\ViewParticipantHistory;
use App\Livewire\Auth\MagicEntry;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/Exercisory');
Route::view('/Exercisory', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::redirect('/register', '/sign-in');
    Route::redirect('/login', '/sign-in');  
    Route::get('sign-in', MagicEntry::class)->name('sign-in');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/leaderboard', Leaderboard::class)->name('leaderboard');

Route::get('/checklist', DailyChecklist::class)->name('checklist');

Route::middleware('auth')->group(function () {
Route::middleware('auth')->group(function () {
    
    Route::get('/profile', UpdateProfile::class)->name('profile.edit'); 
    // ... route logout, verify dll ...

    // grup adm
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/tasks', TaskManager::class)->name('tasks');
        Route::get('/users', UserManagement::class)->name('users.index');
        Route::get('/users/{user}/history', ViewParticipantHistory::class)->name('users.history');
        // ...
    });

    // grup par
    Route::middleware(['role:participant'])->prefix('participant')->name('participant.')->group(function () {        
        Route::get('/history', HistoryCalendar::class)->name('history');
    });
});
    // grup par
    Route::middleware(['role:participant'])->prefix('participant')->name('participant.')->group(function () {
        // rute memeanggil livewire
        //Route::get('/checklist', DailyChecklist::class)->name('checklist');
        Route::get('/history', HistoryCalendar::class)->name('history');
    });
});
