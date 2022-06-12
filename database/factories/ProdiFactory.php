<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prodi>
 */
class ProdiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_prodi' => $this->faker->unique()->randomElement([
                'Pengelolaan Hutan',
                'Pengolahan Hasil Hutan',
                'Budidaya Tanaman Perkebunan',
                'Teknologi Hasil Perkebunan',
                'Pengelolaan Lingkungan',
                'Teknologi Geomatika',
                'Pengelolaan Perkebunan',
                'Teknologi Rekayasa Perangkat Lunak',
                'Rekayasa Kayu'
            ]),
        ];
    }
}
