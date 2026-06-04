@extends('layouts.admin')

@section('dashboard-content')
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-warning border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-warning-emphasis mb-1">Manajemen Pembelian</div>
            <div class="text-warning-emphasis">Transaksi pembelian obat dari supplier dibuat real ke database dengan nota otomatis.</div>
        </div>
        {{-- <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle px-3 py-2">Real Data</span> --}}
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Pembelian</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">{{ $totalPembelian }}</div>
                    <div class="text-secondary small">Semua transaksi pembelian tersimpan.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Nominal</div>
                    <div class="display-6 fw-bold text-success mb-2">Rp {{ number_format($totalNominal, 0, ',', '.') }}</div>
                    <div class="text-secondary small">Akumulasi total pembelian.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Item Dibeli</div>
                    <div class="display-6 fw-bold text-warning mb-2">{{ $totalItem }}</div>
                    <div class="text-secondary small">Total baris detail pembelian.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Supplier Terpakai</div>
                    <div class="display-6 fw-bold text-info mb-2">{{ $supplierTerpakai }}</div>
                    <div class="text-secondary small">Supplier yang sudah pernah dipakai.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Daftar Pembelian</h2>
                <p class="mb-0 text-secondary">Riwayat transaksi pembelian obat dari supplier.</p>
            </div>
            <a href="{{ route('admin.pembelian.create') }}" class="btn btn-success fw-semibold px-4 rounded-pill">Tambah Pembelian</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive p-2">
                <table id="pembelianDatatable"
                    class="table table-hover align-middle mb-0 js-datatable"
                    data-per-page="5"
                    data-searchable="false"
                    data-sortable="true">
                    
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nota</th>
                            <th class="px-4 py-3">Supplier</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Item</th>
                            <th class="px-4 py-3">Subtotal</th>
                            <th class="px-4 py-3">Diskon</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pembelianList as $pembelian)
                            <tr>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.pembelian.show', $pembelian) }}" class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle text-decoration-none">{{ $pembelian->nota }}</a>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="fw-semibold text-dark">{{ $pembelian->supplier?->nama ?? '-' }}</div>
                                    <div class="text-secondary small">{{ $pembelian->supplier?->kode_supplier ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3 text-dark">{{ $pembelian->tanggal_nota?->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle">{{ $pembelian->detail_count }}</span>
                                </td>
                                <td class="px-4 py-3 text-dark">Rp {{ number_format($pembelian->subtotal, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-dark">Rp {{ number_format($pembelian->diskon, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-dark fw-semibold">Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-end">
                                    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                        <a href="{{ route('admin.pembelian.show', $pembelian) }}" class="btn btn-outline-primary btn-sm rounded-pill">Detail</a>
                                        <a href="{{ route('admin.pembelian.show', $pembelian) }}#struk" class="btn btn-outline-success btn-sm rounded-pill">Cetak Struk</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-5 text-center text-secondary">
                                    Belum ada data pembelian. Silakan buat transaksi pertama.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection