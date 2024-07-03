<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MobilisasiSdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mobilisasi_sd')->insert([
            [
                'id_personil' => 1, // Replace with actual id_personil from the personil table
                'id_tsr' => 1, // Replace with actual id_tsr from the tsr table
                'id_alat_tdb' => 1, // Replace with actual id_alat_tdb from the alat_tdb table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_personil' => 2, // Replace with actual id_personil from the personil table
                'id_tsr' => 2, // Replace with actual id_tsr from the tsr table
                'id_alat_tdb' => 2, // Replace with actual id_alat_tdb from the alat_tdb table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_personil' => 3, // Replace with actual id_personil from the personil table
                'id_tsr' => 3, // Replace with actual id_tsr from the tsr table
                'id_alat_tdb' => 3, // Replace with actual id_alat_tdb from the alat_tdb table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_personil' => 4, // Replace with actual id_personil from the personil table
                'id_tsr' => 4, // Replace with actual id_tsr from the tsr table
                'id_alat_tdb' => 4, // Replace with actual id_alat_tdb from the alat_tdb table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_personil' => 5, // Replace with actual id_personil from the personil table
                'id_tsr' => 5, // Replace with actual id_tsr from the tsr table
                'id_alat_tdb' => 5, // Replace with actual id_alat_tdb from the alat_tdb table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_personil' => 6, // Replace with actual id_personil from the personil table
                'id_tsr' => 6, // Replace with actual id_tsr from the tsr table
                'id_alat_tdb' => 6, // Replace with actual id_alat_tdb from the alat_tdb table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
