<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KerusakanFasilSosial>
 */
class KerusakanFasilSosialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sekolah' => $this->faker->randomNumber(),
            'tempat_ibadah' => $this->faker->randomNumber(),
            'rumah_sakit' => $this->faker->randomNumber(),
            'pasar' => $this->faker->randomNumber(),
            'gedung_pemerintah' => $this->faker->randomNumber(),
            'lain_lain' => $this->faker->randomNumber(),
        ];
    }
}
