<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::where('email', 'pelanggan@apotek.test')->value('id');

        $userIdDua = User::where('email', 'pelanggan2@apotek.test')->value('id');

        DB::table('pelanggan')->updateOrInsert(
            ['kode_pelanggan' => 'PLG001'],
            [
                'user_id' => $userId,
                'nama' => 'Pelanggan Satu',
                'alamat' => 'Jl. Melati No. 1',
                'kota' => 'Bandung',
                'telepon' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('pelanggan')->updateOrInsert(
            ['kode_pelanggan' => 'PLG002'],
            [
                'user_id' => $userIdDua,
                'nama' => 'Pelanggan Dua',
                'alamat' => 'Jl. Anggrek No. 2',
                'kota' => 'Jakarta',
                'telepon' => '081298765432',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}