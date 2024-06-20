<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KejadianBencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data to seed
        $data = [
            [
                'id_jeniskejadian' => 1,
                'id_admin' => 1,
                'id_relawan' => 2,
                'tanggal_kejadian' => '2024-06-10',
                'lokasi' => 'Jakarta',
                'update' => 'Update information',
                'dukungan_internasional' => 'Ya',
                'keterangan' => 'Detailed description',
                'akses_ke_lokasi' => 'Accessible',
                'kebutuhan' => 'a',
                'giat_pemerintah' => 'Government activities',
                'hambatan' => 'b',
                'id_assessment' => 1,
                'id_mobilisasi_sd' => 1,
                'id_giat_pmi' => 6,
                'id_dokumentasi' => 1,
                'id_narahubung' => 1,
                'id_petugas_posko' => 1,
                'status' => "Belum_Diverifikasi",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_jeniskejadian' => 1,
                'id_admin' => 1,
                'id_relawan' => 2,
                'tanggal_kejadian' => '2024-05-31',
                'lokasi' => 'Semarang',
                'update' => 'Update information',
                'dukungan_internasional' => 'Tidak',
                'keterangan' => 'Detailed description',
                'akses_ke_lokasi' => 'Accessible',
                'kebutuhan' => 'a',
                'giat_pemerintah' => 'Government activities',
                'hambatan' => 'b',
                'id_assessment' => 2,
                'id_mobilisasi_sd' => 2,
                'id_giat_pmi' =>7,
                'id_dokumentasi' => 2,
                'id_narahubung' => 2,
                'id_petugas_posko' => 2,
                'status' => "Belum_Diverifikasi",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ];

        // Insert data into the database
        DB::table('kejadian_bencana')->insert($data);
    }
}
