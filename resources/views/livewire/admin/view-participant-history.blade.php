<div>

    {{-- padding untuk konten --}}
    <div class="p-6 space-y-8">

        {{-- Header --}}
        <h3 class="text-xl font-bold text-gray-900">
            Riwayat Kepatuhan untuk: <span class="text-blue-700">{{ $user->name }}</span>
        </h3>

        {{-- 1. Panggil Komponen Grafik Skor --}}
        {{-- Kita lempar :userId ke komponen anak --}}
        @livewire('participant.score-chart', ['userId' => $user->id])

        {{-- 2. Panggil Komponen Kalender --}}
        {{-- Kita lempar :userId ke komponen anak --}}
        @livewire('participant.history-calendar', ['userId' => $user->id])

    </div>
</div>