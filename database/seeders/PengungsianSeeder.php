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
            [
                'nama_lokasi' => 'Taman Harapan',
                'laki_laki' => 25,
                'perempuan' => 30,
                'kurang_dari_5' => 3,
                'atr_5_sampai_18' => 10,
                'lebih_dari_18' => 42,
                'jumlah' => 75,
                'kk' => 20,
                'jiwa' => 110,
                'id_dampak' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lokasi' => 'Santai Sejati',
                'laki_laki' => 28,
                'perempuan' => 32,
                'kurang_dari_5' => 4,
                'atr_5_sampai_18' => 12,
                'lebih_dari_18' => 40,
                'jumlah' => 80,
                'kk' => 22,
                'jiwa' => 115,
                'id_dampak' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lokasi' => 'Mutiara Damai',
                'laki_laki' => 32,
                'perempuan' => 38,
                'kurang_dari_5' => 6,
                'atr_5_sampai_18' => 18,
                'lebih_dari_18' => 50,
                'jumlah' => 100,
                'kk' => 28,
                'jiwa' => 130,
                'id_dampak' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lokasi' => 'Bahagia Bersama',
                'laki_laki' => 27,
                'perempuan' => 34,
                'kurang_dari_5' => 5,
                'atr_5_sampai_18' => 15,
                'lebih_dari_18' => 46,
                'jumlah' => 91,
                'kk' => 24,
                'jiwa' => 118,
                'id_dampak' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lokasi' => 'Harmoni Sentosa',
                'laki_laki' => 30,
                'perempuan' => 36,
                'kurang_dari_5' => 7,
                'atr_5_sampai_18' => 20,
                'lebih_dari_18' => 55,
                'jumlah' => 103,
                'kk' => 26,
                'jiwa' => 126,
                'id_dampak' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // Add more entries as needed
        ]);
    }
}
