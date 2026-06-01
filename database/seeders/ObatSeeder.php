<?php

namespace Database\Seeders;

use App\Models\Obat;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplierSatu = Supplier::where('kode_supplier', 'SUP001')->value('id');
        $supplierDua = Supplier::where('kode_supplier', 'SUP002')->value('id');

        $seededImages = [
            'OBT001' => $this->seedImage('obat/obat-obt001.svg', 'Paracetamol', '#0d6efd'),
            'OBT002' => $this->seedImage('obat/obat-obt002.svg', 'Amoxicillin', '#198754'),
            'OBT003' => $this->seedImage('obat/obat-obt003.svg', 'Vitamin C', '#fd7e14'),
            'OBT004' => $this->seedImage('obat/obat-obt004.svg', 'Antasida', '#6f42c1'),
        ];

        Obat::updateOrCreate(
            ['kode_obat' => 'OBT001'],
            [
                'nama_obat' => 'Paracetamol 500mg',
                'gambar_obat' => $seededImages['OBT001'],
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
                'gambar_obat' => $seededImages['OBT002'],
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
                'gambar_obat' => $seededImages['OBT003'],
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
                'gambar_obat' => $seededImages['OBT004'],
                'jenis' => 'Sirup',
                'harga_beli' => 8000,
                'harga_jual' => 12000,
                'stok' => 60,
                'tanggal_kadaluarsa' => '2026-09-30',
                'supplier_id' => $supplierDua,
            ]
        );
    }

    private function seedImage(string $path, string $label, string $color): string
    {
        Storage::disk('public')->put($path, $this->placeholderSvg($label, $color));

        return $path;
    }

    private function placeholderSvg(string $label, string $color): string
    {
        $safeLabel = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" role="img" aria-label="{$safeLabel}">
    <defs>
        <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="{$color}" stop-opacity="0.92" />
            <stop offset="100%" stop-color="#0f172a" stop-opacity="0.92" />
        </linearGradient>
    </defs>
    <rect width="600" height="600" rx="64" fill="url(#bg)" />
    <circle cx="300" cy="210" r="92" fill="rgba(255,255,255,0.14)" />
    <rect x="218" y="258" width="164" height="196" rx="34" fill="rgba(255,255,255,0.9)" />
    <rect x="258" y="288" width="84" height="24" rx="12" fill="{$color}" />
    <rect x="258" y="332" width="84" height="24" rx="12" fill="{$color}" opacity="0.82" />
    <rect x="258" y="376" width="84" height="24" rx="12" fill="{$color}" opacity="0.64" />
    <text x="300" y="520" text-anchor="middle" fill="#ffffff" font-family="Arial, Helvetica, sans-serif" font-size="40" font-weight="700">{$safeLabel}</text>
</svg>
SVG;
    }
}