@extends('layouts.apoteker')

@section('dashboard-content')
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-warning border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-warning-emphasis mb-1">Penjualan Apoteker</div>
            <div class="text-warning-emphasis">Transaksi penjualan obat dibuat dengan format kasir dan data real ke database.</div>
        </div>
        <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle px-3 py-2">Real Data</span>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Penjualan</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">{{ $totalPenjualan }}</div>
                    <div class="text-secondary small">Semua transaksi penjualan tersimpan.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Nominal</div>
                    <div class="display-6 fw-bold text-success mb-2">Rp {{ number_format($totalNominal, 0, ',', '.') }}</div>
                    <div class="text-secondary small">Akumulasi total penjualan.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Item Terjual</div>
                    <div class="display-6 fw-bold text-warning mb-2">{{ $totalItem }}</div>
                    <div class="text-secondary small">Total baris detail penjualan.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Pelanggan Terpakai</div>
                    <div class="display-6 fw-bold text-info mb-2">{{ $pelangganTerpakai }}</div>
                    <div class="text-secondary small">Pelanggan yang sudah dilayani.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Daftar Penjualan</h2>
                <p class="mb-0 text-secondary">Riwayat transaksi penjualan obat yang sudah diproses.</p>
            </div>
            <a href="{{ route('apoteker.penjualan.create') }}" class="btn btn-success fw-semibold px-4 rounded-pill">Tambah Penjualan</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nota</th>
                            <th class="px-4 py-3">Pelanggan</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Item</th>
                            <th class="px-4 py-3">Subtotal</th>
                            <th class="px-4 py-3">Diskon</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjualanList as $penjualan)
                            <tr>
                                <td class="px-4 py-3">
                                    <a href="{{ route('apoteker.penjualan.show', $penjualan) }}" class="badge rounded-pill bg-primary-subtle text-primary-emphasis border border-primary-subtle text-decoration-none">{{ $penjualan->nota }}</a>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="fw-semibold text-dark">{{ $penjualan->pelanggan?->nama ?? '-' }}</div>
                                    <div class="text-secondary small">{{ $penjualan->pelanggan?->kode_pelanggan ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3 text-dark">{{ $penjualan->tanggal_nota?->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle">{{ $penjualan->detail_count }}</span>
                                </td>
                                <td class="px-4 py-3 text-dark">Rp {{ number_format($penjualan->subtotal, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-dark">Rp {{ number_format($penjualan->diskon, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-dark fw-semibold">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-end">
                                    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                        <a href="{{ route('apoteker.penjualan.show', $penjualan) }}" class="btn btn-outline-primary btn-sm rounded-pill">Detail</a>
                                        <a href="{{ route('apoteker.penjualan.show', $penjualan) }}#struk" class="btn btn-outline-success btn-sm rounded-pill">Cetak Struk</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-5 text-center text-secondary">
                                    Belum ada data penjualan. Silakan buat transaksi pertama.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
