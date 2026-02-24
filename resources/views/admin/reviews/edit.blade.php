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

            @php $existingImageCount = $review->media->where('type', 'image')->count(); @endphp
            <div class="reviews-create-layout">
                <div class="reviews-form-card">
                    <form action="{{ route('admin.dashboard1.reviews.update', $review) }}" method="POST" enctype="multipart/form-data" class="reviews-form" id="adminReviewEditForm" data-existing-images="{{ $existingImageCount }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <p class="form-help">Lokasi: <strong>{{ strtoupper(\App\Models\Review::locationDisplay($review->location)) }}</strong> (tidak bisa diubah)</p>
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
                            <div class="review-photo-row">
                                <button type="button" id="addPhotoBtn" class="review-photo-add-btn" title="Tambah foto">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <span id="photoCount" class="review-photo-count">{{ $existingImageCount }}/5 foto</span>
                            </div>
                            <div id="photoSlots" class="review-photo-slots"></div>
                        </div>
                        <div class="form-group">
                            <label>Tambah video (max 1 total)</label>
                            <div class="review-video-wrap">
                                <input type="file" name="video" id="reviewVideoInput" accept="video/*" class="hidden">
                                <button type="button" id="reviewVideoTrigger" class="review-video-trigger">
                                    <i class="fas fa-video"></i>
                                    <span id="videoLabel">Tambah video</span>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn-submit-review">
                            <i class="fas fa-save"></i> Update Review
                        </button>
                    </form>
                </div>
                <div class="reviews-replies reviews-replies-right">
                    <h3>Balasan admin</h3>
                    <div id="replyList">
                        @foreach($review->replies as $reply)
                            <div class="reply-item" data-reply-id="{{ $reply->id }}">
                                <div class="reply-item-view">
                                    <p class="reply-meta"><strong>{{ $reply->admin->name ?? 'Admin' }}</strong> · {{ $reply->created_at->format('d M Y H:i') }}</p>
                                    <p class="reply-content-text">{{ $reply->content }}</p>
                                    <div class="reply-actions">
                                        <button type="button" class="reply-btn-edit" title="Edit" aria-label="Edit balasan"><i class="fas fa-pen"></i></button>
                                        <button type="button" class="reply-btn-delete" title="Hapus" aria-label="Hapus balasan" data-url="{{ route('admin.dashboard1.reviews.replies.destroy', [$review, $reply]) }}"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div class="reply-item-edit" style="display: none;">
                                    <textarea class="reply-edit-textarea" rows="3" maxlength="2000">{{ $reply->content }}</textarea>
                                    <div class="reply-edit-actions">
                                        <button type="button" class="reply-btn-save"><i class="fas fa-check"></i> Simpan</button>
                                        <button type="button" class="reply-btn-cancel">Batal</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route('admin.dashboard1.reviews.replies.store', $review) }}" method="POST" class="reply-form">
                        @csrf
                        <input type="text" name="content" placeholder="Tambah balasan..." required>
                        <button type="submit" class="btn-reply">Balas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="reviewEditData" data-review-id="{{ $review->id }}" style="display: none" aria-hidden="true"></div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var MAX_VIDEO_BYTES = 20 * 1024 * 1024;
        var MAX_VIDEO_LABEL = '20 MB';
        var reviewId = parseInt(document.getElementById('reviewEditData').getAttribute('data-review-id'), 10);
        var csrfToken = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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

        var form = document.getElementById('adminReviewEditForm');
        var addPhotoBtn = document.getElementById('addPhotoBtn');
        var photoSlots = document.getElementById('photoSlots');
        var photoCount = document.getElementById('photoCount');
        var existingImages = form ? parseInt(form.getAttribute('data-existing-images') || '0', 10) : 0;
        var imageInputs = [];
        function getNewImageCount() {
            return imageInputs.filter(function(x) { return x.input.files && x.input.files.length > 0; }).length;
        }
        function getMaxNewSlots() {
            return Math.max(0, 5 - existingImages);
        }
        function updatePhotoUi() {
            if (!photoCount || !addPhotoBtn) return;
            var newCount = getNewImageCount();
            photoCount.textContent = (existingImages + newCount) + '/5 foto';
            var maxNew = getMaxNewSlots();
            addPhotoBtn.style.display = (newCount >= maxNew) ? 'none' : 'inline-flex';
        }
        function addImageSlot() {
            if (!photoSlots || getNewImageCount() >= getMaxNewSlots()) return;
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
                if (!file) { removeSlot(); return; }
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

        document.getElementById('replyList').addEventListener('click', function(e) {
            var deleteBtn = e.target.closest('.reply-btn-delete');
            if (deleteBtn) {
                e.preventDefault();
                if (!confirm('Hapus balasan ini?')) return;
                var url = deleteBtn.getAttribute('data-url');
                var item = deleteBtn.closest('.reply-item');
                fetch(url, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                }).then(function(r) { return r.json(); }).then(function(data) {
                    if (data.success && item) item.remove();
                });
                return;
            }
            var item = e.target.closest('.reply-item');
            if (!item) return;
            var editBtn = e.target.closest('.reply-btn-edit');
            var saveBtn = e.target.closest('.reply-btn-save');
            var cancelBtn = e.target.closest('.reply-btn-cancel');
            if (editBtn) {
                item.querySelector('.reply-item-view').style.display = 'none';
                item.querySelector('.reply-item-edit').style.display = 'block';
                item.querySelector('.reply-edit-textarea').focus();
            } else if (saveBtn) {
                var replyId = item.getAttribute('data-reply-id');
                var textarea = item.querySelector('.reply-edit-textarea');
                var content = textarea.value.trim();
                if (!content) return;
                var url = '/admin/dashboard1/reviews/' + reviewId + '/replies/' + replyId;
                fetch(url, {
                    method: 'PATCH',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: new URLSearchParams({ content: content, _token: csrfToken })
                }).then(function(r) { return r.json(); }).then(function(data) {
                    if (data.success) {
                        item.querySelector('.reply-content-text').textContent = data.content;
                        item.querySelector('.reply-item-view').style.display = 'block';
                        item.querySelector('.reply-item-edit').style.display = 'none';
                    }
                });
            } else if (cancelBtn) {
                var textarea = item.querySelector('.reply-edit-textarea');
                textarea.value = item.querySelector('.reply-content-text').textContent;
                item.querySelector('.reply-item-view').style.display = 'block';
                item.querySelector('.reply-item-edit').style.display = 'none';
            }
        });
        document.querySelectorAll('.reply-item-edit').forEach(function(editEl) {
            var item = editEl.closest('.reply-item');
            var textarea = editEl.querySelector('.reply-edit-textarea');
            if (textarea) textarea.value = item.querySelector('.reply-content-text').textContent;
        });
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
