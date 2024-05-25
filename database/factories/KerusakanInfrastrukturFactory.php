<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KerusakanInfrastruktur>
 */
class KerusakanInfrastrukturFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_kerusakan_infrastruktur' => $this->faker->unique()->randomNumber(),
            'desa_kerusakan' => $this->faker->sentence(),
        ];
    }
}
