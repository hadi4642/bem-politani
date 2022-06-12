<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Divisi>
 */
class DivisiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_divisi' => $this->faker->unique()->randomElement([
                'Kesekretariatan dan Administrasi',
                'Komunikasi dan Media Komunikasi',
                'Luar Negeri',
                'Dalam Negeri',
                'Advokasi',
                'Kesejahteraan Manusia'
            ]),
        ];
    }
}
