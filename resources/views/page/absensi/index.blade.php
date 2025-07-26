<x-app-layout>
    <div class="container mx-auto py-10 px-6">
        <h1 class="text-xl font-bold mb-4">Daftar Absensi</h1>

        @if (session('success'))
            <div class="bg-green-100 p-3 rounded text-green-800 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border border-collapse shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border text-left">No</th>
                    <th class="p-3 border text-left">Mata Pelajaran</th>
                    <th class="p-3 border text-left">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($mapel as $index => $item)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="p-3 border">{{ $index + 1 }}</td>
                        <td class="p-3 border">{{ $item->nama }}</td>
                        <td class="p-3 border space-x-2">
                            <a href="{{ route('absensi.create', $item->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow">
                                Tambah
                            </a>
                            <a href="{{ route('absensi.edit', $item->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow">
                                Edit
                            </a>
                            <a href="{{ route('absensi.tanggal', $item->id) }}"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded shadow">
                                Lihat
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
