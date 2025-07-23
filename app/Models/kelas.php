<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $fillable = [
        'nama',
    ];

    protected $table = 'kelas';

    public function siswa()
    {
        return $this->hasMany(DataSiswa::class, 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_kelas','id');
    }
}
