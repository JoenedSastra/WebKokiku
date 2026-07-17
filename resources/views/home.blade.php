<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KOKIKU – Moslem Chinese Foods Halal</title>
<meta name="description" content="KOKIKU Resto – Menyajikan Chinese Foods Halal terbaik dengan cita rasa otentik dan suasana yang nyaman.">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
:root {
    --red:        #ff1744;
    --red-dark:   #b71c1c;
    --red-light:  #ff5252;
    --red-glow:   rgba(255,23,68,0.5);
    --gold:       #ffb703;
    --gold-dark:  #e09400;
    --gold-light: #ffe566;
    --gold-glow:  rgba(255,183,3,0.45);
    --purple:     #6c63ff;
    --purple-dim: rgba(108,99,255,0.2);
    --dark:       #07070f;
    --surface:    #0d0d1c;
    --surface2:   #12122a;
    --accent:     #6c63ff;
    --accent-dim: rgba(108,99,255,0.15);
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior: smooth; }

body {
    font-family: 'Outfit', sans-serif;
    background: var(--dark);
    color: #f0f0f0;
    overflow-x: hidden;
}

/* ── NAVBAR ─────────────────────────────────────── */
.navbar {
    background: rgba(7,7,15,0.1) !important;
    backdrop-filter: blur(0px);
    -webkit-backdrop-filter: blur(0px);
    border-bottom: 1px solid rgba(255,255,255,0);
    padding: 14px 0;
    transition: all 0.45s cubic-bezier(0.4,0,0.2,1);
    position: fixed; top:0; width:100%; z-index:999;
}
.navbar.scrolled {
    background: rgba(7,7,15,0.96) !important;
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border-bottom: 1px solid rgba(255,23,68,0.2);
    padding: 10px 0;
    box-shadow: 0 8px 40px rgba(0,0,0,0.8), 0 0 80px rgba(255,23,68,0.06);
}

/* Logo ring */
.logo-ring {
    position: relative;
    display: flex; align-items: center; justify-content: center;
    width: 44px; height: 44px;
    flex-shrink: 0;
}
.logo-ring::before {
    content: '';
    position: absolute; inset: -2px;
    border-radius: 50%;
    background: conic-gradient(from 0deg, var(--gold), var(--red), var(--gold-light), var(--red-light), var(--gold));
    animation: spinRing 4s linear infinite;
    z-index: 0;
}
.logo-ring::after {
    content: '';
    position: absolute; inset: 1px;
    border-radius: 50%;
    background: var(--dark);
    z-index: 1;
}
.logo-ring img {
    position: relative; z-index: 2;
    width: 36px; height: 36px;
    border-radius: 50%;
    object-fit: cover;
}
@keyframes spinRing {
    to { transform: rotate(360deg); }
}

