<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KorbanTerdampakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('korban_terdampak')->insert([
            [
                'kk' => 100, // Number of households affected
                'jiwa' => 250, // Number of individuals affected
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kk' => 80,
                'jiwa' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kk' => 120,
                'jiwa' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kk' => 150,
                'jiwa' => 350,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kk' => 100,
                'jiwa' => 250,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kk' => 130,
                'jiwa' => 320,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // Add more entries as needed
        ]);
    }
}
