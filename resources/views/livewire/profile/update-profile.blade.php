<div>
    {{-- Kita akan punya dua 'window' di sini --}}
    <div class="space-y-8">

        {{-- 1. WINDOW PROFIL (NAMA & EMAIL) --}}
        <div class="bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-inner">
            
            <form wire:submit="updateProfile" class="p-6">
                <h3 class="text-xl mb-4 font-bold text-gray-900">
                    Informasi Profil
                </h3>
                <p class="text-sm text-gray-700 mb-4">
                    Perbarui nama dan alamat email Anda.
                </p>

                {{-- Notifikasi Sukses untuk Profil --}}
                @if (session('message_profile'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('message_profile') }}
                    </div>
                @endif

                <div class="space-y-4">
                    {{-- Nama --}}
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 leading-5">Nama</label>
                        <input type="text" wire:model="state.name" id="name" class="mt-1 block w-full px-3 py-1.5 bg-white ... border-white focus:outline-none focus:bg-gray-100">
                        @error('name') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 leading-5">Email</label>
                        <input type="email" wire:model="state.email" id="email" class="mt-1 block w-full px-3 py-1.5 bg-white ... border-white focus:outline-none focus:bg-gray-100">
                        @error('email') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        {{-- akhir window profil --}}


        {{-- 2. WINDOW UBAH PASSWORD --}}
        <div class="bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-inner">
            
            {{-- title bar --}}
            <div class="bg-blue-700 text-white p-1.5 border-b-2 border-gray-700">
                <span class="font-bold text-sm">C:\USER\PASSWORD.EXE</span>
            </div>

            <form wire:submit="updatePassword" class="p-6" x-data="{ showPasswords: false }">
                <h3 class="text-xl mb-4 font-bold text-gray-900">
                    Ubah Password
                </h3>
                <p class="text-sm text-gray-700 mb-4">
                    Pastikan Anda menggunakan password yang panjang dan acak.
                </p>

                {{-- Notifikasi Sukses untuk Password --}}
                @if (session('message_password'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('message_password') }}
                    </div>
                @endif

                <div class="space-y-4">
                    {{-- Password Saat Ini --}}
                    <div>
                        <label for="current_password" class="block text-sm font-bold text-gray-700 leading-5">Password Saat Ini</label>
                        <input :type="showPasswords ? 'text' : 'password'" wire:model="passwordState.current_password" id="current_password" class="mt-1 block w-full px-3 py-1.5 bg-white ... border-white focus:outline-none focus:bg-gray-100">
                        @error('current_password') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Password Baru --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 leading-5">Password Baru</label>
                        <input :type="showPasswords ? 'text' : 'password'" wire:model="passwordState.password" id="password" class="mt-1 block w-full px-3 py-1.5 bg-white ... border-white focus:outline-none focus:bg-gray-100">
                        @error('password') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Konfirmasi Password Baru --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 leading-5">Konfirmasi Password Baru</label>
                        <input :type="showPasswords ? 'text' : 'password'" wire:model="passwordState.password_confirmation" id="password_confirmation" class="mt-1 block w-full px-3 py-1.5 bg-white ... border-white focus:outline-none focus:bg-gray-100">
                        @error('password_confirmation') <span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Checkbox Tampilkan Password --}}
                    <div class="flex items-center">
                        <input id="show_passwords" type="checkbox" x-model="showPasswords" class="form-checkbox w-4 h-4 text-blue-700 bg-white border-gray-700">
                        <label for="show_passwords" class="ml-2 block text-sm text-gray-900 leading-5">
                            Tampilkan Password
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
        {{-- akhir window password --}}

    </div>
</div>