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

<input type="email"
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

</body>
</html>