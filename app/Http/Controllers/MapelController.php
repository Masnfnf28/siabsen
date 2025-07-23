<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function index()
    {
        try {
            $nama = Mapel::paginate(10);
            return view('page.mapel.index', compact('nama'));
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

            Mapel::create($data);

            return redirect()->route('mapel.index')->with([
                'alert' => 'success',
                'message' => 'Data Mapel berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('mapel.index')->with([
                'alert' => 'error',
                'message' => 'Gagal menambahkan Mapel: ' . $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            $mapel = Mapel::findOrFail($id);
            $mapel->update($data);

            return redirect()->route('mapel.index')->with([
                'alert' => 'success',
                'message' => 'Data Mapel berhasil diperbarui!',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('mapel.index')->with([
                'alert' => 'error',
                'message' => 'Gagal memperbarui Mapel: ' . $e->getMessage(),
            ]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $mapel = Mapel::findOrFail($id);
            $mapel->delete();

            return redirect()->route('mapel.index')->with([
                'alert' => 'success',
                'message' => 'Data Mapel berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('mapel.index')->with([
                'alert' => 'error',
                'message' => 'Gagal menghapus Mapel: ' . $e->getMessage(),
            ]);
        }
    }
}
