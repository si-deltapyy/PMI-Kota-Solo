<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personil>
 */
class PersonilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pengurus' => $this->faker->randomNumber(),
            'staf_markas_kabkota' => $this->faker->randomNumber(),
            'staf_markas_prov' => $this->faker->randomNumber(),
            'staf_markas_pusat' => $this->faker->randomNumber(),
            'relawan_pmi_kabkota' => $this->faker->randomNumber(),
            'relawan_pmi_prov' => $this->faker->randomNumber(),
            'relawan_pmi_linprov' => $this->faker->randomNumber(),
            'sukarelawan_sip' => $this->faker->randomNumber(),
        ];
    }
}
