<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KOKIKU</title>
    <link rel="icon" href="{{ $faviconUrl ?? asset('images/logo_kokiku.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
        --red:      #ff1744;
        --red-dark: #b71c1c;
        --gold:     #ffb703;
        --dark:     #07070f;
    }

    body {
        font-family: 'Outfit', sans-serif;
        background: var(--dark);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    /* ─── ANIMATED BACKGROUND ─── */
    .bg-scene {
        position: fixed; inset: 0; z-index: 0;
        background:
            radial-gradient(ellipse 80% 60% at 20% 10%, rgba(255,23,68,0.18) 0%, transparent 60%),
            radial-gradient(ellipse 60% 50% at 80% 80%, rgba(255,183,3,0.12) 0%, transparent 55%),
            radial-gradient(ellipse 50% 70% at 50% 50%, rgba(108,99,255,0.08) 0%, transparent 60%),
            #07070f;
    }

    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        animation: orbFloat 8s ease-in-out infinite;
        pointer-events: none;
    }
    .orb-1 {
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(255,23,68,0.25), transparent 70%);
        top: -100px; left: -100px;
        animation-delay: 0s;
    }
    .orb-2 {
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(255,183,3,0.2), transparent 70%);
        bottom: -80px; right: -80px;
        animation-delay: -3s;
    }
    .orb-3 {
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(108,99,255,0.18), transparent 70%);
        top: 50%; left: 60%;
        animation-delay: -5s;
    }
    @keyframes orbFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -40px) scale(1.05); }
        66% { transform: translate(-20px, 20px) scale(0.95); }
    }

    /* Grid lines */
    .bg-grid {
        position: fixed; inset: 0; z-index: 0;
        background-image:
            linear-gradient(rgba(255,23,68,0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,23,68,0.04) 1px, transparent 1px);
        background-size: 48px 48px;
    }

    /* ─── CARD ─── */
    .login-wrap {
        position: relative; z-index: 10;
        width: 100%; max-width: 440px;
        padding: 16px;
    }

    .login-card {
        background: rgba(12,12,22,0.85);
        backdrop-filter: blur(28px);
        -webkit-backdrop-filter: blur(28px);
        border: 1px solid rgba(255,23,68,0.2);
        border-radius: 24px;
        padding: 44px 40px 36px;
        box-shadow:
            0 0 0 1px rgba(255,255,255,0.04),
            0 30px 80px rgba(0,0,0,0.7),
            0 0 60px rgba(255,23,68,0.08),
            inset 0 1px 0 rgba(255,255,255,0.06);
        position: relative;
        overflow: hidden;
    }

    /* Top accent line */
    .login-card::before {
        content: '';
        position: absolute;
        top: 0; left: 10%; right: 10%; height: 2px;
        background: linear-gradient(90deg, transparent, var(--red), var(--gold), var(--red), transparent);
        border-radius: 0 0 4px 4px;
        filter: blur(0.5px);
    }

    /* Inner glow */
    .login-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 180px;
        background: linear-gradient(180deg, rgba(255,23,68,0.06), transparent);
        border-radius: 24px 24px 0 0;
        pointer-events: none;
    }

    /* ─── LOGO ─── */
    .login-logo {
        text-align: center;
        margin-bottom: 32px;
        position: relative; z-index: 1;
    }

    .logo-badge {
        display: inline-flex;
        align-items: center; gap: 10px;
        background: linear-gradient(135deg, rgba(255,23,68,0.15), rgba(255,183,3,0.08));
        border: 1px solid rgba(255,23,68,0.3);
        border-radius: 50px;
        padding: 8px 20px 8px 12px;
        margin-bottom: 14px;
    }
    .logo-icon {
        width: 36px; height: 36px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid rgba(255,183,3,0.5);
        box-shadow: 0 0 14px rgba(255,183,3,0.35);
        flex-shrink: 0;
    }
    .logo-icon img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .logo-text {
        font-size: 22px;
        font-weight: 900;
        letter-spacing: 2px;
        background: linear-gradient(135deg, #ff1744, #ffb703);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: none;
    }

    .login-title {
        font-size: 28px;
        font-weight: 800;
        color: #f0f0f0;
        margin-bottom: 4px;
    }
    .login-sub {
        font-size: 14px;
        color: rgba(255,255,255,0.35);
    }

    /* ─── ALERTS ─── */
    .alert-glow {
        background: rgba(255,23,68,0.1);
        border: 1px solid rgba(255,23,68,0.3);
        color: #ff6680;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 13px;
        margin-bottom: 18px;
        display: flex; align-items: center; gap: 8px;
    }
    .alert-success-glow {
        background: rgba(34,197,94,0.08);
        border: 1px solid rgba(34,197,94,0.25);
        color: #3ddc84;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 13px;
        margin-bottom: 18px;
        display: flex; align-items: center; gap: 8px;
    }

    /* ─── FORM ─── */
    .field-label {
        font-size: 12px;
        font-weight: 600;
        color: rgba(255,255,255,0.5);
        letter-spacing: 0.6px;
        text-transform: uppercase;
        margin-bottom: 7px;
        display: block;
    }

    .input-wrap {
        position: relative;
        margin-bottom: 20px;
    }

    .input-icon {
        position: absolute;
        left: 14px; top: 50%; transform: translateY(-50%);
        color: rgba(255,255,255,0.3);
        font-size: 14px;
        pointer-events: none;
        transition: color 0.25s;
    }

    .neon-input {
        width: 100%;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 13px 44px 13px 42px;
        color: #f0f0f0;
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 400;
        transition: all 0.3s;
        outline: none;
    }
    .neon-input::placeholder { color: rgba(255,255,255,0.25); }
    .neon-input:focus {
        background: rgba(255,23,68,0.06);
        border-color: rgba(255,23,68,0.5);
        box-shadow: 0 0 0 3px rgba(255,23,68,0.12), 0 0 20px rgba(255,23,68,0.08);
    }
    .neon-input:focus + .input-focus-line { opacity: 1; }
    .neon-input:focus ~ .input-icon { color: rgba(255,100,120,0.7); }

    .toggle-btn {
        position: absolute;
        right: 14px; top: 50%; transform: translateY(-50%);
        background: none; border: none;
        color: rgba(255,255,255,0.3);
        cursor: pointer;
        font-size: 14px;
        transition: color 0.2s;
        padding: 0;
    }
    .toggle-btn:hover { color: rgba(255,255,255,0.7); }

    /* ─── SUBMIT BUTTON ─── */
    .btn-login {
        width: 100%;
        background: linear-gradient(135deg, #ff1744 0%, #c62828 50%, #d90429 100%);
        border: none;
        border-radius: 14px;
        padding: 14px;
        color: #fff;
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        box-shadow: 0 6px 30px rgba(255,23,68,0.4), 0 0 0 1px rgba(255,100,100,0.2);
        margin-top: 6px;
    }
    .btn-login::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent 60%);
        border-radius: 14px;
    }
    .btn-login::after {
        content: '';
        position: absolute;
        top: -50%; left: -60%;
        width: 40%; height: 200%;
        background: rgba(255,255,255,0.12);
        transform: skewX(-20deg);
        transition: left 0.5s;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(255,23,68,0.55), 0 0 60px rgba(255,23,68,0.2);
    }
    .btn-login:hover::after { left: 130%; }
    .btn-login:active { transform: translateY(0); }

    /* ─── DIVIDER ─── */
    .divider {
        display: flex; align-items: center; gap: 12px;
        margin: 24px 0 18px;
    }
    .divider::before, .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(255,255,255,0.08);
    }
    .divider span {
        font-size: 12px; color: rgba(255,255,255,0.3);
        font-weight: 500;
    }

    /* ─── FOOTER LINK ─── */
    .login-footer {
        text-align: center;
        font-size: 14px;
        color: rgba(255,255,255,0.4);
    }
    .login-footer a {
        color: var(--gold);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s;
    }
    .login-footer a:hover {
        color: #ffe566;
        text-shadow: 0 0 12px rgba(255,183,3,0.5);
    }

    /* ─── FLOATING PARTICLES ─── */
    .particle {
        position: fixed;
        border-radius: 50%;
        pointer-events: none;
        z-index: 1;
        animation: particleFloat linear infinite;
        opacity: 0;
    }
    @keyframes particleFloat {
        0%   { transform: translateY(100vh) scale(0); opacity: 0; }
        10%  { opacity: 0.6; }
        90%  { opacity: 0.3; }
        100% { transform: translateY(-10vh) scale(1); opacity: 0; }
    }
    </style>
