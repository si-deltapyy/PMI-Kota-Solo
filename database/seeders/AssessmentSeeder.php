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
                'id_relawan' => 3,
                'id_report' => 1,
                'status' => 'On Process'
            ],
            [
                'id_relawan' => 3,
                'id_report' => 2,
                'status' => 'Aktif'
            ],
            // Add more entries as needed
        ]);
    }
}
