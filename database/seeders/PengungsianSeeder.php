<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PengungsianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengungsian')->insert([
            [
                'nama_lokasi' => 'Lokasi A',
                'laki_laki' => 50.5, // Double type
                'perempuan' => 60.2, // Double type
                '<5' => 10, // Integer type
                '>5_<=18' => 20, // Integer type
                '>18' => 80, // Integer type
                'jumlah' => 110, // Integer type
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lokasi' => 'Lokasi B',
                'laki_laki' => 30.3,
                'perempuan' => 40.8,
                '<5' => 5,
                '>5_<=18' => 15,
                '>18' => 50,
                'jumlah' => 70,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lokasi' => 'Lokasi C',
                'laki_laki' => 40.7,
                'perempuan' => 55.1,
                '<5' => 8,
                '>5_<=18' => 18,
                '>18' => 70,
                'jumlah' => 96,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
