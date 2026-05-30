@extends('layouts.admin')

@section('dashboard-content')
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('admin.obat.index') }}" class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label for="search" class="form-label fw-semibold">Cari Obat</label>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="form-control form-control-lg"
                        value="{{ $search ?? '' }}"
                        placeholder="Nama obat, kode, atau supplier"
                    >
                </div>

                <div class="col-12 col-md-3">
                    <label for="filter" class="form-label fw-semibold">Filter Kadaluarsa</label>
                    <select id="filter" name="filter" class="form-select form-select-lg">
                        <option value="" @selected(($filter ?? '') === '')>Semua</option>
                        <option value="soon" @selected(($filter ?? '') === 'soon')>Akan Kadaluarsa 30 Hari</option>
                        <option value="expired" @selected(($filter ?? '') === 'expired')>Sudah Kadaluarsa</option>
                    </select>
                </div>

                <div class="col-12 col-md-5 d-flex gap-2 justify-content-md-end">
                    <button type="submit" class="btn btn-primary btn-lg px-4 rounded-pill">Terapkan</button>
                    <a href="{{ route('admin.obat.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Manajemen Obat</div>
            <div class="text-primary-emphasis">Data obat diambil real dari tabel obat dan relasi supplier.</div>
        </div>
        <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle px-3 py-2">Real Data</span>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Obat</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">{{ $totalObat }}</div>
                    <div class="text-secondary small">Semua master obat yang tersimpan.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Stok</div>
                    <div class="display-6 fw-bold text-success mb-2">{{ $totalStok }}</div>
                    <div class="text-secondary small">Akumulasi seluruh stok obat.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Stok Menipis</div>
                    <div class="display-6 fw-bold text-warning mb-2">{{ $stokMenipis }}</div>
                    <div class="text-secondary small">Perlu diprioritaskan untuk restock.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Stok Habis</div>
                    <div class="display-6 fw-bold text-danger mb-2">{{ $stokHabis }}</div>
                    <div class="text-secondary small">Obat yang harus segera diisi ulang.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Kadaluarsa</div>
                    <div class="display-6 fw-bold text-danger mb-2">{{ $totalKadaluarsa }}</div>
                    <div class="text-secondary small">Obat yang sudah lewat tanggal kadaluarsa.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Daftar Obat</h2>
                <p class="mb-0 text-secondary">Tabel ini menampilkan master obat beserta supplier dan harga jual/beli.</p>
            </div>
            <a href="{{ route('admin.obat.create') }}" class="btn btn-success fw-semibold px-4 rounded-pill">Tambah Obat</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nama Obat</th>
                            <th class="px-4 py-3">Kode</th>
                            <th class="px-4 py-3">Jenis</th>
                            <th class="px-4 py-3">Harga Beli</th>
                            <th class="px-4 py-3">Harga Jual</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3">Kadaluarsa</th>
                            <th class="px-4 py-3">Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($obatList as $obat)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="fw-semibold text-dark">{{ $obat->nama_obat }}</div>
                                    <div class="text-secondary small">Obat master untuk transaksi apotek.</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle">{{ $obat->kode_obat }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle">{{ $obat->jenis }}</span>
                                </td>
                                <td class="px-4 py-3 text-dark">Rp {{ number_format($obat->harga_beli, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-dark">Rp {{ number_format($obat->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="badge {{ $obat->stok <= 0 ? 'bg-danger-subtle text-danger-emphasis border border-danger-subtle' : ($obat->stok <= 20 ? 'bg-warning-subtle text-warning-emphasis border border-warning-subtle' : 'bg-success-subtle text-success-emphasis border border-success-subtle') }}">
                                        {{ $obat->stok }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge {{ $obat->tanggal_kadaluarsa && $obat->tanggal_kadaluarsa->isPast() ? 'bg-danger-subtle text-danger-emphasis border border-danger-subtle' : ($obat->tanggal_kadaluarsa && $obat->tanggal_kadaluarsa->lessThanOrEqualTo(now()->addDays(30)) ? 'bg-warning-subtle text-warning-emphasis border border-warning-subtle' : 'bg-success-subtle text-success-emphasis border border-success-subtle') }}">
                                        {{ $obat->tanggal_kadaluarsa?->format('d M Y') ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-dark">{{ $obat->supplier?->nama ?? '-' }}</div>
                                    <div class="text-secondary small">{{ $obat->supplier?->kode_supplier ?? '-' }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-5 text-center text-secondary">
                                    Belum ada data obat. Seeder atau input manual belum menghasilkan data.
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
                    <h2 class="panel-title">Ringkasan Obat</h2>
                    <p class="panel-subtitle">Ringkasan stok dan relasi supplier untuk admin.</p>
                </div>
            </div>

            <div class="quick-grid">
                <div class="quick-card border rounded-4">
                    <strong>Stok Aman</strong>
                    <span>{{ $totalObat - $stokMenipis }} obat dalam kondisi aman.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Perlu Restock</strong>
                    <span>{{ $stokMenipis }} obat butuh perhatian stok.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Stok Habis</strong>
                    <span>{{ $stokHabis }} obat kosong.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Sudah Kadaluarsa</strong>
                    <span>{{ $totalKadaluarsa }} obat sudah lewat tanggal kadaluarsa.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Akan Kadaluarsa</strong>
                    <span>{{ $totalAkanKadaluarsa }} obat akan kadaluarsa dalam 30 hari.</span>
                </div>
            </div>
        </div>

        <div class="panel border-0 shadow-sm">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Aksi Cepat</h2>
                    <p class="panel-subtitle">Shortcut untuk modul obat.</p>
                </div>
            </div>

            <div class="quick-grid">
                <div class="quick-card border rounded-4">
                    <strong>Tambah Obat</strong>
                    <span>Form obat baru akan masuk di sini.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Update Stok</strong>
                    <span>Perbarui stok sesuai transaksi masuk.</span>
                </div>
                <div class="quick-card border rounded-4">
                    <strong>Filter Supplier</strong>
                    <span>Lihat obat berdasarkan supplier terkait.</span>
                </div>
            </div>
        </div>
    </section>
@endsection