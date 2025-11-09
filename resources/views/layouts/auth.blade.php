@extends('layouts.base')
@section('body')
    
    {{-- 1. TASKBAR (HANYA UNTUK TAMU / GUEST) --}}
    <div
        class="p-3 bg-gray-400 border-b-2 border-gray-600 shadow-md text-sm sm:fixed sm:top-0 sm:right-0 sm:flex sm:justify-end items-center w-full z-50">
        
        <a href="{{ route('home') }}"
            class="font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
            Home
        </a>
        <a href="{{ route('login') }}"
            class="ml-4 font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
            Sign In
        </a>
    </div>
    {{-- AKHIR DARI TASKBAR --}}
    
    {{-- 2. KONTEN HALAMAN UTAMA (DIBUNGKUS WINDOW) --}}
    <div class="pt-16 bg-gray-300 font-mono min-h-screen flex items-center justify-center">
        <div class="max-w-lg w-full mx-auto px-4 sm:px-6 py-12">
            
            {{-- window utama (frame luar) --}}
            <div class="bg-gray-300 overflow-hidden shadow-[8px_8px_0_0_#000000] border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700">
                {{-- title bar dinamis (mengambil dari URL) --}}
                <div class="bg-blue-700 text-white p-1.5 border-b-2 border-gray-700 border-t-2 border-l-2 border-r-2 border-blue-400 shadow-inner">
                    <span class="font-bold text-sm">
                        C:\{{ \Illuminate\Support\Str::of(request()->path())->upper()->replace('/', '\\') }}.EXE
                    </span>
                </div>
                {{-- konten halaman (login/register) akan dimuat di sini --}}
                <div class="p-6 ">
                    @yield('content')
                    
                    @isset($slot)
                        {{ $slot }}
                    @endisset
                </div>
            </div> {{-- akhir window utama --}}
        </div>
    </div>
@endsection