<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-xl font-bold mb-6">
            Daftar Tanggal Absensi - Mapel: {{ $mapel->nama }}
        </h1>

        <ul class="space-y-3">
            @forelse($tanggalList as $tgl)
                <li class="bg-gray-100 p-3 rounded shadow flex justify-between items-center">
                    <span>{{ \Carbon\Carbon::parse($tgl->tanggal)->format('d M Y') }}</span>
                    <a href="{{ route('absensi.detail', [$mapel->id, $tgl->tanggal]) }}"
                        class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">
                        Detail
                    </a>
                </li>
            @empty
                <li>Tidak ada data absensi.</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
