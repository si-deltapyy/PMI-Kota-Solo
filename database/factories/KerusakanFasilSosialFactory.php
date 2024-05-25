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
            'id_kerusakan_fasil_sosial' => $this->faker->unique()->randomNumber(),
            'kerusakan_fasil_sosial' => $this->faker->sentence(),
            'keloalah' => $this->faker->sentence(),
            'tempat_ibadah' => $this->faker->sentence(),
            'rumah_sakit' => $this->faker->sentence(),
            'senar' => $this->faker->sentence(),
            'gedung_pemerintah' => $this->faker->sentence(),
            'lari_lain' => $this->faker->sentence(),
        ];
    }
}
