@extends('layouts.admin')

@section('dashboard-content')
    @include('admin.transactions.form', [
        'pageTitle' => 'Tambah Pembelian',
        'pageDescription' => 'Input transaksi pembelian ala kasir: pilih supplier, pilih obat, isi jumlah, lalu sistem akan menghitung total otomatis.',
        'backRoute' => route('admin.pembelian.index'),
        'storeRoute' => route('admin.pembelian.store'),
        'referenceLabel' => 'Nota Pembelian',
        'referenceCode' => $referenceCode,
        'partyLabel' => 'Supplier',
        'partyFieldName' => 'supplier_id',
        'partyCodeKey' => 'kode_supplier',
        'partyOptions' => $supplierList,
        'partyPlaceholder' => 'Pilih supplier',
        'itemLabel' => 'Obat',
        'itemOptions' => $obatList,
        'defaultPriceKey' => 'harga_beli',
        'priceLabel' => 'Harga Beli',
        'submitLabel' => 'Simpan Pembelian',
    ])
@endsection