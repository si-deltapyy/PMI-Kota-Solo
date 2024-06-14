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
        DB::table('kerusakan_infrastruktur')->insert([
            [
                'desa_kerusakan' => 'Desa A', // Replace with actual village name as a string
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'desa_kerusakan' => 'Desa B', // Replace with actual village name as a string
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'desa_kerusakan' => 'Desa C', // Replace with actual village name as a string
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
