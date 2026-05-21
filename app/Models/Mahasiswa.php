<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    protected $fillable = ['nama', 'nim', 'email', 'angkatan'];

public function absensis() {
    return $this->hasMany(Absensi::class);
}
}
