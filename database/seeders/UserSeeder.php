<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat admin
        $admin = User::create([
            'name' => 'Admin',
            'username'=>'admin1',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'is_approved' => true, // admin langsung disetujui
        ])->assignRole('admin');


        // Membuat pengelola profil
        $pengelolaProfil = User::create([
            'name' => 'Pengelola Profil',
            'username'=>'Pengelola1',
            'email' => 'pengelola@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => true, // pengelola profil langsung disetujui
        ])->assignRole('pengelola_profil');

        // Membuat beberapa relawan
        $relawan1 = User::create([
            'name' => 'Relawan 1',
            'username'=>'relawan1',
            'email' => 'relawan1@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => true, // relawan perlu menunggu persetujuan
        ])->assignRole('relawan');;

        // Membuat beberapa relawan
        $kiooo = User::create([
            'name' => 'Kio Wu',
            'username'=>'kiooo',
            'email' => 'kiooo@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => true, // relawan perlu menunggu persetujuan
        ])->assignRole('relawan');;

        // Membuat relawan lainnya
        $relawan2 = User::create([
            'name' => 'Relawan 2',
            'username'=>'relawan2',
            'email' => 'relawan2@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => false, // relawan perlu menunggu persetujuan
        ])->assignRole('relawan');
    }
}
