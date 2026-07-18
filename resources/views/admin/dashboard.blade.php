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
    flex-direction: column;
}

/* ── SIDEBAR ─────────────────────────────────── */
.sidebar {
    position: fixed;
    top: 0; left: 0;
    width: 240px;
    height: 100vh;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    z-index: 100;
    padding: 0 0 24px;
}

.sidebar-brand {
    padding: 24px 24px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
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
    color: var(--muted);
    padding: 0 12px; margin-bottom: 8px;
}

.sidebar-link {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 14px;
    border-radius: 12px;
    color: rgba(255,255,255,0.6);
    text-decoration: none;
    font-size: 14px; font-weight: 500;
    transition: all 0.25s;
    margin-bottom: 4px;
}

.sidebar-link .s-icon {
    width: 32px; height: 32px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    background: rgba(255,255,255,0.05);
    transition: all 0.25s;
}

.sidebar-link:hover,
.sidebar-link.active {
    background: rgba(193,18,31,0.15);
    color: #fff;
}

.sidebar-link:hover .s-icon,
.sidebar-link.active .s-icon {
    background: rgba(193,18,31,0.3);
    color: #ff6b6b;
}

.sidebar-link.active { color: #fff; }

.sidebar-footer {
    padding: 16px 12px 0;
    border-top: 1px solid var(--border);
    margin-top: auto;
}

.sidebar-user {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 14px;
    border-radius: 12px;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--border);
}

.user-avatar {
    width: 34px; height: 34px;
    background: linear-gradient(135deg, var(--gold), #ff6b35);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700;
    color: #000; text-transform: uppercase;
    flex-shrink: 0;
    overflow: hidden;
}

.user-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

.user-info .user-name { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.2; }
.user-info .user-role { font-size: 11px; color: var(--gold); line-height: 1.2; }

/* ── MAIN CONTENT ────────────────────────────── */
.main-content {
    margin-left: 240px;
    padding: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* ── TOP BAR ─────────────────────────────────── */
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

.topbar-actions { display: flex; align-items: center; gap: 10px; }

.btn-gold {
    background: linear-gradient(135deg, var(--gold), #e6a800);
    color: #000; border: none;
    border-radius: 10px;
    padding: 8px 18px;
    font-size: 13px; font-weight: 600;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(255,193,7,0.25);
}

.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,193,7,0.4);
    color: #000;
}

.btn-ghost {
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.7); border: 1px solid var(--border);
    border-radius: 10px;
    padding: 8px 16px;
    font-size: 13px; font-weight: 500;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px;
    transition: all 0.3s;
}

.btn-ghost:hover {
    background: rgba(255,255,255,0.1);
    color: #fff;
}

/* ── PAGE BODY ───────────────────────────────── */
.page-body { padding: 28px 32px; flex: 1; }

/* ── STATS STRIP ─────────────────────────────── */
.stats-strip { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 28px; }

.stat-tile {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 20px 22px;
    display: flex; align-items: center; gap: 16px;
    transition: all 0.3s;
    position: relative; overflow: hidden;
}

.stat-tile::before {
    content: '';
    position: absolute; top: 0; left: 0;
    width: 4px; height: 100%;
}

.stat-tile.red::before   { background: var(--red); }
.stat-tile.gold::before  { background: var(--gold); }
.stat-tile.green::before { background: #22c55e; }

.stat-tile:hover { transform: translateY(-3px); border-color: rgba(255,255,255,0.15); }

.stat-tile-icon {
    width: 46px; height: 46px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
}

.stat-tile.red  .stat-tile-icon { background: rgba(193,18,31,0.2);  color: #ff6b6b; }
.stat-tile.gold .stat-tile-icon { background: rgba(255,193,7,0.15); color: var(--gold); }
.stat-tile.green .stat-tile-icon { background: rgba(34,197,94,0.15); color: #4ade80; }

.stat-tile-val { font-size: 26px; font-weight: 800; line-height: 1; }
.stat-tile-lbl { font-size: 12px; color: var(--muted); margin-top: 2px; font-weight: 400; }

/* ── TABLE CARD ──────────────────────────────── */
.table-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
}

.table-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
}

.table-card-header h6 {
    font-size: 15px; font-weight: 700; margin: 0;
    display: flex; align-items: center; gap: 10px;
}

.table-card-header h6 .th-icon {
    width: 32px; height: 32px;
    background: rgba(193,18,31,0.2);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: #ff6b6b; font-size: 14px;
}

.count-badge {
    background: rgba(255,193,7,0.12);
    color: var(--gold);
    border: 1px solid rgba(255,193,7,0.25);
    border-radius: 20px;
    padding: 3px 12px;
    font-size: 12px; font-weight: 600;
}

/* custom table */
.admin-table { width: 100%; border-collapse: collapse; }

.admin-table thead tr {
    background: rgba(255,255,255,0.03);
}

.admin-table thead th {
    padding: 12px 20px;
    font-size: 11px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.8px;
    color: var(--muted);
    border-bottom: 1px solid var(--border);
}

.admin-table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.04);
    transition: background 0.2s;
}

.admin-table tbody tr:last-child { border-bottom: none; }

.admin-table tbody tr:hover { background: rgba(255,255,255,0.03); }

