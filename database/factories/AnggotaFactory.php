<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anggota>
 */
class AnggotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nim' => $this->faker->unique()->randomNumber(8),
            'nama' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'no_telp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'prodi_id' => $this->faker->numberBetween(1, 9),
            'tahun_angkatan' => $this->faker->year,
            'divisi_id' => $this->faker->numberBetween(1, 6),
            'password' => Hash::make('password'),
            'role' => $this->faker->randomElement(['Admin', 'User']),
        ];
    }
}
