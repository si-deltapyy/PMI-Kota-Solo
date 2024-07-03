<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KerusakanInfrastrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Insert data
        DB::table('kerusakan_infrastruktur')->insert([
            [
                'desc_kerusakan' => 'Jembatan rusak parah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'desc_kerusakan' => 'Bangunan roboh',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'desc_kerusakan' => 'Jalanan terbelah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'desc_kerusakan' => 'Bangunan roboh',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'desc_kerusakan' => 'Tanah longsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'desc_kerusakan' => 'Pohon tumbang',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],            
            // Add more records as needed
        ]);
    }
}
