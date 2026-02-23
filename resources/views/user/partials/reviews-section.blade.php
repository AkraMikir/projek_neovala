{{-- Tailwind reviews section for discover pages. Expects: $reviews, $reviewAggregate, $location (e.g. spl), optional $carouselImages (array) --}}
<section id="testimoni-section" class="py-12 px-4 bg-stone-50">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 md:gap-9 max-w-6xl mx-auto items-stretch">
            {{-- Card form: 3/4 lebar (hanya geser sedikit ke kiri, form tetap besar) --}}
            <div class="col-span-4 md:col-span-3 flex flex-col min-w-0">
                <div class="flex flex-col p-6 md:p-9 bg-white rounded-tr-[64px] rounded-es-[64px] shadow-lg border border-[#674c1d]/10 min-h-0">
                <h2 class="text-xl font-semibold text-[#674c1d] mb-1" style="font-family: 'Georgia', serif;">GIVE US FEEDBACK</h2>
                <p class="text-[12px] text-[#674c1d]/70 mb-6">Bagikan cerita dan pendapatmu agar kami bisa berkembang.</p>
                <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data" id="reviewForm">
                    @csrf
                    <input type="hidden" name="location" value="{{ $location }}">

                    <div class="flex flex-col md:flex-row md:space-x-6 md:gap-6">
                        {{-- Kolom kiri: Instagram, Samarkan, Gambar, Video --}}
                        <div class="flex flex-col w-full md:w-1/2 space-y-4">
                            <div class="space-y-2">
                                <div class="flex flex-row justify-between items-center">
                                    <label class="text-[12px] font-semibold text-[#674c1d]">Instagram</label>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[12px] text-[#CFC3B7]">Samarkan</span>
                                        <label class="relative inline-flex items-center cursor-pointer select-none">
                                            <input id="hideIdentityToggle" type="checkbox" name="hide_identity" value="on" class="sr-only peer">
                                            <div class="w-6 h-3.5 bg-gray-200 rounded-full peer-checked:bg-[#674c1d] transition-colors"></div>
                                            <span class="absolute left-0.5 top-[1.5px] w-2.5 h-2.5 bg-white rounded-full border border-gray-300 transition-transform peer-checked:translate-x-[11px] pointer-events-none" style="margin-left: 0;"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex rounded-[8px] border border-[#674c1d]/35 overflow-hidden">
                                    <span class="inline-flex items-center pl-3 text-[#674c1d]/80 text-sm">@</span>
                                    <input type="text" name="instagram" class="flex-1 min-w-0 py-2 pr-3 pl-1 text-sm text-[#674c1d] placeholder-[#CFC3B7] border-0 bg-transparent focus:outline-none focus:ring-0" placeholder="Username instagram Anda" maxlength="50">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[12px] font-semibold text-[#674c1d]">Gambar (max 5)</label>
                                <div class="flex flex-wrap gap-3 items-center">
                                    <button type="button" id="addPhotoBtn" class="flex items-center justify-center w-12 h-12 rounded-[8px] border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors" title="Tambah foto">
                                        <i class="fas fa-plus text-lg"></i>
                                    </button>
                                    <span id="photoCount" class="text-[12px] text-[#674c1d]/60">0/5 foto</span>
                                </div>
                                <div id="photoSlots" class="flex flex-wrap gap-2"></div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[12px] font-semibold text-[#674c1d]">Video (max 1)</label>
                                <input type="file" name="video" id="videoInput" accept="video/*" class="hidden">
                                <button type="button" id="addVideoBtn" class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-[8px] border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors text-sm">
                                    <i class="fas fa-video"></i>
                                    <span id="videoLabel">Tambah video</span>
                                </button>
                            </div>
                        </div>
                        {{-- Kolom kanan: Rating, Pesan --}}
                        <div class="flex flex-col w-full md:w-1/2 space-y-4">
                            <div class="space-y-2">
                                <label class="text-[12px] font-semibold text-[#674c1d]">Rating *</label>
                                <input type="hidden" name="rating" id="ratingInput" value="0" required>
                                <div class="flex gap-1.5" id="starSelect">
                                    @for ($i = 1; $i <= 5; $i++)
                                    <i class="far fa-star text-2xl cursor-pointer transition-colors text-[#674c1d] hover:text-[#5a4218]" data-rating="{{ $i }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="space-y-2 flex-1 flex flex-col">
                                <label class="text-[12px] font-semibold text-[#674c1d]">Bagaimana pengalaman anda? *</label>
                                <textarea name="content" id="contentTextarea" rows="6" class="w-full rounded-[8px] border border-[#674c1d]/35 p-2 text-sm text-[#674c1d] placeholder-[#CFC3B7] focus:outline-none focus:ring-1 focus:ring-[#674c1d]/30 resize-y min-h-[120px]" placeholder="Bagikan pengalaman Anda dengan kami" required maxlength="2000"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" id="reviewSubmitBtn" class="hidden py-3 px-6 rounded-[8px] bg-[#674c1d] text-white font-medium hover:bg-[#5a4218] transition-colors border border-[#674c1d]">Kirim</button>
                        <button type="button" id="reviewSubmitBtnDisabled" disabled class="py-3 px-6 rounded-[8px] bg-[#F6EFE9] text-[#CFC3B7] font-medium cursor-not-allowed border border-[#CFC3B7]/50">Kirim</button>
                    </div>
                </form>
                </div>
            </div>
            {{-- Foto carousel (kanan): 1/4 lebar, proporsi seperti referensi, rounded-tl/rounded-ee --}}
            @if(!empty($carouselImages) && is_array($carouselImages))
            <div id="feedbackCarouselOuter" class="col-span-1 hidden md:block min-h-[280px] md:min-h-0 h-full overflow-hidden rounded-tl-[96px] rounded-br-[96px] border border-[#674c1d]/10 shadow-lg bg-stone-100 relative">
                <div class="feedback-carousel-track flex h-full min-h-[280px] md:min-h-full transition-transform duration-500 ease-out" style="width: {{ count($carouselImages) * 100 }}%;">
                    @foreach($carouselImages as $imgUrl)
                    <div class="feedback-carousel-slide flex-shrink-0 h-full min-h-[280px] md:min-h-full" style="width: {{ 100 / count($carouselImages) }}%;">
                        <img src="{{ $imgUrl }}" alt="" class="h-full w-full object-cover">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <h2 class="text-2xl font-bold text-amber-900 text-center mb-2 mt-16">WHAT THEY SAY?</h2>
        <div class="border-b-2 border-amber-800 w-24 mx-auto mb-6"></div>

        <div id="reviews-aggregate" class="flex flex-wrap items-center justify-center gap-4 mb-6">
            <div class="text-center px-4">
                <span
                    class="text-2xl font-bold text-amber-800">{{ number_format($reviewAggregate['avg'] ?? 0, 1) }}</span>
                <p class="text-sm text-stone-600">Rating</p>
            </div>
            <div class="text-center px-4 border-l border-stone-300">
                <span
                    class="text-xl font-semibold text-amber-800">{{ number_format($reviewAggregate['count'] ?? 0) }}</span>
                <p class="text-sm text-stone-600">Ulasan</p>
            </div>
        </div>

        <div class="reviews-filter-bar flex flex-wrap gap-2 justify-center mb-6" data-location="{{ $location ?? '' }}">
            <span class="text-stone-600 text-sm">Filter:</span>
            <button type="button" class="reviews-filter-btn px-3 py-1 rounded bg-amber-800 text-white"
                data-sort="latest" data-rating="">Terbaru</button>
            <button type="button" class="reviews-filter-btn px-3 py-1 rounded bg-stone-200 text-stone-700"
                data-sort="longest" data-rating="">Waktu terlama</button>
            @for ($r = 5; $r >= 1; $r--)
            <button type="button" class="reviews-filter-btn px-3 py-1 rounded bg-stone-200 text-stone-700"
                data-sort="latest" data-rating="{{ $r }}">{{ $r }} Bintang</button>
            @endfor
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('reviews.detail.discover', $location) }}"
                class="text-[#674c1d] font-medium hover:underline">Lihat semua ulasan</a>
        </div>

        <div class="w-[100%] max-w-7xl mx-auto">
            <div class="reviews-slider-outer relative mb-10">
                <button type="button"
                    class="reviews-slider-btn reviews-slider-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 z-10 w-10 h-10 rounded-full bg-amber-800 text-white shadow-md hover:bg-amber-900 items-center justify-center transition-opacity disabled:pointer-events-none"
                    style="display:none;" aria-label="Lihat ulasan sebelumnya">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button"
                    class="reviews-slider-btn reviews-slider-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-1 z-10 w-10 h-10 rounded-full bg-amber-800 text-white shadow-md hover:bg-amber-900 flex items-center justify-center transition-opacity disabled:pointer-events-none"
                    aria-label="Lihat ulasan berikutnya">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div id="reviews-list"
                    class="reviews-slider-track flex gap-3 overflow-x-auto overflow-y-hidden py-2 px-1 scroll-smooth snap-x snap-mandatory"
                    style="scrollbar-width: thin;">
                    @forelse($reviews as $review)
                    <div
                        class="reviews-card relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm p-3 border border-stone-100 flex flex-col justify-center min-h-[140px]">
                        <div class="reviews-card-inner">
                            <p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">{{ $review->content }}
                            </p>
                            <div class="flex items-center gap-1 mb-0.5">
                                @for ($i = 1; $i <= 5; $i++) <i
                                    class="fas fa-star {{ $i <= $review->rating ? 'text-[#674c1d]' : 'text-stone-200' }} text-xs">
                                    </i>
                                    @endfor
                            </div>
                            <p class="text-stone-500 text-[11px] truncate">
                                {{ $review->hide_identity ? 'Anonymous' : '@' . ($review->instagram ?? '') }} ·
                                {{ $review->created_at->format('d M Y') }}</p>
                            @if($review->replies->count() > 0)
                            <div class="mt-2 relative">
                                <button type="button"
                                    class="review-reply-toggle w-full text-left text-[11px] text-[#674c1d] font-medium flex items-center gap-1 hover:underline focus:outline-none"
                                    aria-expanded="false">
                                    <i
                                        class="fas fa-chevron-down review-reply-chevron text-[10px] transition-transform duration-200"></i>
                                    Balasan admin ({{ $review->replies->count() }})
                                </button>
                                <div
                                    class="review-reply-dropdown hidden absolute left-0 right-0 top-full mt-1 z-[50] pl-3 border-l-2 border-stone-400 bg-stone-100 rounded-r py-2 pr-2 shadow-lg min-w-[200px]">
                                    @foreach($review->replies as $reply)
                                    <p class="text-[11px] text-[#674c1d] font-medium">
                                        {{ $reply->admin->name ?? 'Admin' }}</p>
                                    <p class="text-[11px] text-stone-600 leading-tight">{{ $reply->content }}</p>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="flex-shrink-0 text-center text-stone-500 py-4 w-full text-sm">Belum ada ulasan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Loading overlay saat kirim ulasan --}}
    <div id="reviewLoadingOverlay"
        class="fixed inset-0 z-[9999] hidden flex items-center justify-center bg-black/30 backdrop-blur-sm transition-opacity duration-200"
        aria-hidden="true">
        <div
            class="bg-white rounded-2xl shadow-2xl px-8 py-6 flex flex-col items-center gap-4 min-w-[200px] border border-[#674c1d]/20">
            <i class="fas fa-circle-notch fa-spin text-3xl text-[#674c1d]"></i>
            <p class="text-[#674c1d] font-medium text-center">Mengirim ulasan...</p>
            <p class="text-stone-500 text-sm text-center">Mohon tunggu sebentar</p>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reviewForm');
    const starSelect = document.getElementById('starSelect');
    const ratingInput = document.getElementById('ratingInput');
    const addPhotoBtn = document.getElementById('addPhotoBtn');
    const photoSlots = document.getElementById('photoSlots');
    const photoCount = document.getElementById('photoCount');
    const videoInput = document.getElementById('videoInput');
    const addVideoBtn = document.getElementById('addVideoBtn');
    const videoLabel = document.getElementById('videoLabel');

    var reviewSubmitBtn = document.getElementById('reviewSubmitBtn');
    var reviewSubmitBtnDisabled = document.getElementById('reviewSubmitBtnDisabled');
    var contentTextarea = document.getElementById('contentTextarea');

    function checkFormComplete() {
        var ratingOk = parseInt(ratingInput && ratingInput.value ? ratingInput.value : 0, 10) >= 1;
        var contentOk = contentTextarea && (contentTextarea.value || '').trim().length > 0;
        var complete = ratingOk && contentOk;
        if (reviewSubmitBtn && reviewSubmitBtnDisabled) {
            if (complete) {
                reviewSubmitBtn.classList.remove('hidden');
                reviewSubmitBtn.style.display = '';
                reviewSubmitBtnDisabled.style.display = 'none';
            } else {
                reviewSubmitBtn.style.display = 'none';
                reviewSubmitBtn.classList.add('hidden');
                reviewSubmitBtnDisabled.style.display = '';
            }
        }
    }

    if (starSelect && ratingInput) {
        function applyStars(upToRating) {
            var r = parseInt(upToRating, 10) || 0;
            starSelect.querySelectorAll('[data-rating]').forEach(function(s) {
                var idx = parseInt(s.getAttribute('data-rating'), 10);
                s.classList.toggle('fas', idx <= r);
                s.classList.toggle('far', idx > r);
            });
        }
        starSelect.querySelectorAll('[data-rating]').forEach(function(star) {
            star.addEventListener('click', function() {
                var r = parseInt(this.getAttribute('data-rating'), 10);
                ratingInput.value = r;
                applyStars(r);
                checkFormComplete();
            });
            star.addEventListener('mouseenter', function() {
                var r = parseInt(this.getAttribute('data-rating'), 10);
                applyStars(r);
            });
        });
        starSelect.addEventListener('mouseleave', function() {
            applyStars(ratingInput.value);
        });
    }
    if (contentTextarea) {
        contentTextarea.addEventListener('input', checkFormComplete);
        contentTextarea.addEventListener('keyup', checkFormComplete);
    }
    checkFormComplete();

    // Photos: + button adds a new slot (max 5). Each slot is its own input named images[].
    const imageInputs = [];

    function getSelectedImageCount() {
        return imageInputs.filter(x => x.input.files && x.input.files.length > 0).length;
    }

    function updatePhotoUi() {
        if (!photoCount || !addPhotoBtn) return;
        const selected = getSelectedImageCount();
        photoCount.textContent = selected + '/5 foto';
        addPhotoBtn.style.display = selected >= 5 ? 'none' : 'flex';
    }

    function addImageSlot() {
        if (!photoSlots) return;
        if (getSelectedImageCount() >= 5) return;

        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'images[]';
        input.accept = 'image/*';
        input.className = 'hidden';

        const slot = document.createElement('div');
        slot.className =
            'relative w-12 h-12 rounded-xl overflow-hidden border-2 border-dashed border-[#674c1d]/45 bg-stone-50 flex items-center justify-center';
        slot.innerHTML = '<i class=\"fas fa-image text-[#674c1d]/70\"></i>';

        const rm = document.createElement('button');
        rm.type = 'button';
        rm.className =
            'absolute -top-1 -right-1 w-5 h-5 rounded-full bg-red-600 text-white text-xs flex items-center justify-center shadow';
        rm.textContent = '×';

        function removeSlot() {
            const idx = imageInputs.findIndex(x => x.input === input);
            if (idx >= 0) imageInputs.splice(idx, 1);
            input.remove();
            slot.remove();
            updatePhotoUi();
        }
        rm.addEventListener('click', removeSlot);

        input.addEventListener('change', function() {
            const file = input.files && input.files[0];
            if (!file) {
                removeSlot();
                return;
            }
            slot.innerHTML = '';
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full h-full object-cover';
            img.onload = function() {
                URL.revokeObjectURL(img.src);
            };
            slot.appendChild(img);
            slot.appendChild(rm);
            updatePhotoUi();
        });

        imageInputs.push({
            input,
            slot
        });
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

    if (addVideoBtn && videoInput) {
        addVideoBtn.addEventListener('click', function() {
            videoInput.click();
        });
        var MAX_VIDEO_BYTES = 20 * 1024 * 1024;
        var MAX_VIDEO_LABEL = '20 MB';

        function showVideoSizeAlert() {
            var wrap = document.createElement('div');
            wrap.className = 'review-video-toast';
            wrap.setAttribute('role', 'alert');
            wrap.innerHTML =
                '<span class="review-video-toast-icon"><i class="fas fa-exclamation-circle"></i></span>' +
                '<div class="review-video-toast-body"><strong>File terlalu besar</strong><p>File video maksimal ' +
                MAX_VIDEO_LABEL + '. Pilih file yang lebih kecil.</p></div>' +
                '<button type="button" class="review-video-toast-close" aria-label="Tutup"><i class="fas fa-times"></i></button>';
            document.body.appendChild(wrap);
            setTimeout(function() {
                wrap.classList.add('review-video-toast-visible');
            }, 10);

            function remove() {
                wrap.classList.remove('review-video-toast-visible');
                setTimeout(function() {
                    wrap.remove();
                }, 300);
            }
            wrap.querySelector('.review-video-toast-close').addEventListener('click', remove);
            setTimeout(remove, 5000);
        }
        videoInput.addEventListener('change', function() {
            if (!this.files || !this.files.length) return;
            var file = this.files[0];
            if (file.size > MAX_VIDEO_BYTES) {
                showVideoSizeAlert();
                this.value = '';
                if (videoLabel) videoLabel.textContent = 'Tambah video';
                return;
            }
            if (videoLabel) videoLabel.textContent = file.name || '1 video dipilih';
        });
    }

    if (form) {
        var reviewLoadingOverlay = document.getElementById('reviewLoadingOverlay');

        function showReviewLoading() {
            if (reviewLoadingOverlay) {
                reviewLoadingOverlay.classList.remove('hidden');
                reviewLoadingOverlay.setAttribute('aria-hidden', 'false');
            }
        }

        function hideReviewLoading() {
            if (reviewLoadingOverlay) {
                reviewLoadingOverlay.classList.add('hidden');
                reviewLoadingOverlay.setAttribute('aria-hidden', 'true');
            }
        }
        form.addEventListener('submit', function(e) {
            if (parseInt(ratingInput?.value || 0, 10) < 1) {
                e.preventDefault();
                alert('Pilih rating 1-5 bintang.');
                return;
            }
            e.preventDefault();
            showReviewLoading();
            var formData = new FormData(form);
            var action = form.getAttribute('action');
            var token = document.querySelector('input[name="_token"]');
            if (token) formData.append('_token', token.value);
            fetch(action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(function(res) {
                    return res.json().then(function(data) {
                        return {
                            ok: res.ok,
                            status: res.status,
                            data: data
                        };
                    }).catch(function() {
                        return {
                            ok: res.ok,
                            status: res.status,
                            data: null
                        };
                    });
                })
                .then(function(result) {
                    hideReviewLoading();
                    if (result.ok && result.data && result.data.success) {
                        alert(result.data.message || 'Terima kasih atas ulasan Anda!');
                        form.reset();
                        if (ratingInput) ratingInput.value = '0';
                        if (starSelect) {
                            starSelect.querySelectorAll('[data-rating]').forEach(function(s) {
                                s.classList.add('far');
                                s.classList.remove('fas');
                            });
                        }
                        if (photoSlots) {
                            photoSlots.querySelectorAll('input[type="file"]').forEach(function(
                                inp) {
                                inp.remove();
                            });
                            photoSlots.querySelectorAll('div.relative').forEach(function(div) {
                                div.remove();
                            });
                        }
                        imageInputs.length = 0;
                        if (photoCount) photoCount.textContent = '0/5 foto';
                        if (addPhotoBtn) addPhotoBtn.style.display = 'flex';
                        if (videoInput) videoInput.value = '';
                        if (videoLabel) videoLabel.textContent = 'Tambah video';
                        if (bar) {
                            var terbaruBtn = bar.querySelector(
                                '.reviews-filter-btn[data-sort="latest"][data-rating=""]');
                            if (terbaruBtn) terbaruBtn.click();
                        }
                        checkFormComplete();
                    } else {
                        var msg = (result.data && result.data.message) ? result.data.message : (
                            result.status === 422 ? 'Data tidak valid.' :
                            'Gagal mengirim ulasan.');
                        alert(msg);
                    }
                })
                .catch(function() {
                    hideReviewLoading();
                    alert('Gagal mengirim ulasan. Periksa koneksi dan coba lagi.');
                });
        });
    }

    // Reviews filter (no refresh) on discover pages
    var bar = document.querySelector('#testimoni-section .reviews-filter-bar');
    var listEl = document.getElementById('reviews-list');
    var aggEl = document.getElementById('reviews-aggregate');
    if (bar && listEl && aggEl) {
        function renderCard(r) {
            var identity = r.hide_identity ? 'Anonymous' : ('@' + (r.instagram || ''));
            var stars = '';
            for (var i = 1; i <= 5; i++) {
                stars += '<i class="fas fa-star ' + (i <= r.rating ? 'text-[#674c1d]' : 'text-stone-200') +
                    ' text-xs"></i>';
            }
            var repliesHtml = '';
            if (r.replies && r.replies.length) {
                var replyBlocks = r.replies.map(function(rep) {
                    return '<p class="text-[11px] text-[#674c1d] font-medium">' + (rep.admin_name ||
                        'Admin') + '</p><p class="text-[11px] text-stone-600 leading-tight">' + (rep
                        .content || '') + '</p>';
                }).join('');
                repliesHtml = '<div class="mt-2 relative">' +
                    '<button type="button" class="review-reply-toggle w-full text-left text-[11px] text-[#674c1d] font-medium flex items-center gap-1 hover:underline focus:outline-none" aria-expanded="false">' +
                    '<i class="fas fa-chevron-down review-reply-chevron text-[10px] transition-transform duration-200"></i> Balasan admin (' +
                    r.replies.length + ')</button>' +
                    '<div class="review-reply-dropdown hidden absolute left-0 right-0 top-full mt-1 z-[50] pl-3 border-l-2 border-stone-400 bg-stone-100 rounded-r py-2 pr-2 shadow-lg min-w-[200px]">' +
                    replyBlocks + '</div></div>';
            }
            return '<div class="reviews-card relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm p-3 border border-stone-100 flex flex-col justify-center min-h-[140px]">' +
                '<div class="reviews-card-inner">' +
                '<p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">' + (r.content || '') +
                '</p>' +
                '<div class="flex items-center gap-1 mb-0.5">' + stars + '</div>' +
                '<p class="text-stone-500 text-[11px] truncate">' + identity + ' · ' + (r.created_at || '') +
                '</p>' + repliesHtml + '</div></div>';
        }

        function setActiveBtn(activeBtn) {
            bar.querySelectorAll('.reviews-filter-btn').forEach(function(btn) {
                btn.classList.remove('bg-amber-800', 'text-white');
                btn.classList.add('bg-stone-200', 'text-stone-700');
            });
            activeBtn.classList.remove('bg-stone-200', 'text-stone-700');
            activeBtn.classList.add('bg-amber-800', 'text-white');
        }
        bar.querySelectorAll('.reviews-filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveBtn(this);
                var location = (bar.getAttribute('data-location') || '').trim();
                var sort = this.getAttribute('data-sort') || 'latest';
                var rating = (this.getAttribute('data-rating') || '').trim();
                var params = new URLSearchParams();
                if (location) params.set('location', location);
                params.set('sort', sort);
                if (rating) params.set('rating', rating);
                if (window.closeReviewsReplyDropdown) window.closeReviewsReplyDropdown();
                listEl.innerHTML =
                    '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Memuat...</p>';
                fetch('/api/reviews?' + params.toString())
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(data) {
                        aggEl.querySelector('.text-2xl').textContent = Number(data.aggregate
                            .avg).toFixed(1);
                        aggEl.querySelector('.text-xl').textContent = data.aggregate.count;
                        if (!data.reviews || data.reviews.length === 0) {
                            listEl.innerHTML =
                                '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Belum ada ulasan.</p>';
                        } else {
                            listEl.innerHTML = data.reviews.map(renderCard).join('');
                        }
                        if (typeof updateReviewsSliderButtons === 'function')
                            updateReviewsSliderButtons();
                    })
                    .catch(function() {
                        listEl.innerHTML =
                            '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Gagal memuat ulasan.</p>';
                        if (typeof updateReviewsSliderButtons === 'function')
                            updateReviewsSliderButtons();
                    });
            });
        });
    }

    // Reviews slider: satu baris, tombol kiri hilang saat di awal (biar komentar keliatan)
    var sliderTrack = document.getElementById('reviews-list');
    var sliderPrev = document.querySelector('#testimoni-section .reviews-slider-prev');
    var sliderNext = document.querySelector('#testimoni-section .reviews-slider-next');
    if (sliderTrack && sliderPrev && sliderNext) {
        var CARD_GAP = 16;
        var getCardWidth = function() {
            var card = sliderTrack.querySelector('.reviews-card');
            return card ? card.offsetWidth + CARD_GAP : 304;
        };
        updateReviewsSliderButtons = function() {
            var hasCards = sliderTrack.querySelectorAll('.reviews-card').length > 0;
            if (!hasCards) {
                sliderPrev.style.setProperty('display', 'none');
                sliderNext.style.setProperty('display', 'none');
                return;
            }
            var tw = sliderTrack.scrollWidth;
            var cw = sliderTrack.clientWidth;
            var sl = Math.round(sliderTrack.scrollLeft);
            if (tw <= cw + 2) {
                sliderPrev.style.setProperty('display', 'none');
                sliderNext.style.setProperty('display', 'none');
                sliderPrev.disabled = true;
                sliderNext.disabled = true;
            } else {
                sliderPrev.style.setProperty('display', sl <= 2 ? 'none' : 'flex');
                sliderPrev.disabled = sl <= 2;
                sliderNext.style.setProperty('display', (sl + cw >= tw - 2) ? 'none' : 'flex');
                sliderNext.disabled = sl + cw >= tw - 2;
            }
        };
        sliderTrack.addEventListener('scroll', updateReviewsSliderButtons);
        sliderPrev.addEventListener('click', function() {
            sliderTrack.scrollBy({
                left: -getCardWidth(),
                behavior: 'smooth'
            });
        });
        sliderNext.addEventListener('click', function() {
            sliderTrack.scrollBy({
                left: getCardWidth(),
                behavior: 'smooth'
            });
        });
        updateReviewsSliderButtons();
        setTimeout(updateReviewsSliderButtons, 100);
        window.addEventListener('resize', updateReviewsSliderButtons);
    }

    // Toggle balasan admin: pindah dropdown ke .reviews-slider-outer + position absolute agar tidak terpotong overflow dan ikut scroll dengan section
    var reviewsList = document.getElementById('reviews-list');
    var sliderOuter = document.querySelector('.reviews-slider-outer');
    var openReplyDropdown = null;
    var openReplyBtn = null;
    window.closeReviewsReplyDropdown = function() {
        closeReplyDropdown();
    };

    function closeReplyDropdown() {
        if (openReplyDropdown) {
            var parent = openReplyDropdown._originalParent;
            if (parent && document.body.contains(parent)) {
                parent.appendChild(openReplyDropdown);
            } else if (openReplyDropdown.parentNode) {
                openReplyDropdown.parentNode.removeChild(openReplyDropdown);
            }
            openReplyDropdown.classList.add('hidden');
            openReplyDropdown.style.cssText = '';
            if (openReplyBtn && document.body.contains(openReplyBtn)) {
                openReplyBtn.setAttribute('aria-expanded', 'false');
                var ch = openReplyBtn.querySelector('.review-reply-chevron');
                if (ch) ch.style.transform = 'rotate(0deg)';
            }
            openReplyDropdown = null;
            openReplyBtn = null;
        }
        document.removeEventListener('click', closeReplyOnClickOutside);
    }

    function closeReplyOnClickOutside(ev) {
        if (openReplyDropdown && openReplyBtn && !openReplyDropdown.contains(ev.target) && !openReplyBtn
            .contains(ev.target)) {
            closeReplyDropdown();
        }
    }

    if (reviewsList && sliderOuter) {
        reviewsList.addEventListener('click', function(e) {
            var btn = e.target.closest('.review-reply-toggle');
            if (!btn) return;
            e.preventDefault();
            if (openReplyBtn === btn) {
                closeReplyDropdown();
                return;
            }
            var card = btn.closest('.reviews-card');
            var dropdown = card ? card.querySelector('.review-reply-dropdown') : null;
            if (!dropdown) return;
            closeReplyDropdown();
            var btnRect = btn.getBoundingClientRect();
            var outerRect = sliderOuter.getBoundingClientRect();
            dropdown._originalParent = dropdown.parentNode;
            sliderOuter.appendChild(dropdown);
            dropdown.classList.remove('hidden');
            var topPx = btnRect.bottom - outerRect.top + 4;
            var leftPx = btnRect.left - outerRect.left;
            dropdown.style.cssText = 'position:absolute;left:' + leftPx + 'px;top:' + topPx +
                'px;width:' + Math.max(btnRect.width, 200) + 'px;min-width:200px;z-index:9999;';
            btn.setAttribute('aria-expanded', 'true');
            var chevron = btn.querySelector('.review-reply-chevron');
            if (chevron) chevron.style.transform = 'rotate(180deg)';
            openReplyDropdown = dropdown;
            openReplyBtn = btn;
            setTimeout(function() {
                document.addEventListener('click', closeReplyOnClickOutside);
            }, 0);
        });
    }

    // Feedback section carousel (kanan): auto-rotate, read-only, sumber sama header
    var feedbackTrack = document.querySelector('.feedback-carousel-track');
    if (feedbackTrack) {
        var slides = feedbackTrack.querySelectorAll('.feedback-carousel-slide');
        var totalSlides = slides.length;
        if (totalSlides > 1) {
            var feedbackIndex = 0;
            function updateFeedbackCarousel() {
                feedbackTrack.style.transform = 'translateX(-' + (feedbackIndex * (100 / totalSlides)) + '%)';
            }
            setInterval(function() {
                feedbackIndex = (feedbackIndex + 1) % totalSlides;
                updateFeedbackCarousel();
            }, 4500);
            updateFeedbackCarousel();
        }
    }
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

.review-video-toast.review-video-toast-visible {
    opacity: 1;
    transform: translateX(0);
}

.review-video-toast-icon {
    color: #674c1d;
    font-size: 1.35rem;
    flex-shrink: 0;
}

.review-video-toast-body {
    flex: 1;
    min-width: 0;
}

.review-video-toast-body strong {
    display: block;
    color: #1e293b;
    font-size: 0.95rem;
    margin-bottom: 0.25rem;
}

.review-video-toast-body p {
    margin: 0;
    color: #64748b;
    font-size: 0.875rem;
    line-height: 1.4;
}

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

.review-video-toast-close:hover {
    color: #674c1d;
    background: rgba(103, 76, 29, 0.08);
}

@media (max-width: 480px) {
    .review-video-toast {
        left: 1rem;
        right: 1rem;
        max-width: none;
    }
}
</style>