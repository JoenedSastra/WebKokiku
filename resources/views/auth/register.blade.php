<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Register | KOKIKU</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#f5f5f5;

}

.register-box{

width:450px;

margin:auto;

margin-top:60px;

background:white;

padding:35px;

border-radius:12px;

box-shadow:0 0 15px rgba(0,0,0,.2);

}

.logo{

font-size:38px;

font-weight:bold;

color:#dc3545;

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

<div class="register-box">

<div class="text-center">

<div class="logo">

KOKIKU

</div>

<h4>

Register User

</h4>

</div>

<form action="{{ url('/register') }}" method="POST">

@csrf

<div class="mb-3">

<label>Nama</label>

<input
type="text"
class="form-control"
name="name"
required>

</div>

<div class="mb-3">

<label>Email</label>

<div class="input-group">
    <span class="input-group-text">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.708 2.827L15 12.383V5.383zm-.034 7.166L9.2 8.82 8 9.583 6.8 8.82 1.034 12.55A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.451z"/>
        </svg>
    </span>
    <input
    type="email"
    class="form-control"
    name="email"
    required>
</div>

</div>

<div class="mb-3">

<label>Password</label>

<div class="input-group">
    <span class="input-group-text">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M8 1a4 4 0 0 0-4 4v3H3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1h-1V5a4 4 0 0 0-4-4zm-2 4a2 2 0 1 1 4 0v3H6V5zm-2 4h8v5H4v-5z"/>
        </svg>
    </span>
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

<div class="mb-3">

<label>Konfirmasi Password</label>

<div class="input-group">
    <span class="input-group-text">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M8 1a4 4 0 0 0-4 4v3H3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1h-1V5a4 4 0 0 0-4-4zm-2 4a2 2 0 1 1 4 0v3H6V5zm-2 4h8v5H4v-5z"/>
        </svg>
    </span>
    <input
    type="password"
    class="form-control"
    id="password_confirmation"
    name="password_confirmation"
    required>
    <button class="btn icon-button" type="button" id="togglePasswordConfirmation" aria-label="Toggle confirmation password visibility">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="togglePasswordConfirmationIcon" class="eye-animation" stroke="currentColor" fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>
    </button>
</div>

</div>

<button class="btn btn-danger w-100">

Register

</button>

</form>

<hr>

<div class="text-center">

Sudah punya akun?

<a href="{{ url('/login') }}">

Login

</a>

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

    toggleVisibility('togglePassword', 'password', 'togglePasswordIcon');
    toggleVisibility('togglePasswordConfirmation', 'password_confirmation', 'togglePasswordConfirmationIcon');
</script>

</body>

</html>