<div class="py-12 bg-gray-300 font-mono">

    <h3 class="text-xl font-bold text-gray-900">
        Papan Peringkat
    </h3>

    {{-- INI LOGIKA PINTAR DI SISI VIEW --}}
    @if ($isAdmin)
        <p class="text-sm text-gray-700 mb-6">&gt; (Tampilan Admin) Laporan lengkap skor semua peserta.</p>
    @else
        <p class="text-sm text-gray-700 mb-6">&gt; (Tampilan Peserta) Menampilkan Top 10 peserta anonim.</p>
    @endif


    <div class="border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white bg-white">
        <table class="min-w-full divide-y-2 divide-gray-400">
            <thead class="bg-gray-300 border-b-2 border-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">Peringkat</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">Nama</th>

                    @if ($isAdmin) {{-- Admin lihat Email --}}
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">Email</th>
                    @endif

                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase">Total Skor</th>
                </tr>
            </thead>
            <tbody class="bg-gray-200 divide-y divide-gray-400">

                @forelse ($participants as $participant)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-3 text-lg font-bold">
                            #{{ $isAdmin ? $loop->iteration : $participant['rank'] }}
                        </td>
                        <td class="px-6 py-3 text-md font-bold text-gray-800">
                            {{-- Data bisa berupa objek (admin) atau array (peserta) --}}
                            {{ $participant['name'] ?? $participant->name }}
                        </td>

                        @if ($isAdmin) {{-- Admin lihat Email --}}
                            <td class="px-6 py-3 text-sm text-gray-700">
                                {{ $participant->email }}
                            </td>
                        @endif

                        <td class="px-6 py-3 text-md font-bold text-green-700">
                            {{ $participant['total_score'] ?? $participant->total_score }} Poin
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $isAdmin ? 4 : 3 }}" class="px-6 py-4 text-center text-gray-700">
                            &gt; Belum ada data.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>