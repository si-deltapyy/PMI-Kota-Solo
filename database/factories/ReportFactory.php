<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'id_user' => '2',
            'nama_bencana' => $this->faker->word,
            'tanggal_kejadian' => $this->faker->date,
            'keterangan' => $this->faker->sentence,
            'timestamp_report' => now(),
            'status' => $this->faker->randomElement(['pending', 'resolved']),
            'lokasi_longitude' => $this->faker->longitude,
            'lokasi_latitude' => $this->faker->latitude,
        ];
    }
}