.navbar-brand {
    font-size: 22px;
    font-weight: 800;
    color: var(--gold) !important;
    letter-spacing: 1.5px;
    display: flex; align-items: center; gap: 10px;
    text-decoration: none;
    transition: all 0.3s;
}
.navbar-brand:hover { color: #fff !important; }
.navbar-brand:hover .logo-ring::before { animation-duration: 1s; }

.navbar .nav-link {
    color: rgba(255,255,255,0.7) !important;
    font-weight: 500;
    font-size: 15px;
    padding: 6px 14px !important;
    border-radius: 8px;
    transition: all 0.25s;
    position: relative;
}
.navbar .nav-link::after {
    content: '';
    position: absolute; bottom: 0; left: 50%; right: 50%;
    height: 2px;
    background: linear-gradient(90deg, var(--red-light), var(--gold));
    border-radius: 2px;
    transition: all 0.3s;
    box-shadow: 0 0 8px rgba(255,23,68,0.6);
}
.navbar .nav-link:hover { color: #fff !important; }
.navbar .nav-link:hover::after,
.navbar .nav-link.active::after { left: 14px; right: 14px; }
.navbar .nav-link.active { color: var(--gold) !important; text-shadow: 0 0 12px rgba(255,183,3,0.4); }

/* Profile button */
.profile-btn {
    display: flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 30px; padding: 5px 14px 5px 5px;
    color: #fff !important; font-size: 14px; font-weight: 500;
    text-decoration: none; transition: all 0.25s;
    cursor: pointer;
}
.profile-btn:hover { background: rgba(255,255,255,0.14); border-color: rgba(255,255,255,0.25); }
.profile-btn .p-avatar {
    width: 28px; height: 28px; border-radius: 50%;
    background: linear-gradient(135deg, var(--gold), #ff6b35);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; color: #000;
}
.profile-btn::after { display: none !important; }
.navbar .dropdown-menu {
    background: #0f0f1a;
    border: 1px solid rgba(217,4,41,0.15);
    border-radius: 14px;
    padding: 8px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.7), 0 0 40px rgba(217,4,41,0.08);
    margin-top: 8px;
}
.navbar .dropdown-item {
    color: rgba(255,255,255,0.75);
    border-radius: 8px; padding: 8px 14px;
    font-size: 14px; transition: all 0.2s;
}
.navbar .dropdown-item:hover { background: rgba(217,4,41,0.1); color: #fff; }
.navbar .dropdown-item.text-danger { color: #ff4466 !important; }
.navbar .dropdown-item.text-danger:hover { background: rgba(217,4,41,0.15); }
.navbar .dropdown-divider { border-color: rgba(255,255,255,0.06); }
.navbar .dropdown-item-text { padding: 6px 14px; font-size: 13px; color: rgba(255,255,255,0.5); }
.navbar .dropdown-item-text strong { color: #fff; display: block; }

/* ── HERO ────────────────────────────────────────── */
.hero {
    position: relative;
    min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
    text-align: center;
    overflow: hidden;
}
.hero-bg {
    position: absolute; inset: 0;
    background-image: url('{{ asset($heroBackgroundImage ?? 'images/home_kokiku.jpeg') }}');
    background-size: cover;
    background-position: center;
    transform: scale(1.05);
    animation: heroZoom 18s ease-in-out infinite alternate;
}
@keyframes heroZoom {
    from { transform: scale(1.05); }
    to   { transform: scale(1.12); }
}
.hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(
        150deg,
        rgba(180,0,35,0.85) 0%,
        rgba(15,5,40,0.72) 45%,
        rgba(7,7,15,0.95) 100%
    );
}
.hero-content {
    position: relative; z-index: 2;
    padding: 0 20px;
    animation: fadeUp 1s ease both;
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}

.hero-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,183,3,0.12);
    border: 1px solid rgba(255,183,3,0.5);
    border-radius: 30px; padding: 6px 18px;
    font-size: 13px; font-weight: 600; color: var(--gold);
    letter-spacing: 0.5px; margin-bottom: 24px;
    animation: fadeUp 1s 0.1s ease both;
    box-shadow: 0 0 24px rgba(255,183,3,0.2), inset 0 1px 0 rgba(255,255,255,0.08);
}

.hero h1 {
    font-size: clamp(32px, 6vw, 72px);
    font-weight: 900;
    line-height: 1.08;
    letter-spacing: -1px;
    margin-bottom: 18px;
    animation: fadeUp 1s 0.2s ease both;
}
.hero h1 span { color: var(--gold); }

.hero h4 {
    font-size: clamp(16px, 2.5vw, 28px);
    font-weight: 500;
    color: rgba(255,255,255,0.85);
    margin-bottom: 14px;
    animation: fadeUp 1s 0.3s ease both;
}

.hero p.desc {
    font-size: clamp(14px, 1.8vw, 20px);
    color: rgba(255,255,255,0.65);
    max-width: 560px; margin: 0 auto 36px;
    animation: fadeUp 1s 0.4s ease both;
}

.hero-cta {
    display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;
    animation: fadeUp 1s 0.5s ease both;
}
.btn-kokiku {
    background: linear-gradient(135deg, #ff1744 0%, #c62828 60%, #d90429 100%);
    color: #fff;
    font-weight: 700; font-size: 15px;
    padding: 13px 32px;
    border: none; border-radius: 50px;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 6px 30px rgba(255,23,68,0.5), 0 0 0 1px rgba(255,100,100,0.2);
    font-family: 'Outfit', sans-serif;
    position: relative; overflow: hidden;
}
.btn-kokiku::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent 60%);
    border-radius: 50px;
}
.btn-kokiku::after {
    content: '';
    position: absolute;
    top: -50%; left: -60%;
    width: 40%; height: 200%;
    background: rgba(255,255,255,0.15);
    transform: skewX(-20deg);
    transition: left 0.5s;
}
.btn-kokiku:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 50px rgba(255,23,68,0.65), 0 0 80px rgba(255,23,68,0.2);
    color: #fff;
}
.btn-kokiku:hover::after { left: 130%; }
.btn-outline-kokiku {
    background: transparent;
    color: #fff; font-weight: 600; font-size: 15px;
    padding: 12px 30px;
    border: 2px solid rgba(255,183,3,0.5);
    border-radius: 50px;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none;
    transition: all 0.3s;
    font-family: 'Outfit', sans-serif;
}
.btn-outline-kokiku:hover {
    border-color: var(--gold); color: var(--gold);
    transform: translateY(-4px);
    background: rgba(255,183,3,0.08);
    box-shadow: 0 0 40px rgba(255,183,3,0.25);
    text-shadow: 0 0 12px rgba(255,183,3,0.5);
}

