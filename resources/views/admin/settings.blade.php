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
    --gold:     #ffc107;
    --bg:       #0d0d0d;
    --surface:  #161616;
    --surface2: #1e1e1e;
    --border:   rgba(255,255,255,0.07);
    --text:     #f0f0f0;
    --muted:    rgba(255,255,255,0.4);
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
    background: rgba(13,13,13,0.9);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border);
    padding: 16px 32px;
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 50;
}
.topbar-title { font-size: 20px; font-weight: 700; }
.topbar-title span { color: var(--red); }

.btn-ghost {
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.7); border: 1px solid var(--border);
    border-radius: 10px; padding: 8px 16px;
    font-size: 13px; font-weight: 500; text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px; transition: all 0.3s;
}
.btn-ghost:hover { background: rgba(255,255,255,0.1); color: #fff; }

.btn-save {
    background: linear-gradient(135deg, var(--red), var(--red-dark));
    color: #fff; border: none; border-radius: 12px;
    padding: 12px 32px; font-size: 15px; font-weight: 600;
    display: inline-flex; align-items: center; gap: 8px;
    cursor: pointer; transition: all 0.3s;
    box-shadow: 0 6px 20px rgba(193,18,31,0.35);
    font-family: 'Outfit', sans-serif;
}
.btn-save:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(193,18,31,0.5); }

/* ── PAGE BODY ───────────────────────────────── */
.page-body { padding: 28px 32px 48px; }

/* ── SECTION CARD ────────────────────────────── */
.section-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px; overflow: hidden;
    margin-bottom: 20px;
}
.section-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 12px;
    background: rgba(255,255,255,0.02);
}
.section-card-header .s-icon {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center; font-size: 15px;
}
.s-icon.red   { background: rgba(193,18,31,0.2); color: #ff6b6b; }
.s-icon.gold  { background: rgba(255,193,7,0.15); color: var(--gold); }
.s-icon.blue  { background: rgba(59,130,246,0.15); color: #60a5fa; }
.section-card-header h6 { margin: 0; font-size: 15px; font-weight: 700; }
.section-card-header p  { margin: 0; font-size: 12px; color: var(--muted); }
.section-card-body { padding: 24px; }

/* ── FORM FIELDS ─────────────────────────────── */
.field-group { margin-bottom: 20px; }
.field-group:last-child { margin-bottom: 0; }

.field-label {
    display: block; font-size: 12px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.7px;
    color: rgba(255,255,255,0.5); margin-bottom: 8px;
}

.dark-input, .dark-select, .dark-textarea {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    color: #fff;
    padding: 11px 16px;
    font-size: 14px;
    font-family: 'Outfit', sans-serif;
    transition: all 0.25s;
    outline: none;
}
.dark-input:focus, .dark-select:focus, .dark-textarea:focus {
    border-color: rgba(193,18,31,0.5);
    background: rgba(193,18,31,0.06);
    box-shadow: 0 0 0 3px rgba(193,18,31,0.12);
}
.dark-input::placeholder, .dark-textarea::placeholder { color: rgba(255,255,255,0.25); }
.dark-select option { background: #1e1e1e; color: #fff; }
.dark-textarea { resize: vertical; min-height: 90px; }

/* file input */
.file-drop {
    border: 2px dashed rgba(255,255,255,0.12);
    border-radius: 14px; padding: 20px;
    text-align: center; cursor: pointer;
    transition: all 0.3s;
    background: rgba(255,255,255,0.02);
}
.file-drop:hover { border-color: rgba(193,18,31,0.4); background: rgba(193,18,31,0.04); }
.file-drop input[type="file"] { display: none; }
.file-drop-icon { font-size: 28px; color: var(--muted); margin-bottom: 8px; }
.file-drop-text { font-size: 13px; color: rgba(255,255,255,0.4); }
.file-drop-text strong { color: var(--gold); }

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
    margin: 8px 0 20px;
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
    background: rgba(13,13,13,0.96);
    backdrop-filter: blur(12px);
    border-top: 1px solid var(--border);
    padding: 16px 32px;
    display: flex; align-items: center; justify-content: flex-end;
    gap: 12px;
    z-index: 40;
}
.save-bar-hint { font-size: 13px; color: var(--muted); margin-right: auto; }

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
</style>
</head>
<body>

<!-- ═══════════════ SIDEBAR ═══════════════ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon" style="background:none; padding:0; overflow:hidden;">
            <img src="{{ asset($logoImage) }}" alt="KOKIKU Logo"
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
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">
                @php $g = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim(auth()->user()->email))).'?s=80&d=404'; @endphp
                <img src="{{ $g }}"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';" alt="">
                <span style="display:none;">{{ substr(auth()->user()->name,0,1) }}</span>
            </div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role"><i class="fa-solid fa-shield-halved me-1" style="font-size:10px;"></i>Administrator</div>
            </div>
        </div>
        <a href="{{ route('logout') }}" class="sidebar-link mt-3" style="color:#ff6b6b;">
            <div class="s-icon" style="background:rgba(220,53,69,0.12);color:#ff6b6b;">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            Logout
        </a>
    </div>
