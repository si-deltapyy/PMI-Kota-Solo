<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kejadian>
 */
class KejadianBencanaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_kejadian' => $this->faker->unique()->randomNumber(),
            'tanggal_kejadian' => $this->faker->date(),
            'lokasi' => $this->faker->city(),
            'uraian' => $this->faker->sentence(),
            'kebutuhan_internasional' => $this->faker->boolean(),
            'keterangan' => $this->faker->paragraph(),
            'akses_ke_lokasi' => $this->faker->address(),
            'kebutuhan' => $this->faker->sentence(),
            'giat_pemerintah' => $this->faker->sentence(),
            'hambatan' => $this->faker->sentence(),
        ];
    }
}
