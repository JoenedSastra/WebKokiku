<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengaturan – KOKIKU Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

:root {
    --red:      #c1121f;
    --red-dark: #780000;
    --red-glow: rgba(193,18,31,0.25);
    --gold:     #ffc107;
    --gold-dim: rgba(255,193,7,0.15);
    --bg:       #0a0a0a;
    --surface:  #131313;
    --surface2: #1a1a1a;
    --surface3: #212121;
    --border:   rgba(255,255,255,0.07);
    --border2:  rgba(255,255,255,0.12);
    --text:     #f0f0f0;
    --muted:    rgba(255,255,255,0.4);
    --muted2:   rgba(255,255,255,0.6);
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
    width: 240px; height: 100vh;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    z-index: 100; padding: 0 0 24px;
}

.sidebar-brand {
    padding: 24px 24px 20px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 10px;
}
.sidebar-brand .brand-icon {
    width: 36px; height: 36px;
    background: linear-gradient(135deg, var(--red), var(--red-dark));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: var(--gold);
}
.sidebar-brand .brand-name {
    font-size: 20px; font-weight: 800;
    color: var(--gold); letter-spacing: 1px;
}

.sidebar-nav { padding: 20px 12px; flex: 1; }
.nav-label {
    font-size: 10px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 1.2px;
    color: var(--muted); padding: 0 12px; margin-bottom: 8px;
}
.sidebar-link {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 14px; border-radius: 12px;
    color: rgba(255,255,255,0.6); text-decoration: none;
    font-size: 14px; font-weight: 500; transition: all 0.25s; margin-bottom: 4px;
}
.sidebar-link .s-icon {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center; font-size: 14px;
    background: rgba(255,255,255,0.05); transition: all 0.25s;
}
.sidebar-link:hover, .sidebar-link.active { background: rgba(193,18,31,0.15); color: #fff; }
.sidebar-link:hover .s-icon, .sidebar-link.active .s-icon { background: rgba(193,18,31,0.3); color: #ff6b6b; }

.sidebar-footer {
    padding: 16px 12px 0;
    border-top: 1px solid var(--border);
}
.sidebar-user {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 14px; border-radius: 12px;
    background: rgba(255,255,255,0.04); border: 1px solid var(--border);
}
.user-avatar {
    width: 34px; height: 34px;
    background: linear-gradient(135deg, var(--gold), #ff6b35);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700; color: #000; text-transform: uppercase;
    flex-shrink: 0; overflow: hidden;
}
.user-avatar img { width:100%; height:100%; object-fit:cover; border-radius:50%; }
.user-info .user-name { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.2; }
.user-info .user-role { font-size: 11px; color: var(--gold); line-height: 1.2; }

/* ── MAIN ────────────────────────────────────── */
.main-content {
    margin-left: 240px; flex: 1;
    display: flex; flex-direction: column;
}

.topbar {
    background: rgba(10,10,10,0.96);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--border);
    padding: 0 32px;
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 50;
    height: 64px;
}
.topbar-left { display: flex; align-items: center; gap: 12px; }
.topbar-title { font-size: 18px; font-weight: 700; }
.topbar-badge {
    font-size: 11px; font-weight: 600;
    background: var(--gold-dim);
    color: var(--gold);
    border: 1px solid rgba(255,193,7,0.25);
    border-radius: 20px; padding: 3px 10px;
}

.btn-ghost {
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.7); border: 1px solid var(--border2);
    border-radius: 10px; padding: 8px 16px;
    font-size: 13px; font-weight: 500; text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px; transition: all 0.3s;
    font-family: 'Outfit', sans-serif;
}
.btn-ghost:hover { background: rgba(255,255,255,0.1); color: #fff; }

.btn-save {
    background: linear-gradient(135deg, var(--red), var(--red-dark));
    color: #fff; border: none; border-radius: 10px;
    padding: 10px 24px; font-size: 14px; font-weight: 600;
    display: inline-flex; align-items: center; gap: 8px;
    cursor: pointer; transition: all 0.3s;
    box-shadow: 0 4px 16px var(--red-glow);
    font-family: 'Outfit', sans-serif;
}
.btn-save:hover { transform: translateY(-1px); box-shadow: 0 8px 24px rgba(193,18,31,0.45); }
.btn-save:active { transform: translateY(0); }

/* ── PAGE BODY ───────────────────────────────── */
.page-body { padding: 24px 32px 80px; flex: 1; }

/* ── SETTINGS HERO HEADER ────────────────────── */
.settings-hero {
    background: linear-gradient(135deg, rgba(193,18,31,0.08), rgba(255,193,7,0.04));
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 18px 22px;
    margin-bottom: 18px;
    display: flex; align-items: center; gap: 16px;
}
.settings-hero-icon {
    width: 48px; height: 48px; flex-shrink: 0;
    background: linear-gradient(135deg, var(--red), var(--red-dark));
    border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: #fff;
    box-shadow: 0 6px 18px var(--red-glow);
}
.settings-hero-text h2 { font-size: 17px; font-weight: 800; margin: 0 0 3px; }
.settings-hero-text p  { font-size: 12px; color: var(--muted); margin: 0; }

/* ── SETTINGS TABS ───────────────────────────── */
.settings-tabs {
    display: flex; gap: 4px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 5px;
    margin-bottom: 20px;
    overflow-x: auto;
}
.settings-tabs::-webkit-scrollbar { display: none; }
.tab-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 18px; border-radius: 10px;
    font-size: 13px; font-weight: 600;
    color: var(--muted2); border: none; background: transparent;
    cursor: pointer; transition: all 0.22s; white-space: nowrap;
    font-family: 'Outfit', sans-serif;
}
.tab-btn .tab-icon { font-size: 12px; }
.tab-btn:hover { color: #fff; background: rgba(255,255,255,0.05); }
.tab-btn.active {
    background: var(--surface3);
    color: #fff;
    border: 1px solid var(--border2);
    box-shadow: 0 2px 8px rgba(0,0,0,0.4);
}
.tab-btn.active .tab-icon { color: var(--gold); }

/* ── TAB PANELS ──────────────────────────────── */
.tab-panel { display: none; }
.tab-panel.active {
    display: block;
    animation: fadeInPanel 0.22s ease;
}
@keyframes fadeInPanel {
    from { opacity: 0; transform: translateY(5px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── NAV PREVIEW BOX ─────────────────────────── */
.nav-preview-box {
    display: flex; gap: 10px; flex-wrap: wrap;
    padding: 16px; align-items: center;
    background: rgba(255,255,255,0.02);
    border: 1px solid var(--border);
    border-radius: 12px; min-height: 68px;
}

/* ── SECTION CARD ────────────────────────────── */
.section-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
    margin-bottom: 14px;
}
.section-card-header {
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 12px;
    background: linear-gradient(135deg, rgba(255,255,255,0.02), transparent);
}
.section-card-header .s-icon {
    width: 34px; height: 34px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center; font-size: 13px;
    flex-shrink: 0;
}
.s-icon.red    { background: rgba(193,18,31,0.2);   color: #ff6b6b; }
.s-icon.gold   { background: rgba(255,193,7,0.15);  color: var(--gold); }
.s-icon.blue   { background: rgba(59,130,246,0.15); color: #60a5fa; }
.s-icon.purple { background: rgba(139,92,246,0.15); color: #a78bfa; }
.s-icon.green  { background: rgba(34,197,94,0.15);  color: #4ade80; }
.section-card-header-text h6 { margin: 0; font-size: 14px; font-weight: 700; }
.section-card-header-text p  { margin: 0; font-size: 12px; color: var(--muted); margin-top: 1px; }
.section-card-body { padding: 20px; }

/* ── FORM FIELDS ─────────────────────────────── */
.field-group { margin-bottom: 16px; }
.field-group:last-child { margin-bottom: 0; }

.field-label {
    display: block; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.8px;
    color: var(--muted); margin-bottom: 7px;
}

.dark-input, .dark-select, .dark-textarea {
    width: 100%;
    background: var(--surface2);
    border: 1px solid var(--border2);
    border-radius: 10px;
    color: #fff;
    padding: 10px 14px;
    font-size: 14px;
    font-family: 'Outfit', sans-serif;
    transition: all 0.2s;
    outline: none;
}
.dark-input:focus, .dark-select:focus, .dark-textarea:focus {
    border-color: rgba(193,18,31,0.5);
    background: rgba(193,18,31,0.05);
    box-shadow: 0 0 0 3px rgba(193,18,31,0.1);
}
.dark-input::placeholder, .dark-textarea::placeholder { color: rgba(255,255,255,0.2); }
.dark-select option { background: #1e1e1e; color: #fff; }
.dark-textarea { resize: vertical; min-height: 90px; }

/* file input */
.file-drop {
    border: 2px dashed rgba(255,255,255,0.1);
    border-radius: 12px; padding: 28px 20px;
    text-align: center; cursor: pointer;
    transition: all 0.3s;
    background: rgba(255,255,255,0.02);
    display: block;
}
.file-drop:hover { border-color: rgba(193,18,31,0.5); background: rgba(193,18,31,0.03); }
.file-drop input[type="file"] { display: none; }
.file-drop-icon { font-size: 26px; color: var(--muted); margin-bottom: 10px; }
.file-drop-text { font-size: 13px; color: rgba(255,255,255,0.4); line-height: 1.7; }
.file-drop-text strong { color: var(--gold); }
.file-drop-hint { font-size: 11px; color: var(--muted); margin-top: 5px; }

/* preview */
.img-preview-wrap {
    border-radius: 14px; overflow: hidden;
    border: 1px solid var(--border); margin-top: 14px;
    position: relative;
}
.img-preview-wrap img { width: 100%; height: 180px; object-fit: cover; display: block; }
.img-preview-label {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.7));
    padding: 10px 12px;
    font-size: 12px; color: rgba(255,255,255,0.7);
}

/* color picker */
.color-wrap {
    display: flex; align-items: center; gap: 10px;
}
.color-swatch {
    width: 44px; height: 44px; border-radius: 10px;
    border: 2px solid rgba(255,255,255,0.12);
    cursor: pointer; flex-shrink: 0;
    overflow: hidden; padding: 0;
    background: transparent;
}
.color-swatch::-webkit-color-swatch-wrapper { padding: 0; }
.color-swatch::-webkit-color-swatch { border: none; border-radius: 8px; }
.color-val-text {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px; padding: 8px 12px;
    font-size: 13px; color: rgba(255,255,255,0.6);
    font-family: monospace; flex: 1;
}

/* divider */
.section-divider {
    border: none; border-top: 1px solid var(--border);
    margin: 4px 0 16px;
}

/* flash */
.flash-alert {
    border-radius: 12px; padding: 13px 18px; font-size: 14px; font-weight: 500;
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 20px; border: 1px solid;
}
.flash-success { background: rgba(34,197,94,0.08); border-color: rgba(34,197,94,0.25); color: #4ade80; }
.flash-danger  { background: rgba(220,53,69,0.08);  border-color: rgba(220,53,69,0.25);  color: #ff6b6b; }

/* sticky save bar */
.save-bar {
    position: sticky; bottom: 0;
    background: rgba(10,10,10,0.97);
    backdrop-filter: blur(14px);
    border-top: 1px solid var(--border);
    padding: 14px 32px;
    display: flex; align-items: center; justify-content: flex-end;
    gap: 10px;
    z-index: 40;
}
.save-bar-hint {
    font-size: 12px; color: var(--muted); margin-right: auto;
    display: flex; align-items: center; gap: 6px;
}
.save-bar-hint i { color: var(--gold); }

/* logo preview */
.logo-preview-wrap {
    border-radius: 14px; overflow: hidden;
    border: 1px solid var(--border); margin-top: 14px;
    background: repeating-conic-gradient(rgba(255,255,255,0.04) 0% 25%, transparent 0% 50%) 0 0/20px 20px;
    display: flex; align-items: center; justify-content: center;
    padding: 20px; min-height: 110px; position: relative;
}
.logo-preview-wrap img {
    max-width: 180px; max-height: 80px;
    object-fit: contain; display: block;
    filter: drop-shadow(0 2px 8px rgba(0,0,0,0.5));
}
.logo-preview-label {
    position: absolute; bottom: 6px; right: 10px;
    font-size: 11px; color: rgba(255,255,255,0.4);
}

/* ── THEME TOGGLE ────────────────────────────── */
.theme-toggle {
    width: 42px; height: 42px;
    border: none; border-radius: 12px;
    background: #202020;
    color: #ffc107;
    cursor: pointer;
    display: flex; justify-content: center; align-items: center;
    font-size: 17px;
    transition: .3s;
    box-shadow: 0 0 12px rgba(255,193,7,.18);
    flex-shrink: 0;
}
.theme-toggle:hover {
    background: #2d2d2d;
    box-shadow: 0 0 20px rgba(255,193,7,.35);
}

/* ── LIGHT MODE ──────────────────────────────── */
body.light {
    --bg: #f5f7fb;
    --surface: #ffffff;
    --surface2: #f0f2f5;
    --surface3: #e8eaed;
    --border: rgba(0,0,0,.08);
    --border2: rgba(0,0,0,.14);
    --text: #202124;
    --muted: #6b7280;
    --muted2: #374151;
}
body.light .topbar { background: #ffffff; }
body.light .sidebar { background: #ffffff; }
body.light .sidebar-link { color: #333; }
body.light .section-card { background: #ffffff; }
body.light .settings-tabs { background: #f0f2f5; }
body.light .tab-btn.active { background: #ffffff; }
body.light .dark-input,
body.light .dark-select,
body.light .dark-textarea {
    background: #f8f9fa;
    border-color: rgba(0,0,0,.15);
    color: #202124;
}
body.light .dark-input::placeholder,
body.light .dark-textarea::placeholder { color: rgba(0,0,0,.3); }
body.light .dark-select option { background: #fff; color: #202124; }
body.light .color-val-text { background: #f0f2f5; border-color: rgba(0,0,0,.1); color: #374151; }
body.light .save-bar { background: rgba(245,247,251,.97); }
body.light .theme-toggle {
    background: #ffffff;
    color: #f5a623;
    border: 1px solid rgba(0,0,0,.1);
}
body.light .btn-ghost {
    background: #ffffff;
    color: #222;
    border: 1px solid #d9d9d9;
}
body.light .btn-ghost:hover {
    background: #ffc107;
    color: #111;
    border-color: #ffc107;
}
</style>
</head>
<body>

<!-- ═══════════════ SIDEBAR ═══════════════ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon" style="background:none; padding:0; overflow:hidden;">
            <img src="{{ asset($logoImage ?? 'images/logo_kokiku.png') }}" alt="KOKIKU Logo"
                 style="width:36px; height:36px; object-fit:cover; border-radius:50%;">
        </div>
        <span class="brand-name">KOKIKU</span>
    </div>
    <div class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>
        <a href="{{ url('/admin') }}" class="sidebar-link">
            <div class="s-icon"><i class="fa-solid fa-gauge-high"></i></div>
            Dashboard
        </a>
        <a href="{{ url('/admin/settings') }}" class="sidebar-link active">
            <div class="s-icon"><i class="fa-solid fa-sliders"></i></div>
            Pengaturan
        </a>
    </div>

</div>

<!-- ═══════════════ MAIN ═══════════════ -->
<div class="main-content">

    <!-- TOP BAR -->
    <div class="topbar">
        <div class="topbar-left">
            <div class="topbar-title">Pengaturan</div>
            <span class="topbar-badge"><i class="fa-solid fa-circle me-1" style="font-size:7px;color:#4ade80;"></i>Live Edit</span>
        </div>
        <a href="{{ url('/admin') }}" class="btn-ghost">
            <i class="fa-solid fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- FORM -->
    <form method="POST" action="{{ url('/admin/settings') }}" enctype="multipart/form-data" id="settingsForm">
    @csrf

    <div class="page-body">

        @if(session('success'))
        <div class="flash-alert flash-success">
            <i class="fa-solid fa-circle-check" style="margin-top:2px;flex-shrink:0;"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif
        @if($errors->any())
        <div class="flash-alert flash-danger">
            <i class="fa-solid fa-circle-exclamation" style="margin-top:2px;flex-shrink:0;"></i>
            <div>
                @foreach($errors->all() as $e)
                    <div>{{ $e }}</div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- PAGE HEADER -->
        <div class="settings-hero">
            <div class="settings-hero-icon"><i class="fa-solid fa-sliders"></i></div>
            <div class="settings-hero-text">
                <h2>Pengaturan Website</h2>
                <p>Kustomisasi tampilan, teks, warna, dan gambar seluruh halaman secara real-time</p>
            </div>
        </div>

        <!-- TABS NAV -->
        <div class="settings-tabs">
            <button type="button" class="tab-btn active" data-tab="tab-logo">
                <span class="tab-icon"><i class="fa-solid fa-star"></i></span> Logo
            </button>
            <button type="button" class="tab-btn" data-tab="tab-nav">
                <span class="tab-icon"><i class="fa-solid fa-link"></i></span> Navigasi
            </button>
            <button type="button" class="tab-btn" data-tab="tab-hero">
                <span class="tab-icon"><i class="fa-solid fa-image"></i></span> Hero
            </button>
            <button type="button" class="tab-btn" data-tab="tab-about">
                <span class="tab-icon"><i class="fa-solid fa-circle-info"></i></span> Tentang Kami
            </button>
        </div>

        <!-- ══════ TAB: LOGO ══════ -->
        <div class="tab-panel active" id="tab-logo">
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon gold"><i class="fa-solid fa-star"></i></div>
                    <div class="section-card-header-text">
                        <h6>Logo Website</h6>
                        <p>Gambar logo yang tampil di sidebar dan seluruh halaman admin</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="row g-4 align-items-start">
                        <div class="col-md-7">
                            <label class="field-label">Upload Logo Baru</label>
                            <label class="file-drop" id="logoDropZone">
                                <input type="file" name="logo_image" accept="image/*" id="logoFile"
                                       onchange="previewLogo(this)">
                                <div class="file-drop-icon"><i class="fa-solid fa-image"></i></div>
                                <div class="file-drop-text">
                                    <strong>Klik untuk upload</strong> atau seret file ke sini
                                </div>
                                <div class="file-drop-hint">PNG, SVG, WEBP, JPG &ndash; maks 2MB &nbsp;&middot;&nbsp; Rekomendasi: PNG transparan</div>
                            </label>
                        </div>
                        <div class="col-md-5">
                            <label class="field-label">Preview Logo</label>
                            <div class="logo-preview-wrap" id="logoPreviewContainer">
                                <img src="{{ asset($logoImage ?? 'images/logo_kokiku.png') }}" id="logoPreviewImg" alt="Logo saat ini">
                                <span class="logo-preview-label"><i class="fa-solid fa-image me-1"></i>Logo saat ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════ TAB: NAVIGASI ══════ -->
        <div class="tab-panel" id="tab-nav">
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon purple"><i class="fa-solid fa-link"></i></div>
                    <div class="section-card-header-text">
                        <h6>Tombol Navigasi Hero</h6>
                        <p>Warna background dan teks link Tentang, Menu, Galeri, Kontak</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="row g-4 align-items-end">
                        <div class="col-md-3">
                            <label class="field-label">Warna Background</label>
                            <div class="color-row">
                                <input type="color" name="nav_link_bg_color" id="navLinkBgColor"
                                       value="{{ old('nav_link_bg_color', $navLinkBgColor ?? '#ffc107') }}"
                                       class="color-swatch">
                                <input type="text" class="dark-input color-hex" id="navLinkBgColorHex"
                                       value="{{ old('nav_link_bg_color', $navLinkBgColor ?? '#ffc107') }}"
                                       placeholder="#ffc107" maxlength="7"
                                       oninput="syncNavBgColor()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="field-label">Warna Teks</label>
                            <div class="color-row">
                                <input type="color" name="nav_link_color" id="navLinkColor"
                                       value="{{ old('nav_link_color', $navLinkColor ?? '#000000') }}"
                                       class="color-swatch">
                                <input type="text" class="dark-input color-hex" id="navLinkColorHex"
                                       value="{{ old('nav_link_color', $navLinkColor ?? '#000000') }}"
                                       placeholder="#000000" maxlength="7"
                                       oninput="syncNavTextColor()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="field-label">Preview Tombol</label>
                            <div class="nav-preview-box">
                                @foreach(['Tentang','Menu','Galeri','Kontak'] as $lnk)
                                <span class="nav-btn-preview"
                                      data-preview-style="{{ $navPreviewStyle }}">
                                  {{ $lnk }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div><!-- /tab-nav -->

        <!-- ══════ TAB: HERO ══════ -->
        <div class="tab-panel" id="tab-hero">

            <!-- Judul -->
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon red"><i class="fa-solid fa-heading"></i></div>
                    <div class="section-card-header-text">
                        <h6>Judul Hero</h6>
                        <p>Teks besar di bagian atas halaman utama</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="field-group">
                        <label class="field-label">Teks Judul</label>
                        <input type="text" name="hero_title" class="dark-input"
                               value="{{ old('hero_title', $heroTitle) }}" required
                               placeholder="Contoh: SELAMAT DATANG DI RESTO KOKIKU">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="field-label">Warna</label>
                            <div class="color-wrap">
                                <input type="color" name="hero_title_color" class="color-swatch"
                                       id="heroTitleColor"
                                       value="{{ old('hero_title_color', $heroTitleColor) }}" required>
                                <span class="color-val-text" id="heroTitleColorVal">{{ old('hero_title_color', $heroTitleColor) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ketebalan</label>
                            <select name="hero_title_weight" class="dark-select" required>
                                @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('hero_title_weight',$heroTitleWeight)===$v?'selected':'' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ukuran Font</label>
                            <select name="hero_title_size" class="dark-select" required>
                                @foreach(['44px','48px','52px','56px','60px'] as $s)
                                <option value="{{ $s }}" {{ old('hero_title_size',$heroTitleSize)===$s?'selected':'' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subjudul -->
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon gold"><i class="fa-solid fa-quote-left"></i></div>
                    <div class="section-card-header-text">
                        <h6>Subjudul Hero</h6>
                        <p>Tagline singkat di bawah judul utama</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="field-group">
                        <label class="field-label">Teks Subjudul</label>
                        <input type="text" name="hero_subtitle" class="dark-input"
                               value="{{ old('hero_subtitle', $heroSubtitle) }}" required
                               placeholder="Contoh: Moslem Chinese Foods Halal">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="field-label">Warna</label>
                            <div class="color-wrap">
                                <input type="color" name="hero_subtitle_color" class="color-swatch"
                                       id="heroSubColor"
                                       value="{{ old('hero_subtitle_color', $heroSubtitleColor) }}" required>
                                <span class="color-val-text" id="heroSubColorVal">{{ old('hero_subtitle_color', $heroSubtitleColor) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ketebalan</label>
                            <select name="hero_subtitle_weight" class="dark-select" required>
                                @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('hero_subtitle_weight',$heroSubtitleWeight)===$v?'selected':'' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ukuran Font</label>
                            <select name="hero_subtitle_size" class="dark-select" required>
                                @foreach(['20px','24px','28px','32px','36px'] as $s)
                                <option value="{{ $s }}" {{ old('hero_subtitle_size',$heroSubtitleSize)===$s?'selected':'' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon blue"><i class="fa-solid fa-align-left"></i></div>
                    <div class="section-card-header-text">
                        <h6>Deskripsi Hero</h6>
                        <p>Paragraf singkat di bawah subjudul</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="field-group">
                        <label class="field-label">Teks Deskripsi</label>
                        <textarea name="hero_text" class="dark-textarea" rows="3" required
                                  placeholder="Tulis deskripsi singkat...">{{ old('hero_text', $heroText) }}</textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="field-label">Warna</label>
                            <div class="color-wrap">
                                <input type="color" name="hero_text_color" class="color-swatch"
                                       id="heroTextColor"
                                       value="{{ old('hero_text_color', $heroTextColor) }}" required>
                                <span class="color-val-text" id="heroTextColorVal">{{ old('hero_text_color', $heroTextColor) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ketebalan</label>
                            <select name="hero_text_weight" class="dark-select" required>
                                @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('hero_text_weight',$heroTextWeight)===$v?'selected':'' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ukuran Font</label>
                            <select name="hero_text_size" class="dark-select" required>
                                @foreach(['16px','18px','20px','22px','24px'] as $s)
                                <option value="{{ $s }}" {{ old('hero_text_size',$heroTextSize)===$s?'selected':'' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Background -->
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon green"><i class="fa-solid fa-panorama"></i></div>
                    <div class="section-card-header-text">
                        <h6>Foto Background Hero</h6>
                        <p>Gambar latar belakang bagian hero halaman utama</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="row g-4 align-items-start">
                        <div class="col-md-7">
                            <label class="field-label">Upload Foto Background</label>
                            <label class="file-drop" id="dropZone">
                                <input type="file" name="hero_background_image" accept="image/*" id="bgFile"
                                       onchange="previewBg(this)">
                                <div class="file-drop-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="file-drop-text">
                                    <strong>Klik untuk upload</strong> atau seret file ke sini
                                </div>
                                <div class="file-drop-hint">JPG, PNG, WEBP &ndash; maks 4MB</div>
                            </label>
                        </div>
                        <div class="col-md-5">
                            <label class="field-label">Preview Background</label>
                            @if(!empty($heroBackgroundImage))
                            <div class="img-preview-wrap" id="previewContainer">
                                <img src="{{ asset($heroBackgroundImage ?? 'images/home_kokiku.jpeg') }}" id="previewImg" alt="Hero Background">
                                <div class="img-preview-label">
                                    <i class="fa-solid fa-image me-1"></i> Background saat ini
                                </div>
                            </div>
                            @else
                            <div id="previewContainer" style="display:none;">
                                <div class="img-preview-wrap">
                                    <img src="" id="previewImg" alt="Preview">
                                    <div class="img-preview-label"><i class="fa-solid fa-image me-1"></i> Preview baru</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /tab-hero -->

        <!-- ══════ TAB: TENTANG KAMI ══════ -->
        <div class="tab-panel" id="tab-about">

            <!-- Judul About -->
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon gold"><i class="fa-solid fa-circle-info"></i></div>
                    <div class="section-card-header-text">
                        <h6>Judul Tentang Kami</h6>
                        <p>Heading bagian About di halaman utama</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="field-group">
                        <label class="field-label">Teks Judul</label>
                        <input type="text" name="about_title" class="dark-input"
                               value="{{ old('about_title', $aboutTitle) }}" required
                               placeholder="Contoh: Tentang KOKIKU">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="field-label">Warna</label>
                            <div class="color-wrap">
                                <input type="color" name="about_title_color" class="color-swatch"
                                       id="aboutTitleColor"
                                       value="{{ old('about_title_color', $aboutTitleColor) }}" required>
                                <span class="color-val-text" id="aboutTitleColorVal">{{ old('about_title_color', $aboutTitleColor) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ketebalan</label>
                            <select name="about_title_weight" class="dark-select" required>
                                @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('about_title_weight',$aboutTitleWeight)===$v?'selected':'' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ukuran Font</label>
                            <select name="about_title_size" class="dark-select" required>
                                @foreach(['28px','32px','36px','40px','44px'] as $s)
                                <option value="{{ $s }}" {{ old('about_title_size',$aboutTitleSize)===$s?'selected':'' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gaya Paragraf -->
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon blue"><i class="fa-solid fa-paragraph"></i></div>
                    <div class="section-card-header-text">
                        <h6>Gaya Paragraf</h6>
                        <p>Warna, ketebalan, dan ukuran teks paragraf</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="field-label">Warna</label>
                            <div class="color-wrap">
                                <input type="color" name="about_paragraph_color" class="color-swatch"
                                       id="aboutParaColor"
                                       value="{{ old('about_paragraph_color', $aboutParagraphColor) }}" required>
                                <span class="color-val-text" id="aboutParaColorVal">{{ old('about_paragraph_color', $aboutParagraphColor) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ketebalan</label>
                            <select name="about_paragraph_weight" class="dark-select" required>
                                @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('about_paragraph_weight',$aboutParagraphWeight)===$v?'selected':'' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label">Ukuran Font</label>
                            <select name="about_paragraph_size" class="dark-select" required>
                                @foreach(['16px','18px','20px','22px','24px'] as $s)
                                <option value="{{ $s }}" {{ old('about_paragraph_size',$aboutParagraphSize)===$s?'selected':'' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Paragraf -->
            <div class="section-card">
                <div class="section-card-header">
                    <div class="s-icon red"><i class="fa-solid fa-file-lines"></i></div>
                    <div class="section-card-header-text">
                        <h6>Konten Paragraf</h6>
                        <p>Isi paragraf pertama dan kedua bagian Tentang Kami</p>
                    </div>
                </div>
                <div class="section-card-body">
                    <div class="field-group">
                        <label class="field-label">Paragraf Pertama</label>
                        <textarea name="about_paragraph1" class="dark-textarea" rows="4" required
                                  placeholder="Tulis paragraf pertama...">{{ old('about_paragraph1', $aboutParagraph1) }}</textarea>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Paragraf Kedua</label>
                        <textarea name="about_paragraph2" class="dark-textarea" rows="4" required
                                  placeholder="Tulis paragraf kedua...">{{ old('about_paragraph2', $aboutParagraph2) }}</textarea>
                    </div>
                </div>
            </div>

        </div><!-- /tab-about -->

    </div><!-- /page-body -->

    <!-- SAVE BAR -->
    <div class="save-bar">
        <span class="save-bar-hint">
            <i class="fa-solid fa-circle-info"></i>
            Perubahan akan langsung tampil di website setelah disimpan
        </span>
        <a href="{{ url('/admin') }}" class="btn-ghost">Batal</a>
        <button type="submit" class="btn-save">
            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
        </button>
    </div>

    </form>
</div><!-- /main-content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const form = document.getElementById('settingsForm');
let autoSaveTimer = null;

function autoSaveSettings() {
    if (!form) return;

    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(() => {
        const formData = new FormData(form);
        fetch("{{ url('/admin/settings') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]')?.value || ''
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const hint = document.querySelector('.save-bar-hint');
                if (hint) {
                    hint.innerHTML = '<i class="fa-solid fa-circle-check"></i> Perubahan disimpan otomatis';
                }
            }
        })
        .catch(() => {
            const hint = document.querySelector('.save-bar-hint');
            if (hint) {
                hint.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Gagal menyimpan otomatis';
            }
        });
    }, 600);
}

// ── TAB SWITCHING ────────────────────────────────
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById(btn.dataset.tab).classList.add('active');
    });
});

// Color picker live value display
function bindColor(inputId, labelId) {
    const inp = document.getElementById(inputId);
    const lbl = document.getElementById(labelId);
    if (!inp || !lbl) return;
    lbl.textContent = inp.value;
    inp.addEventListener('input', () => lbl.textContent = inp.value);
}
bindColor('heroTitleColor',  'heroTitleColorVal');
bindColor('heroSubColor',    'heroSubColorVal');
bindColor('heroTextColor',   'heroTextColorVal');
bindColor('aboutTitleColor', 'aboutTitleColorVal');
bindColor('aboutParaColor',  'aboutParaColorVal');

// Sync color picker <-> hex text input + live preview
function syncColor(pickerId, hexId) {
    const picker = document.getElementById(pickerId);
    const hex    = document.getElementById(hexId);
    if (!picker || !hex) return;
    if (hex.value.match(/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/)) {
        picker.value = hex.value;
    }
}

function updateNavPreviews() {
    const bg   = document.getElementById('navLinkBgColor')?.value  || '#ffc107';
    const text = document.getElementById('navLinkColor')?.value    || '#000000';
    document.querySelectorAll('.nav-btn-preview').forEach(el => {
        el.style.background = bg;
        el.style.color      = text;
    });
}

function syncNavBgColor() {
    const hex    = document.getElementById('navLinkBgColorHex');
    const picker = document.getElementById('navLinkBgColor');
    if (hex && picker && hex.value.match(/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/)) {
        picker.value = hex.value;
    }
    updateNavPreviews();
}

function syncNavTextColor() {
    const hex    = document.getElementById('navLinkColorHex');
    const picker = document.getElementById('navLinkColor');
    if (hex && picker && hex.value.match(/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/)) {
        picker.value = hex.value;
    }
    updateNavPreviews();
}

// Bind nav pickers → sync hex + preview on input
['navLinkBgColor', 'navLinkColor'].forEach(id => {
    const picker = document.getElementById(id);
    if (!picker) return;
    const hexId = id + 'Hex';
    picker.addEventListener('input', () => {
        const hexEl = document.getElementById(hexId);
        if (hexEl) hexEl.value = picker.value;
        updateNavPreviews();
    });
});

// Apply preview styles from the server-rendered data attribute
document.querySelectorAll('.nav-btn-preview').forEach(el => {
    const style = el.getAttribute('data-preview-style');
    if (style) {
        el.setAttribute('style', style);
    }
});

// Auto-save on change for text, select, color, and textarea inputs
['input', 'change'].forEach(eventName => {
    form?.addEventListener(eventName, (event) => {
        const target = event.target;
        if (!target || target.tagName === 'BUTTON' || target.type === 'file') return;
        autoSaveSettings();
    });
});

// Image preview - background
function previewBg(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const container = document.getElementById('previewContainer');
        const img = document.getElementById('previewImg');
        img.src = e.target.result;
        container.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}

// Image preview - logo
function previewLogo(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img   = document.getElementById('logoPreviewImg');
        const label = document.querySelector('#logoPreviewContainer .logo-preview-label');
        img.src = e.target.result;
        if (label) label.innerHTML = '<i class="fa-solid fa-check-circle me-1" style="color:#4ade80;"></i>Logo baru (belum disimpan)';
    };
    reader.readAsDataURL(input.files[0]);
}
// ── SINKRON TEMA DARI DASHBOARD ─────────────────
(function(){
    const theme = localStorage.getItem('kokiku_theme') || 'dark';
    if (theme === 'light') document.body.classList.add('light');
})();
</script>
</body>
</html>
