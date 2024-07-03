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
            [
                'id_assessment' => 3,
                'distribusi' => 'Makanan',
                'dapur_umum' => 'Dapur umum tersedia',
                'evakuasi' => 'Evakuasi darurat',
                'layanan_kesehatan' => 'Pelayanan medis',
            ],
            [
                'id_assessment' => 3,
                'distribusi' => 'Obat-obatan',
                'dapur_umum' => 'Dapur umum belum beroperasi',
                'evakuasi' => 'Evakuasi darurat diperlukan',
                'layanan_kesehatan' => 'Posko kesehatan berjalan',
            ],
            [
                'id_assessment' => 3,
                'distribusi' => 'Selimut',
                'dapur_umum' => 'Dapur umum tidak ada',
                'evakuasi' => 'Evakuasi sudah selesai',
                'layanan_kesehatan' => 'Pelayanan kesehatan mendesak',
            ],
            [
                'id_assessment' => 3,
                'distribusi' => 'Air bersih',
                'dapur_umum' => 'Dapur umum sedang dipersiapkan',
                'evakuasi' => 'Evakuasi tidak diperlukan',
                'layanan_kesehatan' => 'Pelayanan kesehatan terbatas',
            ],
            
            // Add more entries as needed
        ]);
    }
}
