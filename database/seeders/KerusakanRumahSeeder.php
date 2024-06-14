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
                'luka_berat' => 5, // Number of serious injuries
                'luka_ringan' => 10, // Number of minor injuries
                'hilang' => 2, // Number of missing persons
                'mengungsi' => 50, // Number of displaced individuals
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'luka_berat' => 3,
                'luka_ringan' => 8,
                'hilang' => 1,
                'mengungsi' => 40,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'luka_berat' => 7,
                'luka_ringan' => 12,
                'hilang' => 3,
                'mengungsi' => 60,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
