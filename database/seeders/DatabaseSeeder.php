<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun dosen
        User::create([
            'name'     => 'Dosen Admin',
            'email'    => 'dosen@gmail.com',
            'password' => Hash::make('dosen123'),
        ]);

        // Data lainnya
        Mahasiswa::factory(20)->create();
        Matakuliah::factory(5)->create();
        Absensi::factory(100)->create();
    }
}
