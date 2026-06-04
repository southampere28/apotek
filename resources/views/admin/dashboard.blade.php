@extends('layouts.admin')

@section('dashboard-content')
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Obat</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">{{ $totalObat }}</div>
                    <div class="text-secondary small">Seluruh data master obat.</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Supplier</div>
                    <div class="display-6 fw-bold text-success mb-2">{{ $totalSupplier }}</div>
                    <div class="text-secondary small">Supplier aktif dalam sistem.</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Pelanggan</div>
                    <div class="display-6 fw-bold text-warning mb-2">{{ $totalPelanggan }}</div>
                    <div class="text-secondary small">Pelanggan yang terdaftar.</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Penjualan</div>
                    <div class="display-6 fw-bold text-info mb-2">{{ $totalPenjualan }}</div>
                    <div class="text-secondary small">Transaksi penjualan tercatat.</div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="panel border-0 shadow-sm">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Akses Cepat Admin</h2>
                    <p class="panel-subtitle">Kelola data utama apotek dari satu halaman.</p>
                </div>
            </div>

            <div class="quick-grid">
                <a href="{{ route('admin.obat.index') }}" class="quick-card border rounded-4 text-decoration-none text-dark">
                    <strong>Master Obat</strong>
                    <span>Kelola data obat, stok, harga, dan kategori.</span>
                </a>

                <a href="{{ route('admin.pembelian.index') }}" class="quick-card border rounded-4 text-decoration-none text-dark">
                    <strong>Pembelian</strong>
                    <span>Kelola transaksi pembelian dari supplier.</span>
                </a>

                <a href="{{ route('admin.penjualan.index') }}" class="quick-card border rounded-4 text-decoration-none text-dark">
                    <strong>Penjualan</strong>
                    <span>Lihat transaksi penjualan dari apoteker.</span>
                </a>
            </div>
        </div>

        <div class="panel border-0 shadow-sm">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Ringkasan Sistem</h2>
                    <p class="panel-subtitle">Status data utama yang perlu dipantau admin.</p>
                </div>
            </div>

            <div class="table-list">
                <div class="table-row">
                    <div>
                        <div class="row-title">Stok Menipis</div>
                        <div class="row-meta">Obat yang perlu segera dipantau.</div>
                    </div>
                    <strong>{{ $stokMenipis }}</strong>
                </div>

                <div class="table-row">
                    <div>
                        <div class="row-title">Total Pembelian</div>
                        <div class="row-meta">Transaksi pembelian yang sudah dicatat.</div>
                    </div>
                    <strong>{{ $totalPembelian }}</strong>
                </div>

                <div class="table-row">
                    <div>
                        <div class="row-title">Total Nominal Penjualan</div>
                        <div class="row-meta">Akumulasi nilai transaksi penjualan.</div>
                    </div>
                    <strong>Rp {{ number_format($totalNominalPenjualan, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
    </section>
@endsection