<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Saya – KOKIKU</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Outfit', sans-serif;
    background: #0f0f0f;
    min-height: 100vh;
    color: #fff;
}

/* Navbar */
.navbar {
    background: rgba(15,15,15,0.95) !important;
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255,255,255,0.07);
    padding: 0.8rem 0;
}

.navbar-brand {
    font-size: 26px;
    font-weight: 800;
    color: #ffc107 !important;
    letter-spacing: 1px;
}

.navbar .nav-link {
    color: rgba(255,255,255,0.8) !important;
    font-weight: 400;
    font-size: 16px;
    transition: color 0.3s;
}

.navbar .nav-link:hover {
    color: #ffc107 !important;
}

.btn-back {
    background: rgba(255,193,7,0.12);
    color: #ffc107;
    border: 1px solid rgba(255,193,7,0.3);
    border-radius: 10px;
    padding: 6px 18px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-back:hover {
    background: #ffc107;
    color: #000;
}

/* Hero banner */
.profile-hero {
    background: linear-gradient(135deg, #c1121f 0%, #780000 50%, #111 100%);
    padding: 70px 0 80px;
    position: relative;
    overflow: hidden;
    z-index: 0;
}

.profile-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.profile-hero .container {
    position: relative;
    z-index: 1;
}

/* Avatar */
.avatar-wrapper {
    position: relative;
    display: inline-block;
}

.avatar-ring {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ffc107, #ff6b35);
    padding: 3px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 30px rgba(255,193,7,0.4);
}

.avatar-inner {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: #1a1a1a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    font-weight: 700;
    color: #ffc107;
    text-transform: uppercase;
    overflow: hidden;
}

.avatar-inner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.status-badge {
    position: absolute;
    bottom: 6px;
    right: 6px;
    width: 18px;
    height: 18px;
    background: #22c55e;
    border: 2px solid #0f0f0f;
    border-radius: 50%;
}

.profile-name {
    font-size: 30px;
    font-weight: 700;
    margin-top: 16px;
    letter-spacing: 0.3px;
}

.profile-role-badge {
    display: inline-block;
    background: rgba(255,193,7,0.15);
    color: #ffc107;
    border: 1px solid rgba(255,193,7,0.3);
    border-radius: 20px;
    padding: 4px 16px;
    font-size: 13px;
    font-weight: 500;
    margin-top: 8px;
    letter-spacing: 0.5px;
}

.profile-email {
    color: rgba(255,255,255,0.55);
    font-size: 15px;
    margin-top: 6px;
}

/* Card area */
.profile-content {
    margin-top: 30px;
    padding-bottom: 60px;
    position: relative;
    z-index: 1;
}

.profile-card {
    background: #1a1a1a;
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    transition: transform 0.3s, box-shadow 0.3s;
}

.profile-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 30px 80px rgba(0,0,0,0.5);
}

.card-header-custom {
    background: rgba(193,18,31,0.15);
    border-bottom: 1px solid rgba(255,255,255,0.07);
    padding: 18px 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-header-custom .header-icon {
    width: 36px;
    height: 36px;
    background: rgba(193,18,31,0.3);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ff6b6b;
    font-size: 16px;
}

.card-header-custom h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #fff;
}

.card-body-custom {
    padding: 24px;
}

.info-row {
    display: flex;
    align-items: flex-start;
    padding: 14px 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    gap: 16px;
}

.info-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.info-icon {
    width: 38px;
    height: 38px;
    background: rgba(255,193,7,0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffc107;
    font-size: 15px;
    flex-shrink: 0;
}

.info-label {
    font-size: 12px;
    color: rgba(255,255,255,0.4);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    line-height: 1;
    margin-bottom: 4px;
}

.info-value {
    font-size: 15px;
    color: #fff;
    font-weight: 500;
    line-height: 1.4;
}

/* Stats card */
.stat-card {
    background: linear-gradient(135deg, rgba(193,18,31,0.2), rgba(193,18,31,0.05));
    border: 1px solid rgba(193,18,31,0.25);
    border-radius: 16px;
    padding: 20px;
    text-align: center;
    transition: all 0.3s;
}

.stat-card:hover {
    border-color: rgba(255,193,7,0.4);
    background: linear-gradient(135deg, rgba(255,193,7,0.1), rgba(255,193,7,0.03));
    transform: translateY(-3px);
}

.stat-icon {
    font-size: 26px;
    color: #ffc107;
    margin-bottom: 10px;
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}

.stat-label {
    font-size: 13px;
    color: rgba(255,255,255,0.45);
    margin-top: 4px;
    font-weight: 400;
}

/* Quick actions */
.action-btn {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 18px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.07);
    background: rgba(255,255,255,0.03);
    color: #fff;
    text-decoration: none;
    transition: all 0.3s;
    margin-bottom: 10px;
}

.action-btn:last-child {
    margin-bottom: 0;
}

.action-btn:hover {
    background: rgba(255,193,7,0.1);
    border-color: rgba(255,193,7,0.3);
    color: #ffc107;
    transform: translateX(4px);
}

.action-btn.danger:hover {
    background: rgba(220,53,69,0.1);
    border-color: rgba(220,53,69,0.3);
    color: #ff6b6b;
}

.action-btn .action-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
    transition: all 0.3s;
}

