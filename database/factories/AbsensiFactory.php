<?php

namespace Database\Factories;

use App\Models\Absensi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Absensi>
 */
class AbsensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mahasiswa_id' => \App\Models\Mahasiswa::inRandomOrder()->first()->id,
            'matakuliah_id' => \App\Models\Matakuliah::inRandomOrder()->first()->id,
            'tanggal' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'status' => fake()->randomElement(['hadir', 'izin', 'sakit', 'alpha']),
        ];
    }
}
