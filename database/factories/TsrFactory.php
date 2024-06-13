<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tsr>
 */
class TsrFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medis' => $this->faker->randomNumber(),
            'paramedis' => $this->faker->randomNumber(),
            'relief' => $this->faker->randomNumber(),
            'logistik' => $this->faker->randomNumber(),
            'watsan' => $this->faker->randomNumber(),
            'it_telekom' => $this->faker->randomNumber(),
            'sheltering' => $this->faker->randomNumber(),
        ];
    }
}
