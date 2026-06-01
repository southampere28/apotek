<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - {{ config('apotek.app_name', 'Farmasi Kita') }}</title>
    @include('layouts.template')
</head>
<body>
    @php
        $currentUser = auth('web')->user();
        $currentUserName = $currentUser?->name ?? 'Apoteker';
        $currentUserInitial = strtoupper(mb_substr($currentUserName, 0, 1));
    @endphp
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
            'brandTitle' => config('apotek.brand_name', config('apotek.app_name', 'Farmasi Kita')),
            'brandSubtitle' => 'Dashboard apoteker',
            'activeLabel' => $currentUserName,
            'menuSections' => [
                [
                    'label' => 'Menu utama',
                    'items' => [
                        ['label' => 'Dashboard', 'routeName' => 'apoteker.dashboard'],
                        ['label' => 'Penjualan', 'routeName' => 'apoteker.penjualan.index'],
                        ['label' => 'Obat', 'routeName' => 'apoteker.obat.index'],
                        ['label' => 'Preview Katalog', 'routeName' => 'home', 'target' => '_blank'],
                    ],
                ],
            ],
            'footerBadge' => $role,
        ])

        <main class="main">
            <div class="shell">
                @if (request()->routeIs('apoteker.dashboard'))
                    <header class="topbar">
                        @include('layouts.partials.mobile-toggle')
                        <div class="page-head">
                            <span class="badge">{{ $role }}</span>
                            <h1>{{ $title }}</h1>
                            <p class="meta">{{ $description }}</p>
                        </div>

                        <div class="topbar-actions">
                            <div style="text-align: right;">
                                <div style="font-weight: 800;">{{ $currentUserName }}</div>
                                <div class="meta">Sesi berjalan</div>
                            </div>
                            <div class="avatar">{{ $currentUserInitial }}</div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="logout" type="submit">Logout</button>
                            </form>
                        </div>
                    </header>
                @endif

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