.hero-nav-links {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-top: 36px;
    flex-wrap: wrap;
    animation: fadeUp 1s 0.6s ease both;
}
.hero-nav-link {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 26px;
    border-radius: 50px;
    font-size: 15px; font-weight: 700;
    text-decoration: none;
    transition: all 0.3s;
    letter-spacing: 0.3px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
}
.hero-nav-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.35);
    filter: brightness(1.1);
}
.hero-nav-sep {
    width: 5px; height: 5px; border-radius: 50%;
    background: rgba(255,255,255,0.3);
    display: inline-block;
    flex-shrink: 0;
}

/* ── SECTIONS COMMON ─────────────────────────────── */
section { padding: 90px 0; }

.section-tag {
    display: inline-block;
    background: linear-gradient(135deg, rgba(217,4,41,0.18), rgba(109,0,20,0.12));
    border: 1px solid rgba(217,4,41,0.4);
    color: #ff6680; border-radius: 20px;
    padding: 4px 16px; font-size: 12px; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    margin-bottom: 12px;
    box-shadow: 0 0 12px rgba(217,4,41,0.15);
}
.section-title {
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 800; margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.section-title span { color: var(--gold); }
.section-sub {
    font-size: 16px; color: rgba(255,255,255,0.4);
    max-width: 480px; margin: 0 auto 56px;
    line-height: 1.7;
}

/* ── ABOUT ───────────────────────────────────────── */
.about {
    background: linear-gradient(180deg, var(--dark) 0%, #0e0824 50%, #0a0516 100%);
    position: relative;
}
.about::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,23,68,0.6), rgba(255,183,3,0.3), rgba(255,23,68,0.6), transparent);
    box-shadow: 0 0 20px rgba(255,23,68,0.3);
}
.about-img-wrap {
    position: relative; border-radius: 24px; overflow: hidden;
    box-shadow: 0 30px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(217,4,41,0.1);
}
.about-img-wrap img {
    width: 100%; height: 420px;
    object-fit: cover;
    display: block;
    transition: transform 0.6s ease;
}
.about-img-wrap:hover img { transform: scale(1.04); }
.about-img-wrap::before {
    content: '';
    position: absolute; inset: 0; z-index: 1;
    background: linear-gradient(180deg, transparent 50%, rgba(8,8,16,0.7) 100%);
    border-radius: 24px;
}
.about-badge {
    position: absolute; bottom: 20px; left: 20px; z-index: 2;
    background: rgba(8,8,16,0.88);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255,183,3,0.2);
    border-radius: 14px; padding: 12px 18px;
    display: flex; align-items: center; gap: 10px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
}
.about-badge-icon {
    width: 38px; height: 38px; border-radius: 10px;
    background: linear-gradient(135deg, var(--gold), #ff6b35);
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: #000; font-weight: 800;
    box-shadow: 0 4px 12px rgba(255,183,3,0.4);
}
.about-badge-text .n { font-size: 18px; font-weight: 800; color: var(--gold); line-height: 1; }
.about-badge-text .l { font-size: 11px; color: rgba(255,255,255,0.4); }

.about-content { padding-left: 40px; }
.about-content .section-title { text-align: left; color: #f0f0f0; }
.about-content .section-tag { display: block; margin-bottom: 12px; }
.about-content p {
    font-size: 16px; line-height: 1.85;
    color: rgba(255,255,255,0.5);
    margin-bottom: 18px;
}
.about-stats { display: flex; gap: 24px; margin-top: 32px; flex-wrap: wrap; }
.stat-item {
    text-align: center;
    background: linear-gradient(135deg, rgba(255,183,3,0.08), rgba(255,23,68,0.05));
    border: 1px solid rgba(255,183,3,0.2);
    border-radius: 16px;
    padding: 16px 22px;
    min-width: 85px;
    transition: all 0.35s;
    position: relative; overflow: hidden;
}
.stat-item::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--red-light), var(--gold));
    opacity: 0; transition: opacity 0.3s;
}
.stat-item:hover {
    background: linear-gradient(135deg, rgba(255,183,3,0.14), rgba(255,23,68,0.08));
    border-color: rgba(255,183,3,0.45);
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(255,183,3,0.2), 0 0 0 1px rgba(255,183,3,0.15);
}
.stat-item:hover::before { opacity: 1; }
.stat-num { font-size: 30px; font-weight: 800; color: var(--gold); line-height: 1; text-shadow: 0 0 20px rgba(255,183,3,0.6); }
.stat-label { font-size: 11px; color: rgba(255,255,255,0.35); margin-top: 5px; text-transform: uppercase; letter-spacing: 0.8px; }

