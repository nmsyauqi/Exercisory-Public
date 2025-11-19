<div>
    {{-- slot header (biarkan, karena ini ada di file layout utama) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Kosongkan jika Anda sudah pakai taskbar di layouts/app.blade.php --}}
        </h2>
    </x-slot>

    {{-- container grid untuk layout side-by-side --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
        {{-- 1. kolom kiri (info dasbor) --}}
        <div class="lg:col-span-1 space-y-6">
    
            {{-- sub-window statistik & grafik --}}
            <div class="bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-inner">
                <div class="bg-blue-700 text-white p-1.5 border-b-2 border-gray-700">
                    <span class="font-bold text-sm">C:\STATS.EXE</span>
                </div>
    
                {{-- padding untuk konten di dalam --}}
                <div class="p-4">
                    {{-- kotak skor hari ini --}}
                    <div
                        class="mb-4 p-4 bg-gray-200 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                        <span class="text-lg font-bold text-gray-800">SKOR HARI INI:</span>
                        <span class="ml-2 text-2xl font-bold text-green-700"
                            style="text-shadow: 0 0 5px rgba(0,255,0,0.7);">
                            {{ $totalPointsToday }} Poin
                        </span>
                    </div>
    
                    {{-- panggil grafik peserta --}}
                    @livewire('participant.score-chart')
                </div>
            </div>
            {{-- akhir sub-window statistik --}}
        </div>
        {{-- akhir kolom kiri --}}
    
    
        {{-- 2. kolom kanan (aksi checklist) --}}
        <div class="lg:col-span-2">
                        
                        {{-- sub-window daftar tugas --}}
                        <div class="bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-inner">
                            <div class="bg-blue-700 text-white p-1.5 border-b-2 border-gray-700">
                                <span class="font-bold text-sm">C:\TASKS.EXE</span>
                            </div>
                        
                            {{-- padding untuk konten di dalam --}}
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900">
                                    Tugas untuk Hari Ini ({{ \Carbon\Carbon::parse($today)->format('l, d F Y') }})
                                </h3>
                                <p class="text-sm text-gray-700 my-4">
                                    &gt; Centang tugas yang sudah Anda selesaikan hari ini.
                                </p>
                        
                                {{-- daftar tugas --}}
                                <div class="space-y-1">
                                    @forelse ($tasks as $task)
                                        <div class="flex items-center p-3 border-b-2 border-gray-400 hover:bg-gray-200">
                                            <input id="task-{{ $task->id }}" type="checkbox"
                                                class="form-checkbox h-5 w-5 text-blue-700 bg-white border-2 border-gray-700 focus:outline-none"
                                                @if(in_array($task->id, $checkedTasks)) checked @endif wire:click="toggleTask({{ $task->id }})">

                                            <label for="task-{{ $task->id }}" class="ml-4 block text-lg font-bold text-gray-900 cursor-pointer">
                                                {{ $task->name }}
                                            </label>

                                            <span class="ml-auto px-2 text-md font-bold text-green-700"
                                                style="text-shadow: 0 0 5px rgba(0,255,0,0.7);">
                                                +{{ $task->points }} Poin
                                            </span>
                                        </div>
                                    @empty
                                        <div class="text-center text-gray-700 py-4">
                                            <p>&gt; Admin belum menambahkan tugas harian.</p>
                                            <p>&gt; Status: IDLE</p>
                                        </div>
                                    @endforelse
                                    
                                </div>
                                {{-- akhir daftar tugas --}}
                            </div>
                        </div>
                        {{-- akhir sub-window daftar tugas --}}
                        </div>
                        {{-- akhir kolom kanan --}}
                        
                        </div>

            