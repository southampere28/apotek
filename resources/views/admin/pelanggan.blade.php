@extends('layouts.admin')

@section('dashboard-content')

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Manajemen Pelanggan</h2>
                <p class="mb-0 text-secondary">Konten halaman ini memuat data pelanggan real dari database.</p>
            </div>
            <a href="#" class="btn btn-success fw-semibold px-4 rounded-pill">Tambah Pelanggan</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nama Pelanggan</th>
                            <th class="px-4 py-3">Kode</th>
                            <th class="px-4 py-3">Kontak</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelangganList as $pelanggan)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="fw-semibold text-dark">{{ $pelanggan->nama }}</div>
                                    <div class="text-secondary small">{{ $pelanggan->alamat }} · {{ $pelanggan->kota }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle">{{ $pelanggan->kode_pelanggan }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-dark">{{ $pelanggan->telepon }}</div>
                                    <div class="text-secondary small">{{ $pelanggan->user?->email ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-secondary">
                                    {{ $pelanggan->created_at?->format('d M Y') ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-5 text-center text-secondary">
                                    Belum ada data pelanggan. Seeder atau input manual belum menghasilkan data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        {{-- testing bootstrap class  --}}
    </div>

    <section class="content mt-4">
        <div class="panel border-0 shadow-sm">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Ringkasan Pelanggan</h2>
                    <p class="panel-subtitle">Nanti bisa diganti ke data asli dari database.</p>
                </div>
            </div>

            <div class="quick-grid">
                <div class="quick-card border rounded-4">
                    <strong>Total Pelanggan</strong>
                    <span>{{ $totalPelanggan }} pelanggan tersimpan di database.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Pelanggan Aktif</strong>
                    <span>{{ $pelangganDenganAkun }} pelanggan terhubung ke akun user.</span>
                </div>
            </div>
        </div>

        <div class="panel border-0 shadow-sm">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Aksi Cepat</h2>
                    <p class="panel-subtitle">Shortcut untuk modul pelanggan.</p>
                </div>
            </div>

            <div class="quick-grid">
                <div class="quick-card border rounded-4">
                    <strong>Tambah Data</strong>
                    <span>Form pelanggan baru akan masuk di sini.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Riwayat Transaksi</strong>
                    <span>Tampilkan histori pembelian pelanggan.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Pelanggan Bulan Ini</strong>
                    <span>{{ $pelangganBaruBulanIni }} pelanggan dibuat bulan ini.</span>
                </div>
            </div>
        </div>
    </section>
@endsection