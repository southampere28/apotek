@extends('layouts.public')

@section('content')
    <section class="stats">
        <div class="panel stat">
            <div class="label">Jumlah Obat</div>
            <div class="value">{{ $totalObat }}</div>
            <div class="muted">Total item dalam katalog</div>
        </div>
        <div class="panel stat">
            <div class="label">Total Stok</div>
            <div class="value">{{ $totalStok }}</div>
            <div class="muted">Jumlah unit tersedia</div>
        </div>
        <div class="panel stat">
            <div class="label">Role Aktif</div>
            <div class="value" style="font-size: 22px; text-transform: capitalize;">{{ $role }}</div>
            <div class="muted">Akses publik atau login</div>
        </div>
    </section>

    <section class="panel">
        <div class="toolbar">
            <div>
                <h2>Daftar Obat</h2>
                <p class="muted">Klik nama obat untuk melihat detail lengkap.</p>
            </div>
            <div class="pill">{{ $obat->count() }} item</div>
        </div>

        @if ($obat->isEmpty())
            <div class="empty">Belum ada obat yang ditampilkan.</div>
        @else
            <div class="catalog-grid">
                @foreach ($obat as $item)
                    <a class="card" href="{{ route('obat.show', $item->id) }}">
                        <span class="pill">{{ $item->kode_obat }}</span>
                        <h3>{{ $item->nama_obat }}</h3>
                        <div class="muted">{{ $item->jenis }}</div>
                        <div class="meta">
                            <span>Stok: {{ $item->stok }}</span>
                            <span>Supplier: {{ $item->supplier_kode }}</span>
                            <span>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection