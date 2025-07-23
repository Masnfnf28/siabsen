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

    public function dataguru()
    {
        return $this->belongsTo(Dataguru::class, 'id_dataguru', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(mapel::class, 'id_matpel', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id');
    }
}
