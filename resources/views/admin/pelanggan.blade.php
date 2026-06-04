@extends('layouts.admin')

@section('dashboard-content')
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="fw-bold mb-1">Berhasil</div>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="alert alert-warning border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-warning-emphasis mb-1">Manajemen Pelanggan</div>
            <div class="text-warning-emphasis">Atur data pelanggan anda.</div>
        </div>
        {{-- <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle px-3 py-2">Data Real</span> --}}
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Pelanggan</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">{{ $totalPelanggan }}</div>
                    <div class="text-secondary small">Semua data pelanggan yang tersimpan.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Terhubung ke Akun</div>
                    <div class="display-6 fw-bold text-success mb-2">{{ $pelangganDenganAkun }}</div>
                    <div class="text-secondary small">Pelanggan yang sudah punya akun login.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Baru Bulan Ini</div>
                    <div class="display-6 fw-bold text-warning mb-2">{{ $pelangganBaruBulanIni }}</div>
                    <div class="text-secondary small">Pelanggan yang dibuat bulan ini.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Manajemen Pelanggan</h2>
                <p class="mb-0 text-secondary">Konten halaman ini memuat data pelanggan real dari database.</p>
            </div>
            <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-success fw-semibold px-4 rounded-pill">Tambah Pelanggan</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive p-2">
                <table id="pelangganDatatable"
                    class="table table-hover align-middle mb-0 js-datatable"
                    data-per-page="5"
                    data-searchable="false"
                    data-sortable="true">

                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nama Pelanggan</th>
                            <th class="px-4 py-3">Kode</th>
                            <th class="px-4 py-3">Kontak</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Dibuat</th>
                            <th class="px-4 py-3">Aksi</th>
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
                                <td class="px-4 py-3 text-end">
                                    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                        <a href="{{ route('admin.pelanggan.edit', $pelanggan) }}" class="btn btn-outline-primary btn-sm rounded-pill">Edit</a>
                                        <form action="{{ route('admin.pelanggan.destroy', $pelanggan) }}" method="POST" onsubmit="return confirm('Hapus data pelanggan ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-5 text-center text-secondary">
                                    Belum ada data pelanggan. Seeder atau input manual belum menghasilkan data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection