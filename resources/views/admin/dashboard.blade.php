<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin – KOKIKU</title>
<link rel="icon" href="{{ $faviconUrl ?? asset('images/logo_kokiku.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
    --red:      #c1121f;
    --red-dark: #780000;
    --red-glow: rgba(193,18,31,0.3);
    --gold:     #ffc107;
    --gold-dim: rgba(255,193,7,0.15);
    --bg:       #0b0b12;
    --surface:  #13131f;
    --surface2: #1a1a2e;
    --surface3: #21213a;
    --border:   rgba(255,255,255,0.07);
    --border2:  rgba(255,255,255,0.12);
    --text:     #f0f0f5;
    --muted:    rgba(255,255,255,0.4);
    --muted2:   rgba(255,255,255,0.65);
}

html { scroll-behavior: smooth; }

body {
    font-family: 'Outfit', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
}

/* ── SIDEBAR ─────────────────────────────────── */
.sidebar {
    position: fixed;
    top: 0; left: 0;
    width: 248px;
    height: 100vh;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    z-index: 100;
}

.sidebar-brand {
    padding: 20px 18px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, rgba(193,18,31,0.06), transparent);
}

.sidebar-brand .brand-logo {
    width: 40px; height: 40px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 2px solid rgba(193,18,31,0.3);
    box-shadow: 0 0 16px rgba(193,18,31,0.2);
}
.sidebar-brand .brand-logo img {
    width: 100%; height: 100%;
    object-fit: cover;
}
.sidebar-brand .brand-name {
    font-size: 21px; font-weight: 800;
    color: var(--gold);
    letter-spacing: 1.5px;
    text-shadow: 0 0 20px rgba(255,193,7,0.35);
}

.sidebar-nav {
    padding: 18px 12px;
    flex: 1;
    overflow-y: auto;
}
.nav-label {
    font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1.5px;
    color: var(--muted);
    padding: 0 10px;
    margin-bottom: 10px;
}
.sidebar-link {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 14px;
    border-radius: 12px;
    color: var(--muted2);
    text-decoration: none;
    font-size: 14px; font-weight: 500;
    transition: all 0.25s;
    margin-bottom: 4px;
    position: relative;
}
.sidebar-link .s-icon {
    width: 34px; height: 34px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    background: rgba(255,255,255,0.05);
    transition: all 0.25s;
    flex-shrink: 0;
}
.sidebar-link:hover {
    background: rgba(193,18,31,0.12);
    color: #fff;
}
.sidebar-link:hover .s-icon {
    background: rgba(193,18,31,0.25);
    color: #ff7a7a;
}
.sidebar-link.active {
    background: linear-gradient(135deg, rgba(193,18,31,0.2), rgba(193,18,31,0.08));
    color: #fff;
    border: 1px solid rgba(193,18,31,0.2);
    box-shadow: 0 4px 18px rgba(193,18,31,0.12);
}
.sidebar-link.active .s-icon {
    background: rgba(193,18,31,0.3);
    color: #ff8080;
    box-shadow: 0 0 12px rgba(193,18,31,0.3);
}
.sidebar-link.active::before {
    content: '';
    position: absolute; left: 0; top: 50%;
    transform: translateY(-50%);
    width: 3px; height: 60%;
    background: var(--red);
    border-radius: 0 4px 4px 0;
    box-shadow: 0 0 8px var(--red);
}

