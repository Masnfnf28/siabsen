<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">
                Tambah Absensi untuk Mapel: <span class="text-green-600">{{ $mapel->nama }}</span>
            </h1>

            <form action="{{ route('absensi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal:</label>
                        <input type="date" name="tanggal" class="border-gray-300 rounded-md shadow-sm w-full p-2" required value="{{ old('tanggal') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Guru:</label>
                        <select name="id_dataguru" class="border-gray-300 rounded-md shadow-sm w-full p-2" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}" {{ old('id_dataguru') == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelas:</label>
                        <select name="kelas_id" class="border-gray-300 rounded-md shadow-sm w-full p-2" onchange="this.form.submit()" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @php
                    $selectedKelasId = old('kelas_id');
                @endphp

                @if ($selectedKelasId)
                    <div class="mt-6 border-t pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Siswa</h3>

                        <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                            @php
                                $siswaList = \App\Models\DataSiswa::where('id_kelas', $selectedKelasId)->get();
                            @endphp

                            @foreach ($siswaList as $siswa)
                                <div class="flex items-center justify-between bg-gray-50 p-2 rounded-md border">
                                    <span class="text-gray-700">{{ $siswa->nama }}</span>
                                    <select name="siswa[{{ $siswa->id }}]" class="border-gray-300 rounded-md p-1">
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Alpa">Alpa</option>
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-6 text-right">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md shadow-md transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
