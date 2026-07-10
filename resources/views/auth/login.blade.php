<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | KOKIKU</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:url('/images/resto.jpg');
            background-size:cover;
            background-position:center;
            height:100vh;
        }

        .overlay{
            background:rgba(0,0,0,.6);
            height:100vh;
        }

        .login-box{

            width:420px;

            background:white;

            padding:35px;

            border-radius:12px;

            box-shadow:0 0 20px rgba(0,0,0,.3);

        }

        .logo{

            color:#dc3545;

            font-weight:bold;

            font-size:40px;

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
        .input-group-text svg {
            width: 18px;
            height: 18px;
            display: block;
            stroke: currentColor;
            stroke-width: 1.2;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
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

<div class="overlay d-flex justify-content-center align-items-center">

<div class="login-box">

<div class="text-center">

<div class="logo">

KOKIKU

</div>

<h4 class="mb-4">

Login

</h4>

</div>

@if(session('error'))

<div class="alert alert-danger">

{{ session('error') }}

</div>

@endif

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<form action="{{ url('/login') }}" method="POST">

@csrf

<div class="mb-3">

<label>Email</label>

<div class="input-group">
    <span class="input-group-text">📧</span>
    <input type="email"
    class="form-control"
    name="email"
    required>
</div>

</div>

<div class="mb-3">

<label>Password</label>

<div class="input-group">
    <span class="input-group-text">🔒</span>
    <input
    type="password"
    class="form-control"
    id="password"
    name="password"
    required>
    <button class="btn icon-button" type="button" id="togglePassword" aria-label="Toggle password visibility">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="togglePasswordIcon" class="eye-animation" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>
    </button>
</div>

</div>

<button class="btn btn-danger w-100">

Login

</button>

</form>

<hr>

<p class="text-center">

Belum punya akun?

<a href="{{ url('/register') }}">

Register

</a>

</p>

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

    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const isHidden = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isHidden ? 'text' : 'password');
        this.innerHTML = isHidden ? eyeSlashIcon() : eyeOpenIcon();
    });
</script>

</body>
</html>