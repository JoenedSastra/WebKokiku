<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Tentang KOKIKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex align-items-center mb-3">
        <a href="{{ url('/admin') }}" class="btn btn-secondary btn-sm me-2">Kembali ke Dashboard</a>
        <h1 class="mb-0">Pengaturan Tentang KOKIKU</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/settings') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Bagian Tentang</label>
                    <input type="text" name="about_title" class="form-control" value="{{ old('about_title', $aboutTitle) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Paragraf 1</label>
                    <textarea name="about_paragraph1" class="form-control" rows="4" required>{{ old('about_paragraph1', $aboutParagraph1) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Paragraf 2</label>
                    <textarea name="about_paragraph2" class="form-control" rows="4" required>{{ old('about_paragraph2', $aboutParagraph2) }}</textarea>
                </div>

                <button class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
