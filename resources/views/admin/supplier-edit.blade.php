@extends('layouts.admin')

@section('dashboard-content')
    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Edit Supplier</div>
            <div class="text-primary-emphasis">Kode supplier diisi otomatis dari helper dan tidak bisa diedit manual.</div>
        </div>
        <a href="{{ route('admin.supplier.index') }}" class="btn btn-outline-primary fw-semibold px-4 rounded-pill">Kembali</a>
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
            <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Form Edit Supplier</h2>
            <p class="mb-0 text-secondary">Edit data supplier berikut untuk diperbarui di database.</p>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.supplier.update', $supplier) }}" method="POST" class="row g-4">
                @csrf
                @method('PUT')

                <div class="col-12 col-md-6">
                    <label for="kode_supplier" class="form-label fw-semibold">Kode Supplier</label>
                    <input type="text" id="kode_supplier" name="kode_supplier" class="form-control form-control-lg @error('kode_supplier') is-invalid @enderror" value="{{ old('kode_supplier', $supplier->kode_supplier) }}" readonly>
                    <div class="form-text">Kode dibuat otomatis dari helper dan dikunci agar tidak diedit manual.</div>
                    @error('kode_supplier')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="nama" class="form-label fw-semibold">Nama Supplier</label>
                    <input type="text" id="nama" name="nama" class="form-control form-control-lg @error('nama') is-invalid @enderror" value="{{ old('nama', $supplier->nama) }}" placeholder="Contoh: PT Sumber Sehat">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="4" class="form-control form-control-lg @error('alamat') is-invalid @enderror" placeholder="Alamat lengkap supplier">{{ old('alamat', $supplier->alamat) }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="kota" class="form-label fw-semibold">Kota</label>
                    <input type="text" id="kota" name="kota" class="form-control form-control-lg @error('kota') is-invalid @enderror" value="{{ old('kota', $supplier->kota) }}" placeholder="Contoh: Bandung">
                    @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="telepon" class="form-label fw-semibold">Telepon</label>
                    <input type="text" id="telepon" name="telepon" class="form-control form-control-lg @error('telepon') is-invalid @enderror" value="{{ old('telepon', $supplier->telepon) }}" placeholder="Contoh: 08123456789">
                    @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex flex-column flex-md-row gap-3 justify-content-end">
                    <a href="{{ route('admin.supplier.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Batal</a>
                    <button type="submit" class="btn btn-success btn-lg px-4 rounded-pill fw-semibold">Simpan Supplier</button>
                </div>
            </form>
        </div>
    </div>
@endsection