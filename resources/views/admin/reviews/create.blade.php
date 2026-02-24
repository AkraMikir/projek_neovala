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

            <div class="reviews-create-layout">
                <div class="reviews-form-card">
                    <form action="{{ route('admin.dashboard1.reviews.store') }}" method="POST" enctype="multipart/form-data" class="reviews-form" id="adminReviewForm">
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
                            <div class="review-photo-row">
                                <button type="button" id="addPhotoBtn" class="review-photo-add-btn" title="Tambah foto">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <span id="photoCount" class="review-photo-count">0/5 foto</span>
                            </div>
                            <div id="photoSlots" class="review-photo-slots"></div>
                        </div>
                        <div class="form-group">
                            <label>Video (max 1)</label>
                            <div class="review-video-wrap">
                                <input type="file" name="video" id="reviewVideoInput" accept="video/*" class="hidden">
                                <button type="button" id="reviewVideoTrigger" class="review-video-trigger">
                                    <i class="fas fa-video"></i>
                                    <span id="videoLabel">Tambah video</span>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn-submit-review">
                            <i class="fas fa-save"></i> Simpan Review
                        </button>
                    </form>
                </div>
                <div class="review-preview-card" id="reviewPreviewCard">
                    <div class="preview-placeholder" id="previewPlaceholder">Isi form untuk melihat preview komentar.</div>
                    <div id="previewContent" style="display: none;">
                        <div class="preview-location" id="previewLocation">-</div>
                        <div class="preview-content" id="previewText">-</div>
                        <div class="preview-meta">
                            <span class="preview-stars" id="previewStars"></span>
                            <span id="previewInstagram">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var MAX_VIDEO_BYTES = 20 * 1024 * 1024;
        var MAX_VIDEO_LABEL = '20 MB';
        function showVideoSizeAlert() {
            var wrap = document.createElement('div');
            wrap.className = 'review-video-toast';
            wrap.setAttribute('role', 'alert');
            wrap.innerHTML = '<span class="review-video-toast-icon"><i class="fas fa-exclamation-circle"></i></span>' +
                '<div class="review-video-toast-body"><strong>File terlalu besar</strong><p>File video maksimal ' + MAX_VIDEO_LABEL + '. Pilih file yang lebih kecil.</p></div>' +
                '<button type="button" class="review-video-toast-close" aria-label="Tutup"><i class="fas fa-times"></i></button>';
            document.body.appendChild(wrap);
            setTimeout(function() { wrap.classList.add('review-video-toast-visible'); }, 10);
            function remove() {
                wrap.classList.remove('review-video-toast-visible');
                setTimeout(function() { wrap.remove(); }, 300);
            }
            wrap.querySelector('.review-video-toast-close').addEventListener('click', remove);
            setTimeout(remove, 5000);
        }
        var videoInput = document.getElementById('reviewVideoInput');
        var videoTrigger = document.getElementById('reviewVideoTrigger');
        var videoLabel = document.getElementById('videoLabel');
        if (videoTrigger && videoInput) {
            videoTrigger.addEventListener('click', function() { videoInput.click(); });
            videoInput.addEventListener('change', function() {
                var file = this.files && this.files[0];
                if (!file) return;
                if (file.size > MAX_VIDEO_BYTES) {
                    showVideoSizeAlert();
                    this.value = '';
                    if (videoLabel) videoLabel.textContent = 'Tambah video';
                    return;
                }
                if (videoLabel) videoLabel.textContent = file.name || '1 video dipilih';
            });
        }

        var addPhotoBtn = document.getElementById('addPhotoBtn');
        var photoSlots = document.getElementById('photoSlots');
        var photoCount = document.getElementById('photoCount');
        var imageInputs = [];
        function getSelectedImageCount() {
            return imageInputs.filter(function(x) { return x.input.files && x.input.files.length > 0; }).length;
        }
        function updatePhotoUi() {
            if (!photoCount || !addPhotoBtn) return;
            var selected = getSelectedImageCount();
            photoCount.textContent = selected + '/5 foto';
            addPhotoBtn.style.display = selected >= 5 ? 'none' : 'inline-flex';
        }
        function addImageSlot() {
            if (!photoSlots) return;
            if (getSelectedImageCount() >= 5) return;
            var input = document.createElement('input');
            input.type = 'file';
            input.name = 'images[]';
            input.accept = 'image/*';
            var slot = document.createElement('div');
            slot.className = 'review-photo-slot';
            slot.innerHTML = '<i class="fas fa-image"></i>';
            var rm = document.createElement('button');
            rm.type = 'button';
            rm.className = 'review-photo-slot-remove';
            rm.innerHTML = '&times;';
            rm.setAttribute('aria-label', 'Hapus');
            function removeSlot() {
                var idx = imageInputs.findIndex(function(x) { return x.input === input; });
                if (idx >= 0) imageInputs.splice(idx, 1);
                input.remove();
                slot.remove();
                updatePhotoUi();
            }
            rm.addEventListener('click', removeSlot);
            input.addEventListener('change', function() {
                var file = input.files && input.files[0];
                if (!file) {
                    removeSlot();
                    return;
                }
                slot.innerHTML = '';
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.onload = function() { URL.revokeObjectURL(img.src); };
                slot.appendChild(img);
                slot.appendChild(rm);
                updatePhotoUi();
            });
            imageInputs.push({ input: input, slot: slot });
            photoSlots.appendChild(input);
            photoSlots.appendChild(slot);
            slot.appendChild(rm);
            input.click();
            updatePhotoUi();
        }
        if (addPhotoBtn) {
            addPhotoBtn.addEventListener('click', addImageSlot);
            updatePhotoUi();
        }

        var previewPlaceholder = document.getElementById('previewPlaceholder');
        var previewContent = document.getElementById('previewContent');
        var previewLocation = document.getElementById('previewLocation');
        var previewText = document.getElementById('previewText');
        var previewStars = document.getElementById('previewStars');
        var previewInstagram = document.getElementById('previewInstagram');
        var locationEl = document.getElementById('location');
        var instagramEl = document.getElementById('instagram');
        var contentEl = document.getElementById('content');
        var ratingEl = document.getElementById('rating');
        function updatePreview() {
            var loc = locationEl ? locationEl.options[locationEl.selectedIndex].value : '';
            var ig = instagramEl ? instagramEl.value.trim() : '';
            var text = contentEl ? contentEl.value.trim() : '';
            var rating = ratingEl ? parseInt(ratingEl.value, 10) || 0 : 0;
            var hasAny = loc || ig || text || rating > 0;
            if (previewPlaceholder) previewPlaceholder.style.display = hasAny ? 'none' : 'block';
            if (previewContent) previewContent.style.display = hasAny ? 'block' : 'none';
            if (previewLocation) previewLocation.textContent = loc ? loc.toUpperCase() : '-';
            if (previewText) previewText.textContent = text || '-';
            if (previewInstagram) previewInstagram.textContent = ig ? '@' + ig : '-';
            if (previewStars) {
                var starsHtml = '';
                for (var i = 1; i <= 5; i++) {
                    starsHtml += '<i class="' + (i <= rating ? 'fas' : 'far') + ' fa-star"></i>';
                }
                previewStars.innerHTML = starsHtml;
            }
        }
        if (locationEl) locationEl.addEventListener('change', updatePreview);
        if (instagramEl) instagramEl.addEventListener('input', updatePreview);
        if (contentEl) contentEl.addEventListener('input', updatePreview);
        if (ratingEl) ratingEl.addEventListener('change', updatePreview);
        updatePreview();
    });
    </script>
    <style>
    .review-video-toast {
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 99999;
        max-width: 360px;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem 1rem 1rem 1.25rem;
        background: #fff;
        border-left: 4px solid #674c1d;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(103, 76, 29, 0.15);
        opacity: 0;
        transform: translateX(1rem);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .review-video-toast.review-video-toast-visible { opacity: 1; transform: translateX(0); }
    .review-video-toast-icon { color: #674c1d; font-size: 1.35rem; flex-shrink: 0; }
    .review-video-toast-body { flex: 1; min-width: 0; }
    .review-video-toast-body strong { display: block; color: #1e293b; font-size: 0.95rem; margin-bottom: 0.25rem; }
    .review-video-toast-body p { margin: 0; color: #64748b; font-size: 0.875rem; line-height: 1.4; }
    .review-video-toast-close {
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 0.25rem;
        font-size: 1rem;
        line-height: 1;
        border-radius: 4px;
        transition: color 0.2s, background 0.2s;
    }
    .review-video-toast-close:hover { color: #674c1d; background: rgba(103, 76, 29, 0.08); }
    @media (max-width: 480px) { .review-video-toast { left: 1rem; right: 1rem; max-width: none; } }
    </style>
</body>
</html>