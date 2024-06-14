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
            'id_korban_terdampak' => KorbanTerdampak::factory(),
            'id_kerusakan_rumah' => KerusakanRumah::factory(),
            'id_kerusakan_fasil_sosial' => KerusakanFasilSosial::factory(),
            'id_kerusakan_infrastruktur' => KerusakanInfrastruktur::factory(),
            'id_pengungsian' => Pengungsian::factory(),
            'id_kejadian' => KejadianBencana::factory(),
        ];
    }
}
