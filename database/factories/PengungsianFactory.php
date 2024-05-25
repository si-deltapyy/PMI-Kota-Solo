<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengungsian>
 */
class PengungsianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pengungsian' => $this->faker->unique()->randomNumber(),
            'nama_lokasi' => $this->faker->address(),
            'lati_lati' => $this->faker->latitude(),
            'lonngi_itude' => $this->faker->longitude(),
            '<5' => $this->faker->numberBetween(1, 100),
            '>5_<=18' => $this->faker->numberBetween(1, 100),
            '>18' => $this->faker->numberBetween(1, 100),
            'jumlah' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
