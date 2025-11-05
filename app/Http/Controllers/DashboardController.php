<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     * INI ADALAH METHOD 'index' YANG HILANG
     */
    public function index(Request $request)
    {
        // Tes debug kita masih ada di sini
        $user = Auth::user();
        

        // Kode di bawah ini belum akan berjalan sampai dd() dihapus
        $role = $user->role ? strtolower($user->role) : ''; 

        if ($role === 'admin') {
            return redirect()->route('admin.tasks');
        } elseif ($role === 'participant') {
            return redirect()->route('participant.checklist');
        } else {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/')->with('error', 'Role Anda tidak valid.');
        }
    }
}