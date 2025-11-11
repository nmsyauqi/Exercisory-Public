<div>
    {{-- slot header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor & Manajemen Tugas') }}
        </h2>
    </x-slot>

    {{-- container utama retro --}}

    {{-- 1. window utama (frame luar) --}}

    {{-- container grid untuk layout side-by-side --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- 2. KOLOM KIRI (DASBOR) --}}
        <div class="lg:col-span-1 space-y-6">

            {{-- sub-window dasbor (statistik, grafik, notifikasi) --}}
            <div
                class="bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-inner">

                {{-- title bar sub-window dasbor --}}
                <div class="bg-blue-700 text-white p-1.5 border-b-2 border-gray-700">
                    <span class="font-bold text-sm">C:\ADMIN\STATS.EXE</span>
                </div>

                {{-- konten statistik (3 kotak) --}}
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">

                    {{-- Kotak 1: Total Peserta (Biarkan) --}}
                    <div
                        class="bg-gray-200 p-3 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                        <h4 class="text-sm font-bold text-gray-700 uppercase">Total Peserta</h4>
                        <p class="text-3xl font-bold text-blue-700">{{ $totalParticipants }}</p>
                    </div>

                    {{-- Kotak 2: Total Tugas Aktif (Biarkan) --}}
                    <div
                        class="bg-gray-200 p-3 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                        <h4 class="text-sm font-bold text-gray-700 uppercase">Total Tugas Aktif</h4>
                        <p class="text-3xl font-bold text-blue-700">{{ $totalTasks }}</p>
                    </div>

                    {{-- Kotak 3: Check-in Hari Ini (Biarkan) --}}
                    <div
                        class="bg-gray-200 p-3 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                        <h4 class="text-sm font-bold text-gray-700 uppercase">Sudah Check-in</h4>
                        <p class="text-3xl font-bold text-green-700">{{ $totalCheckinsToday }}</p>
                    </div>

                    {{-- 2. TAMBAHKAN KOTAK BARU INI --}}
                    <div
                        class="bg-gray-200 p-3 border-t-2 border-l-2 border-gray-400 border-r-2 border-b-2 border-gray-500 shadow-inner">
                        <h4 class="text-sm font-bold text-gray-700 uppercase">Belum Check-in</h4>
                        {{-- Kita beri warna merah agar terlihat sebagai peringatan --}}
                        <p class="text-3xl font-bold text-red-700">{{ $totalNotCheckinsToday }}</p>
                    </div>

                </div>
                {{-- panggil grafik admin --}}
                <div class="px-4 pb-4">
                    @livewire('admin.compliance-chart')
                </div>

                {{-- tombol notifikasi manual --}}
                <div class="p-4 border-t-2 border-gray-400 text-center">
                    {{-- notifikasi sukses atau error --}}
                    @if (session()->has('message'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <button wire:click="triggerReminders" wire:loading.attr="disabled"
                        class="font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        <span wire:loading.remove wire:target="triggerReminders">
                            🔔 Kirim Pengingat Ceklis
                        </span>
                        <span wire:loading wire:target="triggerReminders">
                            Mengirim...
                        </span>
                    </button>
                    <p class="text-xs text-gray-600 mt-2">
                        (Kirim 🔔 ke peserta yang belum ceklis hari ini)
                    </p>
                </div>
                <div class="mt-4">
                    <button wire:click="toggleJokesExe"
                        class="text-xs text-gray-500 hover:text-blue-700 underline opacity-50 hover:opacity-100">
                        [Toggle jokes.exe validation]
                    </button>
                </div>
                

            </div>
            {{-- akhir sub-window dasbor --}}
        </div>

        {{-- 3. KOLOM KANAN (CRUD) --}}
        <div class="lg:col-span-2">

                <h3 class="text-xl mb-4 font-bold text-gray-900">
                    Manajemen Tugas
                </h3>

                {{-- formulir crud --}}
                <div class="mb-6">
                    <form wire:submit="save">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 leading-5">Nama
                                    Tugas</label>
                                <input type="text" wire:model.defer="name" id="name"
                                    class="mt-1 block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100"
                                    placeholder="Misal: Minum 2L air">
                                @error('name') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="points" class="block text-sm font-bold text-gray-700 leading-5">Poin</label>
                                <input type="number" wire:model.defer="points" id="points"
                                    class="mt-1 block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100"
                                    placeholder="Misal: 10">
                                @error('points') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex items-end space-x-2">
                                <button type="submit"
                                    class="flex-1 justify-center font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                                    {{ $isEditing ? 'Perbarui' : 'Tambah Tugas' }}
                                </button>
                                @if ($isEditing)
                                    <button type="button" wire:click="resetForm"
                                        class="flex-1 justify-center font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                                        Batal
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                {{-- akhir formulir crud --}}

                {{-- tabel tugas --}}
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div
                                class="shadow overflow-hidden border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white bg-white">
                                <table class="min-w-full divide-y-2 divide-gray-400">
                                    <thead class="bg-gray-300 border-b-2 border-gray-600">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">
                                                Nama Tugas
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">
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
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-bold rounded-full text-green-700">
                                                        {{ $task->points }} Poin
                                                    </span>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                    <button wire:click="edit({{ $task->id }})"
                                                        class="text-blue-700 hover:text-blue-900 underline">Edit</button>

                                                    <button wire:click="delete({{ $task->id }})"
                                                        wire:confirm="Anda yakin ingin menghapus tugas '{{ $task->name }}'?"
                                                        class="text-red-700 hover:text-red-900 underline">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3"
                                                    class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                                                    &gt; Belum ada tugas yang dibuat.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $tasks->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- akhir tabel tugas --}}
        </div>
    </div>
</div>