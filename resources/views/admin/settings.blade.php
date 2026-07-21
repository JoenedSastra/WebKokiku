@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function colorPresets() {
    return [
        '#ffffff' => 'White',
        '#000000' => 'Black',
        '#dc2626' => 'Red',
        '#ffc107' => 'Gold',
        '#eab308' => 'Yellow',
        '#f97316' => 'Orange',
        '#22c55e' => 'Green',
        '#3b82f6' => 'Blue',
        '#a855f7' => 'Purple',
        '#9ca3af' => 'Gray',
    ];
}
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengaturan – KOKIKU Admin</title>
<link rel="icon" href="{{ $faviconUrl ?? asset('images/logo_kokiku.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior: smooth; }

:root {
    --red:      #c1121f;
    --red-dark: #780000;
    --gold:     #ffc107;
    --bg:       #f0f2f8;
    --surface:  #ffffff;
    --surface2: #f4f6fb;
    --surface3: #e8ecf5;
    --border:   rgba(0,0,0,0.08);
    --border2:  rgba(0,0,0,0.13);
    --text:     #1a1c2e;
    --muted:    #8892a8;
    --muted2:   #4a5068;
    --green:    #22c55e;
}

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
    width: 200px; height: 100vh;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    z-index: 100;
}
.sidebar-brand {
    padding: 16px 14px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 10px;
}
.sidebar-brand .brand-logo {
    width: 38px; height: 38px; border-radius: 50%;
    overflow: hidden; flex-shrink: 0;
    border: 2px solid rgba(193,18,31,0.25);
}
.sidebar-brand .brand-logo img { width:100%; height:100%; object-fit:cover; }
.sidebar-brand .brand-text { display:flex; flex-direction:column; }
.sidebar-brand .brand-name {
    font-size: 18px; font-weight: 800;
    color: var(--red); letter-spacing: 1px; line-height: 1.1;
}
.sidebar-brand .brand-sub {
    font-size: 9px; font-weight: 600;
    color: var(--muted); letter-spacing: 1.2px;
    text-transform: uppercase;
}
.sidebar-nav { padding: 14px 10px; flex: 1; overflow-y: auto; }
.nav-label {
    font-size: 9px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1.5px;
    color: var(--muted); padding: 0 8px; margin-bottom: 8px;
}
.sidebar-link {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 10px; border-radius: 10px;
    color: var(--muted2); text-decoration: none;
    font-size: 13px; font-weight: 500;
    transition: all 0.2s; margin-bottom: 2px;
    position: relative;
}
.sidebar-link .s-icon {
    width: 30px; height: 30px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    background: rgba(0,0,0,0.04);
    transition: all 0.2s; flex-shrink: 0;
}
.sidebar-link:hover { background: rgba(193,18,31,0.06); color: var(--text); }
.sidebar-link:hover .s-icon { background: rgba(193,18,31,0.12); color: var(--red); }
.sidebar-link.active {
    background: linear-gradient(135deg, rgba(193,18,31,0.1), rgba(193,18,31,0.04));
    color: var(--red); border: 1px solid rgba(193,18,31,0.15);
}
.sidebar-link.active .s-icon { background: rgba(193,18,31,0.15); color: var(--red); }
.sidebar-link.active::before {
    content: '';
    position: absolute; left: 0; top: 50%;
    transform: translateY(-50%);
    width: 3px; height: 60%;
    background: var(--red); border-radius: 0 3px 3px 0;
}

