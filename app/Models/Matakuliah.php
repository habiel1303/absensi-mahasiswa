<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matakuliah extends Model
{
    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'dosen'];

public function absensis() {
    return $this->hasMany(Absensi::class);
}
}
