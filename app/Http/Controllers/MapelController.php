<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $nama = Mapel::paginate(10);
            return view('page.mapel.index', compact('nama'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            Mapel::create($data);

            return redirect()
                ->route('mapel.index')
                ->with('message_insert', 'Data Mapel berhasil ditambahkan');
        } catch (\Exception $e) {
            return view('error.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            $mapel = Mapel::findOrFail($id);
            $mapel->update($data);

            return redirect()
                ->route('mapel.index')
                ->with('message_update', 'Data Mapel berhasil diperbarui');
        } catch (\Exception $e) {
            return view('error.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mapel = Mapel::findOrFail($id);
            $mapel->delete();

            return redirect()
                ->route('mapel.index')
                ->with('message_delete', 'Data Mapel berhasil dihapus');
        } catch (\Exception $e) {
            return view('error.index')->with('error', $e->getMessage());
        }
    }
}
