<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EvakuasiKorban>
 */
class EvakuasiKorbanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'luka_ringanberat' => $this->faker->randomNumber(),
            'meninggal' => $this->faker->randomNumber(),
        ];
    }
}
