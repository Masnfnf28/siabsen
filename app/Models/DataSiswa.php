<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama',
        // 'id_kelas',
        'jenis_kelamin',
        'alamat',
        'tgl_lahir',
    ];

    protected $table = 'datasiswa';
}