.action-btn .action-icon.yellow {
    background: rgba(255,193,7,0.15);
    color: #ffc107;
}

.action-btn .action-icon.blue {
    background: rgba(59,130,246,0.15);
    color: #60a5fa;
}

.action-btn .action-icon.red {
    background: rgba(220,53,69,0.15);
    color: #ff6b6b;
}

.action-btn .action-arrow {
    margin-left: auto;
    color: rgba(255,255,255,0.3);
    font-size: 12px;
}

.action-btn span.text {
    font-size: 14px;
    font-weight: 500;
}

/* Member since tag */
.member-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(34,197,94,0.12);
    border: 1px solid rgba(34,197,94,0.25);
    color: #4ade80;
    border-radius: 20px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 500;
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">KOKIKU</a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <a href="{{ url('/home') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</nav>

<!-- Profile Hero -->
<div class="profile-hero" style="padding-top: 100px;">
    <div class="container text-center">
        <div class="avatar-wrapper">
            <div class="avatar-ring">
                <div class="avatar-inner">
                    @php
                        $gravatarUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(auth()->user()->email))) . '?s=200&d=404';
                    @endphp
                    <img src="{{ $gravatarUrl }}"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                         alt="Avatar">
                    <span style="display:none;">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
            </div>
            <span class="status-badge"></span>
        </div>

        <div class="profile-name">{{ auth()->user()->name }}</div>
        <div class="profile-role-badge">
            <i class="fa-solid fa-shield-halved me-1"></i>
            {{ ucfirst(auth()->user()->role) }}
        </div>
        <div class="profile-email">
            <i class="fa-solid fa-envelope me-1"></i>
            {{ auth()->user()->email }}
        </div>
    </div>
</div>

<!-- Profile Content -->
<div class="profile-content">
    <div class="container">
        <div class="row justify-content-center">

            <!-- Informasi Akun (full-width centered) -->
            <div class="col-lg-7 col-md-9">

                <div class="profile-card">
                    <div class="card-header-custom">
                        <div class="header-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h6>Informasi Akun</h6>
                    </div>
                    <div class="card-body-custom">

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="fa-solid fa-id-badge"></i>
                            </div>
                            <div>
                                <div class="info-label">Nama Lengkap</div>
                                <div class="info-value">{{ auth()->user()->name }}</div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <div class="info-label">Alamat Email</div>
                                <div class="info-value">{{ auth()->user()->email }}</div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="fa-solid fa-user-tag"></i>
                            </div>
                            <div>
                                <div class="info-label">Role</div>
                                <div class="info-value">
                                    <span class="profile-role-badge" style="font-size: 12px; padding: 3px 12px;">
                                        {{ ucfirst(auth()->user()->role) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <div>
                                <div class="info-label">Bergabung Sejak</div>
                                <div class="info-value">
                                    <span class="member-tag">
                                        <i class="fa-solid fa-circle-check"></i>
                                        {{ auth()->user()->created_at ? auth()->user()->created_at->translatedFormat('d F Y') : '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="fa-solid fa-key"></i>
                            </div>
                            <div>
                                <div class="info-label">Status Akun</div>
                                <div class="info-value">
                                    <span style="color: #4ade80;">
                                        <i class="fa-solid fa-circle" style="font-size: 8px;"></i>
                                        Aktif
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
