{{-- Style relative diperlukan agar dropdown muncul di posisi yang benar --}}
<div wire:poll.10s class="relative" x-data="{ show: @entangle('showDropdown') }" @click.away="show = false">

    {{-- 1. IKON LONCENG (Tombol Toggle) --}}
    <button @click="show = !show"
        class="ml-4 font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200 relative">
        
        <span class="text-lg">🔔</span>

        {{-- Badge Jumlah Notifikasi (hanya tampil jika ada) --}}
        @if ($unreadNotifications->count() > 0)
            <span
                class="absolute -top-2 -right-2 w-5 h-5 bg-red-600 text-white text-xs font-bold rounded-full flex items-center justify-center border-2 border-gray-300">
                {{ $unreadNotifications->count() }}
            </span>
        @endif
    </button>

    {{-- 2. DROPDOWN MENU (Muncul saat 'show' = true) --}}
    <div x-show="show" x-transition 
         style="display: none;"
         class="absolute right-0 mt-2 w-80 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-700 shadow-[4px_4px_0_0_#000000] z-50">
        
        <div class="p-2 bg-blue-700 text-white border-b-2 border-gray-600">
            <span class="font-bold">Notifikasi</span>
        </div>

        <div class="max-h-96 overflow-y-auto">
            @forelse ($unreadNotifications as $notification)
                <div 
                    wire:click="markAsRead('{{ $notification->id }}')"
                    class="p-3 border-b border-gray-400 hover:bg-gray-200 cursor-pointer text-sm text-gray-800">
                    {{-- Kita ambil 'message' dari data JSON yang kita buat --}}
                    {{ $notification->data['message'] }}
                    <span class="block text-xs text-gray-600 mt-1">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>
            @empty
                <div class="p-3 text-center text-sm text-gray-700">
                    Tidak ada notifikasi baru.
                </div>
            @endforelse
        </div>
        
    </div>
</div>