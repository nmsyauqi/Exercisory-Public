<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

// --- PASTIKAN INI ADALAH 'App\Actions\Fortify' ---
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use App\Actions\Fortify\UpdateUserPassword;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Actions\Fortify\UpdateUserProfileInformation;
// --- SELESAI ---

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // --- PASTIKAN KEDUA BLOK INI ADA ---
        
        // 1. Ikat Kontrak Update Profil
        $this->app->singleton(
            UpdatesUserProfileInformation::class,
            UpdateUserProfileInformation::class
        );

        // 2. Ikat Kontrak Update Password
        $this->app->singleton(
            UpdatesUserPasswords::class,
            UpdateUserPassword::class
        );
        // --- SELESAI ---
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
    }
}