/* Sidebar footer – user info */
.sidebar-footer {
    padding: 14px 12px;
    border-top: 1px solid var(--border);
    background: linear-gradient(135deg, rgba(255,193,7,0.03), transparent);
}
.sidebar-user {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 14px;
    border-radius: 12px;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--border2);
    transition: all 0.25s;
}
.sidebar-user:hover {
    background: rgba(255,255,255,0.07);
    border-color: rgba(255,193,7,0.2);
}
.user-avatar {
    width: 38px; height: 38px;
    background: linear-gradient(135deg, var(--gold), #ff6b35);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 700;
    color: #000; text-transform: uppercase;
    flex-shrink: 0; overflow: hidden;
    box-shadow: 0 0 12px rgba(255,193,7,0.25);
}
.user-avatar img { width: 100%; height: 100%; object-fit: cover; }
.user-info .user-name {
    font-size: 13px; font-weight: 700; color: #fff; line-height: 1.2;
}
.user-info .user-role {
    font-size: 11px; color: var(--gold); line-height: 1.2;
    display: flex; align-items: center; gap: 4px;
    margin-top: 2px;
}

/* ── MAIN CONTENT ────────────────────────────── */
.main-content {
    margin-left: 248px;
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* ── TOP BAR ─────────────────────────────────── */
.topbar {
    background: rgba(11,11,18,0.9);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--border);
    padding: 0 28px;
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 50;
    height: 66px;
}

.topbar-left { display: flex; align-items: center; gap: 14px; }

.theme-toggle {
    width: 40px; height: 40px;
    border: none; border-radius: 10px;
    background: rgba(255,255,255,0.06);
    border: 1px solid var(--border2);
    color: var(--gold);
    cursor: pointer;
    display: flex; justify-content: center; align-items: center;
    font-size: 16px;
    transition: all 0.3s;
    flex-shrink: 0;
}
.theme-toggle:hover {
    background: rgba(255,193,7,0.12);
    border-color: rgba(255,193,7,0.35);
    box-shadow: 0 0 16px rgba(255,193,7,0.2);
}

.topbar-heading {
    display: flex; flex-direction: column; gap: 1px;
}
.topbar-heading .page-title {
    font-size: 18px; font-weight: 800; color: var(--text);
    display: flex; align-items: center; gap: 8px;
    line-height: 1;
}
.topbar-heading .page-title span { color: var(--red); }
.topbar-heading .page-sub {
    font-size: 11px; color: var(--muted);
}

.topbar-icon {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, var(--red), var(--red-dark));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; color: var(--gold);
    box-shadow: 0 4px 14px var(--red-glow);
    flex-shrink: 0;
}

.topbar-actions { display: flex; align-items: center; gap: 10px; }

.btn-ghost {
    background: rgba(255,255,255,0.06);
    color: var(--muted2);
    border: 1px solid var(--border2);
    border-radius: 10px;
    padding: 8px 16px;
    font-size: 13px; font-weight: 500;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px;
    transition: all 0.25s;
    font-family: 'Outfit', sans-serif;
}
.btn-ghost:hover {
    background: rgba(255,255,255,0.1);
    color: #fff;
    border-color: rgba(255,255,255,0.2);
}

/* ── PAGE BODY ───────────────────────────────── */
.page-body { padding: 28px; flex: 1; }

