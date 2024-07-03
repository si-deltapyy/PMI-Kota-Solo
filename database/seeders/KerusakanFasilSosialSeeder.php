<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KerusakanFasilSosialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kerusakan_fasil_sosial')->insert([
            [
                'sekolah' => '5', // Number of schools as a string
                'tempat_ibadah' => '3', // Number of places of worship as a string
                'rumah_sakit' => '2', // Number of hospitals as a string
                'pasar' => '4', // Number of markets as a string
                'gedung_pemerintah' => '1', // Number of government buildings as a string
                'lain_lain' => '6', // Number of other facilities as a string
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'sekolah' => '3',
                'tempat_ibadah' => '2',
                'rumah_sakit' => '1',
                'pasar' => '4',
                'gedung_pemerintah' => '5',
                'lain_lain' => '6',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'sekolah' => '4',
                'tempat_ibadah' => '1',
                'rumah_sakit' => '3',
                'pasar' => '2',
                'gedung_pemerintah' => '5',
                'lain_lain' => '6',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'sekolah' => '5',
                'tempat_ibadah' => '2',
                'rumah_sakit' => '4',
                'pasar' => '3',
                'gedung_pemerintah' => '6',
                'lain_lain' => '7',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'sekolah' => '3',
                'tempat_ibadah' => '1',
                'rumah_sakit' => '2',
                'pasar' => '1',
                'gedung_pemerintah' => '4',
                'lain_lain' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'sekolah' => '6',
                'tempat_ibadah' => '3',
                'rumah_sakit' => '5',
                'pasar' => '2',
                'gedung_pemerintah' => '7',
                'lain_lain' => '8',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],            
            // Add more entries as needed
        ]);
    }
}
