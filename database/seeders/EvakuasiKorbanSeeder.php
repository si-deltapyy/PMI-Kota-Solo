<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EvakuasiKorbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('evakuasi_korban')->insert([
            [
                'luka_ringanberat' => '10', // Number of lightly or severely injured as a string
                'meninggal' => '2', // Number of deceased as a string
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'luka_ringanberat' => '15',
                'meninggal' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'luka_ringanberat' => '5',
                'meninggal' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
