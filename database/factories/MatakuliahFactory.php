<?php

namespace Database\Factories;

use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Matakuliah>
 */
class MatakuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'kode_mk' => fake()->unique()->bothify('MK###'),
        'nama_mk' => fake()->randomElement(['Pemrograman Web','Basis Data','Algoritma','Jaringan Komputer','Sistem Operasi']),
        'sks'     => fake()->randomElement([2, 3]),
        'dosen'   => fake()->name(),
    ];
}
}
