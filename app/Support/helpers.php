<?php

use Illuminate\Support\Facades\DB;

if (! function_exists('generate_business_code')) {
    function generate_business_code(string $table, string $column, string $prefix, int $padLength = 3): string
    {
        $latestCode = DB::table($table)->max($column);

        $nextNumber = 1;

        if (is_string($latestCode) && str_starts_with($latestCode, $prefix)) {
            $numericPart = (int) substr($latestCode, strlen($prefix));
            $nextNumber = $numericPart + 1;
        }

        return $prefix . str_pad((string) $nextNumber, $padLength, '0', STR_PAD_LEFT);
    }
}

if (! function_exists('generate_kode_obat')) {
    function generate_kode_obat(): string
    {
        return generate_business_code('obat', 'kode_obat', 'OBT');
    }
}

if (! function_exists('generate_kode_supplier')) {
    function generate_kode_supplier(): string
    {
        return generate_business_code('supplier', 'kode_supplier', 'SUP');
    }
}

if (! function_exists('generate_kode_pelanggan')) {
    function generate_kode_pelanggan(): string
    {
        return generate_business_code('pelanggan', 'kode_pelanggan', 'PLG');
    }
}

if (! function_exists('generate_kode_apoteker')) {
    function generate_kode_apoteker(): string
    {
        return generate_business_code('apoteker', 'kode_apoteker', 'APT');
    }
}

if (! function_exists('generate_nota_pembelian')) {
    function generate_nota_pembelian(): string
    {
        return generate_business_code('pembelian', 'nota', 'PB-');
    }
}

if (! function_exists('generate_nota_penjualan')) {
    function generate_nota_penjualan(): string
    {
        return generate_business_code('penjualan', 'nota', 'PJ-');
    }
}