/* Help box at bottom of sidebar */
.sidebar-help {
    margin: 10px; border-radius: 12px;
    background: linear-gradient(135deg, rgba(193,18,31,0.07), rgba(193,18,31,0.03));
    border: 1px solid rgba(193,18,31,0.15);
    padding: 12px 12px;
}
.sidebar-help .help-icon {
    width: 28px; height: 28px; border-radius: 8px;
    background: rgba(193,18,31,0.12); color: var(--red);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; margin-bottom: 7px;
}
.sidebar-help .help-title { font-size: 12px; font-weight: 700; color: var(--text); margin-bottom: 2px; }
.sidebar-help .help-sub   { font-size: 10px; color: var(--muted); line-height: 1.4; margin-bottom: 8px; }
.sidebar-help .btn-help {
    display: block; text-align: center;
    background: var(--red); color: #fff;
    border: none; border-radius: 7px; padding: 5px 10px;
    font-size: 11px; font-weight: 600; cursor: pointer;
    font-family: 'Outfit', sans-serif; text-decoration: none;
    transition: all 0.2s;
}
.sidebar-help .btn-help:hover { background: var(--red-dark, #a00); }

/* ── MAIN CONTENT ────────────────────────────── */
.main-content { margin-left: 200px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

/* ── TOPBAR ──────────────────────────────────── */
.topbar {
    background: rgba(255,255,255,0.97);
    backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--border);
    padding: 0 22px;
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 50; height: 60px;
}
.topbar-left { display: flex; align-items: center; gap: 12px; }
.topbar-heading .page-title { font-size: 16px; font-weight: 800; color: var(--text); line-height: 1.1; }
.topbar-heading .page-sub { font-size: 11px; color: var(--muted); margin-top: 1px; }
.topbar-badge {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(34,197,94,0.1);
    border: 1px solid rgba(34,197,94,0.3);
    color: #16a34a; border-radius: 20px;
    padding: 3px 9px; font-size: 11px; font-weight: 700;
}
.topbar-badge i { font-size: 7px; animation: blink 1.5s ease-in-out infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
.topbar-actions { display: flex; align-items: center; gap: 8px; }
.btn-ghost {
    background: #fff; color: var(--muted2);
    border: 1px solid var(--border2); border-radius: 9px;
    padding: 7px 14px; font-size: 12px; font-weight: 500;
    text-decoration: none; display: inline-flex; align-items: center; gap: 5px;
    transition: all 0.2s; font-family: 'Outfit', sans-serif; cursor: pointer;
}
.btn-ghost:hover { background: var(--surface2); color: var(--text); }
.btn-save-main {
    background: linear-gradient(135deg, var(--red), #9b0e18);
    color: #fff; border: none; border-radius: 9px;
    padding: 8px 18px; font-size: 13px; font-weight: 700;
    cursor: pointer; display: inline-flex; align-items: center; gap: 6px;
    font-family: 'Outfit', sans-serif; transition: all 0.2s;
    box-shadow: 0 3px 12px rgba(193,18,31,0.25);
}
.btn-save-main:hover { transform: translateY(-1px); box-shadow: 0 5px 18px rgba(193,18,31,0.35); }

/* ── PAGE BODY ───────────────────────────────── */
.page-body { padding: 16px 18px; flex: 1; overflow-x: hidden; }

/* ── GRID LAYOUT ─────────────────────────────── */
.settings-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 16px;
    align-items: stretch;
}

/* ── SECTION CARD ────────────────────────────── */
.s-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.s-card-header {
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    gap: 8px;
}
.s-card-title {
    display: flex; align-items: center; gap: 7px;
    font-size: 13px; font-weight: 700; color: var(--text);
    min-width: 0; flex: 1;
}
.s-card-title .num {
    width: 20px; height: 20px; border-radius: 5px;
    background: rgba(193,18,31,0.12); color: var(--red);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 800; flex-shrink: 0;
}
.s-card-body { padding: 14px 16px; flex: 1; }

/* Sub-section within a card */
.s-sub {
    padding-bottom: 14px;
    margin-bottom: 14px;
    border-bottom: 1px solid var(--border);
}
.s-sub:last-child { padding-bottom: 0; margin-bottom: 0; border-bottom: none; }
.s-sub-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 10px;
}
.s-sub-title { font-size: 12px; font-weight: 700; color: var(--text); }

/* ── BUTTONS ─────────────────────────────────── */
.btn-cam {
    background: var(--red); color: #fff;
    border: none; border-radius: 7px; padding: 5px 10px;
    font-size: 11px; font-weight: 600; cursor: pointer;
    font-family: 'Outfit', sans-serif;
    display: inline-flex; align-items: center; gap: 4px;
    white-space: nowrap; flex-shrink: 0; text-decoration: none;
    transition: background 0.2s;
}
.btn-cam:hover { background: #a00; }
.btn-cam label { cursor: pointer; margin: 0; }

/* ── INPUTS ──────────────────────────────────── */
.f-label {
    font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.7px;
    color: var(--muted); margin-bottom: 5px; display: block;
}
.f-input, .f-textarea {
    width: 100%; background: var(--surface2);
    border: 1px solid var(--border2); border-radius: 8px;
    color: var(--text); padding: 8px 11px;
    font-size: 13px; font-family: 'Outfit', sans-serif;
    transition: border-color 0.2s; outline: none;
}
.f-input:focus, .f-textarea:focus { border-color: rgba(193,18,31,0.45); }
.f-textarea { resize: vertical; line-height: 1.5; }
.f-group { margin-bottom: 10px; }
.f-group:last-child { margin-bottom: 0; }

/* ── WARNA + TEBAL INLINE ROW ────────────────── */
.wt-row {
    display: flex; align-items: center; flex-wrap: wrap;
    gap: 6px 10px; margin-top: 5px;
}
.wt-label {
    font-size: 10px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .5px;
    white-space: nowrap;
    display: inline-block; width: 44px; flex-shrink: 0;
}
.wt-select {
    background: var(--surface2);
    border: 1px solid var(--border2); border-radius: 6px;
    color: var(--text); padding: 3px 6px; font-size: 11px;
    font-family: 'Outfit', sans-serif; outline: none; cursor: pointer;
    color-scheme: light;
}
.wt-swatch {
    width: 20px; height: 20px; border-radius: 4px;
    border: 1px solid var(--border2); cursor: pointer;
    padding: 1px; background: transparent; flex-shrink: 0;
}
.wt-hex {
    width: 66px;
    background: var(--surface2);
    border: 1px solid var(--border2); border-radius: 6px;
    color: var(--text); padding: 3px 6px; font-size: 11px;
    font-family: 'Outfit', sans-serif; outline: none;
}
.wt-sep {
    flex-basis: 100%; width: 0; height: 0; margin: 0; padding: 0;
}
.wt-custom-wrap { display: inline-flex; align-items: center; gap: 5px; }
.wt-num {
    width: 44px;
    background: var(--surface2);
    border: 1px solid var(--border2); border-radius: 6px;
    color: var(--text); padding: 3px 5px; font-size: 11px;
    font-family: 'Outfit', sans-serif; outline: none;
}

/* ── LOGO PREVIEW ────────────────────────────── */
.logo-row { display: flex; align-items: center; gap: 12px; }
.logo-thumb {
    width: 68px; height: 68px; border-radius: 10px;
    border: 2px solid var(--border2); overflow: hidden;
    display: flex; align-items: center; justify-content: center;
    background: var(--surface2); flex-shrink: 0;
}
.logo-thumb img { width: 90%; height: 90%; object-fit: contain; }
.logo-info .logo-title { font-size: 12px; font-weight: 600; color: var(--text); margin-bottom: 3px; }
.logo-info .logo-hint  { font-size: 10px; color: var(--muted); line-height: 1.5; }

/* ── HERO PREVIEW ────────────────────────────── */
.hero-thumb {
    width: 100%; height: 110px; border-radius: 9px;
    overflow: hidden; margin-bottom: 5px; background: var(--surface3);
}
.hero-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
.img-hint { font-size: 10px; color: var(--muted); margin-bottom: 10px; }

/* ── GALLERY GRID ────────────────────────────── */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    gap: 7px;
    margin-bottom: 8px;
}
.gallery-thumb {
    position: relative; border-radius: 8px;
    overflow: hidden; aspect-ratio: 1;
    border: 1px solid var(--border);
}
.gallery-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
.gallery-del {
    position: absolute; top: 3px; right: 3px;
    width: 20px; height: 20px; border-radius: 4px;
    background: rgba(0,0,0,0.6); color: #fff;
    border: none; cursor: pointer; font-size: 9px;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity .2s;
}
.gallery-thumb:hover .gallery-del { opacity: 1; }

/* ── NAV TABLE ───────────────────────────────── */
.nav-table-wrap { overflow-x: auto; }
.nav-table { width: 100%; border-collapse: collapse; }
.nav-table thead tr { background: var(--surface2); }
.nav-table thead th {
    padding: 6px 6px;
    font-size: 9px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px;
    color: var(--muted); border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.nav-table tbody tr { border-bottom: 1px solid var(--border); }
.nav-table tbody tr:last-child { border-bottom: none; }
.nav-table tbody td { padding: 6px 6px; font-size: 12px; vertical-align: middle; }
.nav-name { font-weight: 600; color: var(--text); }
.nav-color-cell { display: flex; align-items: center; gap: 5px; }
.nav-swatch {
    width: 18px; height: 18px; border-radius: 4px;
    border: 1px solid var(--border2); cursor: pointer;
    padding: 1px; background: transparent;
}
.nav-hex {
    width: 54px; background: var(--surface2);
    border: 1px solid var(--border2); border-radius: 5px;
    color: var(--text); padding: 2px 4px; font-size: 10px;
    font-family: 'Outfit', sans-serif; outline: none;
}
.nav-preview-btn {
    display: inline-flex; align-items: center;
    border-radius: 50px; padding: 3px 9px; font-size: 10px;
    font-weight: 700; white-space: nowrap;
}

/* ── FLASH ───────────────────────────────────── */
.flash-alert {
    border-radius: 10px; padding: 10px 14px; font-size: 13px; font-weight: 500;
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 14px; border: 1px solid;
}
.flash-success { background: rgba(34,197,94,.08); border-color: rgba(34,197,94,.25); color: #16a34a; }
.flash-danger  { background: rgba(220,53,69,.08); border-color: rgba(220,53,69,.25); color: #dc2626; }

/* ── SAVE BAR ────────────────────────────────── */
.save-bar {
    display: flex; justify-content: space-between; align-items: center;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 12px; padding: 12px 18px; margin-top: 14px;
}
.save-bar .save-hint { font-size: 12px; color: var(--muted); display: flex; align-items: center; gap: 6px; }

/* ── FOOTER ──────────────────────────────────── */
.admin-footer {
    text-align: center;
    padding: 14px 0 10px;
    font-size: 11px; color: var(--muted);
    border-top: 1px solid var(--border);
    margin-top: 6px;
}

/* ── MODAL ───────────────────────────────────── */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.5);
    z-index: 1000; display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none; transition: opacity .2s;
}
.modal-overlay.open { opacity: 1; pointer-events: all; }
.modal-box {
    background: var(--surface); border: 1px solid var(--border2);
    border-radius: 16px; padding: 24px; width: 100%; max-width: 480px;
    transform: translateY(16px); transition: transform .2s;
    max-height: 90vh; overflow-y: auto;
}
.modal-overlay.open .modal-box { transform: translateY(0); }
.modal-title { font-size: 15px; font-weight: 800; margin-bottom: 16px; }
.modal-actions { display: flex; gap: 8px; justify-content: flex-end; margin-top: 16px; }
.btn-modal-cancel {
    background: var(--surface2); border: 1px solid var(--border2);
    color: var(--muted2); border-radius: 8px; padding: 7px 14px;
    font-size: 12px; cursor: pointer; font-family: 'Outfit', sans-serif;
}
.btn-modal-save {
    background: linear-gradient(135deg, var(--red), #9b0e18); color: #fff;
    border: none; border-radius: 8px; padding: 7px 18px;
    font-size: 12px; font-weight: 700; cursor: pointer;
    font-family: 'Outfit', sans-serif;
}
.btn-sm-action {
    display: inline-flex; align-items: center; gap: 5px;
    border-radius: 7px; padding: 5px 10px; font-size: 11px; font-weight: 600;
    cursor: pointer; font-family: 'Outfit', sans-serif;
    border: 1px solid; transition: all 0.2s; text-decoration: none;
}
.btn-sm-action.muted { background: var(--surface2); color: var(--muted2); border-color: var(--border2); }
.btn-sm-action.muted:hover { background: var(--surface3); color: var(--text); }

/* ── DARK MODE ───────────────────────────────── */
body.dark {
    --bg: #0b0b12; --surface: #13131f; --surface2: #1a1a2e; --surface3: #21213a;
    --border: rgba(255,255,255,0.07); --border2: rgba(255,255,255,0.12);
    --text: #f0f0f5; --muted: rgba(255,255,255,0.38); --muted2: rgba(255,255,255,0.6);
}
body.dark .topbar { background: rgba(11,11,18,0.97); }
body.dark .f-input, body.dark .f-textarea { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.12); }
body.dark .wt-select, body.dark .wt-hex, body.dark .wt-num { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.12); color-scheme: dark; }
body.dark .nav-hex { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.12); }
body.dark .btn-ghost { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.6); border-color: rgba(255,255,255,0.12); }
body.dark .btn-ghost:hover { background: rgba(255,255,255,0.1); color: #fff; }
body.dark .modal-box { background: #1a1a2e; }
body.dark .btn-modal-cancel { background: rgba(255,255,255,.06); border-color: rgba(255,255,255,.12); color: rgba(255,255,255,.6); }
</style>
</head>
<body>

<!-- ═══════════════ SIDEBAR ═══════════════ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">
            <img src="{{ $logoUrl ?? asset('images/logo_kokiku.png') }}" alt="KOKIKU Logo">
        </div>
        <div class="brand-text">
            <span class="brand-name">KOKIKU</span>
            <span class="brand-sub">Admin Panel</span>
        </div>
    </div>

    <div class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>

        <a href="{{ url('/admin') }}" class="sidebar-link">
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

        <a href="{{ url('/admin/settings') }}" class="sidebar-link active">
            <div class="s-icon"><i class="fa-solid fa-sliders"></i></div>
            Pengaturan
        </a>
    </div>

    <!-- Help Box -->
    <div class="sidebar-help">
        <div class="help-icon"><i class="fa-solid fa-headset"></i></div>
        <div class="help-title">Butuh Bantuan?</div>
        <div class="help-sub">Hubungi kami jika ada kendala pengaturan.</div>
        <a href="mailto:admin@kokiku.id" class="btn-help">Hubungi Admin</a>
    </div>
</div>

<!-- ═══════════════ MAIN ═══════════════ -->
<div class="main-content">

    <!-- TOP BAR -->
    <div class="topbar">
        <div class="topbar-left">
            <div class="topbar-heading">
                <div class="page-title">Pengaturan Website</div>
                <div class="page-sub">Kelola semua konten halaman utama website Anda</div>
            </div>
            <span class="topbar-badge">
                <i class="fa-solid fa-circle"></i> Live Site
            </span>
        </div>
        <div class="topbar-actions">
            <a href="{{ url('/home') }}" target="_blank" class="btn-ghost">
                <i class="fa-solid fa-eye"></i> Preview Website
            </a>
            <a href="{{ url('/admin') }}" class="btn-ghost">
                <i class="fa-solid fa-arrow-left"></i> Dashboard
            </a>
        </div>
    </div>

    <!-- FORM -->
    <form method="POST" action="{{ url('/admin/settings') }}" enctype="multipart/form-data" id="settingsForm">
    @csrf

    <div class="page-body">

        @if(session('success'))
        <div class="flash-alert flash-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="flash-alert flash-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
        </div>
        @endif

        <!-- ═══ 3 COLUMN GRID ═══ -->
        <div class="settings-grid">

            {{-- ══════ KOLOM 1: Logo & Hero Banner ══════ --}}
            <div class="s-card" id="section-logo-hero">
                <div class="s-card-header">
                    <div class="s-card-title">
                        <span class="num">1</span>
                        Logo &amp; Hero Banner
                    </div>
                </div>
                <div class="s-card-body">

                    {{-- Sub: Logo --}}
                    <div class="s-sub">
                        <div class="s-sub-header">
                            <span class="s-sub-title">Logo Website</span>
                            <label class="btn-cam" style="cursor:pointer;">
                                <i class="fa-solid fa-camera"></i> Ganti Logo
                                <input type="file" name="logo_image" id="logoFile" accept="image/*"
                                       style="display:none;" onchange="previewLogo(this)">
                            </label>
                        </div>
                        <div class="logo-row">
                            <div class="logo-thumb" id="logoPreviewWrap">
                                <img src="{{ $logoUrl ?? asset('images/logo_kokiku.png') }}"
                                     id="logoPreviewImg" alt="Logo">
                            </div>
                            <div class="logo-info">
                                <div class="logo-title">Logo Saat Ini</div>
                                <div class="logo-hint">Format: PNG, JPG, SVG<br>Maks. 2MB</div>
                            </div>
                        </div>
                    </div>

                    {{-- Sub: Hero Banner --}}
                    <div class="s-sub">
                        <div class="s-sub-header">
                            <span class="s-sub-title">Hero Banner (Beranda)</span>
                            <label class="btn-cam" style="cursor:pointer;">
                                <i class="fa-solid fa-camera"></i> Ganti Foto
                                <input type="file" name="hero_background_image" accept="image/*"
                                       style="display:none;" onchange="previewHeroBg(this)">
                            </label>
                        </div>
                        @php
                            $heroImg = $heroBackgroundImage ?? 'images/home_kokiku.jpeg';
                            $heroBgUrl = str_starts_with($heroImg, 'http') ? $heroImg : asset($heroImg);
                        @endphp
                        <div class="hero-thumb" id="heroPreviewWrap">
                            <img src="{{ $heroBgUrl }}" id="heroPreviewImg" alt="Hero">
                        </div>
                        <div class="img-hint">Format: JPG, PNG (Maks. 2MB)</div>

                        {{-- Judul --}}
                        <div class="f-group">
                            <label class="f-label">Judul</label>
                            <input type="text" class="f-input" name="hero_title"
                                   value="{{ old('hero_title', $heroTitle) }}" required>
                            @php
                                $htcP = colorPresets();
                                $htcCur = strtolower(old('hero_title_color', $heroTitleColor ?? '#ffffff'));
                                $htw = old('hero_title_weight', $heroTitleWeight ?? '700');
                            @endphp
                            <div class="wt-row">
                                <span class="wt-label">Warna</span>
                                <select class="wt-select" onchange="handleColorSelect(this,'htc_hex','htc_pick','htc_cw')">
                                    @foreach($htcP as $hex => $lbl)
                                    <option value="{{ $hex }}" {{ $htcCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                    @endforeach
                                    <option value="custom" {{ !array_key_exists($htcCur,$htcP) ? 'selected' : '' }}>Custom</option>
                                </select>
                                <span id="htc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($htcCur,$htcP) ? 'inline-flex':'none' }}">
                                    <input type="color" class="wt-swatch" id="htc_pick"
                                           value="{{ old('hero_title_color',$heroTitleColor??'#ffffff') }}"
                                           oninput="syncTs('htc_pick','htc_hex')">
                                    <input type="text" class="wt-hex" id="htc_hex" name="hero_title_color"
                                           value="{{ old('hero_title_color',$heroTitleColor??'#ffffff') }}"
                                           oninput="syncTsHex('htc_hex','htc_pick')">
                                </span>
                                <span class="wt-sep"></span>
                                <span class="wt-label">Tebal</span>
                                <input type="hidden" name="hero_title_weight" id="htc_wv" value="{{ $htw }}">
                                <select class="wt-select" onchange="handleWeightSelect(this,'htc_wv','htc_wc')">
                                    @foreach([300,400,500,600,700,800,900] as $w)
                                    <option value="{{ $w }}" {{ $htw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                    @endforeach
                                    <option value="custom" {{ !in_array($htw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                                </select>
                                <input type="number" class="wt-num" id="htc_wc" min="100" max="900" step="10"
                                       value="{{ $htw }}"
                                       style="display:{{ !in_array($htw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                       oninput="document.getElementById('htc_wv').value=this.value">
                            </div>
                        </div>

                        {{-- Subjudul 1 --}}
                        <div class="f-group">
                            <label class="f-label">Subjudul 1</label>
                            <input type="text" class="f-input" name="hero_subtitle"
                                   value="{{ old('hero_subtitle', $heroSubtitle) }}" required>
                            @php
                                $hscCur = strtolower(old('hero_subtitle_color', $heroSubtitleColor ?? '#ffffff'));
                                $hsw = old('hero_subtitle_weight', $heroSubtitleWeight ?? '500');
                            @endphp
                            <div class="wt-row">
                                <span class="wt-label">Warna</span>
                                <select class="wt-select" onchange="handleColorSelect(this,'hsc_hex','hsc_pick','hsc_cw')">
                                    @foreach($htcP as $hex => $lbl)
                                    <option value="{{ $hex }}" {{ $hscCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                    @endforeach
                                    <option value="custom" {{ !array_key_exists($hscCur,$htcP) ? 'selected' : '' }}>Custom</option>
                                </select>
                                <span id="hsc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($hscCur,$htcP) ? 'inline-flex':'none' }}">
                                    <input type="color" class="wt-swatch" id="hsc_pick"
                                           value="{{ old('hero_subtitle_color',$heroSubtitleColor??'#ffffff') }}"
                                           oninput="syncTs('hsc_pick','hsc_hex')">
                                    <input type="text" class="wt-hex" id="hsc_hex" name="hero_subtitle_color"
                                           value="{{ old('hero_subtitle_color',$heroSubtitleColor??'#ffffff') }}"
                                           oninput="syncTsHex('hsc_hex','hsc_pick')">
                                </span>
                                <span class="wt-sep"></span>
                                <span class="wt-label">Tebal</span>
                                <input type="hidden" name="hero_subtitle_weight" id="hsc_wv" value="{{ $hsw }}">
                                <select class="wt-select" onchange="handleWeightSelect(this,'hsc_wv','hsc_wc')">
                                    @foreach([300,400,500,600,700,800,900] as $w)
                                    <option value="{{ $w }}" {{ $hsw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                    @endforeach
                                    <option value="custom" {{ !in_array($hsw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                                </select>
                                <input type="number" class="wt-num" id="hsc_wc" min="100" max="900" step="10"
                                       value="{{ $hsw }}"
                                       style="display:{{ !in_array($hsw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                       oninput="document.getElementById('hsc_wv').value=this.value">
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="f-group">
                            <label class="f-label">Deskripsi</label>
                            <textarea class="f-textarea" name="hero_text" rows="3" required>{{ old('hero_text', $heroText) }}</textarea>
                            @php
                                $htxcCur = strtolower(old('hero_text_color', $heroTextColor ?? '#ffffff'));
                                $htxw = old('hero_text_weight', $heroTextWeight ?? '400');
                            @endphp
                            <div class="wt-row">
                                <span class="wt-label">Warna</span>
                                <select class="wt-select" onchange="handleColorSelect(this,'htxc_hex','htxc_pick','htxc_cw')">
                                    @foreach($htcP as $hex => $lbl)
                                    <option value="{{ $hex }}" {{ $htxcCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                    @endforeach
                                    <option value="custom" {{ !array_key_exists($htxcCur,$htcP) ? 'selected' : '' }}>Custom</option>
                                </select>
                                <span id="htxc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($htxcCur,$htcP) ? 'inline-flex':'none' }}">
                                    <input type="color" class="wt-swatch" id="htxc_pick"
                                           value="{{ old('hero_text_color',$heroTextColor??'#ffffff') }}"
                                           oninput="syncTs('htxc_pick','htxc_hex')">
                                    <input type="text" class="wt-hex" id="htxc_hex" name="hero_text_color"
                                           value="{{ old('hero_text_color',$heroTextColor??'#ffffff') }}"
                                           oninput="syncTsHex('htxc_hex','htxc_pick')">
                                </span>
                                <span class="wt-sep"></span>
                                <span class="wt-label">Tebal</span>
                                <input type="hidden" name="hero_text_weight" id="htxc_wv" value="{{ $htxw }}">
                                <select class="wt-select" onchange="handleWeightSelect(this,'htxc_wv','htxc_wc')">
                                    @foreach([300,400,500,600,700,800,900] as $w)
                                    <option value="{{ $w }}" {{ $htxw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                    @endforeach
                                    <option value="custom" {{ !in_array($htxw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                                </select>
                                <input type="number" class="wt-num" id="htxc_wc" min="100" max="900" step="10"
                                       value="{{ $htxw }}"
                                       style="display:{{ !in_array($htxw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                       oninput="document.getElementById('htxc_wv').value=this.value">
                            </div>
                        </div>

                        {{-- Hidden size fields --}}
                        <input type="hidden" name="hero_title_size"    value="{{ old('hero_title_size',    $heroTitleSize    ?? '56px') }}">
                        <input type="hidden" name="hero_subtitle_size" value="{{ old('hero_subtitle_size', $heroSubtitleSize ?? '28px') }}">
                        <input type="hidden" name="hero_text_size"     value="{{ old('hero_text_size',     $heroTextSize     ?? '20px') }}">
                    </div>

                </div>{{-- /s-card-body --}}
            </div>{{-- /Kolom 1 --}}

            {{-- ══════ KOLOM 2: Tentang Kami ══════ --}}
            <div class="s-card" id="section-about">
                <div class="s-card-header">
                    <div class="s-card-title">
                        <span class="num" style="background:rgba(59,130,246,0.12);color:#2563eb;">2</span>
                        Tentang Kami
                    </div>
                    <label class="btn-cam" style="cursor:pointer;">
                        <i class="fa-solid fa-camera"></i> Ganti Foto
                        <input type="file" name="about_image" id="aboutFile" accept="image/*"
                               style="display:none;" onchange="previewAbout(this)">
                    </label>
                </div>
                <div class="s-card-body">
                    @php
                        $aImgPath = \App\Models\Setting::get('about_image_path');
                        $aImgUrl  = ($aImgPath && Storage::disk('public')->exists($aImgPath))
                            ? Storage::disk('public')->url($aImgPath)
                            : 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=600&q=70';
                        $atcP = colorPresets();
                        $atcCur = strtolower(old('about_title_color', $aboutTitleColor ?? '#111111'));
                        $atw    = old('about_title_weight', $aboutTitleWeight ?? '700');
                    @endphp
                    <div class="hero-thumb" style="height:130px; margin-bottom:5px;">
                        <img src="{{ $aImgUrl }}" id="aboutPreviewImg" alt="Tentang Kami">
                    </div>
                    <div class="img-hint">Format: JPG, PNG (Maks. 2MB)</div>

                    {{-- Judul --}}
                    <div class="f-group">
                        <label class="f-label">Judul</label>
                        <input type="text" class="f-input" name="about_title"
                               value="{{ old('about_title', $aboutTitle) }}" required>
                        <div class="wt-row">
                            <span class="wt-label">Warna</span>
                            <select class="wt-select" onchange="handleColorSelect(this,'atc_hex','atc_pick','atc_cw')">
                                @foreach($atcP as $hex => $lbl)
                                <option value="{{ $hex }}" {{ $atcCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                                <option value="custom" {{ !array_key_exists($atcCur,$atcP) ? 'selected' : '' }}>Custom</option>
                            </select>
                            <span id="atc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($atcCur,$atcP) ? 'inline-flex':'none' }}">
                                <input type="color" class="wt-swatch" id="atc_pick"
                                       value="{{ old('about_title_color',$aboutTitleColor??'#111111') }}"
                                       oninput="syncTs('atc_pick','atc_hex')">
                                <input type="text" class="wt-hex" id="atc_hex" name="about_title_color"
                                       value="{{ old('about_title_color',$aboutTitleColor??'#111111') }}"
                                       oninput="syncTsHex('atc_hex','atc_pick')">
                            </span>
                            <span class="wt-sep"></span>
                            <span class="wt-label">Tebal</span>
                            <input type="hidden" name="about_title_weight" id="atc_wv" value="{{ $atw }}">
                            <select class="wt-select" onchange="handleWeightSelect(this,'atc_wv','atc_wc')">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ $atw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                                <option value="custom" {{ !in_array($atw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                            </select>
                            <input type="number" class="wt-num" id="atc_wc" min="100" max="900" step="10"
                                   value="{{ $atw }}"
                                   style="display:{{ !in_array($atw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                   oninput="document.getElementById('atc_wv').value=this.value">
                        </div>
                    </div>

                    {{-- Subjudul 1 (Paragraf 1) --}}
                    @php
                        $apcCur = strtolower(old('about_paragraph_color', $aboutParagraphColor ?? '#333333'));
                        $apw    = old('about_paragraph_weight', $aboutParagraphWeight ?? '400');
                    @endphp
                    <div class="f-group">
                        <label class="f-label">Subjudul 1</label>
                        <textarea class="f-textarea" name="about_paragraph1" rows="2" required>{{ old('about_paragraph1', $aboutParagraph1) }}</textarea>
                        <div class="wt-row">
                            <span class="wt-label">Warna</span>
                            <select class="wt-select" onchange="handleColorSelect(this,'apc_hex','apc_pick','apc_cw')">
                                @foreach($atcP as $hex => $lbl)
                                <option value="{{ $hex }}" {{ $apcCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                                <option value="custom" {{ !array_key_exists($apcCur,$atcP) ? 'selected' : '' }}>Custom</option>
                            </select>
                            <span id="apc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($apcCur,$atcP) ? 'inline-flex':'none' }}">
                                <input type="color" class="wt-swatch" id="apc_pick"
                                       value="{{ old('about_paragraph_color',$aboutParagraphColor??'#333333') }}"
                                       oninput="syncTs('apc_pick','apc_hex')">
                                <input type="text" class="wt-hex" id="apc_hex" name="about_paragraph_color"
                                       value="{{ old('about_paragraph_color',$aboutParagraphColor??'#333333') }}"
                                       oninput="syncTsHex('apc_hex','apc_pick')">
                            </span>
                            <span class="wt-sep"></span>
                            <span class="wt-label">Tebal</span>
                            <input type="hidden" name="about_paragraph_weight" id="apc_wv" value="{{ $apw }}">
                            <select class="wt-select" onchange="handleWeightSelect(this,'apc_wv','apc_wc')">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ $apw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                                <option value="custom" {{ !in_array($apw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                            </select>
                            <input type="number" class="wt-num" id="apc_wc" min="100" max="900" step="10"
                                   value="{{ $apw }}"
                                   style="display:{{ !in_array($apw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                   oninput="document.getElementById('apc_wv').value=this.value">
                        </div>
                    </div>

                    {{-- Subjudul 2 (Paragraf 2) --}}
                    @php
                        $ap2cCur = strtolower(old('about_paragraph2_color', $aboutParagraph2Color ?? $aboutParagraphColor ?? '#333333'));
                        $ap2w    = old('about_paragraph2_weight', $aboutParagraph2Weight ?? $aboutParagraphWeight ?? '400');
                    @endphp
                    <div class="f-group">
                        <label class="f-label">Subjudul 2</label>
                        <textarea class="f-textarea" name="about_paragraph2" rows="2" required>{{ old('about_paragraph2', $aboutParagraph2) }}</textarea>
                        <div class="wt-row">
                            <span class="wt-label">Warna</span>
                            <select class="wt-select" onchange="handleColorSelect(this,'ap2c_hex','ap2c_pick','ap2c_cw')">
                                @foreach($atcP as $hex => $lbl)
                                <option value="{{ $hex }}" {{ $ap2cCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                                <option value="custom" {{ !array_key_exists($ap2cCur,$atcP) ? 'selected' : '' }}>Custom</option>
                            </select>
                            <span id="ap2c_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($ap2cCur,$atcP) ? 'inline-flex':'none' }}">
                                <input type="color" class="wt-swatch" id="ap2c_pick"
                                       value="{{ old('about_paragraph2_color',$aboutParagraph2Color??$aboutParagraphColor??'#333333') }}"
                                       oninput="syncTs('ap2c_pick','ap2c_hex')">
                                <input type="text" class="wt-hex" id="ap2c_hex" name="about_paragraph2_color"
                                       value="{{ old('about_paragraph2_color',$aboutParagraph2Color??$aboutParagraphColor??'#333333') }}"
                                       oninput="syncTsHex('ap2c_hex','ap2c_pick')">
                            </span>
                            <span class="wt-sep"></span>
                            <span class="wt-label">Tebal</span>
                            <input type="hidden" name="about_paragraph2_weight" id="ap2c_wv" value="{{ $ap2w }}">
                            <select class="wt-select" onchange="handleWeightSelect(this,'ap2c_wv','ap2c_wc')">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ $ap2w == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                                <option value="custom" {{ !in_array($ap2w,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                            </select>
                            <input type="number" class="wt-num" id="ap2c_wc" min="100" max="900" step="10"
                                   value="{{ $ap2w }}"
                                   style="display:{{ !in_array($ap2w,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                   oninput="document.getElementById('ap2c_wv').value=this.value">
                        </div>
                    </div>

                    {{-- Hidden size fields --}}
                    <input type="hidden" name="about_title_size"     value="{{ old('about_title_size',     $aboutTitleSize     ?? '36px') }}">
                    <input type="hidden" name="about_paragraph_size" value="{{ old('about_paragraph_size', $aboutParagraphSize ?? '16px') }}">

                    <div style="border-top:1px solid var(--border); margin-top:14px; padding-top:14px;">
                        <div class="s-sub-title" style="margin-bottom:8px;">Bagian Hubungi Kami</div>
                        @php
                            $kjcP   = colorPresets();
                            $kjcCur = strtolower(old('kontak_title_color', $kontakTitleColor ?? '#f0f0f0'));
                            $kjw    = old('kontak_title_weight', $kontakTitleWeight ?? '800');
                        @endphp
                        <div class="f-group">
                            <label class="f-label">Judul</label>
                            <input type="text" class="f-input" name="kontak_title"
                                   value="{{ old('kontak_title', $kontakTitle ?? 'Hubungi Kami') }}" required>
                            <div class="wt-row">
                                <span class="wt-label">Warna</span>
                                <select class="wt-select" onchange="handleColorSelect(this,'kjc_hex','kjc_pick','kjc_cw')">
                                    @foreach($kjcP as $hex => $lbl)
                                    <option value="{{ $hex }}" {{ $kjcCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                    @endforeach
                                    <option value="custom" {{ !array_key_exists($kjcCur,$kjcP) ? 'selected' : '' }}>Custom</option>
                                </select>
                                <span id="kjc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($kjcCur,$kjcP) ? 'inline-flex':'none' }}">
                                    <input type="color" class="wt-swatch" id="kjc_pick"
                                           value="{{ old('kontak_title_color',$kontakTitleColor??'#f0f0f0') }}"
                                           oninput="syncTs('kjc_pick','kjc_hex')">
                                    <input type="text" class="wt-hex" id="kjc_hex" name="kontak_title_color"
                                           value="{{ old('kontak_title_color',$kontakTitleColor??'#f0f0f0') }}"
                                           oninput="syncTsHex('kjc_hex','kjc_pick')">
                                </span>
                                <span class="wt-sep"></span>
                                <span class="wt-label">Tebal</span>
                                <input type="hidden" name="kontak_title_weight" id="kjc_wv" value="{{ $kjw }}">
                                <select class="wt-select" onchange="handleWeightSelect(this,'kjc_wv','kjc_wc')">
                                    @foreach([300,400,500,600,700,800,900] as $w)
                                    <option value="{{ $w }}" {{ $kjw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                    @endforeach
                                    <option value="custom" {{ !in_array($kjw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                                </select>
                                <input type="number" class="wt-num" id="kjc_wc" min="100" max="900" step="10"
                                       value="{{ $kjw }}"
                                       style="display:{{ !in_array($kjw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                       oninput="document.getElementById('kjc_wv').value=this.value">
                            </div>
                        </div>

                        @php
                            $kscP   = colorPresets();
                            $kscCur = strtolower(old('kontak_subtitle_color', $kontakSubtitleColor ?? '#a0a0c0'));
                            $ksw    = old('kontak_subtitle_weight', $kontakSubtitleWeight ?? '400');
                        @endphp
                        <div class="f-group">
                            <label class="f-label">Subjudul</label>
                            <input type="text" class="f-input" name="kontak_subtitle"
                                   value="{{ old('kontak_subtitle', $kontakSubtitle ?? 'Kami siap melayani Anda setiap saat') }}" required>
                            <div class="wt-row">
                                <span class="wt-label">Warna</span>
                                <select class="wt-select" onchange="handleColorSelect(this,'ksc_hex','ksc_pick','ksc_cw')">
                                    @foreach($kscP as $hex => $lbl)
                                    <option value="{{ $hex }}" {{ $kscCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                    @endforeach
                                    <option value="custom" {{ !array_key_exists($kscCur,$kscP) ? 'selected' : '' }}>Custom</option>
                                </select>
                                <span id="ksc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($kscCur,$kscP) ? 'inline-flex':'none' }}">
                                    <input type="color" class="wt-swatch" id="ksc_pick"
                                           value="{{ old('kontak_subtitle_color',$kontakSubtitleColor??'#a0a0c0') }}"
                                           oninput="syncTs('ksc_pick','ksc_hex')">
                                    <input type="text" class="wt-hex" id="ksc_hex" name="kontak_subtitle_color"
                                           value="{{ old('kontak_subtitle_color',$kontakSubtitleColor??'#a0a0c0') }}"
                                           oninput="syncTsHex('ksc_hex','ksc_pick')">
                                </span>
                                <span class="wt-sep"></span>
                                <span class="wt-label">Tebal</span>
                                <input type="hidden" name="kontak_subtitle_weight" id="ksc_wv" value="{{ $ksw }}">
                                <select class="wt-select" onchange="handleWeightSelect(this,'ksc_wv','ksc_wc')">
                                    @foreach([300,400,500,600,700,800,900] as $w)
                                    <option value="{{ $w }}" {{ $ksw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                    @endforeach
                                    <option value="custom" {{ !in_array($ksw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                                </select>
                                <input type="number" class="wt-num" id="ksc_wc" min="100" max="900" step="10"
                                       value="{{ $ksw }}"
                                       style="display:{{ !in_array($ksw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                       oninput="document.getElementById('ksc_wv').value=this.value">
                            </div>
                        </div>

                        <input type="hidden" name="kontak_title_size"    value="{{ old('kontak_title_size',    $kontakTitleSize    ?? '36px') }}">
                        <input type="hidden" name="kontak_subtitle_size" value="{{ old('kontak_subtitle_size', $kontakSubtitleSize ?? '16px') }}">
                    </div>
                </div>
            </div>{{-- /Kolom 2 --}}

            {{-- ══════ KOLOM 3: Menu & Navigasi ══════ --}}
            <div class="s-card" id="section-menu-nav">
                <div class="s-card-header">
                    <div class="s-card-title">
                        <span class="num" style="background:rgba(249,115,22,0.12);color:#ea580c;">3</span>
                        Menu &amp; Navigasi
                    </div>
                </div>
                <div class="s-card-body">
                    @php
                        $mP = colorPresets();
                        $mtcCur = strtolower(old('menu_title_color', $menuTitleColor ?? '#f0f0f0'));
                        $mtw    = old('menu_title_weight', $menuTitleWeight ?? '800');
                        $mscCur = strtolower(old('menu_subtitle_color', $menuSubtitleColor ?? '#a0a0c0'));
                        $msw    = old('menu_subtitle_weight', $menuSubtitleWeight ?? '400');
                        $mdcCur = strtolower(old('menu_desc_color', $menuDescColor ?? $menuSubtitleColor ?? '#a0a0c0'));
                        $mdw    = old('menu_desc_weight', $menuDescWeight ?? '400');
                    @endphp

                    {{-- Judul Menu --}}
                    <div class="f-group">
                        <label class="f-label">Judul Menu</label>
                        <input type="text" class="f-input" name="menu_title"
                               value="{{ old('menu_title', $menuTitle) }}" required>
                        <div class="wt-row">
                            <span class="wt-label">Warna</span>
                            <select class="wt-select" onchange="handleColorSelect(this,'mtc_hex','mtc_pick','mtc_cw')">
                                @foreach($mP as $hex => $lbl)
                                <option value="{{ $hex }}" {{ $mtcCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                                <option value="custom" {{ !array_key_exists($mtcCur,$mP) ? 'selected' : '' }}>Custom</option>
                            </select>
                            <span id="mtc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($mtcCur,$mP) ? 'inline-flex':'none' }}">
                                <input type="color" class="wt-swatch" id="mtc_pick"
                                       value="{{ old('menu_title_color',$menuTitleColor??'#f0f0f0') }}"
                                       oninput="syncTs('mtc_pick','mtc_hex')">
                                <input type="text" class="wt-hex" id="mtc_hex" name="menu_title_color"
                                       value="{{ old('menu_title_color',$menuTitleColor??'#f0f0f0') }}"
                                       oninput="syncTsHex('mtc_hex','mtc_pick')">
                            </span>
                            <span class="wt-sep"></span>
                            <span class="wt-label">Tebal</span>
                            <input type="hidden" name="menu_title_weight" id="mtc_wv" value="{{ $mtw }}">
                            <select class="wt-select" onchange="handleWeightSelect(this,'mtc_wv','mtc_wc')">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ $mtw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                                <option value="custom" {{ !in_array($mtw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                            </select>
                            <input type="number" class="wt-num" id="mtc_wc" min="100" max="900" step="10"
                                   value="{{ $mtw }}"
                                   style="display:{{ !in_array($mtw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                   oninput="document.getElementById('mtc_wv').value=this.value">
                        </div>
                    </div>

                    {{-- Subjudul Menu --}}
                    <div class="f-group">
                        <label class="f-label">Subjudul Menu</label>
                        <input type="text" class="f-input" name="menu_subtitle"
                               value="{{ old('menu_subtitle', $menuSubtitle) }}" required>
                        <div class="wt-row">
                            <span class="wt-label">Warna</span>
                            <select class="wt-select" onchange="handleColorSelect(this,'msc_hex','msc_pick','msc_cw')">
                                @foreach($mP as $hex => $lbl)
                                <option value="{{ $hex }}" {{ $mscCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                                <option value="custom" {{ !array_key_exists($mscCur,$mP) ? 'selected' : '' }}>Custom</option>
                            </select>
                            <span id="msc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($mscCur,$mP) ? 'inline-flex':'none' }}">
                                <input type="color" class="wt-swatch" id="msc_pick"
                                       value="{{ old('menu_subtitle_color',$menuSubtitleColor??'#a0a0c0') }}"
                                       oninput="syncTs('msc_pick','msc_hex')">
                                <input type="text" class="wt-hex" id="msc_hex" name="menu_subtitle_color"
                                       value="{{ old('menu_subtitle_color',$menuSubtitleColor??'#a0a0c0') }}"
                                       oninput="syncTsHex('msc_hex','msc_pick')">
                            </span>
                            <span class="wt-sep"></span>
                            <span class="wt-label">Tebal</span>
                            <input type="hidden" name="menu_subtitle_weight" id="msc_wv" value="{{ $msw }}">
                            <select class="wt-select" onchange="handleWeightSelect(this,'msc_wv','msc_wc')">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ $msw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                                <option value="custom" {{ !in_array($msw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                            </select>
                            <input type="number" class="wt-num" id="msc_wc" min="100" max="900" step="10"
                                   value="{{ $msw }}"
                                   style="display:{{ !in_array($msw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                   oninput="document.getElementById('msc_wv').value=this.value">
                        </div>
                    </div>

                    {{-- Subjudul Deskripsi --}}
                    <div class="f-group" style="margin-bottom:14px;">
                        <label class="f-label">Subjudul Deskripsi</label>
                        <input type="text" class="f-input" name="menu_desc"
                               value="{{ old('menu_desc', $menuDesc ?? $menuSubtitle) }}">
                        <div class="wt-row">
                            <span class="wt-label">Warna</span>
                            <select class="wt-select" onchange="handleColorSelect(this,'mdc_hex','mdc_pick','mdc_cw')">
                                @foreach($mP as $hex => $lbl)
                                <option value="{{ $hex }}" {{ $mdcCur == $hex ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                                <option value="custom" {{ !array_key_exists($mdcCur,$mP) ? 'selected' : '' }}>Custom</option>
                            </select>
                            <span id="mdc_cw" class="wt-custom-wrap" style="display:{{ !array_key_exists($mdcCur,$mP) ? 'inline-flex':'none' }}">
                                <input type="color" class="wt-swatch" id="mdc_pick"
                                       value="{{ old('menu_desc_color',$menuDescColor??'#a0a0c0') }}"
                                       oninput="syncTs('mdc_pick','mdc_hex')">
                                <input type="text" class="wt-hex" id="mdc_hex" name="menu_desc_color"
                                       value="{{ old('menu_desc_color',$menuDescColor??'#a0a0c0') }}"
                                       oninput="syncTsHex('mdc_hex','mdc_pick')">
                            </span>
                            <span class="wt-sep"></span>
                            <span class="wt-label">Tebal</span>
                            <input type="hidden" name="menu_desc_weight" id="mdc_wv" value="{{ $mdw }}">
                            <select class="wt-select" onchange="handleWeightSelect(this,'mdc_wv','mdc_wc')">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ $mdw == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                                <option value="custom" {{ !in_array($mdw,[300,400,500,600,700,800,900]) ? 'selected' : '' }}>•••</option>
                            </select>
                            <input type="number" class="wt-num" id="mdc_wc" min="100" max="900" step="10"
                                   value="{{ $mdw }}"
                                   style="display:{{ !in_array($mdw,[300,400,500,600,700,800,900]) ? 'inline-block':'none' }};"
                                   oninput="document.getElementById('mdc_wv').value=this.value">
                        </div>
                    </div>

                    {{-- hidden menu size fields --}}
                    <input type="hidden" name="menu_title_size"    value="{{ old('menu_title_size',    $menuTitleSize    ?? '40px') }}">
                    <input type="hidden" name="menu_subtitle_size" value="{{ old('menu_subtitle_size', $menuSubtitleSize ?? '16px') }}">

                    {{-- Gallery Upload --}}
                    <div style="border-top:1px solid var(--border); padding-top:12px; margin-bottom:12px;">
                        <div class="s-sub-header" style="margin-bottom:8px;">
                            <span class="s-sub-title">Upload Foto Galeri</span>
                            <label class="btn-cam" style="cursor:pointer;" onclick="document.getElementById('galleryUploadInput').click()">
                                <i class="fa-solid fa-camera"></i> Ganti Foto
                            </label>
                            <input type="file" id="galleryUploadInput" multiple accept="image/*"
                                   style="display:none;" onchange="uploadGallery(this)">
                        </div>
                        <div class="gallery-grid" id="galleryGrid">
                            @forelse($galleryItems as $gItem)
                                <div class="gallery-thumb" id="gallery-item-{{ $gItem->id }}">
                                    <img src="{{ $gItem->imageUrl }}" alt="Galeri">
                                    <button type="button" class="gallery-del" onclick="deleteGallery({{ $gItem->id }})">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="img-hint" style="margin-bottom:0;">Format: JPG, PNG (Maks. 2MB)</div>

                        {{-- Hidden gallery title/subtitle fields (preserve functionality) --}}
                        <input type="hidden" name="gallery_title"          value="{{ old('gallery_title',          $galleryTitle          ?? 'Galeri Foto') }}">
                        <input type="hidden" name="gallery_subtitle"       value="{{ old('gallery_subtitle',       $gallerySubtitle       ?? '') }}">
                        <input type="hidden" name="gallery_title_color"    value="{{ old('gallery_title_color',    $galleryTitleColor    ?? '#f0f0f0') }}">
                        <input type="hidden" name="gallery_title_weight"   value="{{ old('gallery_title_weight',   $galleryTitleWeight   ?? '800') }}">
                        <input type="hidden" name="gallery_subtitle_color" value="{{ old('gallery_subtitle_color', $gallerySubtitleColor ?? '#a0a0c0') }}">
                        <input type="hidden" name="gallery_subtitle_weight"value="{{ old('gallery_subtitle_weight',$gallerySubtitleWeight?? '400') }}">
                        <input type="hidden" name="gallery_title_size"     value="{{ old('gallery_title_size',     $galleryTitleSize    ?? '40px') }}">
                        <input type="hidden" name="gallery_subtitle_size"  value="{{ old('gallery_subtitle_size',  $gallerySubtitleSize ?? '16px') }}">
                    </div>

                    {{-- Navigasi / Tombol Table --}}
                    <div style="border-top:1px solid var(--border); padding-top:12px;">
                        <div class="s-sub-title" style="margin-bottom:10px;">Navigasi / Tombol</div>
                        <div class="nav-table-wrap">
                        <table class="nav-table">
                            <thead>
                                <tr>
                                    <th>Nama Tombol</th>
                                    <th>Warna Background</th>
                                    <th>Warna Teks</th>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $navLabels = ['Tentang','Menu','Galeri','Kontak'];
                                    $navBg  = $navLinkBgColor  ?? '#ffc107';
                                    $navTxt = $navLinkColor    ?? '#000000';
                                @endphp
                                @foreach($navLabels as $idx => $lbl)
                                <tr>
                                    <td class="nav-name">{{ $lbl }}</td>
                                    <td>
                                        <div class="nav-color-cell">
                                            <input type="color" class="nav-swatch"
                                                   id="navBgPicker{{ $idx }}"
                                                   value="{{ $navBg }}"
                                                   oninput="syncNavRow({{ $idx }})">
                                            <input type="text" class="nav-hex"
                                                   id="navBgHex{{ $idx }}"
                                                   value="{{ $navBg }}"
                                                   oninput="syncNavRowHex({{ $idx }}, 'bg')">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="nav-color-cell">
                                            <input type="color" class="nav-swatch"
                                                   id="navTxtPicker{{ $idx }}"
                                                   value="{{ $navTxt }}"
                                                   oninput="syncNavRow({{ $idx }})">
                                            <input type="text" class="nav-hex"
                                                   id="navTxtHex{{ $idx }}"
                                                   value="{{ $navTxt }}"
                                                   oninput="syncNavRowHex({{ $idx }}, 'txt')">
                                        </div>
                                    </td>
                                    <td>
                                        <span class="nav-preview-btn" id="navPreview{{ $idx }}"
                                              style="background:{{ $navBg }};color:{{ $navTxt }};">
                                            {{ $lbl }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        {{-- Store first row values as the shared nav color (backend still uses single color) --}}
                        <input type="hidden" name="nav_link_bg_color" id="navBgColorFinal" value="{{ $navBg }}">
                        <input type="hidden" name="nav_link_color"    id="navTxtColorFinal" value="{{ $navTxt }}">
                    </div>

                </div>
            </div>{{-- /Kolom 3 --}}

        </div>{{-- /settings-grid --}}

        {{-- Save Bar --}}
        <div class="save-bar">
            <span class="save-hint">
                <i class="fa-solid fa-circle-info"></i>
                Perubahan akan langsung tampil di website setelah disimpan
            </span>
            <div style="display:flex;gap:8px;">
                <a href="{{ url('/admin') }}" class="btn-ghost">Batal</a>
                <button type="submit" class="btn-save-main">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
                </button>
            </div>
        </div>

    </div>{{-- /page-body --}}
    </form>

    {{-- Footer --}}
    <div class="admin-footer">
        &copy; {{ date('Y') }} KOKIKU Resto Admin Panel. All rights reserved.
    </div>

</div>{{-- /main-content --}}

<!-- ══════ MENU MODAL ══════ -->
<div class="modal-overlay" id="menuModalOverlay">
    <div class="modal-box">
        <div class="modal-title" id="menuModalTitle">Tambah Menu Baru</div>
        <input type="hidden" id="menuModalId">

        <div class="f-group">
            <label class="f-label">Foto Menu</label>
            <div style="display:flex;align-items:center;gap:12px;">
                <img id="menuModalImgPreview" src="{{ asset('images/logo_kokiku.png') }}"
                     style="width:56px;height:56px;object-fit:cover;border-radius:8px;border:1px solid var(--border);" alt="">
                <label class="btn-sm-action muted" style="cursor:pointer;">
                    <i class="fa-solid fa-upload"></i> Pilih Foto
                    <input type="file" id="menuModalImg" accept="image/*" style="display:none;" onchange="previewMenuImg(this)">
                </label>
            </div>
        </div>
        <div class="f-group">
            <label class="f-label">Nama Menu *</label>
            <input type="text" class="f-input" id="menuModalName" placeholder="cth: Nasi Goreng Spesial">
        </div>
        <div class="f-group">
            <label class="f-label">Harga</label>
            <input type="text" class="f-input" id="menuModalPrice" placeholder="cth: 25000">
        </div>
        <div class="f-group">
            <label class="f-label">Deskripsi</label>
            <textarea class="f-textarea" id="menuModalDesc" rows="2" placeholder="Deskripsi singkat..."></textarea>
        </div>
        <div id="menuModalError" style="color:#dc2626;font-size:12px;margin-top:6px;display:none;"></div>
        <div class="modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeMenuModal()">Batal</button>
            <button type="button" class="btn-modal-save" onclick="submitMenu()">
                <i class="fa-solid fa-floppy-disk"></i> Simpan
            </button>
        </div>
    </div>
</div>

<!-- ══════ DRINK MODAL ══════ -->
<div class="modal-overlay" id="drinkModalOverlay">
    <div class="modal-box">
        <div class="modal-title" id="drinkModalTitle">Tambah Minuman Baru</div>
        <input type="hidden" id="drinkModalId">

        <div class="f-group">
            <label class="f-label">Foto Minuman</label>
            <div style="display:flex;align-items:center;gap:12px;">
                <img id="drinkModalImgPreview" src="{{ asset('images/logo_kokiku.png') }}"
                     style="width:56px;height:56px;object-fit:cover;border-radius:8px;border:1px solid var(--border);" alt="">
                <label class="btn-sm-action muted" style="cursor:pointer;">
                    <i class="fa-solid fa-upload"></i> Pilih Foto
                    <input type="file" id="drinkModalImg" accept="image/*" style="display:none;" onchange="previewDrinkImg(this)">
                </label>
            </div>
        </div>
        <div class="f-group">
            <label class="f-label">Nama Minuman *</label>
            <input type="text" class="f-input" id="drinkModalName" placeholder="cth: Es Teh Manis">
        </div>
        <div class="f-group">
            <label class="f-label">Harga</label>
            <input type="text" class="f-input" id="drinkModalPrice" placeholder="cth: 10000">
        </div>
        <div class="f-group">
            <label class="f-label">Deskripsi</label>
            <textarea class="f-textarea" id="drinkModalDesc" rows="2" placeholder="Deskripsi singkat..."></textarea>
        </div>
        <div id="drinkModalError" style="color:#dc2626;font-size:12px;margin-top:6px;display:none;"></div>
        <div class="modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeDrinkModal()">Batal</button>
            <button type="button" class="btn-modal-save" onclick="submitDrink()">
                <i class="fa-solid fa-floppy-disk"></i> Simpan
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const CSRF = document.querySelector('input[name=_token]')?.value || '';

// ── COLOR PRESETS HELPER (PHP outputs this via Blade, used client-side only for reference) ──

// ── LOGO PREVIEW ────────────────────────────────
function previewLogo(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('logoPreviewImg').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}

// ── HERO BG PREVIEW ─────────────────────────────
function previewHeroBg(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('heroPreviewImg').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}

// ── ABOUT PREVIEW ───────────────────────────────
function previewAbout(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('aboutPreviewImg').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}

// ── TEXT STYLE SYNC ──────────────────────────────
function syncTs(pickerId, hexId) {
    document.getElementById(hexId).value = document.getElementById(pickerId).value;
}
function syncTsHex(hexId, pickerId) {
    const v = document.getElementById(hexId).value;
    if (/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/.test(v))
        document.getElementById(pickerId).value = v;
}
function handleWeightSelect(select, hiddenId, customId) {
    const hidden = document.getElementById(hiddenId);
    const custom = document.getElementById(customId);
    if (select.value === 'custom') {
        custom.style.display = 'inline-block';
        custom.value = hidden.value;
        custom.focus();
    } else {
        custom.style.display = 'none';
        hidden.value = select.value;
    }
}
function handleColorSelect(select, hexId, pickId, wrapId) {
    const hex  = document.getElementById(hexId);
    const pick = document.getElementById(pickId);
    const wrap = document.getElementById(wrapId);
    if (select.value === 'custom') {
        wrap.style.display = 'inline-flex';
    } else {
        wrap.style.display = 'none';
        hex.value  = select.value;
        pick.value = select.value;
    }
}

// ── NAV TABLE ROW SYNC ───────────────────────────
function syncNavRow(idx) {
    const bg  = document.getElementById('navBgPicker'  + idx).value;
    const txt = document.getElementById('navTxtPicker' + idx).value;
    document.getElementById('navBgHex'  + idx).value = bg;
    document.getElementById('navTxtHex' + idx).value = txt;
    document.getElementById('navPreview' + idx).style.background = bg;
    document.getElementById('navPreview' + idx).style.color      = txt;
    // Sync first row to hidden fields for form submission
    if (idx === 0) {
        document.getElementById('navBgColorFinal').value  = bg;
        document.getElementById('navTxtColorFinal').value = txt;
    }
}
function syncNavRowHex(idx, type) {
    if (type === 'bg') {
        const v = document.getElementById('navBgHex' + idx).value;
        if (/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/.test(v)) {
            document.getElementById('navBgPicker' + idx).value = v;
            document.getElementById('navPreview'  + idx).style.background = v;
            if (idx === 0) document.getElementById('navBgColorFinal').value = v;
        }
    } else {
        const v = document.getElementById('navTxtHex' + idx).value;
        if (/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/.test(v)) {
            document.getElementById('navTxtPicker' + idx).value = v;
            document.getElementById('navPreview'   + idx).style.color = v;
            if (idx === 0) document.getElementById('navTxtColorFinal').value = v;
        }
    }
}

// ── TOAST ────────────────────────────────────────
function showToast(msg, ok=true) {
    const t = document.createElement('div');
    t.textContent = msg;
    Object.assign(t.style, {
        position:'fixed', bottom:'22px', right:'22px', zIndex:'9999',
        background: ok ? '#16a34a' : '#dc2626', color:'#fff',
        padding:'10px 16px', borderRadius:'10px',
        fontFamily:'Outfit,sans-serif', fontWeight:'600', fontSize:'13px',
        boxShadow:'0 4px 18px rgba(0,0,0,0.2)', opacity:'0',
        transition:'opacity .2s'
    });
    document.body.appendChild(t);
    requestAnimationFrame(() => t.style.opacity = '1');
    setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 250); }, 2500);
}

// ── MENU MODAL ───────────────────────────────────
function openMenuModal(id, name, price, desc, imgUrl) {
    document.getElementById('menuModalId').value    = id   || '';
    document.getElementById('menuModalName').value  = name || '';
    document.getElementById('menuModalPrice').value = price|| '';
    document.getElementById('menuModalDesc').value  = desc || '';
    document.getElementById('menuModalImgPreview').src = imgUrl || '{{ asset("images/logo_kokiku.png") }}';
    document.getElementById('menuModalImg').value   = '';
    document.getElementById('menuModalError').style.display = 'none';
    document.getElementById('menuModalTitle').textContent = id ? 'Edit Menu' : 'Tambah Menu Baru';
    document.getElementById('menuModalOverlay').classList.add('open');
}
function closeMenuModal() { document.getElementById('menuModalOverlay').classList.remove('open'); }
function editMenu(id, name, price, desc, imgUrl) { openMenuModal(id, name, price, desc, imgUrl); }
function previewMenuImg(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('menuModalImgPreview').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}
document.getElementById('menuModalOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeMenuModal();
});

async function submitMenu() {
    const id    = document.getElementById('menuModalId').value;
    const name  = document.getElementById('menuModalName').value.trim();
    const price = document.getElementById('menuModalPrice').value.trim();
    const desc  = document.getElementById('menuModalDesc').value.trim();
    const file  = document.getElementById('menuModalImg').files[0];
    const errEl = document.getElementById('menuModalError');

    if (!name) { errEl.textContent = 'Nama menu wajib diisi.'; errEl.style.display = 'block'; return; }
    errEl.style.display = 'none';

    const fd = new FormData();
    fd.append('_token', CSRF);
    fd.append('name', name);
    fd.append('price', price);
    fd.append('description', desc);
    if (file) fd.append('image', file);

    const url = id ? `/admin/menu/${id}` : '/admin/menu';
    const res  = await fetch(url, { method:'POST', headers:{'X-Requested-With':'XMLHttpRequest'}, body:fd });
    const json = await res.json();

    if (json.success) { closeMenuModal(); showToast(json.message); setTimeout(() => location.reload(), 700); }
    else { errEl.textContent = json.message || 'Terjadi kesalahan.'; errEl.style.display = 'block'; }
}

async function deleteMenu(id, name) {
    if (!confirm(`Yakin ingin menghapus "${name}"?`)) return;
    const fd = new FormData(); fd.append('_token', CSRF);
    const res  = await fetch(`/admin/menu/${id}/delete`, { method:'POST', headers:{'X-Requested-With':'XMLHttpRequest'}, body:fd });
    const json = await res.json();
    if (json.success) { document.getElementById(`menu-row-${id}`)?.remove(); showToast(json.message); }
    else showToast(json.message || 'Gagal menghapus.', false);
}

// ── GALLERY ──────────────────────────────────────
async function uploadGallery(input) {
    if (!input.files || !input.files.length) return;
    const fd = new FormData(); fd.append('_token', CSRF);
    for (const f of input.files) fd.append('images[]', f);
    const res  = await fetch('/admin/gallery', { method:'POST', headers:{'X-Requested-With':'XMLHttpRequest'}, body:fd });
    const json = await res.json();
    if (json.success) { showToast(json.message); setTimeout(() => location.reload(), 700); }
    else showToast(json.message || 'Gagal upload.', false);
}
async function deleteGallery(id) {
    if (!confirm('Yakin ingin menghapus foto ini?')) return;
    const fd = new FormData(); fd.append('_token', CSRF);
    const res  = await fetch(`/admin/gallery/${id}/delete`, { method:'POST', headers:{'X-Requested-With':'XMLHttpRequest'}, body:fd });
    const json = await res.json();
    if (json.success) { document.getElementById(`gallery-item-${id}`)?.remove(); showToast(json.message); }
    else showToast(json.message || 'Gagal menghapus.', false);
}

// ── DRINK MODAL ──────────────────────────────────
function openDrinkModal(id, name, price, desc, imgUrl) {
    document.getElementById('drinkModalId').value    = id    || '';
    document.getElementById('drinkModalName').value  = name  || '';
    document.getElementById('drinkModalPrice').value = price || '';
    document.getElementById('drinkModalDesc').value  = desc  || '';
    document.getElementById('drinkModalImgPreview').src = imgUrl || '{{ asset("images/logo_kokiku.png") }}';
    document.getElementById('drinkModalImg').value   = '';
    document.getElementById('drinkModalError').style.display = 'none';
    document.getElementById('drinkModalTitle').textContent = id ? 'Edit Minuman' : 'Tambah Minuman Baru';
    document.getElementById('drinkModalOverlay').classList.add('open');
}
function closeDrinkModal() { document.getElementById('drinkModalOverlay').classList.remove('open'); }
function editDrink(id, name, price, desc, imgUrl) { openDrinkModal(id, name, price, desc, imgUrl); }
function previewDrinkImg(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('drinkModalImgPreview').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}
document.getElementById('drinkModalOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeDrinkModal();
});

async function submitDrink() {
    const id    = document.getElementById('drinkModalId').value;
    const name  = document.getElementById('drinkModalName').value.trim();
    const price = document.getElementById('drinkModalPrice').value.trim();
    const desc  = document.getElementById('drinkModalDesc').value.trim();
    const file  = document.getElementById('drinkModalImg').files[0];
    const errEl = document.getElementById('drinkModalError');

    if (!name) { errEl.textContent = 'Nama minuman wajib diisi.'; errEl.style.display = 'block'; return; }
    errEl.style.display = 'none';

    const fd = new FormData();
    fd.append('_token', CSRF);
    fd.append('name', name);
    fd.append('price', price);
    fd.append('description', desc);
    if (file) fd.append('image', file);

    const url = id ? `/admin/drink/${id}` : '/admin/drink';
    const res  = await fetch(url, { method:'POST', headers:{'X-Requested-With':'XMLHttpRequest'}, body:fd });
    const json = await res.json();

    if (json.success) { closeDrinkModal(); showToast(json.message); setTimeout(() => location.reload(), 700); }
    else { errEl.textContent = json.message || 'Terjadi kesalahan.'; errEl.style.display = 'block'; }
}
</script>
</body>
</html>


