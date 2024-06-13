<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKejadianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kejadian' => 'a'],
            ['nama_kejadian' => 'b'],
            ['nama_kejadian' => 'c'],
        ];

        // Insert data into the jenis_kejadian table
        DB::table('jenis_kejadian')->insert($data);
        //
    }
}
