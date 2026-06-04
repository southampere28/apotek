<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Penjualan;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function pembelianIndex(): View
    {
        $pembelianList = Pembelian::query()
            ->with(['supplier', 'detail.obat'])
            ->withCount('detail')
            ->orderByDesc('tanggal_nota')
            ->get();

        return view('admin.pembelian', [
            'title' => 'Pembelian',
            'role' => 'admin',
            'description' => 'Kelola transaksi pembelian obat dari supplier dengan format kasir yang mudah dipakai.',
            'pembelianList' => $pembelianList,
            'totalPembelian' => $pembelianList->count(),
            'totalNominal' => $pembelianList->sum('total_harga'),
            'totalItem' => $pembelianList->sum('detail_count'),
            'supplierTerpakai' => $pembelianList->pluck('supplier_id')->unique()->count(),
        ]);
    }

    public function pembelianShow(Pembelian $pembelian): View
    {
        $pembelian->load(['supplier', 'detail.obat']);

        return view('admin.pembelian-show', [
            'title' => 'Detail Pembelian',
            'role' => 'admin',
            'description' => 'Detail transaksi pembelian dan struk yang siap dicetak.',
            'pembelian' => $pembelian,
        ]);
    }

    public function penjualanIndex(): View
    {
        $penjualan = Penjualan::query()
            ->with(['pelanggan', 'detail.obat'])
            ->withCount('detail')
            ->orderByDesc('tanggal_nota')
            ->get();

        return view('admin.penjualan', [
            'title' => 'Penjualan',
            'role' => 'admin',
            'description' => 'Halaman penjualan akan memakai UI kasir yang sama seperti pembelian untuk reuse di modul apoteker nanti.',
            'penjualanList' => $penjualan,
        ]);
    }

    public function pembelianCreate(): View
    {
        $supplierList = Supplier::orderBy('nama')->get();
        $obatList = Obat::query()
            ->with('supplier')
            ->orderBy('nama_obat')
            ->get();

        return view('admin.pembelian-create', [
            'title' => 'Tambah Pembelian',
            'role' => 'admin',
            'description' => 'Input transaksi pembelian dengan pilihan supplier, obat, jumlah, dan harga satuan.',
            'referenceCode' => generate_nota_pembelian(),
            'supplierList' => $supplierList,
            'obatList' => $obatList,
        ]);
    }

    public function pembelianStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nota' => ['required', 'string', 'max:255', 'unique:pembelian,nota'],
            'supplier_id' => ['required', 'exists:supplier,id'],
            'diskon' => ['nullable', 'integer', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.obat_id' => [
                'required',
                Rule::exists('obat', 'id')->where(fn ($query) => $query->where('supplier_id', $request->input('supplier_id'))),
            ],
            'items.*.jumlah' => ['required', 'integer', 'min:1'],
            'items.*.harga_satuan' => ['required', 'integer', 'min:0'],
        ]);

        $items = collect($validated['items'])
            ->filter(fn (array $item) => ! empty($item['obat_id']))
            ->values();

        if ($items->isEmpty()) {
            return back()
                ->withErrors(['items' => 'Tambahkan minimal satu item pembelian.'])
                ->withInput();
        }

        $diskon = (int) ($validated['diskon'] ?? 0);

        DB::transaction(function () use ($validated, $items, $diskon) {
            $subtotal = 0;

            foreach ($items as $item) {
                $subtotal += ((int) $item['jumlah']) * ((int) $item['harga_satuan']);
            }

            $totalHarga = max(0, $subtotal - $diskon);

            $pembelian = Pembelian::create([
                'nota' => $validated['nota'],
                'tanggal_nota' => now(),
                'supplier_id' => $validated['supplier_id'],
                'diskon' => $diskon,
                'subtotal' => $subtotal,
                'total_harga' => $totalHarga,
            ]);

            foreach ($items as $item) {
                $obat = Obat::query()->lockForUpdate()->findOrFail($item['obat_id']);
                $jumlah = (int) $item['jumlah'];
                $hargaSatuan = (int) $item['harga_satuan'];
                $subtotalItem = $jumlah * $hargaSatuan;

                PembelianDetail::create([
                    'pembelian_id' => $pembelian->id,
                    'obat_id' => $obat->id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $hargaSatuan,
                    'subtotal' => $subtotalItem,
                ]);

                $obat->increment('stok', $jumlah);
            }
        });

        return redirect()
            ->route('admin.pembelian.index')
            ->with('success', 'Pembelian baru berhasil disimpan.');
    }
}