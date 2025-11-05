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

Route::view('/', 'welcome')->name('home');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::middleware('auth')->group(function () {
    // Rute redirect utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/leaderboard', Leaderboard::class)->name('leaderboard');

    // Grup Admin
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // INI YANG BENAR
    Route::get('/tasks', TaskManager::class)->name('tasks');
});

    // Grup Participant
    Route::middleware(['role:participant'])->prefix('participant')->name('participant.')->group(function () {

        // Rute ini sekarang memanggil Kelas Livewire
        Route::get('/checklist', DailyChecklist::class)->name('checklist');
        
    });
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
