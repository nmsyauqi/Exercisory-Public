<div>
    {{-- padding untuk konten kalender --}}
    <div class="p-6">
        {{-- 1. Header Navigasi Bulan --}}
        <div class="flex justify-between items-center mb-4">
            {{-- Tombol Bulan Lalu --}}
            <button wire:click="goToPreviousMonth"
                class="font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
                &lt; Sebelumnya
            </button>

            {{-- Nama Bulan --}}
            <h2 class="text-xl font-bold text-gray-900">
                {{ $monthName }}
            </h2>

            {{-- Tombol Bulan Depan --}}
            <button wire:click="goToNextMonth"
                class="font-semibold text-gray-900 px-3 py-1 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
                Berikutnya &gt;
            </button>
        </div>

        {{-- 2. Grid Kalender --}}
        <div class="border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white bg-white">
            <table class="min-w-full">
                {{-- Header Nama Hari --}}
                <thead class="bg-gray-300 border-b-2 border-gray-600">
                    <tr>
                        <th class="py-2 px-2 text-center text-sm font-bold text-gray-900">Min</th>
                        <th class="py-2 px-2 text-center text-sm font-bold text-gray-900">Sen</th>
                        <th class="py-2 px-2 text-center text-sm font-bold text-gray-900">Sel</th>
                        <th class="py-2 px-2 text-center text-sm font-bold text-gray-900">Rab</th>
                        <th class="py-2 px-2 text-center text-sm font-bold text-gray-900">Kam</th>
                        <th class="py-2 px-2 text-center text-sm font-bold text-gray-900">Jum</th>
                        <th class="py-2 px-2 text-center text-sm font-bold text-gray-900">Sab</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200 divide-y divide-gray-400">
                    @foreach ($calendarGrid as $week)
                        <tr class="divide-x divide-gray-400">
                            @foreach ($week as $day)
                                <td class="h-24 p-2 align-top
                                                {{-- Logika Pewarnaan Retro --}}
                                                @if($day['status'] == 'empty') bg-gray-300 @endif
                                                @if($day['status'] == 'none') bg-gray-100 @endif
                                                @if($day['status'] == 'partial') bg-yellow-200 @endif
                                                @if($day['status'] == 'full') bg-green-300 @endif
                                            ">
                                    <span class="font-bold text-gray-900">{{ $day['day'] }}</span>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- 3. Legenda / Keterangan --}}
        <div class="mt-4 flex justify-end space-x-4 text-sm">
            <div class="flex items-center">
                <span class="w-4 h-4 bg-green-300 border border-gray-700 mr-2"></span>
                <span>Kepatuhan Penuh</span>
            </div>
            <div class="flex items-center">
                <span class="w-4 h-4 bg-yellow-200 border border-gray-700 mr-2"></span>
                <span>Sebagian</span>
            </div>
            <div class="flex items-center">
                <span class="w-4 h-4 bg-gray-100 border border-gray-700 mr-2"></span>
                <span>Tidak Ada</span>
            </div>
        </div>
    </div>
</div>