.admin-table tbody td { padding: 14px 20px; font-size: 14px; vertical-align: middle; }

.row-num {
    width: 28px; height: 28px;
    background: rgba(255,255,255,0.05);
    border-radius: 8px;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 600; color: var(--muted);
}

.user-cell { display: flex; align-items: center; gap: 10px; }

.table-avatar {
    width: 34px; height: 34px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; color: #000;
    text-transform: uppercase;
    flex-shrink: 0;
}

.user-fullname { font-size: 14px; font-weight: 600; }
.user-joined   { font-size: 11px; color: var(--muted); margin-top: 1px; }

.email-chip {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,0.05);
    border-radius: 8px;
    padding: 4px 10px;
    font-size: 13px; color: rgba(255,255,255,0.7);
}

.role-badge {
    display: inline-flex; align-items: center; gap: 5px;
    border-radius: 20px; padding: 3px 12px;
    font-size: 12px; font-weight: 600;
}

.role-badge.admin { background: rgba(193,18,31,0.2); color: #ff8080; border: 1px solid rgba(193,18,31,0.3); }
.role-badge.user  { background: rgba(255,193,7,0.1);  color: var(--gold); border: 1px solid rgba(255,193,7,0.25); }

.btn-del {
    background: rgba(220,53,69,0.12);
    color: #ff6b6b;
    border: 1px solid rgba(220,53,69,0.25);
    border-radius: 8px; padding: 5px 14px;
    font-size: 12px; font-weight: 600;
    cursor: pointer; transition: all 0.25s;
    display: inline-flex; align-items: center; gap: 5px;
}

.btn-del:hover {
    background: rgba(220,53,69,0.25);
    border-color: rgba(220,53,69,0.5);
    transform: scale(1.04);
}

/* ── ALERT ───────────────────────────────────── */
.flash-alert {
    border-radius: 12px; padding: 12px 18px;
    font-size: 14px; font-weight: 500;
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 20px; border: 1px solid;
}

.flash-success { background: rgba(34,197,94,0.1); border-color: rgba(34,197,94,0.25); color: #4ade80; }
.flash-danger  { background: rgba(220,53,69,0.1);  border-color: rgba(220,53,69,0.25);  color: #ff6b6b; }

/* ── GLOW DECORATIONS ────────────────────────── */
.glow-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 8px #22c55e;
    display: inline-block;
}
</style>
</head>
<body>

<!-- ═══════════════ SIDEBAR ═══════════════ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon" style="background:none; padding:0; overflow:hidden;">
            <img src="{{ $logoUrl ?? asset('images/logo_kokiku.png') }}" alt="KOKIKU Logo"
                 style="width:36px; height:36px; object-fit:cover; border-radius:50%;">
        </div>
        <span class="brand-name">KOKIKU</span>
    </div>

    <div class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>

        <a href="{{ url('/admin') }}" class="sidebar-link active">
            <div class="s-icon"><i class="fa-solid fa-gauge-high"></i></div>
            Dashboard
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
                <span style="display:none;">{{ substr($admin->name, 0, 1) }}</span>
            </div>
            <div class="user-info">
                <div class="user-name">{{ $admin->name }}</div>
                <div class="user-role"><i class="fa-solid fa-shield-halved me-1" style="font-size:10px;"></i>Administrator</div>
            </div>
        </div>


    </div>
</div>

<!-- ═══════════════ MAIN ═══════════════ -->
<div class="main-content">

    <!-- TOP BAR -->
    <div class="topbar">
        <div class="topbar-title">
            Dashboard <span>Admin</span>
        </div>
        <div class="topbar-actions">
            <a href="{{ url('/home') }}" class="btn-ghost">
                <i class="fa-solid fa-arrow-left"></i> Beranda
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

        <!-- STATS -->
        <div class="stats-strip">
            <div class="stat-tile red">
                <div class="stat-tile-icon"><i class="fa-solid fa-users"></i></div>
                <div>
                    <div class="stat-tile-val">{{ $users->count() }}</div>
                    <div class="stat-tile-lbl">Total Pengguna</div>
                </div>
            </div>
            <div class="stat-tile gold">
                <div class="stat-tile-icon"><i class="fa-solid fa-user-shield"></i></div>
                <div>
                    <div class="stat-tile-val">{{ $users->where('role','admin')->count() }}</div>
                    <div class="stat-tile-lbl">Administrator</div>
                </div>
            </div>
            <div class="stat-tile green">
                <div class="stat-tile-icon"><i class="fa-solid fa-user-check"></i></div>
                <div>
                    <div class="stat-tile-val">{{ $users->where('role','user')->count() }}</div>
                    <div class="stat-tile-lbl">User Aktif</div>
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
                                <div class="table-avatar" style="background: {{ $color }}22; color: {{ $color }}; border: 1px solid {{ $color }}44;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-fullname">{{ $user->name }}</div>
                                    <div class="user-joined">
                                        <span class="glow-dot" style="width:6px;height:6px;margin-right:4px;"></span>
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
                            <span style="color: #4ade80; font-size: 13px;">
                                <i class="fa-solid fa-circle" style="font-size: 7px;"></i> Online
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
                                <span style="color: var(--muted); font-size: 13px;">—</span>
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
</body>
</html>