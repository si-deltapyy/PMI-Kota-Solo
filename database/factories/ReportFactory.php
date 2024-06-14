<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Report;
use App\Models\KejadianBencana;
use App\Models\KorbanTerdampak;
use App\Models\KerusakanFasilSosial;
use App\Models\KerusakanRumah;
use App\Models\KerusakanInfrastruktur;
use App\Models\Pengungsian;
use App\Models\EvakuasiKorban;
use App\Models\LayananKorban;
use App\Models\Assessment;
use App\Models\Tsr;
use App\Models\AlatTdb;
use App\Models\Personil;

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
    public function definition(): array
    {
        return [
            'id_user' => User::factory(),
            'nama_bencana' => $this->faker->sentence(),
            'tanggal_kejadian' => $this->faker->dateTime(),
            'keterangan' => $this->faker->paragraph(),
            'timestamp_report' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['pending', 'verified', 'rejected']),
            'lokasi_longitude' => $this->faker->longitude(),
            'lokasi_latitude' => $this->faker->latitude(),
        ];
    }
}
