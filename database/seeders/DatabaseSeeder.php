<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Relawan;
use App\Models\AlatTdb;
use App\Models\Assessment;
use App\Models\Dampak;
use App\Models\EvakuasiKorban;
use App\Models\GiatPMI;
use App\Models\KejadianBencana;
use App\Models\KerusakanFasilSosial;
use App\Models\KerusakanInfrastruktur;
use App\Models\KerusakanRumah;
use App\Models\KorbanTerdampak;
use App\Models\LampiranDokumentasi;
use App\Models\LayananKorban;
use App\Models\MobilisasiSd;
use App\Models\Pengungsian;
use App\Models\Personil;
use App\Models\PersonilNarahubung;
use App\Models\PetugasPosko;
use App\Models\Tsr;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(AllSeeder::class);
    }
}
