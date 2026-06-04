@extends('layouts.admin')

@section('dashboard-content')
    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Edit Obat</div>
            <div class="text-primary-emphasis">Hanya nama obat, harga beli, harga jual, dan stok yang bisa diubah.</div>
        </div>
        <a href="{{ route('admin.obat.index') }}" class="btn btn-outline-primary fw-semibold px-4 rounded-pill">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <div class="fw-bold mb-2">Periksa input berikut:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4">
            <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Form Edit Obat</h2>
            <p class="mb-0 text-secondary">Data identitas obat tetap tampil, tetapi hanya field tertentu yang bisa diperbarui.</p>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.obat.update', $obat) }}" method="POST" class="row g-4">
                @csrf
                @method('PUT')

                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Kode Obat</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $obat->kode_obat }}" readonly>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Supplier</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $obat->supplier?->nama ?? '-' }}" readonly>
                </div>

                <div class="col-12 col-md-6">
                    <label for="nama_obat" class="form-label fw-semibold">Nama Obat</label>
                    <input
                        type="text"
                        id="nama_obat"
                        name="nama_obat"
                        class="form-control form-control-lg @error('nama_obat') is-invalid @enderror"
                        value="{{ old('nama_obat', $obat->nama_obat) }}"
                        placeholder="Contoh: Paracetamol 500mg"
                    >
                    @error('nama_obat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="stok" class="form-label fw-semibold">Stok</label>
                    <input
                        type="number"
                        id="stok"
                        name="stok"
                        class="form-control form-control-lg @error('stok') is-invalid @enderror"
                        value="{{ old('stok', $obat->stok) }}"
                        min="0"
                        step="1"
                    >
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
                    <input
                        type="number"
                        id="harga_beli"
                        name="harga_beli"
                        class="form-control form-control-lg @error('harga_beli') is-invalid @enderror"
                        value="{{ old('harga_beli', $obat->harga_beli) }}"
                        min="0"
                        step="1"
                    >
                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="harga_jual" class="form-label fw-semibold">Harga Jual</label>
                    <input
                        type="number"
                        id="harga_jual"
                        name="harga_jual"
                        class="form-control form-control-lg @error('harga_jual') is-invalid @enderror"
                        value="{{ old('harga_jual', $obat->harga_jual) }}"
                        min="0"
                        step="1"
                    >
                    @error('harga_jual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Jenis</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $obat->jenis }}" readonly>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold">Tanggal Kadaluarsa</label>
                    {{-- <input type="text" class="form-control form-control-lg" value="{{ $obat->tanggal_kadaluarsa?->format('d M Y') ?? '-' }}" readonly> --}}
                    {{-- editable --}}
                    <input
                        type="date"
                        id="tanggal_kadaluarsa"
                        name="tanggal_kadaluarsa"
                        class="form-control form-control-lg @error('tanggal_kadaluarsa') is-invalid @enderror"
                        value="{{ old('tanggal_kadaluarsa', $obat->tanggal_kadaluarsa?->format('Y-m-d')) }}"
                    >
                    @error('tanggal_kadaluarsa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 d-flex flex-column flex-md-row gap-3 justify-content-end">
                    <a href="{{ route('admin.obat.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Batal</a>
                    <button type="submit" class="btn btn-success btn-lg px-4 rounded-pill fw-semibold">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
