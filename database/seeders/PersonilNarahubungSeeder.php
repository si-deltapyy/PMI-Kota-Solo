<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PersonilNarahubungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personil_narahubung')->insert([
            [
                'nama_lengkap' => 'John Doe',
                'posisi' => 'Manager',
                'kontak' => 'john.doe@example.com',
                'id_kejadian' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lengkap' => 'Jane Smith',
                'posisi' => 'Supervisor',
                'kontak' => 'jane.smith@example.com',
                'id_kejadian' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lengkap' => 'Alice Johnson',
                'posisi' => 'Coordinator',
                'kontak' => 'alice.johnson@example.com',
                'id_kejadian' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}