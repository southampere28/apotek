@extends('layouts.admin')

@section('dashboard-content')
    <div class="alert alert-warning border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-warning-emphasis mb-1">Manajemen Supplier</div>
            <div class="text-warning-emphasis">Halaman ini mengambil data real dari tabel supplier beserta relasi obat dan pembelian.</div>
        </div>
        <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle px-3 py-2">Data Real</span>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Supplier</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">{{ $totalSupplier }}</div>
                    <div class="text-secondary small">Semua data supplier yang tersimpan.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Supplier Punya Obat</div>
                    <div class="display-6 fw-bold text-success mb-2">{{ $supplierDenganObat }}</div>
                    <div class="text-secondary small">Supplier yang sudah terhubung ke data obat.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Obat Terkait</div>
                    <div class="display-6 fw-bold text-info mb-2">{{ $totalObatTerkait }}</div>
                    <div class="text-secondary small">Akumulasi relasi obat per supplier.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Pembelian Terkait</div>
                    <div class="display-6 fw-bold text-warning mb-2">{{ $totalPembelianTerkait }}</div>
                    <div class="text-secondary small">Riwayat pembelian yang mengarah ke supplier.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Daftar Supplier</h2>
                <p class="mb-0 text-secondary">Data tampil real dari database dan bisa langsung dipakai untuk manajemen.</p>
            </div>
            <a href="#" class="btn btn-success fw-semibold px-4 rounded-pill">Tambah Supplier</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nama Supplier</th>
                            <th class="px-4 py-3">Kode</th>
                            <th class="px-4 py-3">Kontak</th>
                            <th class="px-4 py-3">Obat</th>
                            <th class="px-4 py-3">Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($supplierList as $supplier)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="fw-semibold text-dark">{{ $supplier->nama }}</div>
                                    <div class="text-secondary small">{{ $supplier->alamat }} · {{ $supplier->kota }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle">{{ $supplier->kode_supplier }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-dark">{{ $supplier->telepon }}</div>
                                    <div class="text-secondary small">Siap dihubungi untuk restock</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle">{{ $supplier->obat_count }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">{{ $supplier->pembelian_count }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-5 text-center text-secondary">
                                    Belum ada data supplier. Seeder atau input manual belum menghasilkan data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <section class="content mt-4">
        <div class="panel border-0 shadow-sm">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Ringkasan Supplier</h2>
                    <p class="panel-subtitle">Pakai ini untuk dashboard ringkas di bawah tabel utama.</p>
                </div>
            </div>

            <div class="quick-grid">
                <div class="quick-card border rounded-4">
                    <strong>Supplier Aktif</strong>
                    <span>{{ $totalSupplier }} supplier aktif di sistem.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Relasi Obat</strong>
                    <span>{{ $totalObatTerkait }} total obat terhubung ke supplier.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Riwayat Pembelian</strong>
                    <span>{{ $totalPembelianTerkait }} pembelian terkait supplier.</span>
                </div>
            </div>
        </div>

        <div class="panel border-0 shadow-sm">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Aksi Cepat</h2>
                    <p class="panel-subtitle">Shortcut untuk modul supplier.</p>
                </div>
            </div>

            <div class="quick-grid">
                <div class="quick-card border rounded-4">
                    <strong>Tambah Data</strong>
                    <span>Form supplier baru akan masuk di sini.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Relasi Obat</strong>
                    <span>Hubungkan supplier dengan master obat.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Riwayat Pembelian</strong>
                    <span>Lihat transaksi pembelian per supplier.</span>
                </div>
            </div>
        </div>
    </section>
@endsection