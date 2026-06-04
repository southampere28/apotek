@extends('layouts.admin')

@section('dashboard-content')
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="fw-bold mb-1">Berhasil</div>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="alert alert-primary border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Manajemen Apoteker</div>
            <div class="text-primary-emphasis">Data apoteker diambil real dari tabel apoteker beserta relasi user.</div>
        </div>
        <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle px-3 py-2">Real Data</span>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Total Apoteker</div>
                    <div class="display-6 fw-bold text-primary-emphasis mb-2">{{ $totalApoteker }}</div>
                    <div class="text-secondary small">Semua data apoteker yang tersimpan.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Terhubung ke Akun</div>
                    <div class="display-6 fw-bold text-success mb-2">{{ $apotekerDenganAkun }}</div>
                    <div class="text-secondary small">Apoteker yang sudah punya akun login.</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="text-secondary small mb-1">Baru Bulan Ini</div>
                    <div class="display-6 fw-bold text-warning mb-2">{{ $apotekerBaruBulanIni }}</div>
                    <div class="text-secondary small">Apoteker yang dibuat bulan ini.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Daftar Apoteker</h2>
                <p class="mb-0 text-secondary">Tabel ini menampilkan apoteker real dari database dan data login yang terhubung.</p>
            </div>
            <a href="{{ route('admin.apoteker.create') }}" class="btn btn-success fw-semibold px-4 rounded-pill">Tambah Apoteker</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive p-2">
                <table id="apotekerDatatable"
                    class="table table-hover align-middle mb-0 js-datatable"
                    data-per-page="5"
                    data-searchable="false"
                    data-sortable="true">
                    
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nama Apoteker</th>
                            <th class="px-4 py-3">Kode</th>
                            <th class="px-4 py-3">Kontak</th>
                            <th class="px-4 py-3">Akun</th>
                            <th class="px-4 py-3">Dibuat</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apotekerList as $apoteker)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="fw-semibold text-dark">{{ $apoteker->nama }}</div>
                                    <div class="text-secondary small">{{ $apoteker->alamat }} · {{ $apoteker->kota }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle">{{ $apoteker->kode_apoteker }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-dark">{{ $apoteker->telepon }}</div>
                                    <div class="text-secondary small">{{ $apoteker->user?->email ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle">{{ $apoteker->user ? 'Aktif' : 'Belum Ada' }}</span>
                                </td>
                                <td class="px-4 py-3 text-secondary">
                                    {{ $apoteker->created_at?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-end">
                                    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                        <a href="{{ route('admin.apoteker.edit', $apoteker) }}" class="btn btn-outline-primary btn-sm rounded-pill">Edit</a>
                                        <form action="{{ route('admin.apoteker.destroy', $apoteker) }}" method="POST" onsubmit="return confirm('Hapus data apoteker ini?')" class="d-inline">
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
                                    Belum ada data apoteker. Seeder atau input manual belum menghasilkan data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection