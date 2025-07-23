<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;


class KelasController extends Controller
{
    public function index()
    {
        try {
            $nama = kelas::paginate(10);
            return view('page.kelas.index', compact('nama'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            kelas::create($data);

            return redirect()->route('kelas.index')->with([
                'alert' => 'success',
                'message' => 'Data Kelas berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with([
                'alert' => 'error',
                'message' => 'Gagal menambahkan Kelas: ' . $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            $kelas = Kelas::findOrFail($id);
            $kelas->update($data);

            return redirect()->route('kelas.index')->with([
                'alert' => 'success',
                'message' => 'Data Kelas berhasil diperbarui!',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('krlas.index')->with([
                'alert' => 'error',
                'message' => 'Gagal memperbarui Kelas: ' . $e->getMessage(),
            ]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $kelas = kelas::findOrFail($id);
            $kelas->delete();

            return redirect()->route('Kelas.index')->with([
                'alert' => 'success',
                'message' => 'Data Kelas berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with([
                'alert' => 'error',
                'message' => 'Gagal menghapus Kelas: ' . $e->getMessage(),
            ]);
        }
    }
}