</head>
<body>

<!-- Background -->
<div class="bg-scene">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>
<div class="bg-grid"></div>

<!-- Particles -->
<div id="particles"></div>

<!-- Login Card -->
<div class="login-wrap">
    <div class="login-card">

        <!-- Logo -->
        <div class="login-logo">
            <div class="logo-badge">
                <div class="logo-icon">
                    <img src="{{ $logoUrl ?? asset('images/logo_kokiku.png') }}" alt="Logo">
                </div>
                <span class="logo-text">KOKIKU</span>
            </div>
            <div class="login-title">Selamat Datang</div>
            <div class="login-sub">Masuk ke akun Anda untuk melanjutkan</div>
        </div>

        <!-- Alerts -->
        @if(session('error'))
        <div class="alert-glow">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
        @endif
        @if(session('success'))
        <div class="alert-success-glow">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
        @endif

        <!-- Form -->
        <form action="{{ url('/login') }}" method="POST">
        @csrf

            <!-- Email -->
            <div>
                <label class="field-label">Email</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input type="email" name="email" required
                           class="neon-input"
                           placeholder="email@kokiku.com"
                           value="{{ old('email') }}">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="field-label">Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" required
                           class="neon-input"
                           placeholder="••••••••">
                    <button type="button" class="toggle-btn" id="togglePassword" aria-label="Toggle password">
                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk
            </button>

        </form>

        <div class="divider"><span>atau</span></div>

        <div class="login-footer">
            Belum punya akun?
            <a href="{{ url('/register') }}">Daftar Sekarang</a>
        </div>

    </div>
</div>

<script>
// Toggle password
const toggleBtn = document.getElementById('togglePassword');
const passInput = document.getElementById('password');
const eyeIcon   = document.getElementById('eyeIcon');
toggleBtn.addEventListener('click', () => {
    const show = passInput.type === 'password';
    passInput.type = show ? 'text' : 'password';
    eyeIcon.className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
});

// Floating particles
const colors = ['rgba(255,23,68,', 'rgba(255,183,3,', 'rgba(108,99,255,'];
const container = document.getElementById('particles');
for (let i = 0; i < 22; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    const size = Math.random() * 4 + 2;
    const color = colors[Math.floor(Math.random() * colors.length)];
    const opacity = (Math.random() * 0.4 + 0.2).toFixed(2);
    p.style.cssText = `
        width:${size}px; height:${size}px;
        left:${Math.random() * 100}vw;
        background:${color}${opacity});
        box-shadow: 0 0 ${size * 3}px ${color}0.6);
        animation-duration:${Math.random() * 10 + 8}s;
        animation-delay:-${Math.random() * 12}s;
    `;
    container.appendChild(p);
}
</script>

</body>
</html>