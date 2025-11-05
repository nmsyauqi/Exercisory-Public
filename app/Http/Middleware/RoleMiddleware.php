<?php

namespace App\Http\Middleware; // <-- Perhatikan namespace-nya

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware // <-- Ini nama kelas yang benar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login, lempar ke login
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Cek semua role yang diizinkan untuk rute ini
        foreach ($roles as $role) {
            // Kita pakai strtolower untuk memastikan (admin == admin)
            if (strtolower($user->role) == $role) {
                // Jika cocok, izinkan request
                return $next($request);
            }
        }

        // Jika tidak ada role yang cocok, lempar ke halaman utama
        return redirect('/');
    }
}