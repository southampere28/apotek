<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogController::class, 'index'])->name('home');
Route::get('/obat/{obat}', [CatalogController::class, 'show'])->name('obat.show');

Route::middleware('guest:web')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth:web')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', function (Request $request) {
        return match ($request->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'apoteker' => redirect()->route('apoteker.dashboard'),
            'pelanggan' => redirect()->route('pelanggan.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'title' => 'Dashboard Admin',
                'role' => 'admin',
                'description' => 'Kelola data master, transaksi, dan pengaturan sistem.',
            ]);
        })->name('dashboard');

        Route::get('/obat', [ProductController::class, 'index'])->name('obat.index');
        Route::get('/obat/create', [ProductController::class, 'create'])->name('obat.create');
        Route::post('/obat', [ProductController::class, 'store'])->name('obat.store');

        Route::get('/pembelian', function () {
            return view('admin.dashboard', [
                'title' => 'Pembelian',
                'role' => 'admin',
                'description' => 'Contoh route menu sidebar untuk modul pembelian.',
            ]);
        })->name('pembelian.index');

        Route::get('/penjualan', function () {
            return view('admin.dashboard', [
                'title' => 'Penjualan',
                'role' => 'admin',
                'description' => 'Contoh route menu sidebar untuk modul penjualan.',
            ]);
        })->name('penjualan.index');

        Route::get('/supplier', [UserController::class, 'supplierIndex'])->name('supplier.index');

        Route::get('/pelanggan', [UserController::class, 'pelangganIndex'])->name('pelanggan.index');

        Route::get('/apoteker', [UserController::class, 'apotekerIndex'])->name('apoteker.index');

        Route::get('/laporan', function () {
            return view('admin.dashboard', [
                'title' => 'Laporan',
                'role' => 'admin',
                'description' => 'Contoh route menu sidebar untuk laporan.',
            ]);
        })->name('laporan.index');

        Route::get('/pengaturan', function () {
            return view('admin.dashboard', [
                'title' => 'Pengaturan',
                'role' => 'admin',
                'description' => 'Contoh route menu sidebar untuk pengaturan aplikasi.',
            ]);
        })->name('pengaturan.index');
    });

    Route::middleware('role:apoteker')->prefix('apoteker')->name('apoteker.')->group(function () {
        Route::get('/dashboard', function () {
            return view('apoteker.dashboard', [
                'title' => 'Dashboard Apoteker',
                'role' => 'apoteker',
                'description' => 'Kelola resep, stok obat, dan pelayanan farmasi.',
            ]);
        })->name('dashboard');
    });

    Route::middleware('role:pelanggan')->prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/dashboard', function () {
            return view('pelanggan.dashboard', [
                'title' => 'Dashboard Pelanggan',
                'role' => 'pelanggan',
                'description' => 'Lihat katalog obat dan riwayat pesanan.',
            ]);
        })->name('dashboard');
    });
});
