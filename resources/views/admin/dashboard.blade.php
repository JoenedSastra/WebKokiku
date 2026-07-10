<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #f4f5f8;
            color: #212529;
        }

        .admin-header {
            gap: 1rem;
            flex-wrap: wrap;
        }

        .admin-card {
            border-radius: 18px;
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.06);
        }

        .admin-card .card-body {
            padding: 1.8rem;
        }

        .section-title {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            text-transform: uppercase;
            font-size: 0.92rem;
            letter-spacing: 0.05em;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.9);
        }

        .btn-primary {
            min-width: 190px;
        }

        .dashboard-container {
            max-width: 1080px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container dashboard-container py-4">
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('landing') }}" class="btn btn-secondary btn-sm me-2">Kembali ke Beranda</a>
        <h1 class="mb-0">Dashboard Admin</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title">Akun Anda</h5>
                <p class="mb-1"><strong>Nama:</strong> {{ $admin->name }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $admin->email }}</p>
                <p class="mb-0"><strong>Role:</strong> {{ ucfirst($admin->role) }}</p>
            </div>
            <div>
                <a href="{{ url('/admin/settings') }}" class="btn btn-primary">Kelola Tentang KOKIKU</a>
            </div>
        </div>
    </div>

    <h3>Daftar Pengguna</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
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