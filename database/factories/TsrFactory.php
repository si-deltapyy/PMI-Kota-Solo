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
            'id_tsr' => $this->faker->unique()->randomNumber(),
            'randu' => $this->faker->word(),
            'baramode' => $this->faker->word(),
            'reloif' => $this->faker->word(),
            'logistik' => $this->faker->word(),
            'watsan' => $this->faker->word(),
            'shelter' => $this->faker->word(),
            'showering' => $this->faker->word(),
        ];
    }
}
