<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@apotek.test'],
            [
                'name' => 'Admin Apotek',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'apoteker@apotek.test'],
            [
                'name' => 'Apoteker Apotek',
                'role' => 'apoteker',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'pelanggan@apotek.test'],
            [
                'name' => 'Pelanggan Apotek',
                'role' => 'pelanggan',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'pelanggan2@apotek.test'],
            [
                'name' => 'Pelanggan Dua',
                'role' => 'pelanggan',
                'password' => Hash::make('password'),
            ]
        );
    }
}