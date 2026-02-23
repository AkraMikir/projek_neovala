<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Review - Neovala Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/reviews.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="main-wrapper">
        <div class="main-content reviews-form-page">
            <header class="page-header">
                <div>
                    <h1>Tambah Review</h1>
                    <p class="subtitle">Tambah ulasan manual (admin)</p>
                </div>
                <a href="{{ route('admin.dashboard1.reviews.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </header>

            @if($errors->any())
                <ul class="form-errors">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="reviews-form-card">
                <form action="{{ route('admin.dashboard1.reviews.store') }}" method="POST" enctype="multipart/form-data" class="reviews-form">
                    @csrf
                    <div class="form-group">
                        <label for="location">Lokasi</label>
                        <select name="location" id="location" required>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}">{{ strtoupper($loc) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram (opsional)</label>
                        <input type="text" name="instagram" id="instagram" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="content">Konten</label>
                        <textarea name="content" id="content" rows="4" required maxlength="2000"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating (1-5)</label>
                        <select name="rating" id="rating" required>
                            @for($r = 1; $r <= 5; $r++)
                                <option value="{{ $r }}" {{ $r == 5 ? 'selected' : '' }}>{{ $r }} Bintang</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="is_featured" value="on">
                            <span>Tampilkan di featured (home)</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Gambar (max 5)</label>
                        <input type="file" name="images[]" accept="image/*" multiple>
                    </div>
                    <div class="form-group">
                        <label>Video (max 1)</label>
                        <input type="file" name="video" accept="video/*">
                    </div>
                    <button type="submit" class="btn-submit-review">
                        <i class="fas fa-save"></i> Simpan Review
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>