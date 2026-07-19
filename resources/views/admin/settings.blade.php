@php use Illuminate\Support\Facades\Storage; use Illuminate\Support\Str; @endphp
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
    --red-glow: rgba(193,18,31,0.25);
    --gold:     #ffc107;
    --gold-dim: rgba(255,193,7,0.15);
    --bg:       #0b0b12;
    --surface:  #13131f;
    --surface2: #1a1a2e;
    --surface3: #21213a;
    --border:   rgba(255,255,255,0.07);
    --border2:  rgba(255,255,255,0.12);
    --text:     #f0f0f5;
    --muted:    rgba(255,255,255,0.38);
    --muted2:   rgba(255,255,255,0.6);
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
    width: 248px; height: 100vh;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    z-index: 100;
}
.sidebar-brand {
    padding: 20px 18px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 10px;
    background: linear-gradient(135deg, rgba(193,18,31,0.06), transparent);
}
.sidebar-brand .brand-logo {
    width: 40px; height: 40px; border-radius: 50%;
    overflow: hidden; flex-shrink: 0;
    border: 2px solid rgba(193,18,31,0.3);
    box-shadow: 0 0 16px rgba(193,18,31,0.2);
}
.sidebar-brand .brand-logo img { width:100%; height:100%; object-fit:cover; }
.sidebar-brand .brand-name {
    font-size: 21px; font-weight: 800;
    color: var(--gold); letter-spacing: 1.5px;
    text-shadow: 0 0 20px rgba(255,193,7,0.35);
}
.sidebar-nav { padding: 18px 12px; flex: 1; overflow-y: auto; }
.nav-label {
    font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1.5px;
    color: var(--muted); padding: 0 10px; margin-bottom: 10px;
}
.sidebar-link {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 14px; border-radius: 12px;
    color: var(--muted2); text-decoration: none;
    font-size: 14px; font-weight: 500;
    transition: all 0.25s; margin-bottom: 4px;
    position: relative;
}
.sidebar-link .s-icon {
    width: 34px; height: 34px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    background: rgba(255,255,255,0.05);
    transition: all 0.25s; flex-shrink: 0;
}
.sidebar-link:hover { background: rgba(193,18,31,0.12); color: #fff; }
.sidebar-link:hover .s-icon { background: rgba(193,18,31,0.25); color: #ff7a7a; }
.sidebar-link.active {
    background: linear-gradient(135deg, rgba(193,18,31,0.2), rgba(193,18,31,0.08));
    color: #fff; border: 1px solid rgba(193,18,31,0.2);
    box-shadow: 0 4px 18px rgba(193,18,31,0.12);
}
.sidebar-link.active .s-icon { background: rgba(193,18,31,0.3); color: #ff8080; box-shadow: 0 0 12px rgba(193,18,31,0.3); }
.sidebar-link.active::before {
    content: '';
    position: absolute; left: 0; top: 50%;
    transform: translateY(-50%);
    width: 3px; height: 60%;
    background: var(--red); border-radius: 0 4px 4px 0;
    box-shadow: 0 0 8px var(--red);
}

/* ── MAIN CONTENT ────────────────────────────── */
.main-content { margin-left: 248px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

/* ── TOPBAR ──────────────────────────────────── */
.topbar {
    background: rgba(11,11,18,0.95);
    backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--border);
    padding: 0 24px;
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 50; height: 64px;
}
.topbar-left { display: flex; align-items: center; gap: 12px; }
.topbar-heading .page-title { font-size: 17px; font-weight: 800; color: var(--text); line-height: 1.1; }
.topbar-heading .page-sub { font-size: 11px; color: var(--muted); margin-top: 1px; }
.topbar-badge {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(34,197,94,0.12);
    border: 1px solid rgba(34,197,94,0.3);
    color: #4ade80; border-radius: 20px;
    padding: 3px 10px; font-size: 11px; font-weight: 700;
}
.topbar-badge i { font-size: 7px; animation: blink 1.5s ease-in-out infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
.topbar-actions { display: flex; align-items: center; gap: 10px; }
.btn-ghost {
    background: rgba(255,255,255,0.06); color: var(--muted2);
    border: 1px solid var(--border2); border-radius: 10px;
    padding: 8px 16px; font-size: 13px; font-weight: 500;
    text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
    transition: all 0.25s; font-family: 'Outfit', sans-serif; cursor: pointer;
}
.btn-ghost:hover { background: rgba(255,255,255,0.1); color: #fff; }
.btn-save-main {
    background: linear-gradient(135deg, var(--red), var(--red-dark));
    color: #fff; border: none; border-radius: 10px;
    padding: 9px 20px; font-size: 13px; font-weight: 700;
    cursor: pointer; display: inline-flex; align-items: center; gap: 6px;
    font-family: 'Outfit', sans-serif; transition: all 0.25s;
    box-shadow: 0 4px 14px rgba(193,18,31,0.35);
}
.btn-save-main:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(193,18,31,0.45); }

/* ── SECTION NAV TABS ────────────────────────── */
.section-nav {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    padding: 0 24px;
    display: flex; gap: 2px; overflow-x: auto;
    scrollbar-width: none;
}
.section-nav::-webkit-scrollbar { display: none; }
.section-nav-btn {
    background: none; border: none; color: var(--muted);
    padding: 14px 16px; font-size: 13px; font-weight: 600;
    cursor: pointer; white-space: nowrap;
    display: flex; align-items: center; gap: 7px;
    border-bottom: 2px solid transparent;
    transition: all 0.2s; font-family: 'Outfit', sans-serif;
    position: relative; bottom: -1px;
}
.section-nav-btn:hover { color: var(--text); }
.section-nav-btn.active {
    color: var(--red); border-bottom-color: var(--red);
}
.section-nav-btn i { font-size: 12px; }

/* ── PAGE BODY ───────────────────────────────── */
.page-body { padding: 16px 20px; flex: 1; overflow-x: hidden; }

/* ── GRID LAYOUT ─────────────────────────────── */
.settings-row { display: grid; gap: 16px; margin-bottom: 16px; }
.settings-row.three-col { grid-template-columns: repeat(3, 1fr); }
.settings-row.two-col   { grid-template-columns: 1fr 1fr; }
.settings-row.full      { grid-template-columns: 1fr; }
.settings-row.four-col  { grid-template-columns: repeat(4, 1fr); }

/* ── SECTION BLOCK ───────────────────────────── */
.section-block {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    display: flex; flex-direction: column;
}
.section-block-header {
    padding: 14px 18px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    background: rgba(255,255,255,0.02);
    flex-shrink: 0;
}
.section-block-title {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: var(--text);
}
.section-block-title .num {
    width: 22px; height: 22px; border-radius: 6px;
    background: rgba(193,18,31,0.2); color: #ff8080;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 800; flex-shrink: 0;
}
.live-dot {
    display: none;
}
.section-block-body { padding: 16px; flex: 1; }

/* ── INPUTS ──────────────────────────────────── */
.field-label {
    font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.8px;
    color: var(--muted); margin-bottom: 6px; display: block;
}
.dark-input, .dark-textarea {
    width: 100%; background: rgba(255,255,255,0.05);
    border: 1px solid var(--border2); border-radius: 9px;
    color: var(--text); padding: 10px 12px;
    font-size: 13px; font-family: 'Outfit', sans-serif;
    transition: border-color 0.2s; outline: none;
}
.dark-input:focus, .dark-textarea:focus { border-color: rgba(193,18,31,0.5); }
.dark-textarea { resize: vertical; line-height: 1.5; }
.field-group { margin-bottom: 12px; }
.field-group:last-child { margin-bottom: 0; }

/* ── LOGO SECTION ────────────────────────────── */
.logo-display {
    display: flex; flex-direction: column; align-items: center;
    gap: 14px; padding: 8px 0;
}
.logo-img-wrap {
    width: 110px; height: 110px; border-radius: 16px;
    border: 2px solid var(--border2); overflow: hidden;
    display: flex; align-items: center; justify-content: center;
    background: rgba(255,255,255,0.04);
    position: relative;
}
.logo-img-wrap img { width: 90%; height: 90%; object-fit: contain; }
.logo-format-hint { font-size: 11px; color: var(--muted); text-align: center; }
.logo-btn-row { display: flex; gap: 8px; flex-wrap: wrap; justify-content: center; }
.btn-sm-action {
    display: inline-flex; align-items: center; gap: 5px;
    border-radius: 8px; padding: 6px 12px; font-size: 12px; font-weight: 600;
    cursor: pointer; font-family: 'Outfit', sans-serif;
    border: 1px solid; transition: all 0.2s; text-decoration: none;
}
.btn-sm-action.primary { background: rgba(193,18,31,0.15); color: #ff8080; border-color: rgba(193,18,31,0.3); }
.btn-sm-action.primary:hover { background: rgba(193,18,31,0.25); }
.btn-sm-action.danger  { background: rgba(220,53,69,0.1);  color: #ff7a7a; border-color: rgba(220,53,69,0.25); }
.btn-sm-action.danger:hover  { background: rgba(220,53,69,0.2); }
.btn-sm-action.muted   { background: rgba(255,255,255,0.05); color: var(--muted2); border-color: var(--border2); }
.btn-sm-action.muted:hover   { background: rgba(255,255,255,0.1); color: var(--text); }

/* ── HERO SECTION ────────────────────────────── */
.hero-preview-thumb {
    width: 100%; height: 120px; border-radius: 10px; overflow: hidden;
    position: relative; margin-bottom: 12px;
    background: #1a1a2e;
}
.hero-preview-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
.hero-preview-thumb .hero-overlay-text {
    position: absolute; inset: 0; background: rgba(0,0,0,0.5);
    display: flex; flex-direction: column; justify-content: flex-end;
    padding: 10px 12px;
}
.hero-overlay-text h6 { font-size: 13px; font-weight: 700; color: #fff; margin: 0 0 2px; }
.hero-overlay-text p  { font-size: 10px; color: rgba(255,255,255,0.7); margin: 0; }
.hero-thumb-action {
    position: absolute; top: 8px; right: 8px;
}
.btn-hero-change {
    background: rgba(193,18,31,0.85); color: #fff;
    border: none; border-radius: 7px; padding: 5px 10px;
    font-size: 11px; font-weight: 600; cursor: pointer;
    font-family: 'Outfit', sans-serif;
    display: inline-flex; align-items: center; gap: 4px;
    flex-shrink: 0;
    white-space: nowrap;
}
.field-inline { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
.field-inline label { font-size: 11px; color: var(--muted); white-space: nowrap; flex-shrink: 0; width: 60px; }
.field-inline .dark-input { margin: 0; }

/* ── ABOUT SECTION ───────────────────────────── */
.about-foto-row {
    display: flex; gap: 12px; align-items: flex-start;
    margin-bottom: 12px;
}
.about-foto-thumb {
    width: 70px; height: 70px; border-radius: 10px;
    overflow: hidden; flex-shrink: 0;
    border: 1px solid var(--border2);
}
.about-foto-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
.about-foto-btns { display: flex; flex-direction: column; gap: 6px; }

/* ── MENU TABLE ──────────────────────────────── */
.mgmt-table { width:100%; border-collapse:collapse; }
.mgmt-table thead tr { background: rgba(255,255,255,0.03); }
.mgmt-table thead th {
    padding: 10px 14px;
    font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .8px;
    color: var(--muted); border-bottom: 1px solid var(--border);
}
.mgmt-table tbody tr { border-bottom: 1px solid rgba(255,255,255,0.04); transition: background .15s; }
.mgmt-table tbody tr:last-child { border-bottom: none; }
.mgmt-table tbody tr:hover { background: rgba(255,255,255,0.025); }
.mgmt-table tbody td { padding: 10px 14px; font-size: 13px; vertical-align: middle; }
.row-num-sm {
    width: 24px; height: 24px; border-radius: 6px;
    background: rgba(255,255,255,0.05);
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 700; color: var(--muted);
}
.menu-thumb { width: 40px; height: 40px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border); }
.price-text { color: var(--gold); font-weight: 700; font-size: 13px; }
.btn-icon-sm {
    width: 28px; height: 28px; border-radius: 7px; border: none;
    cursor: pointer; display: inline-flex; align-items: center; justify-content: center;
    font-size: 12px; transition: all .2s;
}
.btn-icon-sm.edit { background: rgba(59,130,246,0.12); color: #60a5fa; }
.btn-icon-sm.edit:hover { background: rgba(59,130,246,0.25); }
.btn-icon-sm.del  { background: rgba(193,18,31,0.12); color: #ff7a7a; }
.btn-icon-sm.del:hover  { background: rgba(193,18,31,0.25); }
.btn-add-menu {
    background: linear-gradient(135deg, #c1121f, #780000);
    color: #fff; border: none; border-radius: 9px;
    padding: 7px 14px; font-size: 12px; font-weight: 700;
    cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 5px;
    font-family: 'Outfit', sans-serif;
    box-shadow: 0 3px 12px rgba(193,18,31,0.3);
    transition: all .25s;
    min-width: 152px;
}
.btn-add-menu:hover { transform: translateY(-1px); box-shadow: 0 5px 18px rgba(193,18,31,0.4); }

/* ── GALLERY GRID ────────────────────────────── */
.gallery-grid-sm {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
    gap: 8px;
    margin-bottom: 12px;
}
.gallery-thumb-sm {
    position: relative; border-radius: 9px;
    overflow: hidden; aspect-ratio: 1;
    border: 1px solid var(--border);
}
.gallery-thumb-sm img { width:100%; height:100%; object-fit:cover; display:block; }
.gallery-del-sm {
    position: absolute; top: 4px; right: 4px;
    width: 22px; height: 22px; border-radius: 5px;
    background: rgba(0,0,0,0.7); color: #ff7a7a;
    border: none; cursor: pointer; font-size: 10px;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity .2s;
}
.gallery-thumb-sm:hover .gallery-del-sm { opacity: 1; }
.gallery-drop-zone {
    border: 2px dashed var(--border2);
    border-radius: 10px; padding: 18px;
    text-align: center; cursor: pointer;
    transition: all .2s; color: var(--muted);
    font-size: 12px;
}
.gallery-drop-zone:hover { border-color: rgba(193,18,31,0.4); color: var(--muted2); }
.gallery-drop-zone i { font-size: 22px; margin-bottom: 6px; display: block; color: var(--red); }
.gallery-drop-zone strong { color: var(--gold); }

/* ── NAVIGASI ────────────────────────────────── */
.nav-item-row {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 0; border-bottom: 1px solid var(--border);
}
.nav-item-row:last-child { border-bottom: none; }
.nav-handle { color: var(--muted); cursor: grab; font-size: 14px; flex-shrink: 0; }
.nav-item-info { flex: 1; min-width: 0; }
.nav-item-name { font-size: 13px; font-weight: 700; }
.nav-item-url  { font-size: 11px; color: var(--muted); }
.nav-color-preview {
    display: flex; gap: 6px; align-items: center; flex-shrink: 0;
}
.nav-color-dot { width: 14px; height: 14px; border-radius: 50%; border: 2px solid var(--border2); }

/* ── FLASH ALERTS ────────────────────────────── */
.flash-alert {
    border-radius: 12px; padding: 12px 16px; font-size: 13px; font-weight: 500;
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px; border: 1px solid;
}
.flash-success { background: rgba(34,197,94,.08); border-color: rgba(34,197,94,.25); color: #4ade80; }
.flash-danger  { background: rgba(220,53,69,.08);  border-color: rgba(220,53,69,.25);  color: #ff7a7a; }

/* ── COLOR ROW ───────────────────────────────── */
.color-row { display: flex; align-items: center; gap: 8px; }
.color-row input[type=color] {
    width: 36px; height: 36px; border-radius: 8px;
    border: 1px solid var(--border2); cursor: pointer;
    padding: 2px; background: transparent;
}
.color-val-text {
    width: 90px; background: rgba(255,255,255,0.05);
    border: 1px solid var(--border2); border-radius: 8px;
    color: var(--text); padding: 7px 10px; font-size: 12px;
    font-family: 'Outfit', sans-serif; outline: none;
}
.nav-btn-preview {
    display: inline-flex; align-items: center; gap: 5px;
    border-radius: 50px; padding: 7px 14px; font-size: 12px;
    font-weight: 700; white-space: nowrap; flex-shrink: 0;
}

/* ── MODAL ───────────────────────────────────── */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.78);
    z-index: 1000; display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none; transition: opacity .25s;
}
.modal-overlay.open { opacity: 1; pointer-events: all; }
.modal-box {
    background: var(--surface2); border: 1px solid var(--border2);
    border-radius: 18px; padding: 26px; width: 100%; max-width: 500px;
    transform: translateY(20px); transition: transform .25s;
    max-height: 90vh; overflow-y: auto;
}
.modal-overlay.open .modal-box { transform: translateY(0); }
.modal-title { font-size: 16px; font-weight: 800; margin-bottom: 18px; }
.modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 18px; }
.btn-modal-cancel {
    background: rgba(255,255,255,.06); border: 1px solid var(--border2);
    color: var(--muted2); border-radius: 9px; padding: 8px 16px;
    font-size: 13px; cursor: pointer; font-family: 'Outfit', sans-serif;
}
.btn-modal-save {
    background: linear-gradient(135deg, #c1121f, #780000); color: #fff;
    border: none; border-radius: 9px; padding: 8px 20px;
    font-size: 13px; font-weight: 700; cursor: pointer;
    font-family: 'Outfit', sans-serif;
}

/* ── TEXT STYLE CONTROLS ─────────────────────── */
.text-style-bar {
    display: flex; flex-wrap: wrap; align-items: center;
    gap: 4px 8px;
    margin-top: 5px; margin-bottom: 8px;
    padding: 6px 9px;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border);
    border-radius: 8px;
}
.ts-label {
    font-size: 10px; font-weight: 700;
    color: var(--muted); white-space: nowrap;
    text-transform: uppercase; letter-spacing: .5px;
}
.ts-color {
    width: 22px; height: 22px; border-radius: 5px;
    border: 1px solid var(--border2); cursor: pointer;
    padding: 1px; background: transparent; flex-shrink: 0;
}
.ts-hex {
    width: 72px; min-width: 0;
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--border2); border-radius: 6px;
    color: var(--text); padding: 3px 6px; font-size: 11px;
    font-family: 'Outfit', sans-serif; outline: none;
}
.ts-weight {
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--border2); border-radius: 6px;
    color: var(--text); padding: 3px 5px; font-size: 11px;
    font-family: 'Outfit', sans-serif; outline: none; cursor: pointer;
}
/* Separator between warna and tebal groups */
.ts-sep { width: 1px; height: 16px; background: var(--border2); flex-shrink: 0; }
body.light .text-style-bar { background: #f7f9fc; }
body.light .ts-hex, body.light .ts-weight { background: #f0f2f8; border-color: rgba(0,0,0,.12); color: #1a1c2e; }

.s-icon-red   { background: rgba(193,18,31,0.18);  color: #ff8080; }
.s-icon-gold  { background: rgba(255,193,7,0.14);  color: var(--gold); }
.s-icon-blue  { background: rgba(59,130,246,0.14); color: #60a5fa; }
.s-icon-green { background: rgba(34,197,94,0.14);  color: #4ade80; }
.s-icon-orange{ background: rgba(249,115,22,0.14); color: #fb923c; }

/* ═══════════════ LIGHT MODE ═══════════════════ */
body.light {
    --bg: #f0f2f8;
    --surface: #ffffff;
    --surface2: #f4f6fb;
    --surface3: #e8ecf5;
    --border: rgba(0,0,0,0.07);
    --border2: rgba(0,0,0,0.13);
    --text: #1a1c2e;
    --muted: #8892a8;
    --muted2: #4a5068;
}
body.light .topbar { background: rgba(255,255,255,0.97); }
body.light .sidebar { background: #ffffff; border-right-color: rgba(0,0,0,0.08); }
body.light .sidebar-link { color: #4a5068; }
body.light .sidebar-link:hover { background: rgba(193,18,31,0.07); color: #1a1c2e; }
body.light .sidebar-link.active { background: linear-gradient(135deg, rgba(193,18,31,0.1), rgba(193,18,31,0.04)); color: #1a1c2e; border-color: rgba(193,18,31,0.15); }
body.light .section-nav { background: #ffffff; border-bottom-color: rgba(0,0,0,0.08); }
body.light .section-block { background: #ffffff; }
body.light .section-block-header { background: #fafbfc; }
body.light .dark-input, body.light .dark-textarea { background: #f4f6fb; border-color: rgba(0,0,0,.13); color: #1a1c2e; }
body.light .mgmt-table thead tr { background: #f7f9fc; }
body.light .mgmt-table thead th { color: #9298b0; }
body.light .mgmt-table tbody tr { border-bottom-color: rgba(0,0,0,0.05); }
body.light .mgmt-table tbody tr:hover { background: #f7f9fc; }
body.light .color-val-text { background: #f4f6fb; border-color: rgba(0,0,0,.13); color: #1a1c2e; }
body.light .modal-box { background: #ffffff; }
body.light .btn-ghost { background: #fff; color: #4a5068; border-color: rgba(0,0,0,0.12); }
body.light .btn-ghost:hover { background: var(--gold); color: #111; border-color: var(--gold); }
body.light .gallery-drop-zone { border-color: rgba(0,0,0,.15); }
body.light .logo-img-wrap { background: #f4f6fb; }
body.light .row-num-sm { background: #f0f2f8; }
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

        <!-- ═══ ROW 1: Logo | Hero | Tentang Kami ═══ -->
        <div class="settings-row three-col">

            <!-- Kolom 1: Logo + Menu Minuman -->
            <div style="display:flex; flex-direction:column; gap:16px;">

                <!-- 1. Logo Website (compact) -->
                <div class="section-block" id="section-logo">
                    <div class="section-block-header">
                        <div class="section-block-title">
                            <span class="num">1</span>
                            Logo Website
                            <span class="live-dot"></span>
                        </div>
                        <label class="btn-hero-change" style="cursor:pointer;">
                            <i class="fa-solid fa-camera"></i> Ganti Logo
                            <input type="file" name="logo_image" id="logoFile" accept="image/*" style="display:none;" onchange="previewLogo(this)">
                        </label>
                    </div>
                    <div class="section-block-body">
                        <div style="display:flex; align-items:center; gap:14px;">
                            <div id="logoPreviewWrap" style="width:72px; height:72px; border-radius:12px; border:2px solid var(--border2); overflow:hidden; flex-shrink:0; background:rgba(255,255,255,0.04); display:flex; align-items:center; justify-content:center;">
                                <img src="{{ $logoUrl ?? asset('images/logo_kokiku.png') }}" id="logoPreviewImg" alt="Logo" style="width:90%; height:90%; object-fit:contain;">
                            </div>
                            <div style="flex:1; min-width:0;">
                                <div style="font-size:12px; font-weight:600; color:var(--text); margin-bottom:4px;">Logo Saat Ini</div>
                                <div style="font-size:10px; color:var(--muted);">Format: PNG, JPG, SVG<br>Maks. 2MB</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 7. Menu Minuman -->
                <div class="section-block" id="section-menu-minuman" style="flex:1;">
                    <div class="section-block-header">
                        <div class="section-block-title">
                            <span class="num" style="background:rgba(34,197,94,0.18);color:#4ade80;">4</span>
                            Menu Minuman
                            <span class="live-dot"></span>
                        </div>
                        <button type="button" class="btn-add-menu" onclick="openDrinkModal()">
                            <i class="fa-solid fa-plus"></i> Tambah Minuman
                        </button>
                    </div>
                    <div class="section-block-body" style="padding:0;">
                        <table class="mgmt-table">
                            <thead>
                                <tr>
                                    <th style="width:36px;">No</th>
                                    <th style="width:48px;">Foto</th>
                                    <th>Nama Minuman</th>
                                    <th>Harga</th>
                                    <th style="width:70px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="drinkTableBody">
                            @forelse($drinkItems ?? [] as $drink)
                                <tr id="drink-row-{{ $drink->id }}">
                                    <td><span class="row-num-sm">{{ $loop->iteration }}</span></td>
                                    <td>
                                        <img src="{{ $drink->imageUrl }}" alt="{{ $drink->name }}" class="menu-thumb">
                                    </td>
                                    <td style="font-weight:600;">{{ $drink->name }}</td>
                                    <td class="price-text">{{ $drink->formattedPrice }}</td>
                                    <td>
                                        <div style="display:flex;gap:5px;">
                                            <button type="button" class="btn-icon-sm edit"
                                                    onclick="editDrink({{ $drink->id }}, '{{ addslashes($drink->name) }}', '{{ addslashes($drink->price) }}', '{{ addslashes($drink->description) }}', '{{ $drink->imageUrl }}')">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button type="button" class="btn-icon-sm del"
                                                    onclick="deleteDrink({{ $drink->id }}, '{{ addslashes($drink->name) }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="drink-empty-row">
                                    <td colspan="5" style="text-align:center;padding:28px;color:var(--muted);">
                                        <i class="fa-solid fa-cup-straw" style="font-size:24px;display:block;margin-bottom:6px;"></i>
                                        Belum ada minuman. Klik <strong>Tambah Minuman</strong>.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- /kolom 1 -->

            <!-- 2. Hero Banner -->
            <div class="section-block" id="section-hero">
                <div class="section-block-header">
                    <div class="section-block-title">
                        <span class="num">2</span>
                        Hero Banner (Beranda)
                        <span class="live-dot"></span>
                    </div>
                    <label class="btn-hero-change">
                        <i class="fa-solid fa-camera"></i> Ganti Foto
                        <input type="file" name="hero_background_image" accept="image/*" style="display:none;" onchange="previewHeroBg(this)">
                    </label>
                </div>
                <div class="section-block-body">
                    @php
                        $heroImg = $heroBackgroundImage ?? 'images/home_kokiku.jpeg';
                        $heroBgUrl = str_starts_with($heroImg, 'http') ? $heroImg : asset($heroImg);
                    @endphp
                    <div class="hero-preview-thumb" id="heroPreviewWrap">
                        <img src="{{ $heroBgUrl }}" id="heroPreviewImg" alt="Hero">
                        <div class="hero-overlay-text">
                            <h6>{{ Str::limit($heroTitle ?? 'SELAMAT DATANG', 30) }}</h6>
                            <p>{{ Str::limit($heroSubtitle ?? 'Moslem Chinese Foods Halal', 35) }}</p>
                        </div>
                    </div>

                    <div class="field-group" style="margin-bottom:4px;">
                        <label class="field-label" style="display:flex;align-items:center;gap:5px;">
                            Judul
                        </label>
                        <input type="text" class="dark-input" name="hero_title"
                               value="{{ old('hero_title', $heroTitle) }}" required>
                        <div class="text-style-bar">
                            <span class="ts-label">Warna:</span>
                            <input type="color" class="ts-color" id="htc_pick"
                                   value="{{ old('hero_title_color', $heroTitleColor ?? '#ffffff') }}"
                                   oninput="syncTs('htc_pick','htc_hex')">
                            <input type="text"  class="ts-hex" id="htc_hex"
                                   name="hero_title_color"
                                   value="{{ old('hero_title_color', $heroTitleColor ?? '#ffffff') }}"
                                   oninput="syncTsHex('htc_hex','htc_pick')">
                            <span class="ts-label" style="margin-left:4px;">Tebal:</span>
                            <select class="ts-weight" name="hero_title_weight">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ old('hero_title_weight',$heroTitleWeight??'700') == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field-group" style="margin-bottom:4px;">
                        <label class="field-label">Subjudul</label>
                        <input type="text" class="dark-input" name="hero_subtitle"
                               value="{{ old('hero_subtitle', $heroSubtitle) }}" required>
                        <div class="text-style-bar">
                            <span class="ts-label">Warna:</span>
                            <input type="color" class="ts-color" id="hsc_pick"
                                   value="{{ old('hero_subtitle_color', $heroSubtitleColor ?? '#ffffff') }}"
                                   oninput="syncTs('hsc_pick','hsc_hex')">
                            <input type="text"  class="ts-hex" id="hsc_hex"
                                   name="hero_subtitle_color"
                                   value="{{ old('hero_subtitle_color', $heroSubtitleColor ?? '#ffffff') }}"
                                   oninput="syncTsHex('hsc_hex','hsc_pick')">
                            <span class="ts-label" style="margin-left:4px;">Tebal:</span>
                            <select class="ts-weight" name="hero_subtitle_weight">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ old('hero_subtitle_weight',$heroSubtitleWeight??'500') == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field-group" style="margin-bottom:0;">
                        <label class="field-label">Deskripsi</label>
                        <textarea class="dark-textarea" name="hero_text" rows="2" required>{{ old('hero_text', $heroText) }}</textarea>
                        <div class="text-style-bar">
                            <span class="ts-label">Warna:</span>
                            <input type="color" class="ts-color" id="htxc_pick"
                                   value="{{ old('hero_text_color', $heroTextColor ?? '#ffffff') }}"
                                   oninput="syncTs('htxc_pick','htxc_hex')">
                            <input type="text"  class="ts-hex" id="htxc_hex"
                                   name="hero_text_color"
                                   value="{{ old('hero_text_color', $heroTextColor ?? '#ffffff') }}"
                                   oninput="syncTsHex('htxc_hex','htxc_pick')">
                            <span class="ts-label" style="margin-left:4px;">Tebal:</span>
                            <select class="ts-weight" name="hero_text_weight">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ old('hero_text_weight',$heroTextWeight??'400') == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- size hidden (unchanged) --}}
                    <input type="hidden" name="hero_title_size"    value="{{ old('hero_title_size',    $heroTitleSize    ?? '56px') }}">
                    <input type="hidden" name="hero_subtitle_size" value="{{ old('hero_subtitle_size', $heroSubtitleSize ?? '28px') }}">
                    <input type="hidden" name="hero_text_size"     value="{{ old('hero_text_size',     $heroTextSize     ?? '20px') }}">
                </div>
            </div>

            <!-- 3. Tentang Kami -->
            <div class="section-block" id="section-about">
                <div class="section-block-header">
                    <div class="section-block-title">
                        <span class="num">3</span>
                        Tentang Kami
                        <span class="live-dot"></span>
                    </div>
                    <label class="btn-hero-change" style="cursor:pointer;">
                        <i class="fa-solid fa-camera"></i> Ganti Foto
                        <input type="file" name="about_image" id="aboutFile" accept="image/*" style="display:none;" onchange="previewAbout(this)">
                    </label>
                </div>
                <div class="section-block-body">
                    @php
                        $aImgPath = \App\Models\Setting::get('about_image_path');
                        $aImgUrl  = ($aImgPath && Storage::disk('public')->exists($aImgPath))
                            ? Storage::disk('public')->url($aImgPath)
                            : 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=400&q=60';
                    @endphp
                    <div style="margin-bottom:12px;border-radius:10px;overflow:hidden;">
                        <img src="{{ $aImgUrl }}" id="aboutPreviewImg" alt="Foto Tentang Kami"
                             style="width:100%;height:110px;object-fit:cover;display:block;">
                    </div>
                    <div style="font-size:10px;color:var(--muted);margin-bottom:10px;">Format: JPG, PNG (Maks. 2MB)</div>

                    <div class="field-group" style="margin-bottom:4px;">
                        <label class="field-label">Judul</label>
                        <input type="text" class="dark-input" name="about_title"
                               value="{{ old('about_title', $aboutTitle) }}" required>
                        <div class="text-style-bar">
                            <span class="ts-label">Warna:</span>
                            <input type="color" class="ts-color" id="atc_pick"
                                   value="{{ old('about_title_color', $aboutTitleColor ?? '#111111') }}"
                                   oninput="syncTs('atc_pick','atc_hex')">
                            <input type="text"  class="ts-hex" id="atc_hex"
                                   name="about_title_color"
                                   value="{{ old('about_title_color', $aboutTitleColor ?? '#111111') }}"
                                   oninput="syncTsHex('atc_hex','atc_pick')">
                            <span class="ts-label" style="margin-left:4px;">Tebal:</span>
                            <select class="ts-weight" name="about_title_weight">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ old('about_title_weight',$aboutTitleWeight??'700') == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field-group" style="margin-bottom:4px;">
                        <label class="field-label">Paragraf 1</label>
                        <textarea class="dark-textarea" name="about_paragraph1" rows="2" required>{{ old('about_paragraph1', $aboutParagraph1) }}</textarea>
                        <div class="text-style-bar">
                            <span class="ts-label">Warna:</span>
                            <input type="color" class="ts-color" id="apc_pick"
                                   value="{{ old('about_paragraph_color', $aboutParagraphColor ?? '#333333') }}"
                                   oninput="syncTs('apc_pick','apc_hex')">
                            <input type="text"  class="ts-hex" id="apc_hex"
                                   name="about_paragraph_color"
                                   value="{{ old('about_paragraph_color', $aboutParagraphColor ?? '#333333') }}"
                                   oninput="syncTsHex('apc_hex','apc_pick')">
                            <span class="ts-label" style="margin-left:4px;">Tebal:</span>
                            <select class="ts-weight" name="about_paragraph_weight">
                                @foreach([300,400,500,600,700,800,900] as $w)
                                <option value="{{ $w }}" {{ old('about_paragraph_weight',$aboutParagraphWeight??'400') == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field-group" style="margin-bottom:0;">
                        <label class="field-label">Paragraf 2</label>
                        <textarea class="dark-textarea" name="about_paragraph2" rows="2" required>{{ old('about_paragraph2', $aboutParagraph2) }}</textarea>
                        {{-- Paragraf 2 uses same style as paragraf 1 --}}
                    </div>

                    {{-- size hidden (unchanged) --}}
                    <input type="hidden" name="about_title_size"      value="{{ old('about_title_size',     $aboutTitleSize     ?? '36px') }}">
                    <input type="hidden" name="about_paragraph_size"  value="{{ old('about_paragraph_size', $aboutParagraphSize ?? '16px') }}">

                </div><!-- /section-block-body about -->
            </div><!-- /section-block about -->

        </div><!-- /row 1 -->

        <!-- ═══ ROW 2: Menu | Gallery | Nav ═══ -->
        <div class="settings-row three-col">

            <!-- 4. Menu Makanan -->
            <div class="section-block" id="section-menu">
                <div class="section-block-header">
                    <div class="section-block-title">
                        <span class="num" style="background:rgba(249,115,22,0.18);color:#fb923c;">5</span>
                        Menu Makanan
                        <span class="live-dot"></span>
                    </div>
                    <button type="button" class="btn-add-menu" onclick="openMenuModal()">
                        <i class="fa-solid fa-plus"></i> Tambah Menu
                    </button>
                </div>
                <div class="section-block-body" style="padding:0;">
                    <table class="mgmt-table">
                        <thead>
                            <tr>
                                <th style="width:36px;">No</th>
                                <th style="width:48px;">Foto</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th style="width:70px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="menuTableBody">
                        @forelse($menuItems as $item)
                            <tr id="menu-row-{{ $item->id }}">
                                <td><span class="row-num-sm">{{ $loop->iteration }}</span></td>
                                <td>
                                    <img src="{{ $item->imageUrl }}" alt="{{ $item->name }}" class="menu-thumb">
                                </td>
                                <td style="font-weight:600;">{{ $item->name }}</td>
                                <td class="price-text">{{ $item->formattedPrice }}</td>
                                <td>
                                    <div style="display:flex;gap:5px;">
                                        <button type="button" class="btn-icon-sm edit"
                                                onclick="editMenu({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->price) }}', '{{ addslashes($item->description) }}', '{{ $item->imageUrl }}')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn-icon-sm del"
                                                onclick="deleteMenu({{ $item->id }}, '{{ addslashes($item->name) }}')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="menu-empty-row">
                                <td colspan="5" style="text-align:center;padding:28px;color:var(--muted);">
                                    <i class="fa-solid fa-bowl-food" style="font-size:24px;display:block;margin-bottom:6px;"></i>
                                    Belum ada menu. Klik <strong>Tambah Menu</strong>.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 5. Galeri -->
            <div class="section-block" id="section-gallery">
                <div class="section-block-header">
                    <div class="section-block-title">
                        <span class="num" style="background:rgba(59,130,246,0.18);color:#60a5fa;">6</span>
                        Galeri Foto Resto
                        <span class="live-dot"></span>
                    </div>
                    <label class="btn-hero-change" style="cursor:pointer;" onclick="document.getElementById('galleryUploadInput').click()">
                        <i class="fa-solid fa-camera"></i> Upload Foto
                    </label>
                    <input type="file" id="galleryUploadInput" multiple accept="image/*"
                           style="display:none;" onchange="uploadGallery(this)">
                </div>
                <div class="section-block-body">
                    <div class="gallery-grid-sm" id="galleryGrid">
                        @forelse($galleryItems as $gItem)
                            <div class="gallery-thumb-sm" id="gallery-item-{{ $gItem->id }}">
                                <img src="{{ $gItem->imageUrl }}" alt="Galeri">
                                <button type="button" class="gallery-del-sm"
                                        onclick="deleteGallery({{ $gItem->id }})">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <label class="gallery-drop-zone" for="galleryUploadInput">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <strong>Drag & Drop</strong> foto di sini atau klik untuk upload<br>
                        <span style="font-size:10px;">Format: JPG, PNG (Maks. 2MB)</span>
                    </label>
                </div>
            </div>

            <!-- 6. Navigasi / Warna Tombol -->
            <div class="section-block" id="section-nav">
                <div class="section-block-header">
                    <div class="section-block-title">
                        <span class="num" style="background:rgba(168,85,247,0.18);color:#c084fc;">7</span>
                        Navigasi / Warna Tombol
                        <span class="live-dot"></span>
                    </div>
                </div>
                <div class="section-block-body">
                    <div class="d-flex flex-column gap-3">
                        <div>
                            <label class="field-label">Warna Background Tombol</label>
                            <div class="color-row">
                                <input type="color" id="navBgPicker" name="nav_link_bg_color"
                                       value="{{ $navLinkBgColor ?? '#ffc107' }}"
                                       oninput="syncNavColor('navBgPicker','navBgHex'); updateNavPreview();">
                                <input type="text" class="color-val-text" id="navBgHex"
                                       value="{{ $navLinkBgColor ?? '#ffc107' }}"
                                       oninput="syncNavHex('navBgHex','navBgPicker'); updateNavPreview();">
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Warna Teks Tombol</label>
                            <div class="color-row">
                                <input type="color" id="navTextPicker" name="nav_link_color"
                                       value="{{ $navLinkColor ?? '#000000' }}"
                                       oninput="syncNavColor('navTextPicker','navTextHex'); updateNavPreview();">
                                <input type="text" class="color-val-text" id="navTextHex"
                                       value="{{ $navLinkColor ?? '#000000' }}"
                                       oninput="syncNavHex('navTextHex','navTextPicker'); updateNavPreview();">
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Preview Tombol</label>
                            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                @foreach(['Tentang','Menu','Galeri','Kontak'] as $lbl)
                                <span class="nav-btn-preview" id="navPreviewBtn"
                                      style="background:{{ $navLinkBgColor ?? '#ffc107' }};color:{{ $navLinkColor ?? '#000000' }};">
                                    {{ $lbl }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /row 2 -->

        <!-- Simpan Bar -->
        <div class="d-flex justify-content-between align-items-center"
             style="background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:14px;padding:14px 20px;margin-top:4px;">
            <span style="font-size:12px;color:var(--muted);">
                <i class="fa-solid fa-circle-info me-1"></i>
                Perubahan akan langsung tampil di website setelah disimpan
            </span>
            <div style="display:flex;gap:10px;">
                <a href="{{ url('/admin') }}" class="btn-ghost">Batal</a>
                <button type="submit" class="btn-save-main">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
                </button>
            </div>
        </div>

    </div><!-- /page-body -->
    </form>

</div><!-- /main-content -->

<!-- ══════ MENU MODAL ══════ -->
<div class="modal-overlay" id="menuModalOverlay">
    <div class="modal-box">
        <div class="modal-title" id="menuModalTitle">Tambah Menu Baru</div>
        <input type="hidden" id="menuModalId">

        <div class="field-group">
            <label class="field-label">Foto Menu</label>
            <div style="display:flex;align-items:center;gap:14px;">
                <img id="menuModalImgPreview" src="{{ asset('images/logo_kokiku.png') }}"
                     style="width:60px;height:60px;object-fit:cover;border-radius:9px;border:1px solid var(--border);" alt="">
                <label class="btn-sm-action muted" style="cursor:pointer;">
                    <i class="fa-solid fa-upload"></i> Pilih Foto
                    <input type="file" id="menuModalImg" accept="image/*" style="display:none;" onchange="previewMenuImg(this)">
                </label>
            </div>
        </div>
        <div class="field-group">
            <label class="field-label">Nama Menu *</label>
            <input type="text" class="dark-input" id="menuModalName" placeholder="cth: Nasi Goreng Spesial">
        </div>
        <div class="field-group">
            <label class="field-label">Harga</label>
            <input type="text" class="dark-input" id="menuModalPrice" placeholder="cth: 25000">
        </div>
        <div class="field-group">
            <label class="field-label">Deskripsi</label>
            <textarea class="dark-textarea" id="menuModalDesc" rows="2" placeholder="Deskripsi singkat..."></textarea>
        </div>
        <div id="menuModalError" style="color:#ff7a7a;font-size:12px;margin-top:6px;display:none;"></div>
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

        <div class="field-group">
            <label class="field-label">Foto Minuman</label>
            <div style="display:flex;align-items:center;gap:14px;">
                <img id="drinkModalImgPreview" src="{{ asset('images/logo_kokiku.png') }}"
                     style="width:60px;height:60px;object-fit:cover;border-radius:9px;border:1px solid var(--border);" alt="">
                <label class="btn-sm-action muted" style="cursor:pointer;">
                    <i class="fa-solid fa-upload"></i> Pilih Foto
                    <input type="file" id="drinkModalImg" accept="image/*" style="display:none;" onchange="previewDrinkImg(this)">
                </label>
            </div>
        </div>
        <div class="field-group">
            <label class="field-label">Nama Minuman *</label>
            <input type="text" class="dark-input" id="drinkModalName" placeholder="cth: Es Teh Manis">
        </div>
        <div class="field-group">
            <label class="field-label">Harga</label>
            <input type="text" class="dark-input" id="drinkModalPrice" placeholder="cth: 10000">
        </div>
        <div class="field-group">
            <label class="field-label">Deskripsi</label>
            <textarea class="dark-textarea" id="drinkModalDesc" rows="2" placeholder="Deskripsi singkat..."></textarea>
        </div>
        <div id="drinkModalError" style="color:#ff7a7a;font-size:12px;margin-top:6px;display:none;"></div>
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

// ── TEMA SYNC ──────────────────────────────────────
(function(){
    const theme = localStorage.getItem('kokiku_theme') || 'dark';
    if (theme === 'light') document.body.classList.add('light');
})();

// ── SECTION NAV (scroll to section) ───────────────
document.querySelectorAll('.section-nav-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.section-nav-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const el = document.getElementById(btn.dataset.section);
        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});

// ── LOGO PREVIEW ───────────────────────────────────
function previewLogo(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('logoPreviewImg').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}

// ── HERO BG PREVIEW ────────────────────────────────
function previewHeroBg(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('heroPreviewImg').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}

// ── ABOUT PREVIEW ──────────────────────────────────
function previewAbout(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('aboutPreviewImg').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}

// ── NAVIGASI COLOR SYNC ────────────────────────────
function syncNavColor(pickerId, hexId) {
    const v = document.getElementById(pickerId).value;
    document.getElementById(hexId).value = v;
}
function syncNavHex(hexId, pickerId) {
    const v = document.getElementById(hexId).value;
    if (/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/.test(v))
        document.getElementById(pickerId).value = v;
}

// ── TEXT STYLE (warna & ketebalan) SYNC ───────────
function syncTs(pickerId, hexId) {
    const v = document.getElementById(pickerId).value;
    document.getElementById(hexId).value = v;
}
function syncTsHex(hexId, pickerId) {
    const v = document.getElementById(hexId).value;
    if (/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/.test(v))
        document.getElementById(pickerId).value = v;
}
function updateNavPreview() {
    const bg   = document.getElementById('navBgPicker').value   || '#ffc107';
    const text = document.getElementById('navTextPicker').value || '#000000';
    document.querySelectorAll('.nav-btn-preview').forEach(el => {
        el.style.background = bg;
        el.style.color      = text;
    });
}

// ── TOAST ──────────────────────────────────────────
function showToast(msg, ok=true) {
    const t = document.createElement('div');
    t.textContent = msg;
    Object.assign(t.style, {
        position:'fixed', bottom:'24px', right:'24px', zIndex:'9999',
        background: ok ? '#22c55e' : '#c1121f', color:'#fff',
        padding:'11px 18px', borderRadius:'11px',
        fontFamily:'Outfit,sans-serif', fontWeight:'600', fontSize:'13px',
        boxShadow:'0 6px 22px rgba(0,0,0,0.35)', opacity:'0',
        transition:'opacity .2s'
    });
    document.body.appendChild(t);
    requestAnimationFrame(() => t.style.opacity = '1');
    setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 300); }, 2600);
}

// ── MENU MODAL ─────────────────────────────────────
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

// ── GALLERY ────────────────────────────────────────
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

// ── DRINK MODAL ────────────────────────────────────
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

async function deleteDrink(id, name) {
    if (!confirm(`Yakin ingin menghapus "${name}"?`)) return;
    const fd = new FormData(); fd.append('_token', CSRF);
    const res  = await fetch(`/admin/drink/${id}/delete`, { method:'POST', headers:{'X-Requested-With':'XMLHttpRequest'}, body:fd });
    const json = await res.json();
    if (json.success) { document.getElementById(`drink-row-${id}`)?.remove(); showToast(json.message); }
    else showToast(json.message || 'Gagal menghapus.', false);
}
</script>
</body>
</html>
