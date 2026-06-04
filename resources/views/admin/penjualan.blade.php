@extends('layouts.admin')

@section('dashboard-content')
    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Laporan Penjualan</div>
            <div class="text-primary-emphasis">Admin hanya dapat melihat laporan penjualan (read-only). Transaksi penjualan dilakukan oleh apoteker.</div>
        </div>
        <a href="{{ route('admin.pembelian.index') }}" class="btn btn-outline-primary fw-semibold px-4 rounded-pill">Lihat Pembelian</a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Daftar Penjualan</h2>
                <p class="mb-0 text-secondary">Data penjualan dari transaksi yang diproses oleh apoteker.</p>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive p-2">
                <table id="penjualanDatatable"
                    class="table table-hover align-middle mb-0 js-datatable"
                    data-per-page="5"
                    data-searchable="false"
                    data-sortable="true">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nota</th>
                            <th class="px-4 py-3">Pelanggan</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Item</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjualanList as $penjualan)
                            <tr>
                                <td class="px-4 py-3">
                                    {{-- <a href="{{ route('admin.penjualan.show', $penjualan) }}" class="badge rounded-pill bg-primary-subtle text-primary-emphasis border border-primary-subtle text-decoration-none">{{ $penjualan->nota }}</a> --}}
                                    <a href="#" class="badge rounded-pill bg-primary-subtle text-primary-emphasis border border-primary-subtle text-decoration-none">{{ $penjualan->nota }}</a>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="fw-semibold text-dark">{{ $penjualan->pelanggan?->nama ?? '-' }}</div>
                                    <div class="text-secondary small">{{ $penjualan->pelanggan?->kode_pelanggan ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3 text-dark">{{ $penjualan->tanggal_nota?->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle">{{ $penjualan->detail_count }}</span>
                                </td>
                                <td class="px-4 py-3 text-dark fw-semibold">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-end">
                                    <a href="{{ route('admin.penjualan.show', $penjualan) }}" class="btn btn-outline-primary btn-sm rounded-pill">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-5 text-center text-secondary">
                                    Belum ada data penjualan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection