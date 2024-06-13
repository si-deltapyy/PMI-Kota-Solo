<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlatTdb>
 */
class AlatTdbFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kend_ops' => $this->faker->randomNumber(),
            'truk_angkut' => $this->faker->randomNumber(),
            'truk_tanki' => $this->faker->randomNumber(),
            'double_cabin' => $this->faker->randomNumber(),
            'alat_du' => $this->faker->randomNumber(),
            'ambulans' => $this->faker->randomNumber(),
            'alat_watsan' => $this->faker->randomNumber(),
            'rs_lapangan' => $this->faker->randomNumber(),
            'alat_pkdd' => $this->faker->randomNumber(),
            'gudang_lapangan' => $this->faker->randomNumber(),
            'posko_aju' => $this->faker->randomNumber(),
            'alat_it_lapangan' => $this->faker->randomNumber(),
        ];
    }
}
