<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // cek #1: apakah dia login?
        if (!Auth::check()) {
            return redirect('login');
        }

        // cek #2: ambil data baru dari database, jangan percaya sesi
        $user = User::find(Auth::id());

        // cek #3: cek apakah akun dinonaktifkan?
        if ($user->trashed()) {
            Auth::logout(); // logout paksa
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            // lempar ke login
            return redirect('login')->with('error', 'Akun Anda telah dinonaktifkan oleh Admin.');
        }

        // cek #4: cek rolenya (dari data baru)
        foreach ($roles as $role) {
            if (strtolower($user->role) == $role) {
                // jika cocok, izinkan request
                return $next($request);
            }
        }

        // jika role tidak cocok, lempar ke halaman utama
        return redirect('/');
    }
}