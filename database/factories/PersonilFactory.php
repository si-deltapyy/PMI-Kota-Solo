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
            'id_personil' => $this->faker->unique()->randomNumber(),
            'pengurus' => $this->faker->name(),
            'staf_markas_kahkola' => $this->faker->boolean(),
            'staf_markas_prov' => $this->faker->boolean(),
            'staf_markas_pusat' => $this->faker->boolean(),
            'relawan_pmi_kahkola' => $this->faker->boolean(),
            'relawan_pmi_prov' => $this->faker->boolean(),
            'relawan_pmi_limprov' => $this->faker->boolean(),
            'sukareawan_sip' => $this->faker->boolean(),
        ];
    }
}
