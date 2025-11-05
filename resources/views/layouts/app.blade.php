@extends('layouts.base')

@section('body')
    
    {{-- ================================================================== --}}
    {{-- INI ADALAH SATU-SATUNYA TASKBAR YANG KITA BUTUHKAN --}}
    {{-- ================================================================== --}}
    @if (Route::has('login'))
        <div
            class="p-3 bg-gray-400 border-b-2 border-gray-600 shadow-md text-sm sm:fixed sm:top-0 sm:right-0 sm:flex sm:justify-end items-center w-full z-50">
            
            @auth
                {{-- 1. Tampilkan Nama Pengguna (Dipindah ke sini agar lebih rapi) --}}
                <div class="font-bold text-gray-900 ml-4 mr-4">
                    Hi, {{ Auth::user()->name }}
                </div>

                {{-- 2. Tombol Home (Sekarang di paling kiri) --}}
                <a href="{{ route('home') }}"
                    class="px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                    Home
                </a>

                {{-- 3. Tombol Role-Specific (Admin/Participant) --}}
                @if (strtolower(Auth::user()->role) === 'admin')
                    
                    {{-- Tombol Tasks --}}
                    <a href="{{ route('admin.tasks') }}"
                        class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        Tasks
                    </a>
                    
                    {{-- Tombol Laporan (Sudah benar, Anda nonaktifkan) --}}
                    {{-- <a href="{{ route('admin.participants.report') }}"
                        class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        Laporan
                    </a> --}}

                @elseif (strtolower(Auth::user()->role) === 'participant')
                    
                    {{-- Tombol Checklist --}}
                    <a href="{{ route('participant.checklist') }}"
                        class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        Checklist
                    </a>
                    
                @endif

                {{-- 4. Tombol Umum (Leaderboard) --}}
                <a href="{{ route('leaderboard') }}"
                    class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                    Leaderboard
                </a>

                

                {{-- 5. Tombol Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="inline-block ml-4">
                    @csrf
                    <button type="submit"
                        class="font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        Logout
                    </button>
                </form>

                {{-- 6. Lonceng Notifikasi (Hanya Participant) --}}
                @if (strtolower(Auth::user()->role) === 'participant')
                    {{-- Komponen ini sudah punya ml-4 sendiri di dalamnya --}}
                    <livewire:notification-bell /> 
                @endif
            
            @else
                {{-- 7. Tampilan Guest (Belum Login) --}}
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    @endif
    {{-- ================================================================== --}}
    {{-- AKHIR DARI TASKBAR --}}
    {{-- ================================================================== --}}


    {{-- Konten halaman akan dimuat di sini --}}
    <div class="pt-16"> {{-- Padding-top agar konten tidak tertutup taskbar --}}
        @yield('content')
        
        @isset($slot)
            {{ $slot }}
        @endisset
    </div>
@endsection