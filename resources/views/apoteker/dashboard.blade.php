@extends('layouts.apoteker')

@section('dashboard-content')
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Obat</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">{{ $totalObat }}</div>
                    <div class="text-secondary small">Seluruh master obat yang tersedia.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Stok Menipis</div>
                    <div class="display-6 fw-bold text-warning mb-2">{{ $stokMenipis }}</div>
                    <div class="text-secondary small">Perlu dipantau untuk restock.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Transaksi Penjualan</div>
                    <div class="display-6 fw-bold text-success mb-2">{{ $totalPenjualan }}</div>
                    <div class="text-secondary small">Penjualan yang sudah dicatat.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Nominal</div>
                    <div class="display-6 fw-bold text-info mb-2">Rp {{ number_format($totalNominalPenjualan, 0, ',', '.') }}</div>
                    <div class="text-secondary small">Akumulasi penjualan berjalan.</div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="panel border-0 shadow-sm">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Akses Cepat</h2>
                    <p class="panel-subtitle">Menu utama apoteker yang dipakai setiap hari.</p>
                </div>
            </div>

            <div class="quick-grid">
                <a href="{{ route('apoteker.penjualan.index') }}" class="quick-card border rounded-4 text-decoration-none text-dark">
                    <strong>Penjualan</strong>
                    <span>Buka transaksi kasir untuk melayani pelanggan.</span>
                </a>
                <a href="{{ route('apoteker.obat.index') }}" class="quick-card border rounded-4 text-decoration-none text-dark">
                    <strong>Obat</strong>
                    <span>Lihat stok, harga, dan status kadaluarsa obat.</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="quick-card border rounded-4 text-decoration-none text-dark">
                    <strong>Preview Katalog</strong>
                    <span>Cek tampilan katalog publik di tab baru.</span>
                </a>
            </div>
        </div>
    </section>
@endsection