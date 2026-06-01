@extends('layouts.admin')

@section('dashboard-content')
    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Penjualan</div>
            <div class="text-primary-emphasis">Layout penjualan akan memakai form kasir yang sama dengan pembelian agar reusable untuk modul apoteker.</div>
        </div>
        <a href="{{ route('admin.pembelian.index') }}" class="btn btn-outline-primary fw-semibold px-4 rounded-pill">Lihat Pembelian</a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Status Modul</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">Siap</div>
                    <div class="text-secondary small">Route penjualan sudah aktif dan tinggal dipakai ulang nanti.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Reuse UI</div>
                    <div class="display-6 fw-bold text-success mb-2">Kasir</div>
                    <div class="text-secondary small">Form transaksi akan share partial yang sama.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Target Next</div>
                    <div class="display-6 fw-bold text-warning mb-2">Apoteker</div>
                    <div class="text-secondary small">Modul ini nanti dipindah ke flow apoteker.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Halaman Penjualan</h2>
                <p class="mb-0 text-secondary">Sementara masih placeholder, tapi route dan layout sudah siap dipakai ulang.</p>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="alert alert-light border rounded-4 mb-0">
                <div class="fw-semibold mb-1">Catatan</div>
                <div class="text-secondary">Saat modul penjualan dikerjakan, view ini bisa langsung diganti memakai partial transaksi yang sama dengan pembelian.</div>
            </div>
        </div>
    </div>
@endsection