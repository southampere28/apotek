<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - {{ config('apotek.app_name', 'Farmasi Kita') }}</title>
    <style>
        :root {
            --bg: #f3f7fb;
            --surface: #ffffff;
            --surface-soft: #f8fbfd;
            --text: #10233f;
            --muted: #66758a;
            --accent: #0f766e;
            --accent-2: #115e59;
            --border: #d8e1ea;
            --shadow: 0 22px 50px rgba(16, 35, 63, 0.10);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(15, 118, 110, 0.10), transparent 28%),
                linear-gradient(135deg, #eef4fa 0%, #fbfdff 100%);
        }

        a { color: inherit; }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 28px;
        }

        .hero,
        .panel,
        .card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(216, 225, 234, 0.9);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .hero {
            padding: 28px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            color: #fff;
            font-weight: 900;
            overflow: hidden;
            flex: 0 0 auto;
        }

        .brand-mark img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .hero h1 {
            margin: 10px 0 8px;
            font-size: clamp(30px, 4vw, 48px);
            letter-spacing: -0.05em;
        }

        .muted { color: var(--muted); line-height: 1.7; }

        .hero-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            border: 1px solid var(--border);
            background: #fff;
            font-weight: 800;
        }

        .button.primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border-color: transparent;
            color: #fff;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat {
            padding: 20px;
        }

        .stat .label {
            color: var(--muted);
            font-size: 13px;
        }

        .stat .value {
            font-size: clamp(24px, 3vw, 34px);
            font-weight: 900;
            margin-top: 8px;
        }

        .panel {
            padding: 22px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 18px;
        }

        .toolbar h2 {
            margin: 0;
            font-size: 22px;
        }

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .card {
            padding: 20px;
            display: grid;
            gap: 12px;
            text-decoration: none;
        }

        .pill {
            display: inline-flex;
            width: fit-content;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(15, 118, 110, 0.1);
            color: #115e59;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .card h3 {
            margin: 0;
            font-size: 18px;
        }

        .meta {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 13px;
        }

        .empty {
            padding: 22px;
            border: 1px dashed var(--border);
            border-radius: 18px;
            color: var(--muted);
            background: var(--surface-soft);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1.3fr 0.7fr;
            gap: 16px;
        }

        .detail-box {
            padding: 22px;
            border-radius: 18px;
            border: 1px solid var(--border);
            background: var(--surface-soft);
        }

        .field-list {
            display: grid;
            gap: 12px;
        }

        .field {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .field:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .field span:first-child {
            color: var(--muted);
        }

        @media (max-width: 980px) {
            .catalog-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .detail-grid { grid-template-columns: 1fr; }
            .hero { flex-direction: column; }
        }

        @media (max-width: 640px) {
            .container { padding: 16px; }
            .catalog-grid, .stats { grid-template-columns: 1fr; }
            .toolbar { flex-direction: column; align-items: flex-start; }
            .hero-actions { justify-content: flex-start; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="hero">
            <div>
                <div class="brand">
                    <div class="brand-mark">
                        <img src="{{ asset('images/app_logo.png') }}" alt="{{ config('apotek.brand_name', config('apotek.app_name', 'Farmasi Kita')) }}">
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 18px;">{{ config('apotek.brand_name', config('apotek.app_name', 'Farmasi Kita')) }}</div>
                        <div class="muted">Akses katalog sesuai status login</div>
                    </div>
                </div>

                <h1>{{ $title }}</h1>
                <p class="muted">{{ $description }}</p>
            </div>

            <div class="hero-actions">
                @guest('web')
                    <a class="button" href="{{ route('register') }}">Daftar</a>
                    <a class="button primary" href="{{ route('login') }}">Login</a>
                @else
                    @if (auth('web')->user()?->role === 'pelanggan')
                        @if (request()->routeIs('riwayat.index'))
                            <a class="button" href="{{ route('home') }}">Katalog Obat</a>
                        @else
                            <a class="button" href="{{ route('riwayat.index') }}">Riwayat Pembelian</a>
                        @endif
                    @else
                        <a class="button" href="{{ route('dashboard') }}">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button class="button primary" type="submit">Logout</button>
                    </form>
                @endguest
            </div>
        </header>

        @yield('content')
    </div>
</body>
</html>