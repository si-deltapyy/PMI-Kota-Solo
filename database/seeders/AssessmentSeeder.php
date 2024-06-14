<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assessment')->insert([
            [
                'id_user' => 2,
                'id_report' => 1,
                'timestamp_verifikasi' => Carbon::now(),
                'hasil_verifikasi' => 'Verification result 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 2,
                'id_report' => 2,
                'timestamp_verifikasi' => Carbon::now(),
                'hasil_verifikasi' => 'Verification result 2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
