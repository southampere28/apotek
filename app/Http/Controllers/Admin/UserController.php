<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apoteker;
use App\Models\Pelanggan;
use App\Models\Supplier;
use Illuminate\View\View;

class UserController extends Controller
{
    public function pelangganIndex(): View
    {
        $pelangganList = Pelanggan::with('user')
            ->orderBy('nama')
            ->get();

        return view('admin.pelanggan', [
            'title' => 'Manajemen Pelanggan',
            'role' => 'admin',
            'description' => 'Kelola data pelanggan, status akun, dan riwayat transaksi.',
            'pelangganList' => $pelangganList,
            'totalPelanggan' => $pelangganList->count(),
            'pelangganDenganAkun' => $pelangganList->whereNotNull('user_id')->count(),
            'pelangganBaruBulanIni' => $pelangganList->where('created_at', '>=', now()->startOfMonth())->count(),
        ]);
    }

    public function supplierIndex(): View
    {
        $supplierList = Supplier::withCount(['obat', 'pembelian'])
            ->orderBy('nama')
            ->get();

        return view('admin.supplier', [
            'title' => 'Manajemen Supplier',
            'role' => 'admin',
            'description' => 'Kelola data supplier, kontak, dan relasi pembelian obat.',
            'supplierList' => $supplierList,
            'totalSupplier' => $supplierList->count(),
            'supplierDenganObat' => $supplierList->where('obat_count', '>', 0)->count(),
            'totalObatTerkait' => $supplierList->sum('obat_count'),
            'totalPembelianTerkait' => $supplierList->sum('pembelian_count'),
        ]);
    }

    public function apotekerIndex(): View
    {
        $apotekerList = Apoteker::with('user')
            ->orderBy('nama')
            ->get();

        return view('admin.apoteker', [
            'title' => 'Manajemen Apoteker',
            'role' => 'admin',
            'description' => 'Kelola data apoteker, akun login, dan data kontak.',
            'apotekerList' => $apotekerList,
            'totalApoteker' => $apotekerList->count(),
            'apotekerDenganAkun' => $apotekerList->whereNotNull('user_id')->count(),
            'apotekerBaruBulanIni' => $apotekerList->where('created_at', '>=', now()->startOfMonth())->count(),
        ]);
    }
}