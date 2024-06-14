<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LayananKorbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanan_korban')->insert([
            [
                'id_assessment' => 1, // Replace with actual id_assessment from the assessment table
                'distribusi' => '150', // Number of distributions as a string
                'dapur_umum' => '20', // Number of public kitchens as a string
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_assessment' => 2, // Replace with actual id_assessment from the assessment table
                'distribusi' => '200',
                'dapur_umum' => '25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
