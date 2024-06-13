<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKejadianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kejadian' => 'Banjir'],
            ['nama_kejadian' => 'Gempa Bumi'],
            ['nama_kejadian' => 'Kebakaran'],
            ['nama_kejadian' => 'Longsor'],
            ['nama_kejadian' => 'Tsunami'],
            ['nama_kejadian' => 'Bangunan Runtuh'],
        ];

        // Insert data into the jenis_kejadian table
        DB::table('jenis_kejadian')->insert($data);
        //
    }
}
