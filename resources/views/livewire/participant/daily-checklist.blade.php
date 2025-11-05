<div>
    
    {{-- KITA BIARKAN HEADER SLOT INI, TAPI KITA GANTI STYLING-NYA --}}
    {{-- ATAU, HAPUS SLOT INI JIKA ANDA SUDAH MENAMBAHKAN TASKBAR DI ATAS --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{-- Kosongkan jika Anda sudah pakai taskbar di atas --}}
        </h2>
    </x-slot>

    {{-- UBAH BAGIAN KONTEN UTAMA --}}
    <div class="py-12 bg-gray-300 font-mono"> {{-- Tambah bg-gray-300 dan font-mono --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- GANTI KARTU 'bg-white' DENGAN WINDOW FRAME RETRO --}}
            <div class="bg-gray-300 border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700 shadow-[8px_8px_0_0_#000000] p-4 sm:p-8">

                {{-- TAMBAHKAN TITLE BAR UNTUK KONSISTENSI --}}
                <div class="bg-blue-700 text-white p-1.5 mb-6 border-t-2 border-l-2 border-blue-400 border-r-2 border-b-2 border-blue-900 shadow-inner">
                    <span class="font-bold text-sm">C:\PARTICIPANT\CHECKLIST.EXE</span>
                </div>

                <h3 class="text-xl font-bold text-gray-900">
                    Tugas untuk Hari Ini ({{ \Carbon\Carbon::parse($today)->format('l, d F Y') }})
                </h3>
                {{-- TAMBAHKAN BLOK BARU DI BAWAH INI --}}
                <div
                    class="my-4 p-4 bg-gray-200 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                    <span class="text-lg font-bold text-gray-800">SKOR HARI INI:</span>
                    <span class="ml-2 text-2xl font-bold text-green-700" style="text-shadow: 0 0 5px rgba(0,255,0,0.7);">
                        {{ $totalPointsToday }} Poin
                    </span>
                </div>
                {{-- SELESAI BLOK BARU --}}
                <p class="text-sm text-gray-700 mb-4">
                    &gt; Centang tugas yang sudah Anda selesaikan hari ini.
                </p>

                {{-- GANTI STYLE DAFTAR TUGAS --}}
                <div class="space-y-1">
                    @forelse ($tasks as $task)
                        {{-- Ganti style div ini --}}
                        <div class="flex items-center p-3 border-b-2 border-gray-400 hover:bg-gray-200">
                            <input 
                                id="task-{{ $task->id }}"
                                type="checkbox"
                                {{-- Ganti style checkbox --}}
                                class="form-checkbox h-5 w-5 text-blue-700 bg-white border-2 border-gray-700 focus:outline-none"
                                
                                @if(in_array($task->id, $checkedTasks)) checked @endif
                                wire:click="toggleTask({{ $task->id }})"
                            >
                            
                            {{-- Ganti style label --}}
                            <label for="task-{{ $task->id }}" class="ml-4 block text-lg font-bold text-gray-900 cursor-pointer">
                                {{ $task->name }}
                            </label>

                            {{-- Ganti style badge poin --}}
                            <span class="ml-auto px-2 text-md font-bold text-green-700" style="text-shadow: 0 0 5px rgba(0,255,0,0.7);">
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

            </div> {{-- End Window Frame --}}
        </div>
    </div>
</div>