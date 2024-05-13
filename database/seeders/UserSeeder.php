<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Admin PMI',
            'password' => bcrypt('12345'),
            'name' => 'Supriyadi',
            'email' => 'test@admin',
            'email_verified_at' => null
        ])->assignRole('admin');

        User::create([
            'username' => 'Relawan',
            'password' => bcrypt('12345'),
            'name' => 'Hartanto',
            'email' => 'test@relawan',
            'email_verified_at' => null
        ])->assignRole('relawan');

        User::create([
            'username' => 'Pengelola Profil',
            'password' => bcrypt('12345'),
            'name' => 'Budiyono',
            'email' => 'test@pengelola',
            'email_verified_at' => null
        ])->assignRole('pengelola_profil');
    }
}
