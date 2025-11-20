<div class="flex items-center justify-center min-h-screen bg-gray-300 font-mono">
    
    {{-- WINDOW FRAME RETRO --}}
    <div class="w-full max-w-md bg-gray-300 border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700 shadow-[8px_8px_0_0_#000000]">
        
        {{-- TITLE BAR --}}
        <div class="flex justify-between items-center bg-blue-700 text-white p-1.5 border-b-2 border-gray-700 border-t-2 border-l-2 border-r-2 border-blue-400 shadow-inner mx-1 mt-1">
            <span class="font-bold text-sm truncate">C:\SYSTEM\RECOVERY.EXE</span>
            <a href="{{ route('sign-in') }}" class="bg-gray-300 text-black px-2 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 text-xs font-bold leading-none hover:bg-gray-400">X</a>
        </div>

        {{-- CONTENT AREA --}}
        <div class="p-6">
            
            <div class="flex flex-col items-center mb-6">
                <div class="text-4xl mb-2">🚑</div>
                <h2 class="text-xl font-bold text-gray-900">LUPA PASSWORD?</h2>
                <p class="text-sm text-gray-600 text-center mt-2">
                    Jangan panik. Masukkan email Anda, sistem akan mengirimkan kode penyelamat.
                </p>
            </div>

            {{-- JIKA SUKSES KIRIM --}}
            @if ($emailSent)
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 border-2 border-gray-500 shadow-inner">
                    <p class="font-bold">Status: TERKIRIM</p>
                    <p>{{ $status }}</p>
                    <p class="text-sm mt-2">Silakan cek kotak masuk (atau spam) email Anda.</p>
                </div>
                
                <a href="{{ route('sign-in') }}" 
                   class="block w-full text-center py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner font-bold">
                    < Kembali ke Login
                </a>

            {{-- JIKA BELUM KIRIM --}}
            @else
                <form wire:submit.prevent="sendResetLink">
                    {{-- Input Email --}}
                    <div class="mb-6">
                        <label class="block text-gray-800 font-bold mb-2 text-sm">EMAIL TARGET:</label>
                        <input wire:model="email" type="email" 
                            class="w-full bg-white border-2 border-gray-600 p-2 shadow-inner focus:outline-none focus:border-blue-700 font-mono"
                            placeholder="user@example.com">
                        @error('email') 
                            <span class="text-red-600 text-xs font-bold mt-1 block">> Error: {{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-between items-center gap-4">
                        <a href="{{ route('sign-in') }}" 
                           class="w-1/2 text-center py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-sm hover:bg-gray-200 active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner font-bold text-sm">
                            BATAL
                        </a>

                        <button type="submit" 
                            class="w-1/2 py-2 bg-blue-700 text-white border-t-2 border-l-2 border-blue-400 border-r-2 border-b-2 border-blue-900 shadow-sm hover:bg-blue-800 active:border-r-2 active:border-b-2 active:border-blue-400 active:border-t-2 active:border-l-2 active:shadow-inner font-bold text-sm relative">
                            
                            <span wire:loading.remove wire:target="sendResetLink">
                                KIRIM LINK
                            </span>
                            
                            <span wire:loading wire:target="sendResetLink">
                                PROSES...
                            </span>
                        </button>
                    </div>
                </form>
            @endif
            
        </div>

        {{-- STATUS BAR BAWAH --}}
        <div class="bg-gray-300 border-t-2 border-gray-500 p-1 flex justify-between text-xs text-gray-600 mx-1 mb-1">
            <span>Mode: RECOVERY</span>
            <span>Ver 1.0</span>
        </div>
    </div>
</div>