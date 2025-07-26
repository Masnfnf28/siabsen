<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Dataguru;
use App\Models\DataSiswa;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $mapel = Mapel::all(); // Menampilkan semua mapel
        return view('page.absensi.index', compact('mapel'));
    }

    public function create($mapel_id, $kelas_id = null)
    {
        $mapel = Mapel::findOrFail($mapel_id);
        $gurus = Dataguru::all();
        $kelasList = Kelas::all();
        $siswa = $kelas_id ? DataSiswa::where('id_kelas', $kelas_id)->get() : collect();

        return view('page.absensi.create', compact('mapel', 'gurus', 'kelasList', 'siswa', 'kelas_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required|exists:mapel,id',
            'id_dataguru' => 'required|exists:dataguru,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'siswa' => 'required|array',
        ]);

        foreach ($request->siswa as $siswaId => $status) {
            Absensi::create([
                'id_matpel' => $request->mapel_id,
                'id_dataguru' => $request->id_dataguru,
                'id_kelas' => $request->kelas_id,
                'tanggal' => $request->tanggal,
                'id_siswa' => $siswaId,
                'status' => $status,
            ]);
        }

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $absensi = Absensi::findOrFail($id);
        $dataguru = Dataguru::all();
        $mapel = Mapel::all();
        $kelas = Kelas::all();

        return view('page.absensi.edit', compact('absensi', 'dataguru', 'mapel', 'kelas'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_dataguru' => 'required|exists:dataguru,id',
            'id_mapel' => 'required|exists:mapel,id',
            'id_kelas' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update([
            'id_dataguru' => $request->id_dataguru,
            'id_matpel' => $request->id_mapel,
            'id_kelas' => $request->id_kelas,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Data berhasil dihapus.');
    }

    // Menampilkan daftar tanggal absensi untuk satu mapel
    public function tanggal($mapelId)
    {
        $tanggalList = Absensi::where('id_matpel', $mapelId)
                        ->select('tanggal')
                        ->distinct()
                        ->orderBy('tanggal', 'desc')
                        ->get();

        $mapel = Mapel::findOrFail($mapelId);
        return view('page.absensi.tanggal', compact('tanggalList', 'mapel'));
    }

    // Menampilkan detail absensi per tanggal dan mapel
    public function detail($mapelId, $tanggal)
    {
        $mapel = Mapel::findOrFail($mapelId);
        $absensi = Absensi::with('siswa')
            ->where('id_matpel', $mapelId)
            ->where('tanggal', $tanggal)
            ->get();

        return view('page.absensi.detail', compact('absensi', 'mapel', 'tanggal'));
    }
}
