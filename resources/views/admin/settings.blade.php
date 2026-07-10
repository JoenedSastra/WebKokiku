<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Tentang KOKIKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #eef1f6;
            color: #222;
        }

        .settings-container {
            max-width: 920px;
            margin: 0 auto;
        }

        .settings-card {
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.08);
        }

        .settings-card .card-body {
            padding: 2rem;
        }

        .settings-header {
            gap: 1rem;
            flex-wrap: wrap;
        }

        .form-label {
            font-weight: 600;
        }

        textarea.form-control,
        input.form-control {
            border-radius: 12px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            min-width: 180px;
        }
    </style>
</head>
<body>

<div class="container settings-container py-4">
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
                    <label class="form-label">Teks Hero Utama</label>
                    <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $heroTitle) }}" required>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Warna Hero Judul</label>
                        <input type="color" name="hero_title_color" class="form-control form-control-color" value="{{ old('hero_title_color', $heroTitleColor) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ketebalan Hero Judul</label>
                        <select name="hero_title_weight" class="form-select" required>
                            <option value="400" {{ old('hero_title_weight', $heroTitleWeight) === '400' ? 'selected' : '' }}>Normal</option>
                            <option value="500" {{ old('hero_title_weight', $heroTitleWeight) === '500' ? 'selected' : '' }}>Medium</option>
                            <option value="600" {{ old('hero_title_weight', $heroTitleWeight) === '600' ? 'selected' : '' }}>Semi Bold</option>
                            <option value="700" {{ old('hero_title_weight', $heroTitleWeight) === '700' ? 'selected' : '' }}>Bold</option>
                            <option value="800" {{ old('hero_title_weight', $heroTitleWeight) === '800' ? 'selected' : '' }}>Extra Bold</option>
                            <option value="900" {{ old('hero_title_weight', $heroTitleWeight) === '900' ? 'selected' : '' }}>Black</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran Hero Judul</label>
                        <select name="hero_title_size" class="form-select" required>
                            <option value="44px" {{ old('hero_title_size', $heroTitleSize) === '44px' ? 'selected' : '' }}>44px</option>
                            <option value="48px" {{ old('hero_title_size', $heroTitleSize) === '48px' ? 'selected' : '' }}>48px</option>
                            <option value="52px" {{ old('hero_title_size', $heroTitleSize) === '52px' ? 'selected' : '' }}>52px</option>
                            <option value="56px" {{ old('hero_title_size', $heroTitleSize) === '56px' ? 'selected' : '' }}>56px</option>
                            <option value="60px" {{ old('hero_title_size', $heroTitleSize) === '60px' ? 'selected' : '' }}>60px</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label class="form-label">Subjudul Hero</label>
                    <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', $heroSubtitle) }}" required>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Warna Subjudul Hero</label>
                        <input type="color" name="hero_subtitle_color" class="form-control form-control-color" value="{{ old('hero_subtitle_color', $heroSubtitleColor) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ketebalan Subjudul Hero</label>
                        <select name="hero_subtitle_weight" class="form-select" required>
                            <option value="400" {{ old('hero_subtitle_weight', $heroSubtitleWeight) === '400' ? 'selected' : '' }}>Normal</option>
                            <option value="500" {{ old('hero_subtitle_weight', $heroSubtitleWeight) === '500' ? 'selected' : '' }}>Medium</option>
                            <option value="600" {{ old('hero_subtitle_weight', $heroSubtitleWeight) === '600' ? 'selected' : '' }}>Semi Bold</option>
                            <option value="700" {{ old('hero_subtitle_weight', $heroSubtitleWeight) === '700' ? 'selected' : '' }}>Bold</option>
                            <option value="800" {{ old('hero_subtitle_weight', $heroSubtitleWeight) === '800' ? 'selected' : '' }}>Extra Bold</option>
                            <option value="900" {{ old('hero_subtitle_weight', $heroSubtitleWeight) === '900' ? 'selected' : '' }}>Black</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran Subjudul Hero</label>
                        <select name="hero_subtitle_size" class="form-select" required>
                            <option value="20px" {{ old('hero_subtitle_size', $heroSubtitleSize) === '20px' ? 'selected' : '' }}>20px</option>
                            <option value="24px" {{ old('hero_subtitle_size', $heroSubtitleSize) === '24px' ? 'selected' : '' }}>24px</option>
                            <option value="28px" {{ old('hero_subtitle_size', $heroSubtitleSize) === '28px' ? 'selected' : '' }}>28px</option>
                            <option value="32px" {{ old('hero_subtitle_size', $heroSubtitleSize) === '32px' ? 'selected' : '' }}>32px</option>
                            <option value="36px" {{ old('hero_subtitle_size', $heroSubtitleSize) === '36px' ? 'selected' : '' }}>36px</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label class="form-label">Teks Hero</label>
                    <textarea name="hero_text" class="form-control" rows="3" required>{{ old('hero_text', $heroText) }}</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Warna Teks Hero</label>
                        <input type="color" name="hero_text_color" class="form-control form-control-color" value="{{ old('hero_text_color', $heroTextColor) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ketebalan Teks Hero</label>
                        <select name="hero_text_weight" class="form-select" required>
                            <option value="400" {{ old('hero_text_weight', $heroTextWeight) === '400' ? 'selected' : '' }}>Normal</option>
                            <option value="500" {{ old('hero_text_weight', $heroTextWeight) === '500' ? 'selected' : '' }}>Medium</option>
                            <option value="600" {{ old('hero_text_weight', $heroTextWeight) === '600' ? 'selected' : '' }}>Semi Bold</option>
                            <option value="700" {{ old('hero_text_weight', $heroTextWeight) === '700' ? 'selected' : '' }}>Bold</option>
                            <option value="800" {{ old('hero_text_weight', $heroTextWeight) === '800' ? 'selected' : '' }}>Extra Bold</option>
                            <option value="900" {{ old('hero_text_weight', $heroTextWeight) === '900' ? 'selected' : '' }}>Black</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran Teks Hero</label>
                        <select name="hero_text_size" class="form-select" required>
                            <option value="16px" {{ old('hero_text_size', $heroTextSize) === '16px' ? 'selected' : '' }}>16px</option>
                            <option value="18px" {{ old('hero_text_size', $heroTextSize) === '18px' ? 'selected' : '' }}>18px</option>
                            <option value="20px" {{ old('hero_text_size', $heroTextSize) === '20px' ? 'selected' : '' }}>20px</option>
                            <option value="22px" {{ old('hero_text_size', $heroTextSize) === '22px' ? 'selected' : '' }}>22px</option>
                            <option value="24px" {{ old('hero_text_size', $heroTextSize) === '24px' ? 'selected' : '' }}>24px</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <div class="mb-3">
                    <label class="form-label">Judul Bagian Tentang</label>
                    <input type="text" name="about_title" class="form-control" value="{{ old('about_title', $aboutTitle) }}" required>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Warna Judul</label>
                        <input type="color" name="about_title_color" class="form-control form-control-color" value="{{ old('about_title_color', $aboutTitleColor) }}" title="Pilih warna judul" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ketebalan Judul</label>
                        <select name="about_title_weight" class="form-select" required>
                            <option value="400" {{ old('about_title_weight', $aboutTitleWeight) === '400' ? 'selected' : '' }}>Normal</option>
                            <option value="500" {{ old('about_title_weight', $aboutTitleWeight) === '500' ? 'selected' : '' }}>Medium</option>
                            <option value="600" {{ old('about_title_weight', $aboutTitleWeight) === '600' ? 'selected' : '' }}>Semi Bold</option>
                            <option value="700" {{ old('about_title_weight', $aboutTitleWeight) === '700' ? 'selected' : '' }}>Bold</option>
                            <option value="800" {{ old('about_title_weight', $aboutTitleWeight) === '800' ? 'selected' : '' }}>Extra Bold</option>
                            <option value="900" {{ old('about_title_weight', $aboutTitleWeight) === '900' ? 'selected' : '' }}>Black</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran Judul</label>
                        <select name="about_title_size" class="form-select" required>
                            <option value="28px" {{ old('about_title_size', $aboutTitleSize) === '28px' ? 'selected' : '' }}>28px</option>
                            <option value="32px" {{ old('about_title_size', $aboutTitleSize) === '32px' ? 'selected' : '' }}>32px</option>
                            <option value="36px" {{ old('about_title_size', $aboutTitleSize) === '36px' ? 'selected' : '' }}>36px</option>
                            <option value="40px" {{ old('about_title_size', $aboutTitleSize) === '40px' ? 'selected' : '' }}>40px</option>
                            <option value="44px" {{ old('about_title_size', $aboutTitleSize) === '44px' ? 'selected' : '' }}>44px</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label class="form-label">Warna Paragraf</label>
                        <input type="color" name="about_paragraph_color" class="form-control form-control-color" value="{{ old('about_paragraph_color', $aboutParagraphColor) }}" title="Pilih warna paragraf" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ketebalan Paragraf</label>
                        <select name="about_paragraph_weight" class="form-select" required>
                            <option value="400" {{ old('about_paragraph_weight', $aboutParagraphWeight) === '400' ? 'selected' : '' }}>Normal</option>
                            <option value="500" {{ old('about_paragraph_weight', $aboutParagraphWeight) === '500' ? 'selected' : '' }}>Medium</option>
                            <option value="600" {{ old('about_paragraph_weight', $aboutParagraphWeight) === '600' ? 'selected' : '' }}>Semi Bold</option>
                            <option value="700" {{ old('about_paragraph_weight', $aboutParagraphWeight) === '700' ? 'selected' : '' }}>Bold</option>
                            <option value="800" {{ old('about_paragraph_weight', $aboutParagraphWeight) === '800' ? 'selected' : '' }}>Extra Bold</option>
                            <option value="900" {{ old('about_paragraph_weight', $aboutParagraphWeight) === '900' ? 'selected' : '' }}>Black</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran Paragraf</label>
                        <select name="about_paragraph_size" class="form-select" required>
                            <option value="16px" {{ old('about_paragraph_size', $aboutParagraphSize) === '16px' ? 'selected' : '' }}>16px</option>
                            <option value="18px" {{ old('about_paragraph_size', $aboutParagraphSize) === '18px' ? 'selected' : '' }}>18px</option>
                            <option value="20px" {{ old('about_paragraph_size', $aboutParagraphSize) === '20px' ? 'selected' : '' }}>20px</option>
                            <option value="22px" {{ old('about_paragraph_size', $aboutParagraphSize) === '22px' ? 'selected' : '' }}>22px</option>
                            <option value="24px" {{ old('about_paragraph_size', $aboutParagraphSize) === '24px' ? 'selected' : '' }}>24px</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 mt-3">
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
