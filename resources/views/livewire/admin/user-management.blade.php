<div>
    <div>
        @if ($confirmingDeactivationId)
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50"
                wire:click.self="cancelDeactivation">
                {{-- Window Modal Retro --}}
                <div
                    class="bg-gray-300 border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700 shadow-[8px_8px_0_0_#000000] p-4 sm:p-8 w-full max-w-md">

                    {{-- Title Bar --}}
                    <div
                        class="bg-red-700 text-white p-1.5 mb-6 border-t-2 border-l-2 border-red-400 border-r-2 border-b-2 border-red-900 shadow-inner">
                        <span class="font-bold text-sm">C:\SYSTEM\ALERT.EXE (Peringatan!)</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900">
                        Nonaktifkan Pengguna
                    </h3>
                    <p class="text-base text-gray-800 my-4">
                        Anda yakin ingin menonaktifkan akun
                        <strong class="text-red-700">{{ $confirmingUser->name ?? '' }}</strong>?
                        <br><br>
                        (Akun ini dapat diaktifkan kembali nanti).
                    </p>

                    {{-- Tombol Aksi Modal --}}
                    <div class="flex justify-end space-x-4 mt-6">
                        <button wire:click="cancelDeactivation" {{-- <-- Panggil method baru kita --}} class="font-semibold ...">
                            Batal
                        </button>
                        <button wire:click="deactivateUser({{ $confirmingDeactivationId }})"
                            class="font-semibold text-white px-4 py-2 bg-red-600 border-t-2 border-l-2 border-red-400 border-r-2 border-b-2 border-red-800 shadow-sm active:shadow-inner active:bg-red-700">
                            Ya, Nonaktifkan
                        </button>
                    </div>
                </div>
            </div>
        @endif

    {{-- notifikasi sukses atau error --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    
    {{-- padding untuk konten di dalam --}}
    <div class="p-6">
        <h3 class="text-xl mb-4 font-bold text-gray-900">
            Manajemen Pengguna
        </h3>
        
        {{-- tabel pengguna --}}
        <div class="shadow overflow-hidden border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white bg-white">
            <table class="min-w-full divide-y-2 divide-gray-400">
                <thead class="bg-gray-300 border-b-2 border-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">Peran Saat Ini</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase w-40">Aksi</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase w-28">Riwayat</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200 divide-y divide-gray-400">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- badge peran --}}
                                @if(strtolower($user->role) === 'admin')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-200 text-red-800">
                                        Admin
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-200 text-blue-800">
                                        Participant
                                    </span>
                                @endif
                            </td>
                            
                            {{-- Kolom Aksi (Sudah diperbaiki) --}}
                            <td class="px-6 py-4 space-y-1 w-40">
                                @if($user->id !== Auth::id())
                                    @if ($user->trashed())
                                        {{-- Tombol Aktifkan Kembali --}}
                                        <button 
                                            wire:click="reactivateUser({{ $user->id }})"
                                            class="w-full font-semibold text-gray-900 px-3 py-1 bg-green-300 border-t-2 ... text-xs">
                                            Aktifkan
                                        </button>
                                    @else
                                        {{-- Tombol Ubah Peran --}}
                                        <button 
                                            wire:click="toggleRole({{ $user->id }})"
                                            class="w-full font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 ... text-xs">
                                            Ubah Peran
                                        </button>
                                        
                                        {{-- Tombol Nonaktifkan --}}
                                        <button 
                                            wire:click="askToDeactivate({{ $user->id }})"
                                            class="w-full font-semibold text-gray-900 px-3 py-1 bg-red-300 border-t-2 ... text-xs">
                                            Nonaktifkan
                                        </button>
                                    @endif
                                @else
                                    <span class="text-xs text-gray-500">(Anda)</span>
                                @endif
                            </td>
                            
                            {{-- Kolom Riwayat (Sudah diperbaiki) --}}
                            <td class="px-6 py-4 whitespace-nowrap w-28">
                                @if(strtolower($user->role) === 'participant' && !$user->trashed())
                                    <a href="{{ route('admin.users.history', $user) }}"
                                       wire:navigate
                                       class="font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200 text-xs">
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-xs text-gray-500">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Link Paginasi (biarkan) --}}
        <div class="mt-4">
            {{ $users->links() }}
        </div>
        
    </div>
</div>