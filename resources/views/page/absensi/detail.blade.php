<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-xl font-bold mb-6">
            Detail Absensi - {{ $mapel->nama }} <br>
            <span class="text-sm font-normal text-gray-600">
                Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
            </span>
        </h1>

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama Siswa</th>
                    <th class="p-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensi as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $index + 1 }}</td>
                        <td class="p-2 border">
                            {{ optional($item->dataguru)->nama ?? 'Guru tidak ditemukan' }}
                        </td>
                        <td class="p-2 border">{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
