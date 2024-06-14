<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PersonilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personil')->insert([
            [
                'pengurus' => 5,
                'staf_markas_kabkota' => 10,
                'staf_markas_prov' => 8,
                'staf_markas_pusat' => 12,
                'relawan_pmi_kabkota' => 20,
                'relawan_pmi_prov' => 15,
                'relawan_pmi_linprov' => 7,
                'sukarelawan_sip' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pengurus' => 3,
                'staf_markas_kabkota' => 7,
                'staf_markas_prov' => 5,
                'staf_markas_pusat' => 9,
                'relawan_pmi_kabkota' => 18,
                'relawan_pmi_prov' => 12,
                'relawan_pmi_linprov' => 6,
                'sukarelawan_sip' => 22,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pengurus' => 4,
                'staf_markas_kabkota' => 8,
                'staf_markas_prov' => 6,
                'staf_markas_pusat' => 10,
                'relawan_pmi_kabkota' => 19,
                'relawan_pmi_prov' => 14,
                'relawan_pmi_linprov' => 8,
                'sukarelawan_sip' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
