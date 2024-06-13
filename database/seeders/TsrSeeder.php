<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TsrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tsr')->insert([
            [
                'medis' => 5,
                'paramedis' => 10,
                'relief' => 15,
                'logistik' => 20,
                'watsan' => 25,
                'it_telekom' => 30,
                'sheltering' => 35,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'medis' => 6,
                'paramedis' => 11,
                'relief' => 16,
                'logistik' => 21,
                'watsan' => 26,
                'it_telekom' => 31,
                'sheltering' => 36,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'medis' => 7,
                'paramedis' => 12,
                'relief' => 17,
                'logistik' => 22,
                'watsan' => 27,
                'it_telekom' => 32,
                'sheltering' => 37,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
