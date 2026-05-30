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
            'brandMark' => 'A',
            'brandTitle' => 'Apotek Ujikom',
            'brandSubtitle' => 'Dashboard admin',
            'activeLabel' => 'Admin Aktif',
            'menuSections' => [
                [
                    'label' => 'Menu utama',
                    'items' => [
                        ['label' => 'Dashboard', 'routeName' => 'admin.dashboard'],
                        ['label' => 'Master Obat', 'routeName' => 'admin.obat.index'],
                        ['label' => 'Pembelian', 'routeName' => 'admin.pembelian.index'],
                        ['label' => 'Penjualan', 'routeName' => 'admin.penjualan.index'],
                    ],
                ],
                [
                    'label' => 'Manajemen',
                    'items' => [
                        ['label' => 'Pelanggan', 'routeName' => 'admin.pelanggan.index'],
                        ['label' => 'Supplier', 'routeName' => 'admin.supplier.index'],
                        ['label' => 'Apoteker', 'routeName' => 'admin.apoteker.index'],
                        ['label' => 'Laporan', 'routeName' => 'admin.laporan.index', 'badge' => 'New'],
                        ['label' => 'Pengaturan', 'routeName' => 'admin.pengaturan.index'],
                    ],
                ],
            ],
            'footerBadge' => $role,
        ])

        <main class="main">
            <div class="shell">
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