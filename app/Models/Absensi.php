<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    protected $fillable = ['mahasiswa_id', 'matakuliah_id', 'tanggal', 'status'];

public function mahasiswa() {
    return $this->belongsTo(Mahasiswa::class);
}
public function matakuliah() {
    return $this->belongsTo(Matakuliah::class);
}
}
