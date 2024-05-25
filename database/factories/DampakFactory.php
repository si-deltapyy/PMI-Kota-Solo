<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Relawan;
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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dampak>
 */
class DampakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_dampak' => $this->faker->unique()->randomNumber(),
            'fk_id_kejadian_bencana' => KejadianBencana::factory()->create()->id_kejadian,
            'fk_id_korban_terdampak' => KorbanTerdampak::factory()->create()->id_korban_terdampak,
            'fk2_id_kerusakan_rumah' => KerusakanRumah::factory()->create()->id_kerusakan_rumah,
            'fk3_id_kerusakan_fasil_sosial' => KerusakanFasilSosial::factory()->create()->id_kerusakan_fasil_sosial,
            'fk4_id_kerusakan_infrastruktur' => KerusakanInfrastruktur::factory()->create()->id_kerusakan_infrastruktur,
            'fk5_id_pengungsian' => Pengungsian::factory()->create()->id_pengungsian,
        ];
    }
}
