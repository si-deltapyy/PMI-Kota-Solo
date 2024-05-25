<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LampiranDokumentasi>
 */
class LampiranDokumentasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_dokumentasi' => $this->faker->unique()->randomNumber(),
            'file_dokumentasi' => $this->faker->fileName(),
        ];
    }
}
