<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonilNarahubung>
 */
class PersonilNarahubungFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_narahubung' => $this->faker->unique()->randomNumber(),
            'nama_lengkap' => $this->faker->name(),
            'posisi' => $this->faker->jobTitle(),
            'kontak' => $this->faker->phoneNumber(),
        ];
    }
}
