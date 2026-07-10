<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="p-4">

<div class="container">
    <h1 class="mb-3">Profil Saya</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p class="mb-1"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p class="mb-0"><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ url('/home') }}" class="btn btn-secondary btn-sm">Kembali ke Beranda</a>
        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
    </div>

</div>

</body>
</html>