/* ── MENU ────────────────────────────────────────── */
.menu-section {
    background: linear-gradient(180deg, #0e0824 0%, #0a0a1e 50%, #0c0514 100%);
    position: relative;
}
.menu-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(108,99,255,0.5), var(--gold), rgba(108,99,255,0.5), transparent);
    box-shadow: 0 0 20px rgba(108,99,255,0.3);
}
.menu-card {
    background: linear-gradient(145deg, #15152e, #0f0f22);
    border: 1px solid rgba(108,99,255,0.18);
    border-radius: 20px; overflow: hidden;
    transition: all 0.4s;
    height: 100%;
    box-shadow: 0 4px 24px rgba(0,0,0,0.5);
}
.menu-card:hover {
    transform: translateY(-12px) scale(1.01);
    border-color: rgba(255,23,68,0.6);
    box-shadow: 0 28px 70px rgba(0,0,0,0.7), 0 0 0 1px rgba(255,23,68,0.3), 0 0 60px rgba(255,23,68,0.12);
}
.menu-card-img {
    height: 220px; overflow: hidden; position: relative;
}
.menu-card-img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
    display: block;
}
.menu-card:hover .menu-card-img img { transform: scale(1.1); }
.menu-card-img::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 55%, rgba(8,8,20,0.65));
}
.menu-card-body { padding: 20px; }
.menu-card-body h5 { font-size: 17px; font-weight: 700; color: #f0f0f0; margin-bottom: 6px; }
.menu-card-body .price {
    font-size: 16px; font-weight: 700; color: var(--gold);
    display: flex; align-items: center; gap: 5px;
    text-shadow: 0 0 16px rgba(255,183,3,0.5);
}
.menu-tag {
    display: inline-block;
    background: rgba(34,197,94,0.08);
    border: 1px solid rgba(34,197,94,0.25);
    color: #3ddc84; border-radius: 20px;
    padding: 2px 10px; font-size: 11px; font-weight: 700;
    margin-bottom: 10px;
    letter-spacing: 0.3px;
}

/* ── GALLERY ─────────────────────────────────────── */
.gallery {
    background: linear-gradient(180deg, #0a0a1e 0%, var(--dark) 100%);
    position: relative;
}
.gallery::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,183,3,0.5), rgba(255,23,68,0.3), rgba(255,183,3,0.5), transparent);
    box-shadow: 0 0 20px rgba(255,183,3,0.2);
}
.gallery-item {
    border-radius: 18px; overflow: hidden;
    position: relative; cursor: pointer;
    box-shadow: 0 8px 30px rgba(0,0,0,0.6);
    transition: transform 0.4s, box-shadow 0.4s;
}
.gallery-item:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 24px 70px rgba(0,0,0,0.8), 0 0 0 2px rgba(255,183,3,0.35), 0 0 40px rgba(255,183,3,0.1);
}
.gallery-item img {
    width: 100%; height: 260px;
    object-fit: cover; display: block;
    transition: transform 0.5s ease;
}
.gallery-item:hover img { transform: scale(1.08); }
.gallery-item-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(transparent 35%, rgba(8,8,20,0.85));
    opacity: 0; transition: opacity 0.35s;
    display: flex; align-items: flex-end; padding: 18px;
}
.gallery-item:hover .gallery-item-overlay { opacity: 1; }
.gallery-item-overlay span {
    color: #fff; font-size: 13px; font-weight: 700;
    display: flex; align-items: center; gap: 6px;
    background: rgba(255,183,3,0.22);
    border: 1px solid rgba(255,183,3,0.5);
    padding: 6px 16px; border-radius: 20px;
    backdrop-filter: blur(6px);
    letter-spacing: 0.3px;
    box-shadow: 0 0 14px rgba(255,183,3,0.25);
}

