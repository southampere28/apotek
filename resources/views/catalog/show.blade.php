@extends('layouts.public')

@section('content')
    <section class="detail-grid">
        <div class="panel">
            <div class="toolbar" style="margin-bottom: 0;">
                <div>
                    <span class="pill">{{ $obat->kode_obat }}</span>
                    <h2 style="margin: 12px 0 6px; font-size: 28px;">{{ $obat->nama_obat }}</h2>
                    <p class="muted">Detail obat dari katalog publik.</p>
                </div>
                <a class="button" href="{{ route('home') }}">Kembali</a>
            </div>

            <div class="detail-box">
                <div class="field-list">
                    <div class="field"><span>Nama Obat</span><strong>{{ $obat->nama_obat }}</strong></div>
                    <div class="field"><span>Jenis</span><strong>{{ $obat->jenis }}</strong></div>
                    <div class="field"><span>Supplier</span><strong>{{ $obat->supplier_kode }}</strong></div>
                    <div class="field"><span>Harga Jual</span><strong>Rp {{ number_format($obat->harga_jual, 0, ',', '.') }}</strong></div>
                    <div class="field"><span>Stok</span><strong>{{ $obat->stok }}</strong></div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div>
                <h2 style="margin: 0 0 6px;">Ringkasan</h2>
                <p class="muted">Halaman detail awal untuk kebutuhan requirement poin (b).</p>
            </div>

            <div class="detail-box">
                <div class="field-list">
                    <div class="field"><span>Kode Obat</span><strong>{{ $obat->kode_obat }}</strong></div>
                    <div class="field"><span>Harga Beli</span><strong>Rp {{ number_format($obat->harga_beli, 0, ',', '.') }}</strong></div>
                    <div class="field"><span>Stok Tersisa</span><strong>{{ $obat->stok }}</strong></div>
                    <div class="field"><span>Terakhir Update</span><strong>{{ $updatedAtLabel }}</strong></div>
                </div>
            </div>
        </div>
    </section>
@endsection