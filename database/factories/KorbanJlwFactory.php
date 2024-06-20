<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KorbanJlw>
 */
class KorbanJlwFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_korban_jlw' => $this->faker->unique()->randomNumber(),
            'luka_berat' => $this->faker->numberBetween(1, 100),
            'luka_ringan' => $this->faker->numberBetween(1, 100),
            'hilang' => $this->faker->numberBetween(1, 1000),
            'mengungsi' => $this->faker->numberBetween(1, 1000),

        ];
    }
}
