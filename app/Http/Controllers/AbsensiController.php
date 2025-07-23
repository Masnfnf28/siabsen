<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Dataguru;
use App\Models\kelas;
use App\Models\mapel;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::Paginate(3);
        $dataguru = Dataguru::all();
        $mapel = mapel::all();
        $kelas = kelas::all();
        return view('page.absensi.index')->with([
            'absensi' => $absensi,
            'dataguru' => $dataguru,
            'mapel' => $mapel,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataguru = Dataguru::all();
        $mapel = mapel::all();
        $kelas = kelas::all();
        return view('page.absensi.create')->with([
            'dataguru' => $dataguru,
            'mapel' => $mapel,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'id_dataguru' => $request->input('id_dataguru'),
            'id_mapel' => $request->input('id_mapel'),
            'id_kelas' => $request->input('id_kelas'),
            'tanggal' => $request->input('tanggal'),
        ];

        Absensi::create($data);

        return redirect()->route('absensi.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'id_dataguru' => $request->input('id_dataguru'),
            'id_mapel' => $request->input('id_mapel'),
            'id_kelas' => $request->input('id_kelas'),
            'tanggal' => $request->input('tanggal'),
        ];

        $datas = Absensi::findOrFail($id);
        $datas->Absensi->update($data);

        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
