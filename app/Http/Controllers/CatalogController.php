<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $obat = Obat::query()
            ->with('supplier')
            ->orderBy('nama_obat')
            ->get();

        return view('catalog.index', [
            'title' => 'Daftar Obat',
            'description' => 'Lihat daftar obat yang tersedia beserta detail singkatnya.',
            'obat' => $obat,
            'totalObat' => $obat->count(),
            'totalStok' => $obat->sum('stok'),
            'role' => auth('web')->check() ? auth('web')->user()->role : 'pengunjung',
        ]);
    }

    public function show(int $obat)
    {
        $item = Obat::query()
            ->with('supplier')
            ->find($obat);

        abort_if(! $item, 404);

        return view('catalog.show', [
            'title' => $item->nama_obat,
            'description' => 'Detail obat yang dipilih dari katalog publik.',
            'obat' => $item,
            'updatedAtLabel' => $item->updated_at ? Carbon::parse($item->updated_at)->format('d M Y H:i') : '-',
            'role' => auth('web')->check() ? auth('web')->user()->role : 'pengunjung',
        ]);
    }
}