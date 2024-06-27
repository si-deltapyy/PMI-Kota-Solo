<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DampakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data to seed
        $data = [
            [
                'id_korban_terdampak' => 1, // Replace with actual ID from korban_terdampak table
                'id_kerusakan_rumah' => 1, // Replace with actual ID from kerusakan_rumah table
                'id_kerusakan_fasil_sosial' => 1, // Replace with actual ID from kerusakan_fasil_sosial table
                'id_kerusakan_infrastruktur' => 1, // Replace with actual ID from kerusakan_infrastruktur table
                'id_korban_jlw' => 1,
                'created_at' => '2024-04-20 16:27:19',
                'updated_at' => Carbon::now(),
            ],
            [
                'id_korban_terdampak' => 2, // Replace with actual ID from korban_terdampak table
                'id_kerusakan_rumah' => 2, // Replace with actual ID from kerusakan_rumah table
                'id_kerusakan_fasil_sosial' => 2, // Replace with actual ID from kerusakan_fasil_sosial table
                'id_kerusakan_infrastruktur' => 2, // Replace with actual ID from kerusakan_infrastruktur table
                'id_korban_jlw' => 2,
                'created_at' => '2024-05-20 16:27:19',
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ];

        // Insert data into the database
        DB::table('dampak')->insert($data);
    }
}
