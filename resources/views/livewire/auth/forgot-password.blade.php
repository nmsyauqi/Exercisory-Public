<div class="w-full sm:max-w-md mx-auto">
    
    {{-- HEADER (GAYA MAGIC ENTRY) --}}
    <div class="mb-6 text-center">
        <div class="flex justify-center mb-4">
             {{-- Ikon Kunci/Gembok Retro (Opsional, bisa diganti logo) --}}
            <div class="bg-white p-2 border-2 border-gray-800 shadow-[4px_4px_0_0_#000]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
        </div>
        
        <h2 class="text-xl font-bold text-gray-900 uppercase tracking-wide">
            Lupa Password?
        </h2>
        <p class="text-sm text-gray-700 mt-2 px-4">
            Masukkan email Anda, sistem akan mengirimkan kode pemulihan untuk Anda.
        </p>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 p-1 shadow-[4px_4px_0_0_#000]">
        <div class="border-2 border-gray-400 p-4">
            
            {{-- JIKA SUKSES TERKIRIM --}}
            @if ($emailSent)
                <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-4 shadow-sm">
                    <div class="flex items-center">
                        <span class="text-xl mr-2">✅</span>
                        <div>
                            <p class="font-bold text-sm">STATUS: TERKIRIM</p>
                            <p class="text-xs mt-1">{{ $status }}</p>
                        </div>
                    </div>
                    <p class="text-xs mt-2 italic border-t border-green-200 pt-2">
                        Silakan cek kotak masuk (atau spam) email Anda sekarang.
                    </p>
                </div>

                <a href="{{ route('sign-in') }}"
                    class="block w-full text-center font-bold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200 hover:bg-gray-200 transition-colors">
                    &laquo; Kembali ke Login
                </a>

            {{-- FORM INPUT --}}
            @else
                <form wire:submit.prevent="sendResetLink">
                    
                    {{-- Input Email --}}
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-bold text-gray-700 leading-5 mb-1">
                            EMAIL TARGET:
                        </label>
                        <input wire:model="email" id="email" type="email" autofocus
                            class="block w-full px-3 py-2 bg-white text-gray-900 border-2 border-gray-600 shadow-inner focus:outline-none focus:border-blue-700 focus:shadow-outline-blue font-mono"
                            placeholder="user@example.com">
                        
                        @error('email') 
                            <div class="mt-2 flex items-center text-red-600 text-xs font-bold animate-pulse">
                                <span class="mr-1">❌</span> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-between items-center gap-3 mt-6">
                        <a href="{{ route('sign-in') }}"
                            class="w-1/3 text-center font-semibold text-gray-700 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm hover:bg-gray-200 active:shadow-inner active:bg-gray-200 text-sm">
                            Batal
                        </a>

                        <button type="submit" wire:loading.attr="disabled"
                            class="w-2/3 font-bold text-white px-4 py-2 bg-blue-700 border-t-2 border-l-2 border-blue-400 border-r-2 border-b-2 border-blue-900 shadow-sm hover:bg-blue-800 active:shadow-inner active:border-blue-900 text-sm flex justify-center items-center">
                            
                            <span wire:loading.remove wire:target="sendResetLink">
                                KIRIM LINK
                            </span>
                            
                            <span wire:loading wire:target="sendResetLink">
                                MEMPROSES...
                            </span>
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </div>

    {{-- FOOTER KECIL --}}
    <div class="mt-4 text-center text-xs text-gray-500 font-mono">
        SYSTEM_RECOVERY.EXE v1.0
    </div>

</div>