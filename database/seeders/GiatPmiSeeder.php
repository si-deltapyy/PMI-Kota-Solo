<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GiatPmiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('giat_pmi')->insert([
            [
                'id_evakuasikorban' => 1, // Replace with actual id_evakuasikorban from evakuasi_korban table
                'id_layanankorban' => 1, // Replace with actual id_layanankorban from layanan_korban table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_evakuasikorban' => 2, // Replace with actual id_evakuasikorban from evakuasi_korban table
                'id_layanankorban' => 2, // Replace with actual id_layanankorban from layanan_korban table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_evakuasikorban' => 3, // Replace with actual id_evakuasikorban from evakuasi_korban table
                'id_layanankorban' => 3, // Replace with actual id_layanankorban from layanan_korban table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_evakuasikorban' => 4, // Replace with actual id_evakuasikorban from evakuasi_korban table
                'id_layanankorban' => 4, // Replace with actual id_layanankorban from layanan_korban table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_evakuasikorban' => 5, // Replace with actual id_evakuasikorban from evakuasi_korban table
                'id_layanankorban' => 5, // Replace with actual id_layanankorban from layanan_korban table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_evakuasikorban' => 6, // Replace with actual id_evakuasikorban from evakuasi_korban table
                'id_layanankorban' => 6, // Replace with actual id_layanankorban from layanan_korban table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // Add more entries as needed
        ]);
    }
}
