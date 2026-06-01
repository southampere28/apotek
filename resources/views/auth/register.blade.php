<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - {{ config('apotek.app_name', 'Farmasi Kita') }}</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f4f7fb;
            --card: #ffffff;
            --text: #10233f;
            --muted: #5f6f82;
            --primary: #0f766e;
            --primary-dark: #115e59;
            --border: #d8e1ea;
            --shadow: 0 24px 60px rgba(16, 35, 63, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(15, 118, 110, 0.16), transparent 28%),
                radial-gradient(circle at bottom right, rgba(17, 94, 89, 0.12), transparent 24%),
                linear-gradient(135deg, #eef4fa 0%, #f8fafc 100%);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .page {
            width: min(100%, 920px);
            display: grid;
            gap: 24px;
        }

        .header, .card {
            border: 1px solid rgba(216, 225, 234, 0.95);
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.76);
            backdrop-filter: blur(18px);
            box-shadow: var(--shadow);
        }

        .header {
            padding: 28px 32px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            width: fit-content;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(15, 118, 110, 0.1);
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .brand-lockup {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .brand-logo {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            overflow: hidden;
            background: rgba(15, 118, 110, 0.08);
            border: 1px solid rgba(15, 118, 110, 0.12);
            flex: 0 0 auto;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        h1 {
            margin: 22px 0 12px;
            font-size: clamp(36px, 6vw, 64px);
            line-height: 0.95;
            letter-spacing: -0.05em;
        }

        .lead {
            margin: 0;
            max-width: 42rem;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.7;
        }

        .page-note {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            border-radius: 18px;
            border: 1px solid rgba(15, 118, 110, 0.16);
            background: rgba(15, 118, 110, 0.08);
            color: var(--text);
            font-weight: 700;
        }

        .card {
            padding: 36px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card h2 {
            margin: 0 0 8px;
            font-size: 30px;
            letter-spacing: -0.04em;
        }

        .card p {
            margin: 0 0 24px;
            color: var(--muted);
        }

        .error {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 14px;
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .field { margin-bottom: 18px; }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 18px;
        }

        .span-2 {
            grid-column: 1 / -1;
        }

        input, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 14px;
            font: inherit;
            color: var(--text);
            background: #fff;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        textarea { min-height: 110px; resize: vertical; }

        input:focus, textarea:focus {
            border-color: rgba(15, 118, 110, 0.55);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.14);
        }

        button {
            width: 100%;
            padding: 14px 18px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            font: inherit;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 18px 30px rgba(15, 118, 110, 0.2);
        }

        .footer {
            margin-top: 18px;
            color: var(--muted);
            font-size: 14px;
            text-align: center;
        }

        .footer a {
            color: var(--primary-dark);
            font-weight: 700;
            text-decoration: none;
        }

        @media (max-width: 900px) {
            .page { gap: 18px; }
            .header, .card { padding: 24px; }
            .form-grid { grid-template-columns: 1fr; }
            .span-2 { grid-column: auto; }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="header">
            <div class="brand-lockup">
                <div class="brand-logo">
                    <img src="{{ asset('images/app_logo.png') }}" alt="{{ config('apotek.brand_name', config('apotek.app_name', 'Farmasi Kita')) }}">
                </div>
                <div class="eyebrow" style="margin: 0;">{{ config('apotek.brand_name', config('apotek.app_name', 'Farmasi Kita')) }}</div>
            </div>
            <h1>Daftar sebagai pelanggan aktif.</h1>
            <p class="lead">
                Buat akun pelanggan untuk masuk ke katalog obat, melihat detail produk, dan mengakses riwayat pesanan.
            </p>
            <div class="page-note">Halaman registrasi pelanggan aktif</div>
        </header>

        <section class="card">
            <h2>Register Pelanggan</h2>
            <p>Lengkapi data di bawah ini untuk membuat akun baru.</p>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="form-grid">
                @csrf

                <div class="field span-2">
                    <label for="kode_pelanggan">Kode Pelanggan</label>
                    <input id="kode_pelanggan" type="text" name="kode_pelanggan" value="{{ old('kode_pelanggan', $kodePelanggan) }}" readonly>
                </div>

                <div class="field">
                    <label for="name">Nama</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" autofocus required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                </div>

                <div class="field span-2">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" autocomplete="street-address" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="field">
                    <label for="kota">Kota</label>
                    <input id="kota" type="text" name="kota" value="{{ old('kota') }}" autocomplete="address-level2" required>
                </div>

                <div class="field">
                    <label for="telepon">Telepon</label>
                    <input id="telepon" type="text" name="telepon" value="{{ old('telepon') }}" autocomplete="tel" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" autocomplete="new-password" required>
                </div>

                <div class="field">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required>
                </div>

                <div class="field span-2" style="margin-bottom: 0;">
                    <button type="submit">Buat Akun</button>
                </div>
            </form>

            <div class="footer">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </section>
    </div>
</body>
</html>