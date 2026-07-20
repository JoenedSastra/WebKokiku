@php use Illuminate\Support\Facades\Storage; use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Orderan Resto – KOKIKU Admin</title>
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
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--green); flex-shrink: 0;
    box-shadow: 0 0 6px var(--green);
    animation: blink 1.5s ease-in-out infinite;
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
    cursor: pointer; display: inline-flex; align-items: center; gap: 5px;
    font-family: 'Outfit', sans-serif;
    box-shadow: 0 3px 12px rgba(193,18,31,0.3);
    transition: all .25s;
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

        <a href="{{ url('/admin/menu-drink') }}" class="sidebar-link">
            <div class="s-icon"><i class="fa-solid fa-utensils"></i></div>
            Menu dan Minuman
        </a>

        <a href="{{ url('/admin/orders') }}" class="sidebar-link active">
            <div class="s-icon"><i class="fa-solid fa-receipt"></i></div>
            Orderan Resto
        </a>

        <a href="{{ url('/admin/settings') }}" class="sidebar-link">
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
                <div class="page-title">Orderan Resto</div>
                <div class="page-sub">Kelola pesanan pelanggan resto Anda</div>
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



    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="page-body">

        @if(session('success'))
        <div class="flash-alert flash-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flash-alert flash-danger">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
        @endif

        <div class="settings-row full">
            <div class="section-block">
                <div class="section-block-header">
                    <div class="section-block-title">
                        <span class="num" style="background:rgba(193,18,31,0.2);color:#ff8080;">
                            <i class="fa-solid fa-receipt"></i>
                        </span>
                        Daftar Order
                        <span class="live-dot"></span>
                    </div>
                    <button type="button" class="btn-add-menu" onclick="openOrderModal()">
                        <i class="fa-solid fa-plus"></i> Tambah Order
                    </button>
                </div>
                <div class="section-block-body" style="padding:0;">
                    <table class="mgmt-table">
                        <thead>
                            <tr>
                                <th style="width:36px;">No</th>
                                <th>Pelanggan</th>
                                <th style="width:80px;">Meja</th>
                                <th>Item</th>
                                <th style="width:110px;">Total</th>
                                <th style="width:130px;">Status</th>
                                <th style="width:80px;">Waktu</th>
                                <th style="width:60px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                        @forelse($orders as $order)
                            <tr id="order-row-{{ $order->id }}">
                                <td><span class="row-num-sm">{{ $loop->iteration }}</span></td>
                                <td>
                                    <div style="font-weight:600;">{{ $order->customer_name }}</div>
                                    @if($order->phone)
                                        <div style="font-size:11px;color:var(--muted);">{{ $order->phone }}</div>
                                    @endif
                                </td>
                                <td>{{ $order->table_number ?: '-' }}</td>
                                <td style="max-width:260px;">
                                    <div style="font-size:12px;line-height:1.6;">
                                        @foreach($order->items as $line)
                                            <div>{{ $line->qty }}× {{ $line->item_name }}</div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="price-text">{{ $order->formattedTotal }}</td>
                                <td>
                                    <select class="ts-weight" style="width:100%;color:{{ $order->statusColor }};font-weight:700;"
                                            onchange="updateOrderStatus({{ $order->id }}, this.value)">
                                        @foreach(['menunggu'=>'Menunggu','diproses'=>'Diproses','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'] as $val => $label)
                                            <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="font-size:11px;color:var(--muted);">{{ $order->created_at->format('d/m H:i') }}</td>
                                <td>
                                    <button type="button" class="btn-icon-sm del" onclick="deleteOrder({{ $order->id }}, '{{ addslashes($order->customer_name) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr id="order-empty-row">
                                <td colspan="8" style="text-align:center;padding:28px;color:var(--muted);">
                                    <i class="fa-solid fa-receipt" style="font-size:24px;display:block;margin-bottom:6px;"></i>
                                    Belum ada order. Klik <strong>Tambah Order</strong>.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /row -->

    </div><!-- /page-body -->

</div><!-- /main-content -->

