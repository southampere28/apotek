<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Apotek</title>
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

        .shell {
            width: min(100%, 1080px);
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 24px;
            align-items: stretch;
        }

        .hero, .card {
            border: 1px solid rgba(216, 225, 234, 0.95);
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.76);
            backdrop-filter: blur(18px);
            box-shadow: var(--shadow);
        }

        .hero {
            padding: 42px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 560px;
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

        h1 {
            margin: 22px 0 12px;
            font-size: clamp(36px, 6vw, 64px);
            line-height: 0.95;
            letter-spacing: -0.05em;
        }

        .lead {
            margin: 0;
            max-width: 36rem;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.7;
        }

        .points {
            display: grid;
            gap: 14px;
            margin-top: 28px;
        }

        .point {
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid var(--border);
            color: var(--text);
        }

        .point strong {
            display: block;
            margin-bottom: 6px;
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

        input {
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

        input:focus {
            border-color: rgba(15, 118, 110, 0.55);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.14);
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 6px 0 22px;
            color: var(--muted);
            font-size: 14px;
        }

        .row label {
            margin: 0;
            font-weight: 600;
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

        @media (max-width: 900px) {
            .shell { grid-template-columns: 1fr; }
            .hero, .card { padding: 28px; }
            .hero { min-height: auto; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div>
                <div class="eyebrow">Apotek Ujikom</div>
                <h1>Sistem login untuk admin, apoteker, dan pelanggan.</h1>
                <p class="lead">
                    Masuk ke aplikasi sesuai role akun kamu. Hak akses akan diarahkan otomatis ke dashboard yang sesuai.
                </p>
            </div>

            <div class="points">
                <div class="point">
                    <strong>Admin</strong>
                    Kelola master data, pengguna, dan pengaturan aplikasi.
                </div>
                <div class="point">
                    <strong>Apoteker</strong>
                    Proses resep, pantau stok, dan layani transaksi obat.
                </div>
                <div class="point">
                    <strong>Pelanggan</strong>
                    Lihat katalog, pesanan, dan riwayat pembelian.
                </div>
            </div>
        </section>

        <section class="card">
            <h2>Login</h2>
            <p>Gunakan email dan password akun kamu.</p>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" autocomplete="current-password" required>
                </div>

                <div class="row">
                    <label>
                        <input type="checkbox" name="remember" value="1" style="width:auto; margin-right:8px; vertical-align:middle;">
                        Ingat saya
                    </label>
                </div>

                <button type="submit">Masuk</button>
            </form>

            <div class="footer">
                Akses login dilindungi Sanctum dan middleware role.
            </div>
        </section>
    </div>
</body>
</html>