<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PengungsianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengungsian')->insert([
            [
                'nama_lokasi' => 'Pengungsian A',
                'laki_laki' => 50.5,
                'perempuan' => 45.3,
                'kurang_dari_5' => 10,
                'atr_5_sampai_18' => 20,
                'lebih_dari_18' => 65,
                'jumlah' => 145,
                'kk' => 40,
                'jiwa' => 185,
                'id_dampak' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lokasi' => 'Pengungsian B',
                'laki_laki' => 30,
                'perempuan' => 35,
                'kurang_dari_5' => 5,
                'atr_5_sampai_18' => 15,
                'lebih_dari_18' => 45,
                'jumlah' => 95,
                'kk' => 25,
                'jiwa' => 120,
                'id_dampak' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lokasi' => 'Pengungsian C',
                'laki_laki' => 30,
                'perempuan' => 35,
                'kurang_dari_5' => 5,
                'atr_5_sampai_18' => 15,
                'lebih_dari_18' => 45,
                'jumlah' => 95,
                'kk' => 25,
                'jiwa' => 120,
                'id_dampak' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
