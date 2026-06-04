@extends('layouts.admin')

@section('dashboard-content')
    @php
        $brandName = config('apotek.brand_name', config('apotek.app_name', 'Farmasi Kita'));
        $receiptItems = $penjualan->detail->map(function ($detail) {
            return [
                'nama_obat' => $detail->obat?->nama_obat ?? '-',
                'kode_obat' => $detail->obat?->kode_obat ?? '-',
                'jumlah' => (int) $detail->jumlah,
                'harga_satuan' => (int) $detail->harga_satuan,
                'subtotal' => (int) $detail->subtotal,
            ];
        })->values();
    @endphp

    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 print-hide" role="alert">
        <div>
            <div class="fw-bold text-primary-emphasis mb-1">Detail Penjualan</div>
            <div class="text-primary-emphasis">Struk penjualan dibuat untuk pelanggan dan siap dicetak ke kertas kecil 80mm.</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('apoteker.penjualan.index') }}" class="btn btn-outline-primary fw-semibold px-4 rounded-pill">Kembali</a>
            <button type="button" class="btn btn-success fw-semibold px-4 rounded-pill" onclick="printReceipt()">Cetak Struk</button>
        </div>
    </div>

    <div class="mx-auto" style="max-width: 420px;" id="receipt-preview">
        <div class="card border border-dark border-opacity-25 shadow-sm rounded-3">
            <div class="card-body p-3">
                <div class="text-center mb-3">
                    <div class="text-uppercase fw-bold small text-dark" style="letter-spacing: 0.08em;">{{ $brandName }}</div>
                    <div class="small text-secondary text-uppercase">Struk Penjualan</div>
                </div>

                <hr class="my-2 opacity-100">

                <div class="small d-grid gap-1 mb-3 text-dark">
                    <div class="d-flex justify-content-between gap-3">
                        <span class="text-secondary">Nota</span>
                        <span class="fw-semibold text-end">{{ $penjualan->nota }}</span>
                    </div>
                    <div class="d-flex justify-content-between gap-3">
                        <span class="text-secondary">Tanggal</span>
                        <span class="fw-semibold text-end">{{ $penjualan->tanggal_nota?->format('d M Y H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between gap-3">
                        <span class="text-secondary">Pelanggan</span>
                        <span class="fw-semibold text-end">{{ $penjualan->pelanggan?->nama ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between gap-3">
                        <span class="text-secondary">Kode</span>
                        <span class="fw-semibold text-end">{{ $penjualan->pelanggan?->kode_pelanggan ?? '-' }}</span>
                    </div>
                </div>

                <hr class="my-2 opacity-100">

                <div class="d-grid gap-1 mb-3 small">
                    <div class="d-flex justify-content-between gap-3">
                        <span class="text-secondary">Subtotal</span>
                        <span class="fw-semibold">Rp {{ number_format($penjualan->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between gap-3">
                        <span class="text-secondary">Diskon</span>
                        <span class="fw-semibold">Rp {{ number_format($penjualan->diskon, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between gap-3 pt-1">
                        <span class="fw-bold text-dark">Total</span>
                        <span class="fw-bold text-dark">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <hr class="my-2 opacity-100">

                <div class="table-responsive mb-3">
                    <table class="table table-sm align-middle mb-0 small">
                        <thead>
                            <tr>
                                <th class="px-0 py-2 border-0 fw-normal text-secondary">Obat</th>
                                <th class="px-0 py-2 border-0 fw-normal text-secondary text-center">Qty</th>
                                <th class="px-0 py-2 border-0 fw-normal text-secondary text-end">Harga</th>
                                <th class="px-0 py-2 border-0 fw-normal text-secondary text-end">Sub</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan->detail as $detail)
                                <tr>
                                    <td class="px-0 py-2 border-0">
                                        <div class="fw-semibold text-dark">{{ $detail->obat?->nama_obat ?? '-' }}</div>
                                        <div class="text-secondary small">{{ $detail->obat?->kode_obat ?? '-' }}</div>
                                    </td>
                                    <td class="px-0 py-2 border-0 text-center">{{ $detail->jumlah }}</td>
                                    <td class="px-0 py-2 border-0 text-end">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="px-0 py-2 border-0 text-end fw-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr class="my-2 opacity-100">

                <div class="d-grid gap-1">
                    <div class="small text-center text-dark fw-semibold">
                        Terima kasih telah berbelanja di {{ $brandName }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const receipt = {
                brandName: @json($brandName),
                nota: @json($penjualan->nota),
                tanggal: @json($penjualan->tanggal_nota?->format('d M Y H:i')),
                pelanggan: @json($penjualan->pelanggan?->nama ?? '-'),
                pelangganCode: @json($penjualan->pelanggan?->kode_pelanggan ?? '-'),
                subtotal: @json((int) $penjualan->subtotal),
                diskon: @json((int) $penjualan->diskon),
                total: @json((int) $penjualan->total_harga),
                items: @json($receiptItems),
            };

            function formatCurrency(value) {
                return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
            }

            window.printReceipt = function () {
                const printWindow = window.open('', '_blank', 'width=420,height=800');

                if (!printWindow) {
                    window.print();
                    return;
                }

                const itemsHtml = receipt.items.map(function (item) {
                    return `
                        <tr>
                            <td style="padding: 4px 0; vertical-align: top;">
                                <div style="font-weight: 700;">${item.nama_obat}</div>
                                <div style="font-size: 10px; color: #666;">${item.kode_obat}</div>
                            </td>
                            <td style="padding: 4px 0; text-align: center; vertical-align: top;">${item.jumlah}</td>
                            <td style="padding: 4px 0; text-align: right; vertical-align: top;">${formatCurrency(item.harga_satuan)}</td>
                            <td style="padding: 4px 0; text-align: right; vertical-align: top; font-weight: 700;">${formatCurrency(item.subtotal)}</td>
                        </tr>
                    `;
                }).join('');

                const html = `
                    <!DOCTYPE html>
                    <html lang="id">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Struk Penjualan</title>
                        <style>
                            @page {
                                size: 80mm auto;
                                margin: 4mm;
                            }

                            html, body {
                                width: 80mm;
                                margin: 0;
                                padding: 0;
                                background: #fff;
                                color: #000;
                                font-family: Arial, Helvetica, sans-serif;
                                -webkit-print-color-adjust: exact;
                                print-color-adjust: exact;
                            }

                            * {
                                box-sizing: border-box;
                            }

                            .receipt {
                                width: 80mm;
                                padding: 0;
                                font-size: 11px;
                                line-height: 1.35;
                            }

                            .center {
                                text-align: center;
                            }

                            .brand {
                                font-size: 12px;
                                font-weight: 700;
                                letter-spacing: 0.08em;
                                text-transform: uppercase;
                            }

                            .subtitle {
                                font-size: 10px;
                                text-transform: uppercase;
                                color: #444;
                            }

                            .divider {
                                border: 0;
                                border-top: 1px dashed #000;
                                margin: 6px 0;
                            }

                            .meta, .summary {
                                width: 100%;
                                border-collapse: collapse;
                            }

                            .meta td, .summary td, .items td {
                                padding: 2px 0;
                                vertical-align: top;
                            }

                            .meta td:first-child,
                            .summary td:first-child {
                                color: #555;
                                padding-right: 8px;
                                white-space: nowrap;
                            }

                            .meta td:last-child,
                            .summary td:last-child {
                                text-align: right;
                                font-weight: 600;
                            }

                            .items {
                                width: 100%;
                                border-collapse: collapse;
                                table-layout: fixed;
                            }

                            .items th {
                                font-size: 10px;
                                color: #555;
                                font-weight: 400;
                                padding: 2px 0 4px;
                                text-align: left;
                                border-bottom: 1px solid #000;
                            }

                            .items th.qty,
                            .items td.qty {
                                text-align: center;
                                width: 10mm;
                            }

                            .items th.num,
                            .items td.num {
                                text-align: right;
                                width: 18mm;
                            }

                            .footer {
                                text-align: center;
                                font-size: 10px;
                                margin-top: 6px;
                            }

                            .footer-strong {
                                margin-top: 4px;
                                font-weight: 700;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="receipt">
                            <div class="center brand">${receipt.brandName}</div>
                            <div class="center subtitle">Struk Penjualan</div>

                            <hr class="divider">

                            <table class="meta">
                                <tr><td>Nota</td><td>${receipt.nota}</td></tr>
                                <tr><td>Tanggal</td><td>${receipt.tanggal || '-'}</td></tr>
                                <tr><td>Pelanggan</td><td>${receipt.pelanggan}</td></tr>
                                <tr><td>Kode</td><td>${receipt.pelangganCode}</td></tr>
                            </table>

                            <hr class="divider">

                            <table class="summary">
                                <tr><td>Subtotal</td><td>${formatCurrency(receipt.subtotal)}</td></tr>
                                <tr><td>Diskon</td><td>${formatCurrency(receipt.diskon)}</td></tr>
                                <tr><td>Total</td><td>${formatCurrency(receipt.total)}</td></tr>
                            </table>

                            <hr class="divider">

                            <table class="items">
                                <thead>
                                    <tr>
                                        <th>Obat</th>
                                        <th class="qty">Qty</th>
                                        <th class="num">Harga</th>
                                        <th class="num">Sub</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${itemsHtml}
                                </tbody>
                            </table>

                            <hr class="divider">

                            <div class="footer">Terima kasih telah berbelanja di ${receipt.brandName}</div>
                            <div class="footer footer-strong">Simpan struk ini sebagai bukti transaksi.</div>
                        </div>

                        <script>
                            window.addEventListener('load', function () {
                                setTimeout(function () {
                                    window.focus();
                                    window.print();
                                }, 250);
                            });

                            window.addEventListener('afterprint', function () {
                                window.close();
                            });
                        <\/script>
                    </body>
                    </html>
                `;

                printWindow.document.open();
                printWindow.document.write(html);
                printWindow.document.close();
            };
        })();
    </script>
@endsection