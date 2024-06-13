<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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



class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlatTdb::factory(5)->create();
        Assessment::factory(5)->create();
        Dampak::factory(5)->create();
        EvakuasiKorban::factory(5)->create();
        GiatPmi::factory(5)->create();
        KejadianBencana::factory(5)->create();
        KerusakanFasilSosial::factory(5)->create();
        KerusakanInfrastruktur::factory(5)->create();
        KerusakanRumah::factory(5)->create();
        KorbanTerdampak::factory(5)->create();
        LampiranDokumentasi::factory(5)->create();
        LayananKorban::factory(5)->create();
        MobilisasiSd::factory(5)->create();
        Pengungsian::factory(5)->create();
        Personil::factory(5)->create();
        PersonilNarahubung::factory(5)->create();
        PetugasPosko::factory(5)->create();
        Tsr::factory(5)->create();
    }
}