</div>

<!-- ═══════════════ MAIN ═══════════════ -->
<div class="main-content">

    <!-- TOP BAR -->
    <div class="topbar">
        <div class="topbar-title">Pengaturan <span>KOKIKU</span></div>
        <a href="{{ url('/admin') }}" class="btn-ghost">
            <i class="fa-solid fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- FORM STARTS HERE -->
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
            <div>
                @foreach($errors->all() as $e)
                    <div>{{ $e }}</div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- ══════ LOGO SECTION ══════ -->
        <div class="section-card">
            <div class="section-card-header">
                <div class="s-icon gold"><i class="fa-solid fa-star"></i></div>
                <div>
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
                                <strong>Klik untuk upload</strong> atau seret file ke sini<br>
                                <span style="font-size:11px;">PNG, SVG, WEBP, JPG – maks 2MB. Rekomendasi: PNG transparan</span>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-5">
                        <label class="field-label">Preview Logo</label>
                        <div class="logo-preview-wrap" id="logoPreviewContainer">
                            <img src="{{ asset($logoImage) }}" id="logoPreviewImg" alt="Logo saat ini">
                            <span class="logo-preview-label"><i class="fa-solid fa-image me-1"></i>Logo saat ini</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════ HERO SECTION ══════ -->
        <div class="section-card">
            <div class="section-card-header">
                <div class="s-icon red"><i class="fa-solid fa-image"></i></div>
                <div>
                    <h6>Bagian Hero Utama</h6>
                    <p>Teks, warna, dan gambar background halaman utama</p>
                </div>
            </div>
            <div class="section-card-body">

                <!-- Judul -->
                <div class="field-group">
                    <label class="field-label">Teks Judul Hero</label>
                    <input type="text" name="hero_title" class="dark-input"
                           value="{{ old('hero_title', $heroTitle) }}" required
                           placeholder="Contoh: SELAMAT DATANG DI RESTO KOKIKU">
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="field-label">Warna Judul</label>
                        <div class="color-wrap">
                            <input type="color" name="hero_title_color" class="color-swatch"
                                   id="heroTitleColor"
                                   value="{{ old('hero_title_color', $heroTitleColor) }}" required>
                            <span class="color-val-text" id="heroTitleColorVal">{{ old('hero_title_color', $heroTitleColor) }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ketebalan Judul</label>
                        <select name="hero_title_weight" class="dark-select" required>
                            @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('hero_title_weight',$heroTitleWeight)===$v?'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ukuran Judul</label>
                        <select name="hero_title_size" class="dark-select" required>
                            @foreach(['44px','48px','52px','56px','60px'] as $s)
                            <option value="{{ $s }}" {{ old('hero_title_size',$heroTitleSize)===$s?'selected':'' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Subjudul -->
                <div class="field-group">
                    <label class="field-label">Subjudul Hero</label>
                    <input type="text" name="hero_subtitle" class="dark-input"
                           value="{{ old('hero_subtitle', $heroSubtitle) }}" required
                           placeholder="Contoh: Moslem Chinese Foods Halal">
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="field-label">Warna Subjudul</label>
                        <div class="color-wrap">
                            <input type="color" name="hero_subtitle_color" class="color-swatch"
                                   id="heroSubColor"
                                   value="{{ old('hero_subtitle_color', $heroSubtitleColor) }}" required>
                            <span class="color-val-text" id="heroSubColorVal">{{ old('hero_subtitle_color', $heroSubtitleColor) }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ketebalan Subjudul</label>
                        <select name="hero_subtitle_weight" class="dark-select" required>
                            @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('hero_subtitle_weight',$heroSubtitleWeight)===$v?'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ukuran Subjudul</label>
                        <select name="hero_subtitle_size" class="dark-select" required>
                            @foreach(['20px','24px','28px','32px','36px'] as $s)
                            <option value="{{ $s }}" {{ old('hero_subtitle_size',$heroSubtitleSize)===$s?'selected':'' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Teks deskripsi -->
                <div class="field-group">
                    <label class="field-label">Teks Deskripsi Hero</label>
                    <textarea name="hero_text" class="dark-textarea" rows="3" required
                              placeholder="Tulis deskripsi singkat...">{{ old('hero_text', $heroText) }}</textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="field-label">Warna Deskripsi</label>
                        <div class="color-wrap">
                            <input type="color" name="hero_text_color" class="color-swatch"
                                   id="heroTextColor"
                                   value="{{ old('hero_text_color', $heroTextColor) }}" required>
                            <span class="color-val-text" id="heroTextColorVal">{{ old('hero_text_color', $heroTextColor) }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ketebalan Deskripsi</label>
                        <select name="hero_text_weight" class="dark-select" required>
                            @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('hero_text_weight',$heroTextWeight)===$v?'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ukuran Deskripsi</label>
                        <select name="hero_text_size" class="dark-select" required>
                            @foreach(['16px','18px','20px','22px','24px'] as $s)
                            <option value="{{ $s }}" {{ old('hero_text_size',$heroTextSize)===$s?'selected':'' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Background Image -->
                <div class="field-group">
                    <label class="field-label">Foto Background Hero</label>
                    <label class="file-drop" id="dropZone">
                        <input type="file" name="hero_background_image" accept="image/*" id="bgFile"
                               onchange="previewBg(this)">
                        <div class="file-drop-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                        <div class="file-drop-text">
                            <strong>Klik untuk upload</strong> atau seret file ke sini<br>
                            <span style="font-size:11px;">JPG, PNG, WEBP – maks 4MB</span>
                        </div>
                    </label>
                    @if(!empty($heroBackgroundImage))
                    <div class="img-preview-wrap" id="previewContainer">
                        <img src="{{ asset($heroBackgroundImage) }}" id="previewImg" alt="Hero Background">
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

        <!-- ══════ ABOUT SECTION ══════ -->
        <div class="section-card">
            <div class="section-card-header">
                <div class="s-icon gold"><i class="fa-solid fa-circle-info"></i></div>
                <div>
                    <h6>Bagian Tentang Kami</h6>
                    <p>Judul, paragraf, dan gaya teks halaman About</p>
                </div>
            </div>
            <div class="section-card-body">

                <!-- Judul About -->
                <div class="field-group">
                    <label class="field-label">Judul Bagian Tentang</label>
                    <input type="text" name="about_title" class="dark-input"
                           value="{{ old('about_title', $aboutTitle) }}" required
                           placeholder="Contoh: Tentang KOKIKU">
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="field-label">Warna Judul</label>
                        <div class="color-wrap">
                            <input type="color" name="about_title_color" class="color-swatch"
                                   id="aboutTitleColor"
                                   value="{{ old('about_title_color', $aboutTitleColor) }}" required>
                            <span class="color-val-text" id="aboutTitleColorVal">{{ old('about_title_color', $aboutTitleColor) }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ketebalan Judul</label>
                        <select name="about_title_weight" class="dark-select" required>
                            @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('about_title_weight',$aboutTitleWeight)===$v?'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ukuran Judul</label>
                        <select name="about_title_size" class="dark-select" required>
                            @foreach(['28px','32px','36px','40px','44px'] as $s)
                            <option value="{{ $s }}" {{ old('about_title_size',$aboutTitleSize)===$s?'selected':'' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Paragraf style -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="field-label">Warna Paragraf</label>
                        <div class="color-wrap">
                            <input type="color" name="about_paragraph_color" class="color-swatch"
                                   id="aboutParaColor"
                                   value="{{ old('about_paragraph_color', $aboutParagraphColor) }}" required>
                            <span class="color-val-text" id="aboutParaColorVal">{{ old('about_paragraph_color', $aboutParagraphColor) }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ketebalan Paragraf</label>
                        <select name="about_paragraph_weight" class="dark-select" required>
                            @foreach(['400'=>'Normal','500'=>'Medium','600'=>'Semi Bold','700'=>'Bold','800'=>'Extra Bold','900'=>'Black'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('about_paragraph_weight',$aboutParagraphWeight)===$v?'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Ukuran Paragraf</label>
                        <select name="about_paragraph_size" class="dark-select" required>
                            @foreach(['16px','18px','20px','22px','24px'] as $s)
                            <option value="{{ $s }}" {{ old('about_paragraph_size',$aboutParagraphSize)===$s?'selected':'' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Paragraf 1 -->
                <div class="field-group">
                    <label class="field-label">Paragraf Pertama</label>
                    <textarea name="about_paragraph1" class="dark-textarea" rows="4" required
                              placeholder="Tulis paragraf pertama...">{{ old('about_paragraph1', $aboutParagraph1) }}</textarea>
                </div>

                <!-- Paragraf 2 -->
                <div class="field-group">
                    <label class="field-label">Paragraf Kedua</label>
                    <textarea name="about_paragraph2" class="dark-textarea" rows="4" required
                              placeholder="Tulis paragraf kedua...">{{ old('about_paragraph2', $aboutParagraph2) }}</textarea>
                </div>

            </div>
        </div>

    </div><!-- /page-body -->

    <!-- STICKY SAVE BAR -->
    <div class="save-bar">
        <span class="save-bar-hint">
            <i class="fa-solid fa-circle-info me-1" style="color:var(--gold);"></i>
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
</script>
</body>
</html>
