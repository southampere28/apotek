<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApotekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::where('email', 'apoteker@apotek.test')->value('id');

        DB::table('apoteker')->updateOrInsert(
            ['kode_apoteker' => 'APT001'],
            [
                'user_id' => $userId,
                'nama' => 'Apoteker Utama',
                'alamat' => 'Jl. Kesehatan No. 5',
                'kota' => 'Bandung',
                'telepon' => '081311112222',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}