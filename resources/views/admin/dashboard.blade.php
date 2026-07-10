<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex align-items-center mb-3">
        <a href="{{ url('/home') }}" class="btn btn-secondary btn-sm me-2">Kembali ke Beranda</a>
        <h1 class="mb-0">Dashboard Admin</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Akun Anda</h5>
            <p class="mb-1"><strong>Nama:</strong> {{ $admin->name }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $admin->email }}</p>
            <p class="mb-0"><strong>Role:</strong> {{ ucfirst($admin->role) }}</p>
        </div>
    </div>

    <h3>Daftar Pengguna</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        @if($user->role !== 'admin')
                            <form method="POST" action="{{ url('/admin/users/'.$user->id.'/delete') }}" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                @csrf
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>