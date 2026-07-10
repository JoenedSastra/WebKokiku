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

<input
type="email"
class="form-control"
name="email"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
class="form-control"
name="password"
required>

</div>

<div class="mb-3">

<label>Konfirmasi Password</label>

<input
type="password"
class="form-control"
name="password_confirmation"
required>

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

</body>

</html>