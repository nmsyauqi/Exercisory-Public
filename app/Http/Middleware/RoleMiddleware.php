<?php

namespace App\Http\Middleware; // <-- Perhatikan namespace-nya

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // redirect ke login jika belum
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // cek role
        foreach ($roles as $role) {
            // pastikan admin == admin
            if (strtolower($user->role) == $role) {
                // sesuai maka lanjutkan request
                return $next($request);
            }
        }

        // tidak sesuai redirect ke home
        return redirect('/');
    }
}