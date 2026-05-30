<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth('web')->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

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
            return view('dashboard', [
                'title' => 'Dashboard Admin',
                'role' => 'admin',
                'description' => 'Kelola data master, transaksi, dan pengaturan sistem.',
            ]);
        })->name('dashboard');
    });

    Route::middleware('role:apoteker')->prefix('apoteker')->name('apoteker.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard', [
                'title' => 'Dashboard Apoteker',
                'role' => 'apoteker',
                'description' => 'Kelola resep, stok obat, dan pelayanan farmasi.',
            ]);
        })->name('dashboard');
    });

    Route::middleware('role:pelanggan')->prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard', [
                'title' => 'Dashboard Pelanggan',
                'role' => 'pelanggan',
                'description' => 'Lihat katalog obat dan riwayat pesanan.',
            ]);
        })->name('dashboard');
    });
});
