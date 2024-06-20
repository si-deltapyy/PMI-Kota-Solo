<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LayananKorbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanan_korban')->insert([
            [
                'id_assessment' => 1,
                'distribusi' => 'Sembako',
                'dapur_umum' => 'Makanan siap saji',
                'evakuasi' => 'Tenda darurat',
                'layanan_kesehatan' => 'Tim medis'
            ],
            [
                'id_assessment' => 2,
                'distribusi' => 'Pakaian',
                'dapur_umum' => 'Dapur umum berjalan',
                'evakuasi' => 'Evakuasi air',
                'layanan_kesehatan' => 'Posko kesehatan'
            ],
            // Add more entries as needed
        ]);
    }
}