/* ── WELCOME BANNER ──────────────────────────── */
.welcome-banner {
    background: linear-gradient(135deg, rgba(193,18,31,0.12) 0%, rgba(255,193,7,0.06) 50%, rgba(193,18,31,0.04) 100%);
    border: 1px solid rgba(193,18,31,0.2);
    border-radius: 20px;
    padding: 22px 28px;
    margin-bottom: 24px;
    display: flex; align-items: center; justify-content: space-between;
    position: relative; overflow: hidden;
}
.welcome-banner::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--red), var(--gold), var(--red));
    box-shadow: 0 0 16px rgba(193,18,31,0.5);
}
.welcome-banner::after {
    content: '';
    position: absolute; right: -40px; top: -40px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(193,18,31,0.08), transparent 70%);
    pointer-events: none;
}
.welcome-text h2 {
    font-size: 19px; font-weight: 800; margin-bottom: 4px;
}
.welcome-text h2 span { color: var(--gold); }
.welcome-text p {
    font-size: 13px; color: var(--muted);
}
.welcome-meta {
    display: flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--border2);
    border-radius: 10px; padding: 8px 14px;
    font-size: 12px; color: var(--muted2);
    flex-shrink: 0;
}
.welcome-meta i { color: #4ade80; font-size: 8px; }

/* ── STATS STRIP ─────────────────────────────── */
.stats-strip {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 24px;
}

.stat-tile {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 22px 22px 20px;
    display: flex; align-items: flex-start; gap: 16px;
    transition: all 0.35s;
    position: relative; overflow: hidden;
    cursor: default;
}
.stat-tile::after {
    content: '';
    position: absolute; bottom: 0; left: 0; right: 0;
    height: 2px;
    opacity: 0; transition: opacity 0.3s;
}
.stat-tile:hover { transform: translateY(-4px); }
.stat-tile:hover::after { opacity: 1; }

.stat-tile.red   { border-color: rgba(193,18,31,0.2); }
.stat-tile.gold  { border-color: rgba(255,193,7,0.18); }
.stat-tile.green { border-color: rgba(34,197,94,0.18); }

.stat-tile.red:hover   { box-shadow: 0 16px 40px rgba(193,18,31,0.18), 0 0 0 1px rgba(193,18,31,0.15); }
.stat-tile.gold:hover  { box-shadow: 0 16px 40px rgba(255,193,7,0.14), 0 0 0 1px rgba(255,193,7,0.15); }
.stat-tile.green:hover { box-shadow: 0 16px 40px rgba(34,197,94,0.14), 0 0 0 1px rgba(34,197,94,0.12); }

.stat-tile.red::after   { background: linear-gradient(90deg, var(--red), #ff6b6b); }
.stat-tile.gold::after  { background: linear-gradient(90deg, var(--gold), #ffde7a); }
.stat-tile.green::after { background: linear-gradient(90deg, #22c55e, #4ade80); }

/* glow blob */
.stat-tile::before {
    content: '';
    position: absolute; top: -30px; right: -30px;
    width: 100px; height: 100px;
    border-radius: 50%;
    opacity: 0.06;
    pointer-events: none;
}
.stat-tile.red::before   { background: var(--red); }
.stat-tile.gold::before  { background: var(--gold); }
.stat-tile.green::before { background: #22c55e; }

.stat-tile-icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; flex-shrink: 0;
}
.stat-tile.red   .stat-tile-icon { background: rgba(193,18,31,0.2);   color: #ff7a7a;  box-shadow: 0 4px 16px rgba(193,18,31,0.2); }
.stat-tile.gold  .stat-tile-icon { background: rgba(255,193,7,0.15);  color: var(--gold); box-shadow: 0 4px 16px rgba(255,193,7,0.15); }
.stat-tile.green .stat-tile-icon { background: rgba(34,197,94,0.15);  color: #4ade80;  box-shadow: 0 4px 16px rgba(34,197,94,0.12); }

.stat-tile-body { flex: 1; }
.stat-tile-val {
    font-size: 32px; font-weight: 800;
    line-height: 1; margin-bottom: 4px;
}
.stat-tile.red   .stat-tile-val { color: #ff8080; }
.stat-tile.gold  .stat-tile-val { color: var(--gold); }
.stat-tile.green .stat-tile-val { color: #4ade80; }

.stat-tile-lbl {
    font-size: 12px; color: var(--muted);
    font-weight: 500; text-transform: uppercase; letter-spacing: 0.6px;
}
.stat-tile-trend {
    font-size: 11px; margin-top: 6px;
    display: flex; align-items: center; gap: 4px;
    color: #4ade80;
}

/* ── TABLE CARD ──────────────────────────────── */
.table-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
}

.table-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    background: linear-gradient(135deg, rgba(255,255,255,0.02), transparent);
}

.table-card-header h6 {
    font-size: 15px; font-weight: 700; margin: 0;
    display: flex; align-items: center; gap: 10px;
}
.th-icon {
    width: 34px; height: 34px;
    background: rgba(193,18,31,0.2);
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    color: #ff7a7a; font-size: 14px;
    box-shadow: 0 0 10px rgba(193,18,31,0.2);
}
.count-badge {
    background: var(--gold-dim);
    color: var(--gold);
    border: 1px solid rgba(255,193,7,0.25);
    border-radius: 20px;
    padding: 4px 14px;
    font-size: 12px; font-weight: 700;
}

/* table */
.admin-table { width: 100%; border-collapse: collapse; }
.admin-table thead tr { background: rgba(255,255,255,0.025); }
.admin-table thead th {
    padding: 13px 22px;
    font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--muted);
    border-bottom: 1px solid var(--border);
}
.admin-table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.04);
    transition: background 0.2s;
}
.admin-table tbody tr:last-child { border-bottom: none; }
.admin-table tbody tr:hover { background: rgba(255,255,255,0.03); }
.admin-table tbody td { padding: 16px 22px; font-size: 14px; vertical-align: middle; }

.row-num {
    width: 30px; height: 30px;
    background: rgba(255,255,255,0.05);
    border-radius: 8px;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 600; color: var(--muted);
}
.user-cell { display: flex; align-items: center; gap: 11px; }
.table-avatar {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700;
    text-transform: uppercase; flex-shrink: 0;
}
.user-fullname { font-size: 14px; font-weight: 600; }
.user-joined { font-size: 11px; color: var(--muted); margin-top: 2px; display: flex; align-items: center; gap: 5px; }
.glow-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: #22c55e; box-shadow: 0 0 6px #22c55e;
    display: inline-block; flex-shrink: 0;
}
.email-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--border);
    border-radius: 8px; padding: 5px 11px;
    font-size: 13px; color: var(--muted2);
}
.role-badge {
    display: inline-flex; align-items: center; gap: 5px;
    border-radius: 20px; padding: 4px 13px;
    font-size: 12px; font-weight: 700;
}
.role-badge.admin { background: rgba(193,18,31,0.18); color: #ff8080; border: 1px solid rgba(193,18,31,0.3); }
.role-badge.user  { background: rgba(255,193,7,0.1);  color: var(--gold); border: 1px solid rgba(255,193,7,0.25); }

.status-online {
    display: inline-flex; align-items: center; gap: 6px;
    color: #4ade80; font-size: 13px; font-weight: 500;
}

.btn-del {
    background: rgba(220,53,69,0.1);
    color: #ff7a7a;
    border: 1px solid rgba(220,53,69,0.25);
    border-radius: 9px; padding: 6px 14px;
    font-size: 12px; font-weight: 600;
    cursor: pointer; transition: all 0.25s;
    display: inline-flex; align-items: center; gap: 5px;
    font-family: 'Outfit', sans-serif;
}
.btn-del:hover {
    background: rgba(220,53,69,0.22);
    border-color: rgba(220,53,69,0.5);
    box-shadow: 0 0 14px rgba(220,53,69,0.2);
    transform: scale(1.03);
}

/* ── FLASH ALERTS ────────────────────────────── */
.flash-alert {
    border-radius: 14px; padding: 13px 18px;
    font-size: 14px; font-weight: 500;
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 20px; border: 1px solid;
}
.flash-success { background: rgba(34,197,94,0.08); border-color: rgba(34,197,94,0.25); color: #4ade80; }
.flash-danger  { background: rgba(220,53,69,0.08);  border-color: rgba(220,53,69,0.25);  color: #ff7a7a; }

/* ===============================
   LIGHT MODE
=============================== */
body.light {
    --bg: #f4f6fb;
    --surface: #ffffff;
    --surface2: #f0f2f8;
    --surface3: #e8ecf5;
    --border: rgba(0,0,0,0.07);
    --border2: rgba(0,0,0,0.12);
    --text: #1a1c2e;
    --muted: #7c829a;
    --muted2: #4a5068;
}

body.light .topbar {
    background: rgba(255,255,255,0.95);
    border-bottom-color: rgba(0,0,0,0.08);
}
body.light .sidebar {
    background: #ffffff;
    border-right-color: rgba(0,0,0,0.08);
}
body.light .sidebar-link { color: #4a5068; }
body.light .sidebar-link:hover { background: rgba(193,18,31,0.07); color: #1a1c2e; }
body.light .sidebar-link.active { background: linear-gradient(135deg, rgba(193,18,31,0.1), rgba(193,18,31,0.04)); border-color: rgba(193,18,31,0.15); color: #1a1c2e; }
body.light .sidebar-footer { background: #fafafa; }
body.light .sidebar-user { background: #f4f6fb; border-color: rgba(0,0,0,0.1); }
body.light .user-info .user-name { color: #1a1c2e; }
body.light .stat-tile { background: #ffffff; }
body.light .stat-tile.red  { border-color: rgba(193,18,31,0.15); }
body.light .stat-tile.gold { border-color: rgba(255,193,7,0.2);  }
body.light .stat-tile.green{ border-color: rgba(34,197,94,0.15); }
body.light .stat-tile.red:hover   { box-shadow: 0 12px 32px rgba(193,18,31,0.12); }
body.light .stat-tile.gold:hover  { box-shadow: 0 12px 32px rgba(255,193,7,0.1); }
body.light .stat-tile.green:hover { box-shadow: 0 12px 32px rgba(34,197,94,0.1); }
body.light .stat-tile-lbl { color: #7c829a; }
body.light .table-card { background: #ffffff; }
body.light .admin-table thead tr { background: #f7f9fc; }
body.light .admin-table thead th { color: #9298b0; border-bottom-color: rgba(0,0,0,0.07); }
body.light .admin-table tbody tr { border-bottom-color: rgba(0,0,0,0.05); }
body.light .admin-table tbody tr:hover { background: #f7f9fc; }
body.light .admin-table tbody td { color: #2d3048; }
body.light .row-num { background: #f0f2f8; color: #9298b0; }
body.light .email-chip { background: #f4f6fb; border-color: rgba(0,0,0,0.08); color: #4a5068; }
body.light .btn-ghost {
    background: #ffffff; color: #4a5068;
    border: 1px solid rgba(0,0,0,0.12);
}
body.light .btn-ghost:hover { background: #ffc107; color: #1a1c2e; border-color: #ffc107; }
body.light .theme-toggle {
    background: #f4f6fb; color: #f5a623;
    border-color: rgba(0,0,0,0.1);
}
body.light .welcome-banner {
    background: linear-gradient(135deg, rgba(193,18,31,0.06), rgba(255,193,7,0.04), rgba(193,18,31,0.02));
}
body.light .welcome-meta { background: #f4f6fb; border-color: rgba(0,0,0,0.1); color: #4a5068; }
body.light .th-icon { background: rgba(193,18,31,0.12); }
body.light .count-badge { background: rgba(255,193,7,0.12); }
</style>
</head>
<body>

<!-- ═══════════════ SIDEBAR ═══════════════ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">
            <img src="{{ $logoUrl ?? asset('images/logo_kokiku.png') }}" alt="KOKIKU Logo">
        </div>
        <span class="brand-name">KOKIKU</span>
    </div>

    <div class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>

        <a href="{{ url('/admin') }}" class="sidebar-link active">
            <div class="s-icon"><i class="fa-solid fa-gauge-high"></i></div>
            Dashboard
        </a>

        <a href="{{ url('/admin/menu-drink') }}" class="sidebar-link">
            <div class="s-icon"><i class="fa-solid fa-utensils"></i></div>
            Menu dan Minuman
        </a>

        <a href="{{ url('/admin/orders') }}" class="sidebar-link">
            <div class="s-icon"><i class="fa-solid fa-receipt"></i></div>
            Orderan Resto
        </a>

        <a href="{{ url('/admin/settings') }}" class="sidebar-link">
            <div class="s-icon"><i class="fa-solid fa-sliders"></i></div>
            Pengaturan
        </a>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">
                @php
                    $gravatarUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($admin->email))) . '?s=80&d=404';
                @endphp
                <img src="{{ $gravatarUrl }}"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                     alt="Avatar">
                <span style="display:none;">{{ strtoupper(substr($admin->name,0,1)) }}</span>
            </div>
            <div class="user-info">
                <div class="user-name">{{ $admin->name }}</div>
                <div class="user-role">
                    <i class="fa-solid fa-shield-halved" style="font-size:9px;"></i>
                    Administrator
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════ MAIN ═══════════════ -->
<div class="main-content">

    <!-- TOP BAR -->
    <div class="topbar">
        <div class="topbar-left">
            <button id="themeToggle" class="theme-toggle" title="Toggle Dark/Light Mode">
                <i class="fa-solid fa-moon"></i>
            </button>
            <div class="topbar-icon">
                <i class="fa-solid fa-gauge-high"></i>
            </div>
            <div class="topbar-heading">
                <div class="page-title">Dashboard <span>Admin</span></div>
                <div class="page-sub">Kelola pengguna & pengaturan sistem</div>
            </div>
        </div>
        <div class="topbar-actions">
            <a href="{{ url('/home') }}" class="btn-ghost">
                <i class="fa-solid fa-arrow-left"></i>
                Beranda
            </a>
        </div>
    </div>

    <!-- PAGE BODY -->
    <div class="page-body">

        @if(session('success'))
        <div class="flash-alert flash-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flash-alert flash-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
        @endif

        <!-- WELCOME BANNER -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h2>Selamat datang, <span>{{ $admin->name }}</span> 👋</h2>
                <p>Berikut ringkasan data pengguna sistem KOKIKU saat ini.</p>
            </div>
            <div class="welcome-meta">
                <i class="fa-solid fa-circle"></i>
                Sistem berjalan normal
            </div>
        </div>

        <!-- STATS -->
        <div class="stats-strip">
            <div class="stat-tile red">
                <div class="stat-tile-icon"><i class="fa-solid fa-users"></i></div>
                <div class="stat-tile-body">
                    <div class="stat-tile-val">{{ $users->count() }}</div>
                    <div class="stat-tile-lbl">Total Pengguna</div>
                    <div class="stat-tile-trend"><i class="fa-solid fa-users" style="font-size:9px;"></i> Semua akun terdaftar</div>
                </div>
            </div>
            <div class="stat-tile gold">
                <div class="stat-tile-icon"><i class="fa-solid fa-user-shield"></i></div>
                <div class="stat-tile-body">
                    <div class="stat-tile-val">{{ $users->where('role','admin')->count() }}</div>
                    <div class="stat-tile-lbl">Administrator</div>
                    <div class="stat-tile-trend"><i class="fa-solid fa-shield-halved" style="font-size:9px;"></i> Akses penuh</div>
                </div>
            </div>
            <div class="stat-tile green">
                <div class="stat-tile-icon"><i class="fa-solid fa-user-check"></i></div>
                <div class="stat-tile-body">
                    <div class="stat-tile-val">{{ $users->where('role','user')->count() }}</div>
                    <div class="stat-tile-lbl">User Aktif</div>
                    <div class="stat-tile-trend"><i class="fa-solid fa-circle" style="font-size:8px;color:#4ade80;"></i> Sedang online</div>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-card">
            <div class="table-card-header">
                <h6>
                    <div class="th-icon"><i class="fa-solid fa-list-ul"></i></div>
                    Daftar Pengguna
                </h6>
                <span class="count-badge">{{ $users->count() }} akun</span>
            </div>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <span class="row-num">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <div class="user-cell">
                                @php
                                    $colors = ['#ffc107','#c1121f','#22c55e','#3b82f6','#a78bfa','#f97316'];
                                    $color  = $colors[$loop->index % count($colors)];
                                @endphp
                                <div class="table-avatar" style="background:{{ $color }}1a; color:{{ $color }}; border:1px solid {{ $color }}33;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-fullname">{{ $user->name }}</div>
                                    <div class="user-joined">
                                        <span class="glow-dot"></span>
                                        Aktif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="email-chip">
                                <i class="fa-solid fa-envelope" style="font-size:11px; color:var(--muted);"></i>
                                {{ $user->email }}
                            </span>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="role-badge admin">
                                    <i class="fa-solid fa-shield-halved" style="font-size:10px;"></i>
                                    Admin
                                </span>
                            @else
                                <span class="role-badge user">
                                    <i class="fa-solid fa-user" style="font-size:10px;"></i>
                                    User
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="status-online">
                                <span class="glow-dot"></span>
                                Online
                            </span>
                        </td>
                        <td>
                            @if($user->role !== 'admin')
                                <form method="POST" action="{{ url('/admin/users/'.$user->id.'/delete') }}"
                                      onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->name }}?');">
                                    @csrf
                                    <button type="submit" class="btn-del">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            @else
                                <span style="color:var(--muted); font-size:13px;">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div><!-- /page-body -->
</div><!-- /main-content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const btn  = document.getElementById("themeToggle");
const icon = btn.querySelector("i");
const KEY  = "kokiku_theme";

function setTheme(theme){
    if(theme === "light"){
        document.body.classList.add("light");
        document.body.classList.remove("dark");
        icon.className = "fa-solid fa-sun";
    } else {
        document.body.classList.add("dark");
        document.body.classList.remove("light");
        icon.className = "fa-solid fa-moon";
    }
    localStorage.setItem(KEY, theme);
}

let savedTheme = localStorage.getItem(KEY) || "dark";
setTheme(savedTheme);

btn.addEventListener("click", function(){
    setTheme(document.body.classList.contains("light") ? "dark" : "light");
});
</script>
</body>
</html>