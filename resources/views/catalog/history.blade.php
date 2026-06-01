@extends('layouts.public')

@section('content')
    <section class="panel">
        <div class="toolbar">
            <div>
                <h2>Riwayat Pembelian</h2>
                <p class="muted">Daftar transaksi pembelian obat milik akun pelanggan.</p>
            </div>
            <div class="pill">{{ $riwayat->count() }} transaksi</div>
        </div>

        @if ($riwayat->isEmpty())
            <div class="empty">Belum ada riwayat pembelian untuk akun ini.</div>
        @else
            <div style="display:grid; gap:16px;">
                @foreach ($riwayat as $transaksi)
                    <div class="detail-box">
                        <div class="field-list">
                            <div class="field">
                                <span>Nota</span>
                                <strong>{{ $transaksi->nota }}</strong>
                            </div>
                            <div class="field">
                                <span>Tanggal</span>
                                <strong>{{ $transaksi->tanggal_nota?->format('d M Y H:i') }}</strong>
                            </div>
                            <div class="field">
                                <span>Subtotal</span>
                                <strong>Rp {{ number_format($transaksi->subtotal, 0, ',', '.') }}</strong>
                            </div>
                            <div class="field">
                                <span>Diskon</span>
                                <strong>Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</strong>
                            </div>
                            <div class="field">
                                <span>Total</span>
                                <strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong>
                            </div>
                        </div>

                        <div style="margin-top:16px;">
                            <div class="muted" style="font-weight:700; margin-bottom:8px;">Detail item</div>
                            <div style="display:grid; gap:8px;">
                                @foreach ($transaksi->detail as $detail)
                                    <div class="field" style="padding-bottom:0; border-bottom:0;">
                                        <span>{{ $detail->obat?->nama_obat ?? 'Obat' }} x {{ $detail->jumlah }}</span>
                                        <strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection