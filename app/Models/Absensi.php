<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_dataguru',
        'id_matpel',
        'id_kelas',
        'tanggal',
    ];

    protected $table = 'absensi';

    // relasi ke guru
    public function dataguru()
    {
        return $this->belongsTo(Dataguru::class, 'id_dataguru', 'id');
    }

    // relasi ke mapel
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_matpel', 'id'); // huruf M besar
    }

    // relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id'); // huruf K besar
    }

    // App\Models\Absensi.php

    // app/Models/Absensi.php
    public function siswa()
    {
        return $this->belongsTo(\App\Models\DataSiswa::class, 'id_siswa');
    }

    // Tambahkan ini di dalam class Absensi
    public function detailAbsensi()
    {
        return $this->hasMany(DetailAbsensi::class, 'id_absensi');
    }
}
