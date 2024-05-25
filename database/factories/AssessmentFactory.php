<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Report;
use App\Models\Relawan;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_assessment' => $this->faker->unique()->randomNumber(),
            'id_relawan' => Relawan::factory()->create()->id_relawan,
            'fk2_id_report' => Report::factory()->create()->id_report,
            'timestamp_verifikasi' => $this->faker->dateTime(),
            'hasil_verifikasi' => $this->faker->sentence(),
        ];
    }
}
