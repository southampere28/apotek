@extends('layouts.admin')

@section('dashboard-content')
    <header class="topbar">
        @include('layouts.partials.mobile-toggle')
        <div class="page-head">
            <span class="badge">{{ $role }}</span>
            <h1>{{ $title }}</h1>
            <p class="meta">{{ $description }}</p>
        </div>

        <div class="topbar-actions">
            <div style="text-align: right;">
                <div style="font-weight: 800;">Admin Aktif</div>
                <div class="meta">Sesi berjalan</div>
            </div>
            <div class="avatar">A</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout" type="submit">Logout</button>
            </form>
        </div>
    </header>

    <section class="stats">
        <div class="stat-card">
            <div class="stat-label">Total Obat</div>
            <div class="stat-value">128</div>
            <div class="stat-note">+12 dari bulan lalu</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Transaksi Hari Ini</div>
            <div class="stat-value">24</div>
            <div class="stat-note">5 menunggu proses</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Stok Menipis</div>
            <div class="stat-value">8</div>
            <div class="stat-note">Perlu restock segera</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Pengguna Aktif</div>
            <div class="stat-value">3</div>
            <div class="stat-note">Admin, apoteker, pelanggan</div>
        </div>
    </section>

    <section class="content">
        <div class="panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Aktivitas Terbaru</h2>
                    <p class="panel-subtitle">Ringkasan aktivitas yang nanti bisa kamu sambungkan ke data asli.</p>
                </div>
                <span class="chip" style="background: rgba(15, 118, 110, 0.1); color: #115e59;">Live</span>
            </div>

            <div class="table-list">
                <div class="table-row">
                    <div>
                        <div class="row-title">Pembelian masuk dari supplier</div>
                        <div class="row-meta">12 menit lalu</div>
                    </div>
                    <div class="row-meta">Rp 1.250.000</div>
                </div>
                <div class="table-row">
                    <div>
                        <div class="row-title">Stok amoksisilin diperbarui</div>
                        <div class="row-meta">30 menit lalu</div>
                    </div>
                    <div class="row-meta">+40 pcs</div>
                </div>
                <div class="table-row">
                    <div>
                        <div class="row-title">Transaksi penjualan selesai</div>
                        <div class="row-meta">1 jam lalu</div>
                    </div>
                    <div class="row-meta">#PJ-2026-001</div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Quick Actions</h2>
                    <p class="panel-subtitle">Akses cepat untuk modul utama.</p>
                </div>
            </div>

            <div class="quick-grid">
                <div class="quick-card">
                    <strong>Tambah Obat</strong>
                    <span>Input master obat baru dan atur stok awal.</span>
                </div>
                <div class="quick-card">
                    <strong>Buat Pembelian</strong>
                    <span>Catat pembelian dari supplier dengan detail item.</span>
                </div>
                <div class="quick-card">
                    <strong>Transaksi Jual</strong>
                    <span>Proses penjualan obat ke pelanggan.</span>
                </div>
                <div class="quick-card">
                    <strong>Lihat Laporan</strong>
                    <span>Monitor aktivitas harian dan performa stok.</span>
                </div>
            </div>
        </div>
    </section>

    <div class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Panel Admin</h2>
                <p class="panel-subtitle">Tempat kamu isi widget, laporan, dan shortcut khusus admin.</p>
            </div>
        </div>

        <div class="quick-grid">
            <div class="quick-card">
                <strong>Master Data</strong>
                <span>Kelola obat, supplier, pelanggan, dan apoteker.</span>
            </div>
            <div class="quick-card">
                <strong>Transaksi</strong>
                <span>Pantau pembelian dan penjualan harian.</span>
            </div>
        </div>
    </div>
@endsection