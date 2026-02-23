<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Review - Neovala Admin</title>
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
                    <h1>Edit Review</h1>
                    <p class="subtitle">Edit teks, rating, status</p>
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
                <form action="{{ route('admin.dashboard1.reviews.update', $review) }}" method="POST" enctype="multipart/form-data" class="reviews-form">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <p class="form-help">Lokasi: <strong>{{ strtoupper($review->location) }}</strong> (tidak bisa diubah)</p>
                    </div>
                    <div class="form-group">
                        <label for="content">Konten</label>
                        <textarea name="content" id="content" rows="4" required maxlength="2000">{{ old('content', $review->content) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating (1-5)</label>
                        <select name="rating" id="rating" required>
                            @for($r = 1; $r <= 5; $r++)
                                <option value="{{ $r }}" {{ $review->rating == $r ? 'selected' : '' }}>{{ $r }} Bintang</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="accepted" {{ $review->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="pending" {{ $review->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="is_featured" value="on" {{ $review->is_featured ? 'checked' : '' }}>
                            <span>Featured</span>
                        </label>
                    </div>
                    @if($review->media->count() > 0)
                        <div class="form-group">
                            <label>Media saat ini</label>
                            <div class="media-current">
                                @foreach($review->media as $m)
                                    <div class="media-item">
                                        @if($m->type === 'image')
                                            <img src="{{ asset('storage/' . $m->file_path) }}" alt="">
                                        @else
                                            <span class="media-placeholder">Video</span>
                                        @endif
                                        <a href="{{ route('admin.dashboard1.reviews.media.destroy', [$review, $m]) }}" class="media-remove" onclick="return confirm('Hapus media ini?');">×</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Tambah gambar (max 5 total)</label>
                        <input type="file" name="images[]" accept="image/*" multiple>
                    </div>
                    <div class="form-group">
                        <label>Tambah video (max 1 total)</label>
                        <input type="file" name="video" accept="video/*">
                    </div>
                    <button type="submit" class="btn-submit-review">
                        <i class="fas fa-save"></i> Update Review
                    </button>
                </form>
            </div>

            <div class="reviews-replies">
                <h3>Balasan admin</h3>
                @foreach($review->replies as $reply)
                    <div class="reply-item">
                        <p class="reply-meta"><strong>{{ $reply->admin->name ?? 'Admin' }}</strong> · {{ $reply->created_at->format('d M Y H:i') }}</p>
                        <p>{{ $reply->content }}</p>
                    </div>
                @endforeach
                <form action="{{ route('admin.dashboard1.reviews.replies.store', $review) }}" method="POST" class="reply-form">
                    @csrf
                    <input type="text" name="content" placeholder="Tambah balasan..." required>
                    <button type="submit" class="btn-reply">Balas</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
