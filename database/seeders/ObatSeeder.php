<?php

namespace Database\Seeders;

use App\Models\Obat;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplierSatu = Supplier::where('kode_supplier', 'SUP001')->value('id');
        $supplierDua = Supplier::where('kode_supplier', 'SUP002')->value('id');

        Obat::updateOrCreate(
            ['kode_obat' => 'OBT001'],
            [
                'nama_obat' => 'Paracetamol 500mg',
                'jenis' => 'Tablet',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
                'stok' => 120,
                'tanggal_kadaluarsa' => '2027-12-31',
                'supplier_id' => $supplierSatu,
            ]
        );

        Obat::updateOrCreate(
            ['kode_obat' => 'OBT002'],
            [
                'nama_obat' => 'Amoxicillin 500mg',
                'jenis' => 'Kapsul',
                'harga_beli' => 6500,
                'harga_jual' => 9000,
                'stok' => 80,
                'tanggal_kadaluarsa' => '2026-11-30',
                'supplier_id' => $supplierDua,
            ]
        );

        Obat::updateOrCreate(
            ['kode_obat' => 'OBT003'],
            [
                'nama_obat' => 'Vitamin C 1000mg',
                'jenis' => 'Tablet',
                'harga_beli' => 4500,
                'harga_jual' => 7000,
                'stok' => 150,
                'tanggal_kadaluarsa' => '2027-08-15',
                'supplier_id' => $supplierSatu,
            ]
        );

        Obat::updateOrCreate(
            ['kode_obat' => 'OBT004'],
            [
                'nama_obat' => 'Antasida Doen',
                'jenis' => 'Sirup',
                'harga_beli' => 8000,
                'harga_jual' => 12000,
                'stok' => 60,
                'tanggal_kadaluarsa' => '2026-09-30',
                'supplier_id' => $supplierDua,
            ]
        );
    }
}