/* ── CONTACT ─────────────────────────────────────── */
.contact {
    background: linear-gradient(180deg, var(--dark) 0%, #0e0520 50%, #07070f 100%);
    position: relative;
}
.contact::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,23,68,0.6), rgba(255,183,3,0.3), rgba(255,23,68,0.6), transparent);
    box-shadow: 0 0 24px rgba(255,23,68,0.25);
}
.contact-card {
    background: linear-gradient(145deg, #14142e, #0f0f22);
    border: 1px solid rgba(108,99,255,0.15);
    border-radius: 24px; padding: 34px 26px;
    text-align: center;
    height: 100%;
    transition: all 0.4s;
    box-shadow: 0 4px 24px rgba(0,0,0,0.5);
    position: relative; overflow: hidden;
}
.contact-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--red-light), var(--purple), var(--gold));
    opacity: 0; transition: opacity 0.4s;
}
.contact-card:hover {
    border-color: rgba(255,23,68,0.45);
    transform: translateY(-8px);
    box-shadow: 0 24px 60px rgba(0,0,0,0.6), 0 0 40px rgba(255,23,68,0.1);
}
.contact-card:hover::before { opacity: 1; }
.contact-icon {
    width: 60px; height: 60px; border-radius: 18px;
    background: linear-gradient(135deg, rgba(255,23,68,0.25), rgba(180,0,35,0.15));
    border: 1px solid rgba(255,23,68,0.35);
    display: flex; align-items: center; justify-content: center;
    font-size: 24px; color: #ff4466;
    margin: 0 auto 20px;
    box-shadow: 0 0 30px rgba(255,23,68,0.2), inset 0 1px 0 rgba(255,255,255,0.05);
    transition: all 0.35s;
}
.contact-card:hover .contact-icon {
    background: linear-gradient(135deg, rgba(255,23,68,0.35), rgba(180,0,35,0.25));
    box-shadow: 0 0 50px rgba(255,23,68,0.4), 0 0 0 4px rgba(255,23,68,0.1);
    transform: scale(1.08) rotate(-3deg);
    color: #ff6680;
}
.contact-card h5 { font-size: 16px; font-weight: 700; margin-bottom: 6px; }
.contact-card p { font-size: 14px; color: rgba(255,255,255,0.4); margin: 0; line-height: 1.6; }

/* ── FOOTER ──────────────────────────────────────── */
footer {
    background: linear-gradient(180deg, #0e0520 0%, #07070f 100%);
    border-top: 1px solid rgba(255,23,68,0.2);
    padding: 40px 0 24px;
    position: relative;
}
footer::before {
    content: '';
    position: absolute;
    top: 0; left: 50%; transform: translateX(-50%);
    width: 50%; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,183,3,0.6), rgba(255,23,68,0.4), rgba(255,183,3,0.6), transparent);
    box-shadow: 0 0 20px rgba(255,183,3,0.3);
}
.footer-logo {
    display: flex; align-items: center; gap: 10px;
    font-size: 22px; font-weight: 800; color: var(--gold);
    margin-bottom: 10px;
    text-shadow: 0 0 30px rgba(255,183,3,0.5);
}
.footer-logo img {
    width: 36px; height: 36px; border-radius: 50%; object-fit: cover;
    border: 2px solid rgba(255,183,3,0.6);
    box-shadow: 0 0 20px rgba(255,183,3,0.4);
}
footer p { font-size: 13px; color: rgba(255,255,255,0.28); margin: 0; }
.footer-links { display: flex; gap: 20px; justify-content: flex-end; flex-wrap: wrap; }
.footer-links a { font-size: 13px; color: rgba(255,255,255,0.35); text-decoration: none; transition: color 0.2s; }
.footer-links a:hover { color: var(--gold); }

