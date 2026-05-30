<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --card: #ffffff;
            --text: #10233f;
            --muted: #5f6f82;
            --accent: #0f766e;
            --border: #d8e1ea;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #eef4fa 0%, #f8fafc 100%);
            color: var(--text);
            padding: 28px;
        }

        .page {
            max-width: 1120px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(216, 225, 234, 0.9);
            border-radius: 28px;
            box-shadow: 0 24px 60px rgba(16, 35, 63, 0.12);
            overflow: hidden;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 28px 32px;
            background: linear-gradient(135deg, rgba(15, 118, 110, 0.08), rgba(15, 118, 110, 0.02));
            border-bottom: 1px solid var(--border);
        }

        .badge {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(15, 118, 110, 0.1);
            color: #115e59;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-size: 12px;
        }

        h1 {
            margin: 14px 0 8px;
            font-size: clamp(30px, 4vw, 46px);
            letter-spacing: -0.04em;
        }

        p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .content {
            padding: 32px;
            display: grid;
            gap: 18px;
        }

        .panel {
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: var(--card);
        }

        .actions {
            display: flex;
            justify-content: flex-end;
        }

        button {
            padding: 12px 16px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #0f766e, #115e59);
            color: #fff;
            font: inherit;
            font-weight: 800;
            cursor: pointer;
        }

        @media (max-width: 640px) {
            body { padding: 16px; }
            .topbar, .content { padding: 22px; }
            .topbar { flex-direction: column; align-items: flex-start; }
            .actions { justify-content: stretch; }
            button { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="topbar">
            <div>
                <span class="badge">{{ $role }}</span>
                <h1>{{ $title }}</h1>
                <p>{{ $description }}</p>
            </div>

            <div class="actions">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        <div class="content">
            <div class="panel">
                <strong>Role aktif:</strong> {{ $role }}
                <p>Halaman ini hanya bisa diakses jika role cocok dengan middleware route group.</p>
            </div>
        </div>
    </div>
</body>
</html>