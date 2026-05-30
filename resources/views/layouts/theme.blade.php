<style>
    :root {
        --bg: #eef3f8;
        --surface: #ffffff;
        --surface-soft: #f7fafc;
        --text: #10233f;
        --muted: #66758a;
        --accent: #0f766e;
        --accent-2: #115e59;
        --border: #d8e1ea;
        --shadow: 0 24px 60px rgba(16, 35, 63, 0.12);
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        min-height: 100vh;
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        background:
            radial-gradient(circle at top left, rgba(15, 118, 110, 0.12), transparent 26%),
            linear-gradient(135deg, #eef4fa 0%, #f8fafc 100%);
        color: var(--text);
    }

    .app {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 280px 1fr;
    }

    .sidebar-toggle {
        display: none;
        width: 46px;
        height: 46px;
        border: 1px solid rgba(216, 225, 234, 0.9);
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.88);
        box-shadow: var(--shadow);
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 0;
        cursor: pointer;
    }

    .sidebar-backdrop {
        display: none;
    }

    .sidebar-toggle span {
        display: block;
        width: 18px;
        height: 2px;
        border-radius: 999px;
        background: #115e59;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .sidebar {
        padding: 28px;
        background: rgba(10, 24, 45, 0.96);
        color: #e8eef5;
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .brand {
        display: grid;
        gap: 6px;
        padding-bottom: 22px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .user-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        color: #fff;
        font-weight: 900;
    }

    .user-info {
        display: grid;
        gap: 2px;
        min-width: 0;
    }

    .user-info strong {
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-info span {
        font-size: 12px;
        color: rgba(232, 238, 245, 0.65);
        text-transform: capitalize;
    }

    .brand-mark {
        width: 44px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        color: #fff;
        font-weight: 900;
        letter-spacing: 0.04em;
    }

    .brand small,
    .sidebar small,
    .meta,
    .stat-label,
    .panel-subtitle,
    .chip,
    .nav-link,
    .nav-label {
        color: rgba(232, 238, 245, 0.72);
    }

    .brand strong {
        font-size: 18px;
    }

    .nav {
        display: grid;
        gap: 10px;
    }

    .nav-group {
        display: grid;
        gap: 8px;
    }

    .nav-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: rgba(232, 238, 245, 0.5);
        margin-bottom: 2px;
    }

    .nav-list {
        display: grid;
        gap: 6px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 12px 14px;
        border-radius: 16px;
        text-decoration: none;
        background: transparent;
        transition: 0.18s ease;
    }

    .nav-badge {
        font-size: 11px;
        padding: 5px 8px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.10);
        color: rgba(255, 255, 255, 0.88);
        font-weight: 800;
        letter-spacing: 0.03em;
    }

    .nav-link:hover,
    .nav-link.active {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
    }

    .sidebar-footer {
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        display: grid;
        gap: 10px;
    }

    .chip {
        display: inline-flex;
        width: fit-content;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-size: 12px;
        font-weight: 800;
    }

    .main {
        padding: 28px;
    }

    .shell {
        max-width: 1280px;
        margin: 0 auto;
        display: grid;
        gap: 20px;
    }

    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 20px 24px;
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid rgba(216, 225, 234, 0.9);
        border-radius: 24px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(12px);
    }

    .page-head {
        display: grid;
        gap: 6px;
    }

    .badge {
        display: inline-flex;
        width: fit-content;
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
        margin: 0;
        font-size: clamp(30px, 4vw, 44px);
        letter-spacing: -0.05em;
    }

    .meta {
        color: var(--muted);
        line-height: 1.6;
    }

    .topbar-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #fff;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
    }

    .logout {
        padding: 12px 16px;
        border: 0;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        color: #fff;
        font: inherit;
        font-weight: 800;
        cursor: pointer;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .stat-card,
    .panel {
        background: rgba(255, 255, 255, 0.88);
        border: 1px solid rgba(216, 225, 234, 0.9);
        border-radius: 24px;
        box-shadow: var(--shadow);
    }

    .stat-card {
        padding: 22px;
        display: grid;
        gap: 10px;
    }

    .stat-label {
        color: var(--muted);
        font-size: 13px;
    }

    .stat-value {
        font-size: clamp(24px, 3vw, 34px);
        font-weight: 900;
        letter-spacing: -0.04em;
    }

    .stat-note {
        color: var(--accent);
        font-size: 13px;
        font-weight: 700;
    }

    .content {
        display: grid;
        gap: 18px;
        grid-template-columns: 1.6fr 1fr;
    }

    .panel {
        padding: 22px;
        display: grid;
        gap: 16px;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .panel-title {
        margin: 0;
        font-size: 18px;
    }

    .panel-subtitle {
        margin: 0;
        color: var(--muted);
    }

    .table-list {
        display: grid;
        gap: 12px;
    }

    .table-row {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 14px 16px;
        border-radius: 16px;
        background: var(--surface-soft);
        border: 1px solid var(--border);
    }

    .row-title {
        font-weight: 800;
    }

    .row-meta {
        color: var(--muted);
        font-size: 13px;
    }

    .quick-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .quick-card {
        padding: 16px;
        border-radius: 18px;
        background: var(--surface-soft);
        border: 1px solid var(--border);
        display: grid;
        gap: 8px;
    }

    .quick-card strong {
        font-size: 15px;
    }

    .quick-card span {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.5;
    }

    @media (max-width: 1100px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { order: 2; }
        .main { order: 1; }
        .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .content { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .app {
            grid-template-columns: 1fr;
        }

        .sidebar-toggle {
            display: inline-flex;
        }

        .main { padding: 16px; }
        .sidebar { padding: 20px; }
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: min(88vw, 320px);
            transform: translateX(-102%);
            transition: transform 0.22s ease;
            z-index: 50;
            box-shadow: 0 24px 60px rgba(10, 24, 45, 0.35);
        }

        body.sidebar-open .sidebar {
            transform: translateX(0);
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10, 24, 45, 0.46);
            z-index: 40;
        }

        body.sidebar-open .sidebar-backdrop {
            display: block;
        }

        .topbar { flex-direction: column; align-items: flex-start; }
        .topbar-actions { width: 100%; justify-content: space-between; }
        .stats, .quick-grid { grid-template-columns: 1fr; }
        .panel-header, .table-row { flex-direction: column; align-items: flex-start; }
        .logout { width: 100%; }
    }
</style>