.footer-social { display: flex; width: 100%; gap: 20px; justify-content: center; margin-top: 12px; }
.footer-social a {
    width: 66px; height: 66px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 30px;
    text-decoration: none;
    transition: transform 0.25s, box-shadow 0.25s;
    position: relative;
}
.footer-social a::before {
    content: '';
    position: absolute; inset: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    transition: all 0.25s;
}
.footer-social a:hover { transform: translateY(-4px); }
.footer-social a:hover::before {
    background: rgba(255,183,3,0.1);
    border-color: rgba(255,183,3,0.4);
    box-shadow: 0 0 30px rgba(255,183,3,0.25), 0 0 60px rgba(255,23,68,0.1);
}

.footer-hours { max-width: 250px; margin: 14px auto 0; text-align: left; }
.footer-hours h6 {
    text-align: center; color: var(--gold); font-weight: 800;
    font-size: 14px; letter-spacing: 4px; text-transform: uppercase;
    margin-bottom: 16px;
}
.footer-hours .hours-row {
    display: flex; justify-content: space-between;
    padding: 5px 0; font-size: 14px;
}
.footer-hours .hours-row span:first-child { color: rgba(255,255,255,0.85); }
.footer-hours .hours-row span:last-child { color: rgba(255,255,255,0.55); }

/* ── DIVIDER ─────────────────────────────────────── */
.section-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,23,68,0.4), rgba(255,183,3,0.25), rgba(108,99,255,0.2), rgba(255,183,3,0.25), rgba(255,23,68,0.4), transparent);
    margin: 0;
    box-shadow: 0 0 10px rgba(255,23,68,0.15);
}

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 768px) {
    .about-content { padding-left: 0; margin-top: 32px; }
    .about-stats { justify-content: center; }
    .footer-links { justify-content: center; margin-top: 16px; }
}
</style>
</head>
<body>

<!-- ═══════════════ NAVBAR ═══════════════ -->
<nav class="navbar navbar-expand-lg navbar-dark" id="mainNav">
<div class="container">

    <a class="navbar-brand" href="#home">
        <div class="logo-ring">
            <img src="{{ asset($logoImage ?? 'images/logo_kokiku.png') }}" alt="Logo KOKIKU">
        </div>
        KOKIKU
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">



        {{-- Profile – right --}}
        @if(auth()->check())
        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown">
                <a class="profile-btn nav-link dropdown-toggle" href="#" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="p-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-item-text">
                        <strong>{{ auth()->user()->name }}</strong>
                        {{ ucfirst(auth()->user()->role) }}
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa-solid fa-user me-2"></i>Profil Saya</a></li>
                    @if(auth()->user()->role === 'admin')
                    <li><a class="dropdown-item" href="{{ url('/admin') }}"><i class="fa-solid fa-gauge-high me-2"></i>Dashboard Admin</a></li>
                    @endif
                    <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
                </ul>
            </li>
        </ul>
        @endif

    </div>
</div>
</nav>

<!-- ═══════════════ HERO ═══════════════ -->
<section class="hero" id="home">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 style="color:{{ $heroTitleColor ?? '#ffffff' }}; font-weight:{{ $heroTitleWeight ?? '900' }};">
            {{ $heroTitle ?? 'SELAMAT DATANG DI RESTO KOKIKU' }}
        </h1>
        <h4 style="color:{{ $heroSubtitleColor ?? '#ffffff' }}; font-weight:{{ $heroSubtitleWeight ?? '500' }}; font-size:{{ $heroSubtitleSize ?? '28px' }};">
            {{ $heroSubtitle ?? 'Moslem Chinese Foods Halal' }}
        </h4>
        <p class="desc" style="color:{{ $heroTextColor ?? 'rgba(255,255,255,0.65)' }}; font-size:{{ $heroTextSize ?? '18px' }};">
            {{ $heroText ?? 'Nikmati cita rasa terbaik dengan pengalaman kuliner yang tak pernah terlupakan.' }}
        </p>
        <div class="hero-nav-links">
            <a href="#about" class="hero-nav-link"
               style="background:{{ $navLinkBgColor ?? '#ffc107' }};color:{{ $navLinkColor ?? '#000000' }};">
                <i class="fa-solid fa-address-card" style="font-size:13px;"></i> Tentang
            </a>
            <a href="#menu-kami" class="hero-nav-link"
               style="background:{{ $navLinkBgColor ?? '#ffc107' }};color:{{ $navLinkColor ?? '#000000' }};">
                <i class="fa-solid fa-bowl-food" style="font-size:13px;"></i> Menu
            </a>
            <a href="#gallery" class="hero-nav-link"
               style="background:{{ $navLinkBgColor ?? '#ffc107' }};color:{{ $navLinkColor ?? '#000000' }};">
                <i class="fa-solid fa-images" style="font-size:13px;"></i> Galeri
            </a>
            <a href="#contact" class="hero-nav-link"
               style="background:{{ $navLinkBgColor ?? '#ffc107' }};color:{{ $navLinkColor ?? '#000000' }};">
                <i class="fa-solid fa-envelope" style="font-size:13px;"></i> Kontak
            </a>
        </div>
    </div>
    <div class="hero-scroll">
        <i class="fa-solid fa-chevron-down"></i>
        <span>Scroll</span>
    </div>
