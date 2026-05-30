<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supplier')->updateOrInsert(
            ['kode_supplier' => 'SUP001'],
            [
                'nama' => 'Supplier Farma Jaya',
                'alamat' => 'Jl. Mawar No. 10',
                'kota' => 'Surabaya',
                'telepon' => '082112223333',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('supplier')->updateOrInsert(
            ['kode_supplier' => 'SUP002'],
            [
                'nama' => 'Supplier Sehat Sentosa',
                'alamat' => 'Jl. Kenanga No. 20',
                'kota' => 'Yogyakarta',
                'telepon' => '082144445555',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}