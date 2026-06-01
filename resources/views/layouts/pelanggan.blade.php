<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @include('layouts.template')
</head>
<body>
    <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="app-sidebar" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
        <span class="sr-only">Toggle sidebar</span>
    </button>
    <div class="sidebar-backdrop" data-sidebar-backdrop></div>
    <div class="app">
        @include('layouts.partials.sidebar', [
            'sidebarId' => 'app-sidebar',
            'brandLogoPath' => 'images/app_logo.png',
            'brandTitle' => 'Apotek Ujikom',
            'brandSubtitle' => 'Dashboard pelanggan',
            'activeLabel' => 'Pelanggan Aktif',
            'menuSections' => [
                [
                    'label' => 'Menu utama',
                    'items' => [
                        ['label' => 'Dashboard', 'url' => '#', 'active' => true],
                        ['label' => 'Katalog Obat', 'url' => route('home')],
                        ['label' => 'Keranjang', 'url' => '#'],
                        ['label' => 'Pesanan', 'url' => '#'],
                    ],
                ],
                [
                    'label' => 'Riwayat',
                    'items' => [
                        ['label' => 'Transaksi', 'url' => '#'],
                        ['label' => 'Promo Aktif', 'url' => '#', 'badge' => '2'],
                    ],
                ],
            ],
            'footerBadge' => $role,
        ])

        <main class="main">
            <div class="shell">
                <header class="topbar">
                    @include('layouts.partials.mobile-toggle')
                    <div class="page-head">
                        <span class="badge">{{ $role }}</span>
                        <h1>{{ $title }}</h1>
                        <p class="meta">{{ $description }}</p>
                    </div>

                    <div class="topbar-actions">
                        <div style="text-align: right;">
                            <div style="font-weight: 800;">Pelanggan Aktif</div>
                            <div class="meta">Sesi berjalan</div>
                        </div>
                        <div class="avatar">K</div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="logout" type="submit">Logout</button>
                        </form>
                    </div>
                </header>

                <section class="stats">
                    <div class="stat-card">
                        <div class="stat-label">Obat Tersedia</div>
                        <div class="stat-value">86</div>
                        <div class="stat-note">Bisa dibeli sekarang</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Pesanan Aktif</div>
                        <div class="stat-value">4</div>
                        <div class="stat-note">Sedang diproses</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Riwayat Transaksi</div>
                        <div class="stat-value">18</div>
                        <div class="stat-note">Total pembelian</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Promo Aktif</div>
                        <div class="stat-value">2</div>
                        <div class="stat-note">Sedang berlangsung</div>
                    </div>
                </section>

                <section class="content">
                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h2 class="panel-title">Pesanan Terbaru</h2>
                                <p class="panel-subtitle">Ringkasan order yang nanti bisa kamu hubungkan ke data asli.</p>
                            </div>
                        </div>

                        <div class="table-list">
                            <div class="table-row">
                                <div>
                                    <div class="row-title">Order #PJ-2026-002</div>
                                    <div class="row-meta">2 item</div>
                                </div>
                                <div class="row-meta">Diproses</div>
                            </div>
                            <div class="table-row">
                                <div>
                                    <div class="row-title">Order #PJ-2026-001</div>
                                    <div class="row-meta">5 item</div>
                                </div>
                                <div class="row-meta">Selesai</div>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h2 class="panel-title">Quick Actions</h2>
                                <p class="panel-subtitle">Akses cepat untuk pelanggan.</p>
                            </div>
                        </div>

                        <div class="quick-grid">
                            <div class="quick-card">
                                <strong>Buka Katalog</strong>
                                <span>Lihat daftar obat dan detailnya.</span>
                            </div>
                            <div class="quick-card">
                                <strong>Lihat Pesanan</strong>
                                <span>Periksa status order yang sedang berjalan.</span>
                            </div>
                        </div>
                    </div>
                </section>

                @yield('dashboard-content')
            </div>
        </main>
    </div>

    <script>
        (function () {
            const body = document.body;
            const toggleButtons = document.querySelectorAll('[data-sidebar-toggle]');
            const backdrop = document.querySelector('[data-sidebar-backdrop]');

            function setOpen(isOpen) {
                body.classList.toggle('sidebar-open', isOpen);
                toggleButtons.forEach((button) => {
                    button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }

            toggleButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    setOpen(! body.classList.contains('sidebar-open'));
                });
            });

            if (backdrop) {
                backdrop.addEventListener('click', function () {
                    setOpen(false);
                });
            }
        })();
    </script>
</body>
</html>