</section>

<div class="section-divider"></div>

<!-- ═══════════════ ABOUT ═══════════════ -->
<section class="about" id="about">
<div class="container">
    <div class="row align-items-center g-5">
        <div class="col-lg-5">
            <div class="about-img-wrap">
                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800&q=80" alt="KOKIKU Resto">
            </div>
        </div>
        <div class="col-lg-7">
            <div class="about-content">
                
                <h2 class="section-title"
                    style="color:{{ $aboutTitleColor ?? '#f0f0f0' }}; font-weight:{{ $aboutTitleWeight ?? '800' }}; font-size:{{ $aboutTitleSize ?? '40px' }};">
                    {{ $aboutTitle ?? 'Tentang KOKIKU' }}
                </h2>
                <p style="color:{{ $aboutParagraphColor ?? 'rgba(255,255,255,0.55)' }}; font-weight:{{ $aboutParagraphWeight ?? '400' }}; font-size:{{ $aboutParagraphSize ?? '16px' }};">
                    {{ $aboutParagraph1 ?? 'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.' }}
                </p>
                <p style="color:{{ $aboutParagraphColor ?? 'rgba(255,255,255,0.55)' }}; font-weight:{{ $aboutParagraphWeight ?? '400' }}; font-size:{{ $aboutParagraphSize ?? '16px' }};">
                    {{ $aboutParagraph2 ?? 'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.' }}
                </p>
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-num">50+</div>
                        <div class="stat-label">Menu Pilihan</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">10K+</div>
                        <div class="stat-label">Pelanggan</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">100%</div>
                        <div class="stat-label">Halal</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<div class="section-divider"></div>

<!-- ═══════════════ MENU ═══════════════ -->
<section class="menu-section" id="menu-kami">
<div class="container">
    <div class="text-center">
        
        <h2 class="section-title" style="color:#f0f0f0;">Menu Favorit</h2>
        <p class="section-sub">Cita rasa otentik Chinese halal yang selalu bikin rindu</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="menu-card">
                <div class="menu-card-img">
                    <img src="https://images.unsplash.com/photo-1604908554165-e7c3d31c89c4?w=600&q=80" alt="Nasi Goreng">
                </div>
                <div class="menu-card-body">
                    <span class="menu-tag"><i class="fa-solid fa-leaf me-1"></i>Halal</span>
                    <h5>Nasi Goreng Spesial</h5>
                    <div class="price"><i class="fa-solid fa-tag" style="font-size:12px;"></i> Rp 25.000</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="menu-card">
                <div class="menu-card-img">
                    <img src="https://images.unsplash.com/photo-1529042410759-befb1204b468?w=600&q=80" alt="Sate Ayam">
                </div>
                <div class="menu-card-body">
                    <span class="menu-tag"><i class="fa-solid fa-leaf me-1"></i>Halal</span>
                    <h5>Sate Ayam</h5>
                    <div class="price"><i class="fa-solid fa-tag" style="font-size:12px;"></i> Rp 30.000</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="menu-card">
                <div class="menu-card-img">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&q=80" alt="Ayam Bakar">
                </div>
                <div class="menu-card-body">
                    <span class="menu-tag"><i class="fa-solid fa-leaf me-1"></i>Halal</span>
                    <h5>Ayam Bakar Madu</h5>
                    <div class="price"><i class="fa-solid fa-tag" style="font-size:12px;"></i> Rp 35.000</div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<div class="section-divider"></div>

