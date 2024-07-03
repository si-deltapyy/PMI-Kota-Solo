<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the table first
        DB::table('reports')->truncate();

        // Insert data
        DB::table('reports')->insert([
            [
                'id_relawan' => 3,
                'id_jeniskejadian' => 1,
                'tanggal_kejadian' => '2023-01-15',
                'keterangan' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'timestamp_report' => Carbon::now(),
                'status' => 'On Process',
                'lokasi_longitude' => 123.456789,
                'lokasi_latitude' => -12.345678,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_relawan' => 3,
                'id_jeniskejadian' => 2,
                'tanggal_kejadian' => '2023-02-20',
                'keterangan' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'timestamp_report' => Carbon::now(),
                'status' => 'Valid',
                'lokasi_longitude' => 98.765432,
                'lokasi_latitude' => -21.987654,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_relawan' => 4,
                'id_jeniskejadian' => 5,
                'tanggal_kejadian' => '2024-05-23',
                'keterangan' => 'Kerusakan signifikan terjadi di lokasi ini, memerlukan perhatian segera dari tim penyelamat.',
                'timestamp_report' => Carbon::now(),
                'status' => 'Valid',
                'lokasi_longitude' => 110.8236931,
                'lokasi_latitude' => -7.5731812,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more records as needed
        ]);
    }
}
