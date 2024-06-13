<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengungsian>
 */
class PengungsianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lokasi' => $this->faker->address(),
            'laki_laki' => $this->faker->randomNumber(),
            'perempuan' => $this->faker->randomNumber(),
            '<5' => $this->faker->randomNumber(),
            '>5_<=18' => $this->faker->randomNumber(),
            '>18' => $this->faker->randomNumber(),
            'jumlah' => $this->faker->randomNumber(),
        ];
    }
}
