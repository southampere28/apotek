@extends('layouts.public')

@section('content')
    <section style="display: grid; grid-template-columns: minmax(300px, 420px) minmax(0, 1fr); gap: 20px; align-items: start;">
        <div style="align-self: start; position: sticky; top: 20px;">
            <div style="border-radius: 28px; overflow: hidden; background: #fff; border: 1px solid rgba(216, 225, 234, 0.9); box-shadow: 0 18px 40px rgba(16, 35, 63, 0.12); padding: 16px;">
                <div style="width: 100%; aspect-ratio: 1 / 1; border-radius: 22px; overflow: hidden; background: rgba(15, 23, 42, 0.04);">
                    @if ($obat->gambar_obat)
                        <img
                            src="{{ asset('storage/' . $obat->gambar_obat) }}"
                            alt="{{ $obat->nama_obat }}"
                            style="width: 100%; height: 100%; object-fit: cover; display: block;"
                        >
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: rgba(15, 23, 42, 0.45); font-weight: 700; letter-spacing: 0.04em;">
                            No Image
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <div class="panel" style="padding: 28px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; margin-bottom: 14px; flex-wrap: wrap;">
                <div style="min-width: 0;">
                    <h1 style="margin: 0;">{{ $obat->nama_obat }}</h1>
                </div>
                <span class="pill" style="margin-top: 4px; background: {{ $obat->stok > 0 ? 'rgba(15, 118, 110, 0.12)' : 'rgba(220, 38, 38, 0.12)' }}; color: {{ $obat->stok > 0 ? '#0f766e' : '#dc2626' }};">
                    Ketersediaan: {{ $obat->stok > 0 ? 'Tersedia' : 'Habis' }}
                </span>
            </div>

            <h3 style="margin: 0 0 18px; color: #0f766e; font-size: 18px;">Jenis: {{ $obat->jenis }}</h3>

            <div class="detail-box" style="margin-top: 16px; background: #fff;">
                <div class="field-list" style="gap: 10px;">
                    <div class="field"><span>Kode Obat</span><strong>{{ $obat->kode_obat }}</strong></div>
                    <div class="field"><span>Nama Obat</span><strong>{{ $obat->nama_obat }}</strong></div>
                    <div class="field"><span>Harga</span><strong>Rp {{ number_format($obat->harga_jual, 0, ',', '.') }}</strong></div>
                    <div class="field"><span>Stok Tersisa</span><strong>{{ $obat->stok }}</strong></div>
                </div>
            </div>
        </div>
    </section>
@endsection