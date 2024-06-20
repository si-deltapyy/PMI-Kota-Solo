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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            JenisKejadianSeeder::class,
            AssessmentSeeder::class,
            PersonilNarahubungSeeder::class,
            PetugasPoskoSeeder::class,
            PersonilSeeder::class,
            TsrSeeder::class,
            AlatTdbSeeder::class,
            MobilisasiSdSeeder::class,
            EvakuasiKorbanSeeder::class,
            LayananKorbanSeeder::class,
            GiatPmiSeeder::class,
            KerusakanFasilSosialSeeder::class,
            KerusakanInfrastrukturSeeder::class,
            KorbanTerdampakSeeder::class,
            KerusakanRumahSeeder::class,
            PengungsianSeeder::class,
            LampiranDokumentasiSeeder::class,
            ReportsSeeder::class,
            KorbanJlwSeeder::class,
            DampakSeeder::class,
            KejadianBencanaSeeder::class,
        ]);
    }
}
