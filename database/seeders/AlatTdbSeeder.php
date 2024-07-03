<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AlatTdbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alat_tdb')->insert([
            [
                'kend_ops' => '10',
                'truk_angkut' => '5',
                'truk_tanki' => '3',
                'double_cabin' => '7',
                'alat_du' => '8',
                'ambulans' => '4',
                'alat_watsan' => '6',
                'rs_lapangan' => '2',
                'alat_pkdd' => '9',
                'gudang_lapangan' => '1',
                'posko_aju' => '11',
                'alat_it_lapangan' => '12',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kend_ops' => '8',
                'truk_angkut' => '4',
                'truk_tanki' => '2',
                'double_cabin' => '6',
                'alat_du' => '7',
                'ambulans' => '3',
                'alat_watsan' => '5',
                'rs_lapangan' => '1',
                'alat_pkdd' => '8',
                'gudang_lapangan' => '2',
                'posko_aju' => '9',
                'alat_it_lapangan' => '10',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kend_ops' => '9',
                'truk_angkut' => '6',
                'truk_tanki' => '4',
                'double_cabin' => '5',
                'alat_du' => '8',
                'ambulans' => '7',
                'alat_watsan' => '3',
                'rs_lapangan' => '2',
                'alat_pkdd' => '5',
                'gudang_lapangan' => '1',
                'posko_aju' => '12',
                'alat_it_lapangan' => '11',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kend_ops' => '10',
                'truk_angkut' => '7',
                'truk_tanki' => '5',
                'double_cabin' => '6',
                'alat_du' => '9',
                'ambulans' => '8',
                'alat_watsan' => '4',
                'rs_lapangan' => '3',
                'alat_pkdd' => '6',
                'gudang_lapangan' => '2',
                'posko_aju' => '13',
                'alat_it_lapangan' => '12',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kend_ops' => '8',
                'truk_angkut' => '5',
                'truk_tanki' => '3',
                'double_cabin' => '4',
                'alat_du' => '7',
                'ambulans' => '6',
                'alat_watsan' => '2',
                'rs_lapangan' => '1',
                'alat_pkdd' => '4',
                'gudang_lapangan' => '1',
                'posko_aju' => '11',
                'alat_it_lapangan' => '10',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kend_ops' => '9',
                'truk_angkut' => '6',
                'truk_tanki' => '4',
                'double_cabin' => '5',
                'alat_du' => '8',
                'ambulans' => '7',
                'alat_watsan' => '3',
                'rs_lapangan' => '2',
                'alat_pkdd' => '5',
                'gudang_lapangan' => '1',
                'posko_aju' => '12',
                'alat_it_lapangan' => '11',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],            
            // Add more entries as needed
        ]);
    }
}
