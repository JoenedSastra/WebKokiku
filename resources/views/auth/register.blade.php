<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | KOKIKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
        }

        .register-box {
            width: 450px;
            margin: auto;
            margin-top: 60px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, .2);
        }

        .logo {
            font-size: 38px;
            font-weight: bold;
            color: #dc3545;
        }

        .input-group-text {
            background: #f8f9fa;
            border-right: 0;
        }

        .input-group-text {
            background: #f8f9fa;
            border-right: 0;
        }

        .form-control {
            border-left: 0;
        }

        .input-group .btn {
            border: none;
            background: transparent;
            padding: 0.6rem 0.75rem;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .icon-button {
            color: #6c757d;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .icon-button:hover,
        .icon-button:focus {
            color: #212529;
            background: rgba(0, 0, 0, 0.05);
            transform: scale(1.05);
        }

        .icon-button svg,
        .input-group-text svg,
        .input-group-text .icon-emoji {
            width: 18px;
            height: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-text .icon-emoji {
            font-size: 16px;
            line-height: 1;
        }

        .input-group-text svg.thin,
        .icon-button svg.thin {
            stroke-width: 0.9 !important;
        }

        .eye-animation {
            animation: eyeMove 1.6s ease-in-out infinite alternate;
            transform-origin: center;
        }

        @keyframes eyeMove {
            from { transform: translateX(0); }
            to { transform: translateX(1px); }
        }
    </style>
</head>
<body>

<div class="register-box">
    <div class="text-center mb-4">
        <div class="logo">KOKIKU</div>
        <h4 class="mt-3">Register User</h4>
    </div>

    <form action="{{ url('/register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <div class="input-group">
                <span class="input-group-text">
                    <span class="icon-emoji">👤</span>
                </span>
                <input type="text" class="form-control" name="name" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <span class="icon-emoji">📧</span>
                </span>
                <input type="email" class="form-control" name="email" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <span class="icon-emoji">🔒</span>
                </span>
                <input type="password" class="form-control" id="password" name="password" required>
                <button class="btn icon-button" type="button" id="togglePassword" aria-label="Toggle password visibility">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="togglePasswordIcon" class="eye-animation" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <span class="icon-emoji">🔒</span>
                </span>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                <button class="btn icon-button" type="button" id="togglePasswordConfirmation" aria-label="Toggle confirmation password visibility">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="togglePasswordConfirmationIcon" class="eye-animation" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
        </div>

        <button class="btn btn-danger w-100">Register</button>
    </form>

    <hr>

    <div class="text-center">
        Sudah punya akun?
        <a href="{{ url('/login') }}">Login</a>
    </div>
</div>

<script>
    function eyeOpenIcon() {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="eye-animation" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">' +
            '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>' +
            '<circle cx="12" cy="12" r="3"/>' +
            '</svg>';
    }

    function eyeSlashIcon() {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="eye-animation" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">' +
            '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>' +
            '<circle cx="12" cy="12" r="3"/>' +
            '<path d="M2 2l20 20"/>' +
            '</svg>';
    }

    function toggleVisibility(buttonId, inputId) {
        const button = document.getElementById(buttonId);
        const input = document.getElementById(inputId);

        button.addEventListener('click', function () {
            const isHidden = input.getAttribute('type') === 'password';
            input.setAttribute('type', isHidden ? 'text' : 'password');
            this.innerHTML = isHidden ? eyeSlashIcon() : eyeOpenIcon();
        });
    }

    toggleVisibility('togglePassword', 'password');
    toggleVisibility('togglePasswordConfirmation', 'password_confirmation');
</script>

</body>
</html>
