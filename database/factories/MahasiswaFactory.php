<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'nim' => fake()->unique()->numerify('##########'),
            'email' => fake()->unique()->safeEmail(),
            'angkatan' => fake()->randomElement(['2021', '2022', '2023', '2024']),
        ];
    }
}
