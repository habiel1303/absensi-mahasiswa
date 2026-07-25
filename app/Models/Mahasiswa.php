<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'angkatan',
        'foto',
    ];

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function matakuliahs()
    {
        return $this->belongsToMany(
            Matakuliah::class,
            'absensis',
            'mahasiswa_id',
            'matakuliah_id'
        );
    }
}
