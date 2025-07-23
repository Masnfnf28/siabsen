<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    protected $fillable = [
        'nama',
    ];

    protected $table = 'mapel';

    public function absensi(){
        return $this ->hasMany(absensi::class,'id');
    }
}
