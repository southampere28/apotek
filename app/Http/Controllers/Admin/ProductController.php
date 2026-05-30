<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
	public function index(Request $request): View
	{
		$filter = $request->string('filter')->toString();
		$search = $request->string('search')->toString();

		$obatQuery = Obat::with('supplier')
			->when($search !== '', function ($query) use ($search) {
				$query->where(function ($query) use ($search) {
					$query->where('nama_obat', 'like', '%' . $search . '%')
						->orWhere('kode_obat', 'like', '%' . $search . '%')
						->orWhereHas('supplier', function ($supplierQuery) use ($search) {
							$supplierQuery->where('nama', 'like', '%' . $search . '%')
								->orWhere('kode_supplier', 'like', '%' . $search . '%');
						});
				});
			});

		if ($filter === 'expired') {
			$obatQuery->whereNotNull('tanggal_kadaluarsa')->whereDate('tanggal_kadaluarsa', '<', now()->startOfDay());
		} elseif ($filter === 'soon') {
			$obatQuery->whereNotNull('tanggal_kadaluarsa')
				->whereDate('tanggal_kadaluarsa', '>=', now()->startOfDay())
				->whereDate('tanggal_kadaluarsa', '<=', now()->addDays(30)->startOfDay());
		}

		$obatList = $obatQuery->orderBy('nama_obat')->get();

		return view('admin.obat', [
			'title' => 'Manajemen Obat',
			'role' => 'admin',
			'description' => 'Kelola master obat, stok, harga, supplier, dan tanggal kadaluarsa.',
			'obatList' => $obatList,
			'totalObat' => $obatList->count(),
			'stokMenipis' => $obatList->where('stok', '<=', 20)->count(),
			'stokHabis' => $obatList->where('stok', '<=', 0)->count(),
			'totalStok' => $obatList->sum('stok'),
			'filter' => $filter,
			'search' => $search,
			'totalKadaluarsa' => $obatList->whereNotNull('tanggal_kadaluarsa')->where('tanggal_kadaluarsa', '<', now()->startOfDay())->count(),
			'totalAkanKadaluarsa' => $obatList->whereNotNull('tanggal_kadaluarsa')->where('tanggal_kadaluarsa', '>=', now()->startOfDay())->where('tanggal_kadaluarsa', '<=', now()->addDays(30)->toDateString())->count(),
		]);
	}

	public function create(): View
	{
		return view('admin.obat-create', [
			'title' => 'Tambah Obat',
			'role' => 'admin',
			'description' => 'Tambahkan master obat baru dengan kode otomatis dari helper.',
			'kodeObat' => generate_kode_obat(),
			'supplierList' => Supplier::orderBy('nama')->get(),
			'jenisObatList' => config('apotek.obat_jenis', []),
		]);
	}

	public function store(Request $request): RedirectResponse
	{
		$validated = $request->validate([
			'kode_obat' => ['required', 'string', 'max:255', 'unique:obat,kode_obat'],
			'nama_obat' => ['required', 'string', 'max:255'],
			'jenis' => ['required', 'string', 'max:255'],
			'harga_beli' => ['required', 'integer', 'min:0'],
			'harga_jual' => ['required', 'integer', 'min:0'],
			'stok' => ['required', 'integer', 'min:0'],
			'tanggal_kadaluarsa' => ['required', 'date'],
			'supplier_id' => ['required', 'exists:supplier,id'],
		]);

		Obat::create($validated);

		return redirect()
			->route('admin.obat.index')
			->with('success', 'Obat baru berhasil ditambahkan.');
	}
}
