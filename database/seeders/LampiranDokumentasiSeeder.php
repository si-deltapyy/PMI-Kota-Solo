<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LampiranDokumentasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data to seed
        $data = [
            [
                'file_dokumentasi' => 'document1.pdf',
                'id_kejadian' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'file_dokumentasi' => 'document2.jpg',
                'id_kejadian' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'file_dokumentasi' => 'document3.png',
                'id_kejadian' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ];

        // Insert data into the database
        DB::table('lampiran_dokumentasi')->insert($data);
    }
}
