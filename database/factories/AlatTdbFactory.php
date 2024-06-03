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
            'kend_ops' => $this->faker->word(),
            'truk_angkut' => $this->faker->word(),
            'truk_tanki' => $this->faker->word(),
            'double_cabin' => $this->faker->word(),
            'alat_du' => $this->faker->word(),
            'ambulans' => $this->faker->word(),
            'alat_watsan' => $this->faker->word(),
            'rs_lapangan' => $this->faker->word(),
            'alat_pkdd' => $this->faker->word(),
            'gudang_lapangan' => $this->faker->word(),
            'posko_aju' => $this->faker->word(),
            'alat_it_lapangan' => $this->faker->word(),
        ];        
    }
}
