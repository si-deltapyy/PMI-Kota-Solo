<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KerusakanRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kerusakan_rumah')->insert([
            [
                'rusak_berat' => 10,
                'rusak_sedang' => 20,
                'rusak_ringan' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'rusak_berat' => 5,
                'rusak_sedang' => 15,
                'rusak_ringan' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'rusak_berat' => 8,
                'rusak_sedang' => 12,
                'rusak_ringan' => 22,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            // Add more records as needed
        ]);
    }
}
