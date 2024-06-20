<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvakuasiKorbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Insert data
        DB::table('evakuasi_korban')->insert([
            [
                'luka_ringanberat' => '5',
                'meninggal' => '1',
                'keterangan' => 'Some description 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'luka_ringanberat' => '3',
                'meninggal' => '0',
                'keterangan' => 'Some description 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'luka_ringanberat' => '10',
                'meninggal' => '2',
                'keterangan' => 'Some description 3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Add more records as needed
        ]);
    }
}