<!-- ═══════════════ GALLERY ═══════════════ -->
<section class="gallery" id="gallery">
<div class="container">
    <div class="text-center">
        
        <h2 class="section-title" style="color:#f0f0f0;">Galeri Resto</h2>
        <p class="section-sub">Sekilas suasana dan hidangan terbaik KOKIKU</p>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=700&q=80" alt="Galeri 1">
                <div class="gallery-item-overlay"><span><i class="fa-solid fa-expand"></i> Lihat</span></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?w=700&q=80" alt="Galeri 2">
                <div class="gallery-item-overlay"><span><i class="fa-solid fa-expand"></i> Lihat</span></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=700&q=80" alt="Galeri 3">
                <div class="gallery-item-overlay"><span><i class="fa-solid fa-expand"></i> Lihat</span></div>
            </div>
        </div>
    </div>
</div>
</section>

<div class="section-divider"></div>

<!-- ═══════════════ CONTACT ═══════════════ -->
<section class="contact" id="contact">
<div class="container">
    <div class="text-center mb-5">
        <h2 class="section-title" style="color:#f0f0f0;">Hubungi Kami</h2>
        <p class="section-sub">Kami siap melayani Anda setiap saat</p>
    </div>
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="contact-card">
                <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                <h5>Alamat</h5>
                <p>Jl. Pahlawan No.59, Kepanjen,</p>
                <p>Kec. Jombang, Kabupaten</p>
                <p>Jombang, Jawa Timur 61419</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-card">
                <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
                <h5>Telepon</h5>
                <p>0812-3200-3556</p>
                <p></p>
                <p></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-card">
                <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                <h5>Email</h5>
                <p>info@kokiku.com</p>
            </div>
        </div>
    </div>
</div>
</section>

<!-- ═══════════════ FOOTER ═══════════════ -->
<footer>
<div class="container">
    <div class="row align-items-center py-2">
        <div class="col-md-12">
            <div class="footer-social">
                <a href="https://instagram.com/kokiku_jombang" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://tiktok.com/@kokikujombang" target="_blank" rel="noopener" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://wa.me/6281232003556" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
            <div class="col-12">
    <div class="footer-hours">
        <h6>Opening Hours</h6>
        <div class="hours-row"><span>Monday</span><span>09:00 AM - 10:00 PM</span></div>
        <div class="hours-row"><span>Tuesday</span><span>09:00 AM - 10:00 PM</span></div>
        <div class="hours-row"><span>Wednesday</span><span>09:00 AM - 10:00 PM</span></div>
        <div class="hours-row"><span>Thursday</span><span>09:00 AM - 10:00 PM</span></div>
        <div class="hours-row"><span>Friday</span><span>09:00 AM - 10:00 PM</span></div>
        <div class="hours-row"><span>Saturday</span><span>09:00 AM - 10:00 PM</span></div>
        <div class="hours-row"><span>Sunday</span><span>09:00 AM - 10:00 PM</span></div>
    </div>
</div>
        </div>
    </div>
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Navbar scroll effect
const nav = document.getElementById('mainNav');
window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 60);
});

// Active nav link on scroll
const sections  = document.querySelectorAll('section[id]');
const navLinks  = document.querySelectorAll('.nav-link[href^="#"]');
const observer  = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            navLinks.forEach(l => l.classList.remove('active'));
            const active = document.querySelector(`.nav-link[href="#${e.target.id}"]`);
            if (active) active.classList.add('active');
        }
    });
}, { threshold: 0.45 });
sections.forEach(s => observer.observe(s));

// Animate elements on scroll
const animItems = document.querySelectorAll('.menu-card, .gallery-item, .contact-card, .about-img-wrap, .about-content');
const animObs   = new IntersectionObserver(entries => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => {
                e.target.style.opacity = '1';
                e.target.style.transform = 'translateY(0)';
            }, i * 80);
            animObs.unobserve(e.target);
        }
    });
}, { threshold: 0.12 });
animItems.forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    animObs.observe(el);
});
</script>
</body>
</html>