<!-- ══════ ORDER MODAL ══════ -->
<div class="modal-overlay" id="orderModalOverlay">
    <div class="modal-box" style="max-width:560px;">
        <div class="modal-title">Tambah Order Baru</div>

        <div class="field-group">
            <label class="field-label">Nama Pelanggan *</label>
            <input type="text" class="dark-input" id="orderCustomerName" placeholder="cth: Budi Santoso">
        </div>
        <div style="display:flex;gap:10px;">
            <div class="field-group" style="flex:1;">
                <label class="field-label">No. Meja</label>
                <input type="text" class="dark-input" id="orderTableNumber" placeholder="cth: 4">
            </div>
            <div class="field-group" style="flex:1;">
                <label class="field-label">No. HP</label>
                <input type="text" class="dark-input" id="orderPhone" placeholder="cth: 0812xxxxxxx">
            </div>
        </div>

        <div class="field-group">
            <label class="field-label">Pilih Menu &amp; Minuman</label>
            <div style="max-height:220px;overflow-y:auto;border:1px solid var(--border2);border-radius:9px;padding:8px;">
                @foreach($menuItems as $m)
                <div style="display:flex;align-items:center;gap:8px;padding:5px 2px;">
                    <input type="checkbox" class="order-item-check" data-type="menu" data-id="{{ $m->id }}" data-name="{{ addslashes($m->name) }}" data-price="{{ (int) preg_replace('/[^0-9]/','',(string) $m->price) }}" onchange="toggleOrderQty(this)">
                    <span style="flex:1;font-size:13px;">{{ $m->name }} <span style="color:var(--muted);">({{ $m->formattedPrice }})</span></span>
                    <input type="number" min="1" max="99" value="1" class="dark-input order-item-qty" style="width:56px;padding:4px 6px;display:none;" data-type="menu" data-id="{{ $m->id }}">
                </div>
                @endforeach
                @foreach($drinkItems as $d)
                <div style="display:flex;align-items:center;gap:8px;padding:5px 2px;">
                    <input type="checkbox" class="order-item-check" data-type="drink" data-id="{{ $d->id }}" data-name="{{ addslashes($d->name) }}" data-price="{{ (int) preg_replace('/[^0-9]/','',(string) $d->price) }}" onchange="toggleOrderQty(this)">
                    <span style="flex:1;font-size:13px;">{{ $d->name }} <span style="color:var(--muted);">({{ $d->formattedPrice }})</span></span>
                    <input type="number" min="1" max="99" value="1" class="dark-input order-item-qty" style="width:56px;padding:4px 6px;display:none;" data-type="drink" data-id="{{ $d->id }}">
                </div>
                @endforeach
                @if($menuItems->isEmpty() && $drinkItems->isEmpty())
                <div style="color:var(--muted);font-size:12px;padding:8px 2px;">Belum ada menu/minuman. Tambahkan dulu di halaman <strong>Menu dan Minuman</strong>.</div>
                @endif
            </div>
        </div>

        <div class="field-group">
            <label class="field-label">Catatan</label>
            <textarea class="dark-textarea" id="orderNotes" rows="2" placeholder="cth: Pedas sedang, tanpa es..."></textarea>
        </div>

        <div id="orderModalError" style="color:#ff7a7a;font-size:12px;margin-top:6px;display:none;"></div>
        <div class="modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeOrderModal()">Batal</button>
            <button type="button" class="btn-modal-save" onclick="submitOrder()">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Order
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

// ── ORDER MODAL ─────────────────────────────────────
function openOrderModal() {
    document.getElementById('orderCustomerName').value = '';
    document.getElementById('orderTableNumber').value  = '';
    document.getElementById('orderPhone').value        = '';
    document.getElementById('orderNotes').value         = '';
    document.querySelectorAll('.order-item-check').forEach(el => el.checked = false);
    document.querySelectorAll('.order-item-qty').forEach(el => { el.style.display = 'none'; el.value = 1; });
    document.getElementById('orderModalError').style.display = 'none';
    document.getElementById('orderModalOverlay').classList.add('open');
}
function closeOrderModal() { document.getElementById('orderModalOverlay').classList.remove('open'); }
document.getElementById('orderModalOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeOrderModal();
});

function toggleOrderQty(checkbox) {
    const qtyInput = document.querySelector(
        `.order-item-qty[data-type="${checkbox.dataset.type}"][data-id="${checkbox.dataset.id}"]`
    );
    if (qtyInput) qtyInput.style.display = checkbox.checked ? 'inline-block' : 'none';
}

async function submitOrder() {
    const name  = document.getElementById('orderCustomerName').value.trim();
    const table = document.getElementById('orderTableNumber').value.trim();
    const phone = document.getElementById('orderPhone').value.trim();
    const notes = document.getElementById('orderNotes').value.trim();
    const errEl = document.getElementById('orderModalError');

    if (!name) { errEl.textContent = 'Nama pelanggan wajib diisi.'; errEl.style.display = 'block'; return; }

    const items = [];
    document.querySelectorAll('.order-item-check:checked').forEach(chk => {
        const qtyInput = document.querySelector(
            `.order-item-qty[data-type="${chk.dataset.type}"][data-id="${chk.dataset.id}"]`
        );
        items.push({
            type: chk.dataset.type,
            id:   parseInt(chk.dataset.id, 10),
            qty:  parseInt(qtyInput?.value || 1, 10)
        });
    });

    if (items.length === 0) { errEl.textContent = 'Pilih minimal 1 menu/minuman.'; errEl.style.display = 'block'; return; }
    errEl.style.display = 'none';

    const res = await fetch('{{ url("/admin/orders") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ customer_name: name, table_number: table, phone: phone, notes: notes, items: items })
    });
    const json = await res.json();

    if (json.success) { closeOrderModal(); showToast(json.message); setTimeout(() => location.reload(), 700); }
    else { errEl.textContent = json.message || 'Terjadi kesalahan.'; errEl.style.display = 'block'; }
}

async function updateOrderStatus(id, status) {
    const fd = new FormData();
    fd.append('_token', CSRF);
    fd.append('status', status);
    const res  = await fetch(`{{ url('/admin/orders') }}/${id}/status`, { method: 'POST', headers: {'X-Requested-With':'XMLHttpRequest'}, body: fd });
    const json = await res.json();
    if (json.success) showToast(json.message);
    else showToast(json.message || 'Gagal memperbarui status.', false);
}

async function deleteOrder(id, name) {
    if (!confirm(`Yakin ingin menghapus order dari "${name}"?`)) return;
    const fd = new FormData(); fd.append('_token', CSRF);
    const res  = await fetch(`{{ url('/admin/orders') }}/${id}/delete`, { method: 'POST', headers: {'X-Requested-With':'XMLHttpRequest'}, body: fd });
    const json = await res.json();
    if (json.success) { document.getElementById(`order-row-${id}`)?.remove(); showToast(json.message); }
    else showToast(json.message || 'Gagal menghapus.', false);
}
</script>
</body>
</html>