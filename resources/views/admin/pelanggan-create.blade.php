@extends('layouts.admin')

@section('dashboard-content')
    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Tambah Pelanggan Baru</div>
            <div class="text-primary-emphasis">Data pelanggan sekaligus akun login akan dibuat dari form ini.</div>
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
            <h2 class="h4 fw-bold mb-1 text-primary-emphasis">Form Tambah Pelanggan</h2>
            <p class="mb-0 text-secondary">Isi data pelanggan baru berikut untuk membuat akun login yang terhubung.</p>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.pelanggan.store') }}" method="POST" class="row g-4">
                @csrf

                <div class="col-12 col-md-6">
                    <label for="kode_pelanggan" class="form-label fw-semibold">Kode Pelanggan</label>
                    <input type="text" id="kode_pelanggan" name="kode_pelanggan" class="form-control form-control-lg @error('kode_pelanggan') is-invalid @enderror" value="{{ old('kode_pelanggan', $kodePelanggan) }}" readonly>
                    <div class="form-text">Kode dibuat otomatis dari helper dan dikunci agar tidak diedit manual.</div>
                    @error('kode_pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="name" class="form-label fw-semibold">Nama Pelanggan</label>
                    <input type="text" id="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Andi Pratama">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label fw-semibold">Email Login</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="contoh@email.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="telepon" class="form-label fw-semibold">Telepon</label>
                    <input type="text" id="telepon" name="telepon" class="form-control form-control-lg @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}" placeholder="Contoh: 08123456789">
                    @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="4" class="form-control form-control-lg @error('alamat') is-invalid @enderror" placeholder="Alamat lengkap pelanggan">{{ old('alamat') }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="kota" class="form-label fw-semibold">Kota</label>
                    <input type="text" id="kota" name="kota" class="form-control form-control-lg @error('kota') is-invalid @enderror" value="{{ old('kota') }}" placeholder="Contoh: Bandung">
                    @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" placeholder="Ulangi password">
                </div>

                <div class="col-12 d-flex flex-column flex-md-row gap-3 justify-content-end">
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Batal</a>
                    <button type="submit" class="btn btn-success btn-lg px-4 rounded-pill fw-semibold">Simpan Pelanggan</button>
                </div>
            </form>
        </div>
    </div>
@endsection