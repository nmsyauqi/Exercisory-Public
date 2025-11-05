<div>
    {{-- Kita akan letakkan ini di dalam slot 'header' jika menggunakan layout app --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor & Manajemen Tugas') }}
        </h2>
    </x-slot>

    {{-- UBAH CONTAINER UTAMA AGAR BERTEMA RETRO --}}
    <div class="py-12 bg-gray-300 font-mono">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-300 overflow-hidden shadow-[8px_8px_0_0_#000000] border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700 p-6">

                @if (session()->has('message'))
                    <div class..." role="alert">
                        ...
                    </div>
                @endif
                @if (session()->has('error'))
                    ...
                @endif
                
                
                {{-- ============== TAMBAHKAN KODE BARU MULAI DARI SINI ============== --}}
                
                <div class="mb-8">
                    <div class="bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-inner">
                        
                        <div class="bg-blue-700 text-white p-1.5 border-b-2 border-gray-700">
                            <span class="font-bold text-sm">C:\ADMIN\TASKS.EXE</span>
                        </div>
                        
                        <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <div class="bg-gray-200 p-3 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                                <h4 class="text-sm font-bold text-gray-700 uppercase">Total Peserta</h4>
                                <p class="text-3xl font-bold text-blue-700">{{ $totalParticipants }}</p>
                            </div>
                            
                            <div class="bg-gray-200 p-3 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                                <h4 class="text-sm font-bold text-gray-700 uppercase">Total Tugas Aktif</h4>
                                <p class="text-3xl font-bold text-blue-700">{{ $totalTasks }}</p>
                            </div>
                            
                            <div class="bg-gray-200 p-3 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                                <h4 class="text-sm font-bold text-gray-700 uppercase">Check-in Hari Ini</h4>
                                <p class="text-3xl font-bold text-green-700">{{ $totalCheckinsToday }}</Sistem Gamifikasi Kepatuhan Kesehatan (Health Compliance ScoringSystem)span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- ============== SELESAI KODE BARU ============== --}}
                
                
                
                <div class="mb-6">
                    <form wire:submit="save">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 leading-5">Nama Tugas</label>
                                {{-- Ganti style input --}}
                                <input type="text" wire:model.defer="name" id="name" class="mt-1 block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100" placeholder="Misal: Minum 2L air">
                                @error('name') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="points" class="block text-sm font-bold text-gray-700 leading-5">Poin</label>
                                {{-- Ganti style input --}}
                                <input type="number" wire:model.defer="points" id="points" class="mt-1 block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100" placeholder="Misal: 10">
                                @error('points') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex items-end space-x-2">
                                {{-- Ganti style tombol --}}
                                <button type="submit" class="font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                                    {{ $isEditing ? 'Perbarui Tugas' : 'Tambah Tugas' }}
                                </button>
                                @if ($isEditing)
                                    <button type="button" wire:click="resetForm" class="font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                                        Batal
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            {{-- Ganti style tabel --}}
                            <div class="shadow overflow-hidden border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white bg-white">
                                <table class="min-w-full divide-y-2 divide-gray-400">
                                    <thead class="bg-gray-300 border-b-2 border-gray-600">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">
                                                Nama Tugas
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">
                                                Poin
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Aksi</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-200 divide-y divide-gray-400">
                                        @forelse ($tasks as $task)
                                            <tr class="hover:bg-gray-100">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-bold text-gray-900">{{ $task->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full text-green-700">
                                                        {{ $task->points }} Poin
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                    <button wire:click="edit({{ $task->id }})" class="text-blue-700 hover:text-blue-900 underline">Edit</button>
                                                    
                                                    <button 
                                                        wire:click="delete({{ $task->id }})" 
                                                        wire:confirm="Anda yakin ingin menghapus tugas '{{ $task->name }}'?"
                                                        class="text-red-700 hover:text-red-900 underline">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                                                    &gt; Belum ada tugas yang dibuat.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>