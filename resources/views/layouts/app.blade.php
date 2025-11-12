@extends('layouts.base')

@section('body')

    {{-- 1. TASKBAR (Tetap di atas, di luar window) --}}
    @if (Route::has('login'))
        <div
            class="p-3 bg-gray-400 border-b-2 border-gray-600 shadow-md text-sm sm:fixed sm:top-0 sm:right-0 sm:flex sm:justify-end items-center w-full z-50">

            @auth
                {{-- Nama Pengguna --}}
                <a href="{{ route('profile.edit') }}"
                    class="ml-4 mr-4 px-3 py-1 font-bold text-gray-900 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
                    Hi, {{ Auth::user()->name }}
                </a>

                {{-- Tombol Home --}}
                <a href="{{ route('home') }}"
                    class="px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                    Home
                </a>

                {{-- Tombol Role-Specific (Admin/Participant) --}}
                @if (strtolower(Auth::user()->role) === 'admin')
                    <a href="{{ route('admin.tasks') }}"
                        class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        Tasks
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm ...">
                        Users
                    </a>
                    {{-- <a href="{{ route('admin.participants.report') }}" ...> Laporan </a> --}}

                @elseif (strtolower(Auth::user()->role) === 'participant')
                    <a href="{{ route('participant.checklist') }}"
                        class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        Checklist
                    </a>

                    <a href="{{ route('participant.history') }}"
                        class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm ...">
                        History
                    </a>
                @endif

                {{-- Tombol Umum (Leaderboard) --}}
                <a href="{{ route('leaderboard') }}"
                    class="ml-4 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                    Leaderboard
                </a>



                {{-- Tombol Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="inline-block ml-4">
                    @csrf
                    <button type="submit"
                        class="font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        Logout
                    </button>
                </form>

                {{-- Lonceng Notifikasi (Hanya Participant) --}}
                @if (strtolower(Auth::user()->role) === 'participant')
                    <livewire:notification-bell /> 
                @endif

            @else
                <a href="{{ route('home') }}"
                    class="font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
                    Home
                </a>
                <a href="{{ route('login') }}"
                    class="ml-4 font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
                    Sign In
                </a>
            @endauth
        </div>
    @endif
    {{-- AKHIR DARI TASKBAR --}}

    {{-- 2. KONTEN HALAMAN UTAMA (DIBUNGKUS WINDOW) --}}
    <div class="pt-16 bg-gray-300 font-mono min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">

            {{-- window utama (frame luar) --}}
            <div class="bg-gray-300 overflow-hidden shadow-[8px_8px_0_0_#000000] border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700">

                {{-- title bar dinamis (mengambil dari URL) --}}
                <div class="bg-green-700 text-white p-1.5 border-b-2 border-gray-700 border-t-2 border-l-2 border-r-2 border-blue-400 shadow-inner">
                    <span class="font-bold text-sm">
                        C:\{{ \Illuminate\Support\Str::of(request()->path())->upper()->replace('/', '\\') }}.EXE
                    </span>
                </div>

                {{-- konten halaman (slot) sekarang ada di dalam window --}}
                <div class="p-6">
                    @yield('content')

                    @isset($slot)
                        {{ $slot }}
                    @endisset
                </div>

            </div> {{-- akhir window utama --}}
        </div>
    </div>
@endsection