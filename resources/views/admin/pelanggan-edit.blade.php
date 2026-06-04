@extends('layouts.admin')

@section('dashboard-content')
    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Edit Pelanggan</div>
            <div class="text-primary-emphasis">Edit data pelanggan berikut untuk memperbarui informasi akun login.</div>
        </div>
        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-primary fw-semibold px-4 rounded-pill">Kembali</a>
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
            <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Form Edit Pelanggan</h2>
            <p class="mb-0 text-secondary">Edit data pelanggan berikut untuk memperbarui informasi akun login.</p>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.pelanggan.update', $pelanggan) }}" method="POST" class="row g-4">
                @csrf
                @method('PUT')

                <div class="col-12 col-md-6">
                    <label for="kode_pelanggan" class="form-label fw-semibold">Kode Pelanggan</label>
                    <input type="text" id="kode_pelanggan" name="kode_pelanggan" class="form-control form-control-lg @error('kode_pelanggan') is-invalid @enderror" value="{{ old('kode_pelanggan', $pelanggan->kode_pelanggan) }}" readonly>
                    <div class="form-text">Kode dibuat otomatis dari helper dan dikunci agar tidak diedit manual.</div>
                    @error('kode_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="name" class="form-label fw-semibold">Nama Pelanggan</label>
                    <input type="text" id="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name', $pelanggan->nama) }}" placeholder="Contoh: Andi Pratama">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label fw-semibold">Email Login</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email', $pelanggan->user->email ?? '') }}" placeholder="contoh@email.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="telepon" class="form-label fw-semibold">Telepon</label>
                    <input type="text" id="telepon" name="telepon" class="form-control form-control-lg @error('telepon') is-invalid @enderror" value="{{ old('telepon', $pelanggan->telepon) }}" placeholder="Contoh: 08123456789">
                    @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="4" class="form-control form-control-lg @error('alamat') is-invalid @enderror" placeholder="Alamat lengkap pelanggan">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="kota" class="form-label fw-semibold">Kota</label>
                    <input type="text" id="kota" name="kota" class="form-control form-control-lg @error('kota') is-invalid @enderror" value="{{ old('kota', $pelanggan->kota) }}" placeholder="Contoh: Bandung">
                    @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex flex-column flex-md-row gap-3 justify-content-end">
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Batal</a>
                    <button type="submit" class="btn btn-success btn-lg px-4 rounded-pill fw-semibold">Simpan Pelanggan</button>
                </div>
            </form>
        </div>
    </div>
@endsection