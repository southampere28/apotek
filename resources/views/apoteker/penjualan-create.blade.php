@extends('layouts.apoteker')

@section('dashboard-content')
    @include('admin.transactions.form', [
        'pageTitle' => 'Tambah Penjualan',
        'pageDescription' => 'Input transaksi penjualan ala kasir: pilih pelanggan, pilih obat, isi jumlah, lalu sistem akan menghitung total otomatis.',
        'backRoute' => route('apoteker.penjualan.index'),
        'storeRoute' => route('apoteker.penjualan.store'),
        'referenceLabel' => 'Nota Penjualan',
        'referenceCode' => $referenceCode,
        'partyLabel' => 'Pelanggan',
        'partyFieldName' => 'pelanggan_id',
        'partyCodeKey' => 'kode_pelanggan',
        'partyOptions' => $pelangganList,
        'partyPlaceholder' => 'Pilih pelanggan',
        'itemLabel' => 'Obat',
        'itemOptions' => $obatList,
        'defaultPriceKey' => 'harga_jual',
        'priceLabel' => 'Harga Jual',
        'restrictItemOptions' => false,
        'submitLabel' => 'Simpan Penjualan',
    ])
@endsection
