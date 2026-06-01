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
                        <div style="width: 100%; aspect-ratio: 1 / 1; border-radius: 18px; overflow: hidden; background: rgba(15, 23, 42, 0.04); margin-bottom: 14px;">
                            @if ($item->gambar_obat)
                                <img
                                    src="{{ asset('storage/' . $item->gambar_obat) }}"
                                    alt="{{ $item->nama_obat }}"
                                    style="width: 100%; height: 100%; object-fit: cover; display: block;"
                                >
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: rgba(15, 23, 42, 0.45); font-weight: 700;">
                                    No Image
                                </div>
                            @endif
                        </div>
                        <h3>{{ $item->nama_obat }}</h3>
                        <h4>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</h4>
                        <div class="muted">{{ $item->jenis }}</div>
                        {{-- <div class="meta">
                            <span>Stok: {{ $item->stok }}</span>
                            <span>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                        </div> --}}
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection