<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CatalogController;
use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::middleware('guest:web')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('home');
    Route::get('/obat/{obat}', [CatalogController::class, 'show'])->name('obat.show');
    Route::middleware('role:pelanggan')->get('/riwayat', [CatalogController::class, 'history'])->name('riwayat.index');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', function (Request $request) {
        return match ($request->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'apoteker' => redirect()->route('apoteker.dashboard'),
            'pelanggan' => redirect()->route('home'),
            default => abort(403),
        };
    })->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'title' => 'Dashboard Admin',
                'role' => 'admin',
                'description' => 'Kelola data master, transaksi, dan pengaturan sistem.',

                'totalObat' => Obat::count(),
                'totalSupplier' => Supplier::count(),
                'totalPelanggan' => Pelanggan::count(),
                'totalPenjualan' => Penjualan::count(),
                'totalPembelian' => Pembelian::count(),
                'stokMenipis' => Obat::where('stok', '<=', 10)->count(),
                'totalNominalPenjualan' => Penjualan::sum('total_harga'),
            ]);
        })->name('dashboard');

        Route::get('/obat', [ProductController::class, 'index'])->name('obat.index');
        Route::get('/obat/create', [ProductController::class, 'create'])->name('obat.create');
        Route::post('/obat', [ProductController::class, 'store'])->name('obat.store');
        Route::get('/obat/{obat}/edit', [ProductController::class, 'edit'])->whereNumber('obat')->name('obat.edit');
        Route::put('/obat/{obat}', [ProductController::class, 'update'])->whereNumber('obat')->name('obat.update');
        Route::delete('/obat/{obat}', [ProductController::class, 'destroy'])->whereNumber('obat')->name('obat.destroy');

        Route::get('/supplier/create', [UserController::class, 'supplierCreate'])->name('supplier.create');
        Route::post('/supplier', [UserController::class, 'supplierStore'])->name('supplier.store');

        Route::get('/pembelian', [TransactionController::class, 'pembelianIndex'])->name('pembelian.index');
        Route::get('/pembelian/create', [TransactionController::class, 'pembelianCreate'])->name('pembelian.create');
        Route::get('/pembelian/{pembelian}', [TransactionController::class, 'pembelianShow'])->name('pembelian.show');
        Route::post('/pembelian', [TransactionController::class, 'pembelianStore'])->name('pembelian.store');

        Route::get('/penjualan', [TransactionController::class, 'penjualanIndex'])->name('penjualan.index');

        Route::get('/penjualan/{penjualan}', function (Penjualan $penjualan) {
            $penjualan->load(['pelanggan', 'detail.obat']);

            return view('admin.penjualan-show', [
                'title' => 'Detail Penjualan',
                'role' => 'admin',
                'description' => 'Detail transaksi penjualan dan struk yang siap dicetak.',
                'penjualan' => $penjualan,
            ]);
        })->whereNumber('penjualan')->name('penjualan.show');

        Route::get('/pelanggan/create', [UserController::class, 'pelangganCreate'])->name('pelanggan.create');
        Route::post('/pelanggan', [UserController::class, 'pelangganStore'])->name('pelanggan.store');

        Route::get('/apoteker/create', [UserController::class, 'apotekerCreate'])->name('apoteker.create');
        Route::post('/apoteker', [UserController::class, 'apotekerStore'])->name('apoteker.store');

        // manajemen supplier
        Route::get('/supplier', [UserController::class, 'supplierIndex'])->name('supplier.index');
        Route::get('/supplier/{supplier}/edit', [UserController::class, 'supplierEdit'])->whereNumber('supplier')->name('supplier.edit');
        Route::put('/supplier/{supplier}', [UserController::class, 'supplierUpdate'])->whereNumber('supplier')->name('supplier.update');
        Route::delete('/supplier/{supplier}', [UserController::class, 'supplierDestroy'])->whereNumber('supplier')->name('supplier.destroy');

        //  manajemen pelanggan
        Route::get('/pelanggan', [UserController::class, 'pelangganIndex'])->name('pelanggan.index');
        Route::get('/pelanggan/{pelanggan}/edit', [UserController::class, 'pelangganEdit'])->whereNumber('pelanggan')->name('pelanggan.edit');
        Route::put('/pelanggan/{pelanggan}', [UserController::class, 'pelangganUpdate'])->whereNumber('pelanggan')->name('pelanggan.update');
        Route::delete('/pelanggan/{pelanggan}', [UserController::class, 'pelangganDestroy'])->whereNumber('pelanggan')->name('pelanggan.destroy');

        // manajemen apoteker
        Route::get('/apoteker', [UserController::class, 'apotekerIndex'])->name('apoteker.index');
        Route::get('/apoteker/{apoteker}/edit', [UserController::class, 'apotekerEdit'])->whereNumber('apoteker')->name('apoteker.edit');
        Route::put('/apoteker/{apoteker}', [UserController::class, 'apotekerUpdate'])->whereNumber('apoteker')->name('apoteker.update');
        Route::delete('/apoteker/{apoteker}', [UserController::class, 'apotekerDestroy'])->whereNumber('apoteker')->name('apoteker.destroy');

    });

    Route::middleware('role:apoteker')->prefix('apoteker')->name('apoteker.')->group(function () {
        Route::get('/dashboard', function () {
            $obatList = Obat::query()->get();
            $penjualanList = Penjualan::query()->withCount('detail')->get();

            return view('apoteker.dashboard', [
                'title' => 'Dashboard Apoteker',
                'role' => 'apoteker',
                'description' => 'Kelola penjualan, cek stok obat, dan pantau katalog layanan farmasi.',
                'totalObat' => $obatList->count(),
                'stokMenipis' => $obatList->where('stok', '<=', 20)->count(),
                'stokHabis' => $obatList->where('stok', '<=', 0)->count(),
                'totalPenjualan' => $penjualanList->count(),
                'totalNominalPenjualan' => $penjualanList->sum('total_harga'),
            ]);
        })->name('dashboard');

        Route::get('/obat', function (Request $request) {
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

            return view('apoteker.obat', [
                'title' => 'Data Obat',
                'role' => 'apoteker',
                'description' => 'Lihat master obat, stok, harga, supplier, dan tanggal kadaluarsa.',
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
        })->name('obat.index');

        Route::get('/penjualan', function () {
            $penjualanList = Penjualan::query()
                ->with(['pelanggan', 'detail.obat'])
                ->withCount('detail')
                ->orderByDesc('tanggal_nota')
                ->get();

            return view('apoteker.penjualan', [
                'title' => 'Penjualan',
                'role' => 'apoteker',
                'description' => 'Kelola transaksi penjualan obat dalam format kasir sederhana.',
                'penjualanList' => $penjualanList,
                'totalPenjualan' => $penjualanList->count(),
                'totalNominal' => $penjualanList->sum('total_harga'),
                'totalItem' => $penjualanList->sum('detail_count'),
                'pelangganTerpakai' => $penjualanList->pluck('pelanggan_id')->unique()->count(),
            ]);
        })->name('penjualan.index');

        Route::get('/penjualan/{penjualan}', function (Penjualan $penjualan) {
            $penjualan->load(['pelanggan', 'detail.obat']);

            return view('apoteker.penjualan-show', [
                'title' => 'Detail Penjualan',
                'role' => 'apoteker',
                'description' => 'Detail transaksi penjualan dan struk yang siap dicetak.',
                'penjualan' => $penjualan,
            ]);
        })->whereNumber('penjualan')->name('penjualan.show');

        Route::get('/penjualan/create', function () {
            return view('apoteker.penjualan-create', [
                'title' => 'Tambah Penjualan',
                'role' => 'apoteker',
                'description' => 'Input transaksi penjualan dengan pilihan pelanggan, obat, jumlah, dan harga jual.',
                'referenceCode' => generate_nota_penjualan(),
                'pelangganList' => Pelanggan::orderBy('nama')->get(),
                'obatList' => Obat::query()->orderBy('nama_obat')->get(),
            ]);
        })->name('penjualan.create');

        Route::post('/penjualan', function (Request $request) {
            $validated = $request->validate([
                'nota' => ['required', 'string', 'max:255', 'unique:penjualan,nota'],
                'pelanggan_id' => ['required', 'exists:pelanggan,id'],
                'diskon' => ['nullable', 'integer', 'min:0'],
                'items' => ['required', 'array', 'min:1'],
                'items.*.obat_id' => ['required', 'exists:obat,id'],
                'items.*.jumlah' => ['required', 'integer', 'min:1'],
                'items.*.harga_satuan' => ['required', 'integer', 'min:0'],
            ]);

            $items = collect($validated['items'])
                ->filter(fn (array $item) => ! empty($item['obat_id']))
                ->values();

            if ($items->isEmpty()) {
                return back()
                    ->withErrors(['items' => 'Tambahkan minimal satu item penjualan.'])
                    ->withInput();
            }

            $diskon = (int) ($validated['diskon'] ?? 0);
            $penjualan = null;

            DB::transaction(function () use ($validated, $items, $diskon, &$penjualan) {
                $subtotal = 0;

                foreach ($items as $item) {
                    $subtotal += ((int) $item['jumlah']) * ((int) $item['harga_satuan']);
                }

                $totalHarga = max(0, $subtotal - $diskon);

                $penjualan = Penjualan::create([
                    'nota' => $validated['nota'],
                    'tanggal_nota' => now(),
                    'pelanggan_id' => $validated['pelanggan_id'],
                    'diskon' => $diskon,
                    'subtotal' => $subtotal,
                    'total_harga' => $totalHarga,
                ]);

                foreach ($items as $item) {
                    $obat = Obat::query()->lockForUpdate()->findOrFail($item['obat_id']);
                    $jumlah = (int) $item['jumlah'];
                    $hargaSatuan = (int) $item['harga_satuan'];

                    if ($jumlah > $obat->stok) {
                        throw ValidationException::withMessages([
                            'items' => 'Stok obat ' . $obat->nama_obat . ' tidak cukup.',
                        ]);
                    }

                    $subtotalItem = $jumlah * $hargaSatuan;

                    PenjualanDetail::create([
                        'penjualan_id' => $penjualan->id,
                        'obat_id' => $obat->id,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $hargaSatuan,
                        'subtotal' => $subtotalItem,
                    ]);

                    $obat->decrement('stok', $jumlah);
                }
            });

            return redirect()
                ->route('apoteker.penjualan.show', $penjualan)
                ->with('success', 'Penjualan baru berhasil disimpan.');
        })->name('penjualan.store');
    });
});
