<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Mahasiswa::factory(20)->create();
        \App\Models\Matakuliah::factory(5)->create();
        \App\Models\Absensi::factory(100)->create();
    }
}
