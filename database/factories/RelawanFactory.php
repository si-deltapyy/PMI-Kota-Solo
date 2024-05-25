<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\User; // Import kelas User
use App\Models\Relawan; // Import kelas Relawan


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relawan>
 */
class RelawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_relawan' => $this->faker->unique()->randomNumber(),
            'id_user' => User::factory()->create()->id_user,
            'lokasi_relawan' => $this->faker->city(),
            'status_relawan' => $this->faker->randomElement(['aktif', 'tidak aktif']),
        ];
    }
}
