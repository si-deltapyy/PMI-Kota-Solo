<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlatTdb>
 */
class AlatTdbFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_alat_tdb' => $this->faker->unique()->randomNumber(),
            'randu_ops' => $this->faker->word(),
            'ruk_depot' => $this->faker->word(),
            'ruk_tanki' => $this->faker->word(),
            'double_cabin' => $this->faker->word(),
            'alat_du' => $this->faker->word(),
            'amk_tpm' => $this->faker->word(),
            'alat_wasan' => $this->faker->word(),
            'rs_lapangan' => $this->faker->word(),
            'alat_pkod' => $this->faker->word(),
            'gedung_lapangan' => $this->faker->word(),
            'produk_giz' => $this->faker->word(),
            'alat_il_lapangan' => $this->faker->word(),
        ];
    }
}
