@extends('layouts.app')

@section('title', 'Ulasan & Feedback - Neovala')

@section('skip-footer')
@endsection

@section('content')
<section class="py-10 px-4 bg-stone-50 min-h-screen">
    <div class="max-w-5xl mx-auto">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ $backUrl ?? route('home') }}" class="inline-flex items-center gap-2 text-[#674c1d] font-medium hover:underline text-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- =============================
             GIVE US FEEDBACK FORM
             ============================= --}}
        <div class="mb-12">
            <div class="flex flex-col p-6 md:p-9 bg-white rounded-tr-[64px] rounded-es-[64px] shadow-lg border border-[#674c1d]/10">
                <h2 class="text-xl font-semibold text-[#674c1d] mb-1" style="font-family: 'Georgia', serif;">GIVE US FEEDBACK</h2>
                <p class="text-[12px] text-[#674c1d]/70 mb-6">Bagikan cerita dan pendapatmu agar kami bisa berkembang.</p>
                <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data" id="reviewFormPage">
                    @csrf
                    <div class="space-y-2 mb-4">
                        <label for="locationPage" class="text-[12px] font-semibold text-[#674c1d]">Pilih apartemen *</label>
                        <select name="location" id="locationPage" required
                            class="w-full rounded-[8px] border border-[#674c1d]/35 py-2 px-3 text-sm text-[#674c1d] bg-white focus:outline-none focus:ring-1 focus:ring-[#674c1d]/30">
                            @foreach($locations ?? [] as $loc)
                                @if($loc !== 'keseluruhan')
                                <option value="{{ $loc }}">{{ strtoupper($loc) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-6 md:gap-6">
                        <div class="flex flex-col w-full md:w-1/2 space-y-4">
                            <div class="space-y-2">
                                <div class="flex flex-row justify-between items-center">
                                    <label class="text-[12px] font-semibold text-[#674c1d]">Instagram</label>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[12px] text-[#CFC3B7]">Samarkan</span>
                                        <label class="relative inline-flex items-center cursor-pointer select-none">
                                            <input id="hideIdentityTogglePage" type="checkbox" name="hide_identity" value="on" class="sr-only peer">
                                            <div class="w-6 h-3.5 bg-gray-200 rounded-full peer-checked:bg-[#674c1d] transition-colors"></div>
                                            <span class="absolute left-0.5 top-[1.5px] w-2.5 h-2.5 bg-white rounded-full border border-gray-300 transition-transform peer-checked:translate-x-[11px] pointer-events-none" style="margin-left: 0;"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex rounded-[8px] border border-[#674c1d]/35 overflow-hidden">
                                    <span class="inline-flex items-center pl-3 text-[#674c1d]/80 text-sm">@</span>
                                    <input type="text" name="instagram"
                                        class="flex-1 min-w-0 py-2 pr-3 pl-1 text-sm text-[#674c1d] placeholder-[#CFC3B7] border-0 bg-transparent focus:outline-none focus:ring-0"
                                        placeholder="Username instagram Anda" maxlength="50">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[12px] font-semibold text-[#674c1d]">Gambar (max 5)</label>
                                <div class="flex flex-wrap gap-3 items-center">
                                    <button type="button" id="addPhotoBtnPage"
                                        class="flex items-center justify-center w-12 h-12 rounded-[8px] border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors"
                                        title="Tambah foto">
                                        <i class="fas fa-plus text-lg"></i>
                                    </button>
                                    <span id="photoCountPage" class="text-[12px] text-[#674c1d]/60">0/5 foto</span>
                                </div>
                                <div id="photoSlotsPage" class="flex flex-wrap gap-2"></div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[12px] font-semibold text-[#674c1d]">Video (max 1)</label>
                                <input type="file" name="video" id="videoInputPage" accept="video/*" class="hidden">
                                <button type="button" id="addVideoBtnPage"
                                    class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-[8px] border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors text-sm">
                                    <i class="fas fa-video"></i>
                                    <span id="videoLabelPage">Tambah video</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col w-full md:w-1/2 space-y-4">
                            <div class="space-y-2">
                                <label class="text-[12px] font-semibold text-[#674c1d]">Rating *</label>
                                <input type="hidden" name="rating" id="ratingInputPage" value="0" required>
                                <div class="flex gap-1.5" id="starSelectPage">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="far fa-star text-2xl cursor-pointer transition-colors text-[#674c1d] hover:text-[#5a4218]" data-rating="{{ $i }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="space-y-2 flex-1 flex flex-col">
                                <label class="text-[12px] font-semibold text-[#674c1d]">Bagaimana pengalaman anda? *</label>
                                <textarea name="content" id="contentTextareaPage" rows="6"
                                    class="w-full rounded-[8px] border border-[#674c1d]/35 p-2 text-sm text-[#674c1d] placeholder-[#CFC3B7] focus:outline-none focus:ring-1 focus:ring-[#674c1d]/30 resize-y min-h-[120px]"
                                    placeholder="Bagikan pengalaman Anda dengan kami" required maxlength="2000"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" id="reviewSubmitBtnPage"
                            class="hidden py-3 px-6 rounded-[8px] bg-[#674c1d] text-white font-medium hover:bg-[#5a4218] transition-colors border border-[#674c1d]">Kirim</button>
                        <button type="button" id="reviewSubmitBtnDisabledPage" disabled
                            class="py-3 px-6 rounded-[8px] bg-[#F6EFE9] text-[#CFC3B7] font-medium cursor-not-allowed border border-[#CFC3B7]/50">Kirim</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Loading overlay saat kirim ulasan --}}
        <div id="reviewLoadingOverlayPage"
            class="fixed inset-0 z-[9999] hidden flex items-center justify-center bg-black/30 backdrop-blur-sm transition-opacity duration-200"
            aria-hidden="true">
            <div class="bg-white rounded-2xl shadow-2xl px-8 py-6 flex flex-col items-center gap-4 min-w-[200px] border border-[#674c1d]/20">
                <i class="fas fa-circle-notch fa-spin text-3xl text-[#674c1d]"></i>
                <p class="text-[#674c1d] font-medium text-center">Mengirim ulasan...</p>
                <p class="text-stone-500 text-sm text-center">Mohon tunggu sebentar</p>
            </div>
        </div>

        {{-- =============================
             WHAT THEY SAY SECTION
             ============================= --}}
        <h2 class="text-2xl md:text-3xl font-bold text-amber-900 text-center mb-2">WHAT THEY SAY?</h2>
        <div class="border-b-2 border-amber-800 w-24 mx-auto mb-8"></div>

        <div id="reviews-page-aggregate" class="flex flex-wrap items-center justify-center gap-6 mb-8">
            <div class="text-center px-4">
                <span class="text-3xl font-bold text-[#674c1d]">{{ number_format($reviewAggregate['avg'] ?? 0, 1) }}</span>
                <p class="text-sm text-stone-600 mt-0.5">Rating rata-rata</p>
            </div>
            <div class="text-center px-4 border-l border-stone-300">
                <span class="text-2xl font-semibold text-[#674c1d]">{{ number_format($reviewAggregate['count'] ?? 0) }}</span>
                <p class="text-sm text-stone-600 mt-0.5">Ulasan</p>
            </div>
        </div>

        <div class="reviews-page-filter-container bg-white rounded-xl border border-stone-200 shadow-sm p-4 md:p-5 mb-8">
            <div class="flex flex-wrap gap-3 items-center">
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <label class="text-stone-600 text-sm font-medium shrink-0">Lokasi:</label>
                    <select id="reviews-page-location" class="rounded-lg border border-[#674c1d]/40 px-3 py-2 text-sm text-[#674c1d] bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]">
                        <option value="">Semua</option>
                        @foreach($locations ?? [] as $loc)
                            @if($loc !== 'keseluruhan')
                                <option value="{{ $loc }}">{{ strtoupper($loc) }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[180px]">
                    <input type="text" id="reviews-page-search"
                        class="w-full rounded-lg border border-[#674c1d]/40 px-3 py-2 text-sm text-[#674c1d] placeholder-stone-400 bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]"
                        placeholder="Cari dalam ulasan..." autocomplete="off">
                </div>
            </div>
            {{-- Mobile dropdown filter --}}
            <div class="mt-4 pt-4 border-t border-stone-200 md:hidden">
                <label class="block text-stone-600 text-sm font-medium mb-2">Filter ulasan</label>
                <select id="reviews-page-filter-dropdown"
                    class="w-full rounded-lg border border-[#674c1d]/40 px-3 py-2.5 text-sm text-[#674c1d] bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]">
                    <option value="all">Semua</option>
                    <option value="sort:latest">Terbaru</option>
                    <option value="sort:popular">Terpopuler</option>
                    <option value="sort:longest">Waktu terlama</option>
                    <option value="rating:5">5 Bintang</option>
                    <option value="rating:4">4 Bintang</option>
                    <option value="rating:3">3 Bintang</option>
                    <option value="rating:2">2 Bintang</option>
                    <option value="rating:1">1 Bintang</option>
                    <option value="has_media">Foto/Video ({{ $reviewAggregate['count_has_media'] ?? 0 }})</option>
                    <optgroup label="Kata kunci" id="reviews-page-filter-dropdown-keywords"></optgroup>
                </select>
            </div>
            {{-- Desktop filter buttons --}}
            <div class="mt-4 pt-4 border-t border-stone-200 hidden md:flex flex-wrap gap-3 justify-center md:justify-start items-center">
                <span class="text-stone-600 text-sm font-medium shrink-0">Filter:</span>
                <button type="button" class="reviews-page-filter-btn px-3 py-1.5 rounded-lg text-sm bg-[#674c1d] text-white reviews-page-active" data-sort="latest" data-rating="" data-filter-type="all">Semua</button>
                <button type="button" class="reviews-page-filter-btn px-3 py-1.5 rounded-lg text-sm bg-stone-200 text-stone-700 hover:bg-stone-300" data-sort="latest" data-rating="">Terbaru</button>
                <button type="button" class="reviews-page-filter-btn px-3 py-1.5 rounded-lg text-sm bg-stone-200 text-stone-700 hover:bg-stone-300" data-sort="popular" data-rating=""><i class="fas fa-thumbs-up text-xs mr-1"></i>Terpopuler</button>
                <button type="button" class="reviews-page-filter-btn px-3 py-1.5 rounded-lg text-sm bg-stone-200 text-stone-700 hover:bg-stone-300" data-sort="longest" data-rating="">Waktu terlama</button>
                @for ($r = 5; $r >= 1; $r--)
                    <button type="button" class="reviews-page-filter-btn px-3 py-1.5 rounded-lg text-sm bg-stone-200 text-stone-700 hover:bg-stone-300" data-sort="latest" data-rating="{{ $r }}">{{ $r }} Bintang</button>
                @endfor
                <button type="button" class="reviews-page-filter-btn reviews-page-has-media px-3 py-1.5 rounded-lg text-sm bg-stone-200 text-stone-700 hover:bg-stone-300" data-has-media="1">Foto/Video ({{ $reviewAggregate['count_has_media'] ?? 0 }})</button>
                <div id="reviews-page-keywords" class="flex flex-wrap gap-2 items-center"></div>
            </div>
        </div>

        <div id="reviews-page-list" class="space-y-6">
            @forelse($reviews as $review)
                <article class="bg-white rounded-xl shadow-sm border border-stone-200 p-5 relative">
                    <div class="absolute top-4 right-4 z-10">
                        <x-like-button :review="$review" />
                    </div>
                    <div class="flex flex-wrap items-center gap-2 mb-2 pr-16">
                        <span class="text-xs font-semibold text-[#674c1d] uppercase tracking-wide">{{ \App\Models\Review::locationDisplay($review->location) }}</span>
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-[#674c1d]' : 'text-stone-200' }}"></i>
                            @endfor
                        </div>
                        <span class="text-stone-500 text-sm">{{ ($review->hide_identity || empty($review->instagram)) ? 'Anonymous' : 'IG: @' . $review->instagram }}</span>
                        <span class="text-stone-400 text-xs">{{ $review->created_at->format('d M Y') }}</span>
                    </div>
                    <p class="text-stone-800 text-sm leading-relaxed whitespace-pre-wrap">{{ $review->content }}</p>
                    @if($review->media->count() > 0)
                        @php
                            $reviewImages = $review->media->where('type', 'image');
                            $reviewVideo = $review->media->where('type', 'video')->first();
                        @endphp
                        <div class="mt-4 flex flex-wrap gap-2 items-start">
                            @foreach($reviewImages as $m)
                                @php $url = asset('storage/' . $m->file_path); @endphp
                                <button type="button" class="review-page-media-preview block w-20 h-20 sm:w-24 sm:h-24 rounded-lg border border-[#674c1d]/30 overflow-hidden flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="{{ $url }}" data-type="image" aria-label="Perbesar gambar">
                                    <img src="{{ $url }}" alt="" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                            @if($reviewVideo)
                                @php $videoUrl = asset('storage/' . $reviewVideo->file_path); @endphp
                                <button type="button" class="review-page-media-preview relative block w-32 h-24 sm:w-40 sm:h-28 rounded-lg border border-[#674c1d]/30 overflow-hidden bg-stone-100 flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="{{ $videoUrl }}" data-type="video" aria-label="Putar video">
                                    <video src="{{ $videoUrl }}" class="w-full h-full object-cover pointer-events-none" preload="metadata" muted></video>
                                    <span class="absolute inset-0 flex items-center justify-center bg-black/20"><i class="fas fa-play text-white text-2xl"></i></span>
                                </button>
                            @endif
                        </div>
                    @endif
                    @foreach($review->replies as $reply)
                        <div class="mt-4 pl-4 py-2 border-l-2 border-[#674c1d]/40 bg-stone-100 rounded-r-lg">
                            <p class="text-xs font-semibold text-[#674c1d]">{{ $reply->admin->name ?? 'Admin' }}</p>
                            <p class="text-sm text-stone-700 mt-0.5">{{ $reply->content }}</p>
                            <p class="text-xs text-stone-500 mt-1">{{ $reply->created_at->format('d M Y H:i') }}</p>
                        </div>
                    @endforeach
                </article>
            @empty
                <p class="text-center text-stone-500 py-12">Belum ada ulasan.</p>
            @endforelse
        </div>

        <div id="reviews-page-pagination" class="mt-8">
            @if($reviews->hasPages())
                {{ $reviews->withQueryString()->links('user.reviews.pagination') }}
            @endif
        </div>
    </div>
</section>

{{-- Media modal --}}
<div id="review-page-media-overlay" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 opacity-0 pointer-events-none transition-opacity duration-300" aria-hidden="true">
    <div class="relative max-w-4xl max-h-[90vh] w-full flex items-center justify-center" onclick="event.stopPropagation()">
        <button type="button" id="review-page-media-close" class="absolute -top-10 right-0 w-10 h-10 flex items-center justify-center rounded-full bg-white border-2 border-[#674c1d] text-[#674c1d] hover:bg-[#674c1d] hover:text-white transition-colors z-10" aria-label="Tutup">
            <i class="fas fa-times text-lg"></i>
        </button>
        <div id="review-page-media-content" class="bg-white rounded-xl overflow-hidden shadow-xl border-2 border-[#674c1d]/30 max-w-full max-h-[85vh]"></div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ========================
    // FORM LOGIC
    // ========================
    var form = document.getElementById('reviewFormPage');
    var starSelect = document.getElementById('starSelectPage');
    var ratingInput = document.getElementById('ratingInputPage');
    var addPhotoBtn = document.getElementById('addPhotoBtnPage');
    var photoSlots = document.getElementById('photoSlotsPage');
    var photoCount = document.getElementById('photoCountPage');
    var videoInput = document.getElementById('videoInputPage');
    var addVideoBtn = document.getElementById('addVideoBtnPage');
    var videoLabel = document.getElementById('videoLabelPage');
    var submitBtn = document.getElementById('reviewSubmitBtnPage');
    var submitBtnDisabled = document.getElementById('reviewSubmitBtnDisabledPage');
    var contentTextarea = document.getElementById('contentTextareaPage');
    var loadingOverlay = document.getElementById('reviewLoadingOverlayPage');
    var MAX_VIDEO_BYTES = 20 * 1024 * 1024;

    function checkFormComplete() {
        var ratingOk = parseInt(ratingInput && ratingInput.value ? ratingInput.value : 0, 10) >= 1;
        var contentOk = contentTextarea && (contentTextarea.value || '').trim().length > 0;
        var complete = ratingOk && contentOk;
        if (submitBtn && submitBtnDisabled) {
            if (complete) {
                submitBtn.classList.remove('hidden');
                submitBtn.style.display = '';
                submitBtnDisabled.style.display = 'none';
            } else {
                submitBtn.style.display = 'none';
                submitBtn.classList.add('hidden');
                submitBtnDisabled.style.display = '';
            }
        }
    }

    if (starSelect && ratingInput) {
        function applyStars(r) {
            starSelect.querySelectorAll('[data-rating]').forEach(function (s) {
                var idx = parseInt(s.getAttribute('data-rating'), 10);
                s.classList.toggle('fas', idx <= r);
                s.classList.toggle('far', idx > r);
            });
        }
        starSelect.querySelectorAll('[data-rating]').forEach(function (star) {
            star.addEventListener('click', function () {
                var r = parseInt(this.getAttribute('data-rating'), 10);
                ratingInput.value = r;
                applyStars(r);
                checkFormComplete();
            });
            star.addEventListener('mouseenter', function () { applyStars(parseInt(this.getAttribute('data-rating'), 10)); });
        });
        starSelect.addEventListener('mouseleave', function () { applyStars(ratingInput.value); });
    }
    if (contentTextarea) {
        contentTextarea.addEventListener('input', checkFormComplete);
        contentTextarea.addEventListener('keyup', checkFormComplete);
    }
    checkFormComplete();

    // Photos
    var imageInputs = [];
    function getSelectedImageCount() {
        return imageInputs.filter(function (x) { return x.input.files && x.input.files.length > 0; }).length;
    }
    function updatePhotoUi() {
        if (photoCount) photoCount.textContent = getSelectedImageCount() + '/5 foto';
        if (addPhotoBtn) addPhotoBtn.style.display = getSelectedImageCount() >= 5 ? 'none' : '';
    }
    function addImageSlot() {
        if (!photoSlots || getSelectedImageCount() >= 5) return;
        var input = document.createElement('input');
        input.type = 'file'; input.name = 'images[]'; input.accept = 'image/*';
        var slot = document.createElement('div');
        slot.className = 'relative w-12 h-12 rounded-[8px] border border-[#674c1d]/30 overflow-hidden bg-stone-50';
        var rm = document.createElement('button');
        rm.type = 'button';
        rm.className = 'absolute top-0 right-0 w-4 h-4 bg-[#674c1d] text-white flex items-center justify-center text-[10px] rounded-bl z-10';
        rm.innerHTML = '&times;';
        function removeSlot() {
            var idx = imageInputs.findIndex(function (x) { return x.input === input; });
            if (idx >= 0) imageInputs.splice(idx, 1);
            input.remove(); slot.remove(); updatePhotoUi();
        }
        rm.addEventListener('click', removeSlot);
        input.addEventListener('change', function () {
            var file = input.files && input.files[0];
            if (!file) { removeSlot(); return; }
            slot.innerHTML = '';
            var img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full h-full object-cover';
            img.onload = function () { URL.revokeObjectURL(img.src); };
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
    if (addPhotoBtn) addPhotoBtn.addEventListener('click', addImageSlot);
    updatePhotoUi();

    // Video
    if (addVideoBtn && videoInput) {
        addVideoBtn.addEventListener('click', function () { videoInput.click(); });
        videoInput.addEventListener('change', function () {
            var file = this.files && this.files[0];
            if (!file) return;
            if (file.size > MAX_VIDEO_BYTES) {
                alert('File video maksimal 20 MB.'); this.value = '';
                if (videoLabel) videoLabel.textContent = 'Tambah video'; return;
            }
            if (videoLabel) videoLabel.textContent = file.name || '1 video dipilih';
        });
    }

    // Form submit via AJAX
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var csrf = (document.querySelector('meta[name="csrf-token"]') || {}).getAttribute('content') || '';
            var formData = new FormData(form);
            if (loadingOverlay) { loadingOverlay.classList.remove('hidden'); loadingOverlay.setAttribute('aria-hidden', 'false'); }
            fetch(form.getAttribute('action'), {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                body: formData,
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (loadingOverlay) { loadingOverlay.classList.add('hidden'); loadingOverlay.setAttribute('aria-hidden', 'true'); }
                if (data.success) {
                    form.reset();
                    imageInputs.length = 0;
                    if (photoSlots) photoSlots.innerHTML = '';
                    if (videoLabel) videoLabel.textContent = 'Tambah video';
                    if (ratingInput) ratingInput.value = 0;
                    if (starSelect) starSelect.querySelectorAll('[data-rating]').forEach(function(s){ s.classList.remove('fas'); s.classList.add('far'); });
                    checkFormComplete(); updatePhotoUi();
                    var toast = document.createElement('div');
                    toast.className = 'fixed top-4 right-4 z-[99999] bg-white border-l-4 border-[#674c1d] rounded-lg shadow-lg px-5 py-4 flex items-center gap-3 max-w-sm';
                    toast.innerHTML = '<i class="fas fa-check-circle text-[#674c1d] text-xl"></i><p class="text-sm text-stone-800">' + (data.message || 'Terima kasih atas ulasan Anda!') + '</p>';
                    document.body.appendChild(toast);
                    setTimeout(function () { toast.remove(); fetchReviews(); }, 3000);
                } else {
                    alert(data.message || 'Terjadi kesalahan, coba lagi.');
                }
            })
            .catch(function () {
                if (loadingOverlay) { loadingOverlay.classList.add('hidden'); loadingOverlay.setAttribute('aria-hidden', 'true'); }
                alert('Terjadi kesalahan koneksi, coba lagi.');
            });
        });
    }

    // ========================
    // REVIEWS FILTER & FETCH
    // ========================
    var listEl = document.getElementById('reviews-page-list');
    var aggEl = document.getElementById('reviews-page-aggregate');
    var paginationEl = document.getElementById('reviews-page-pagination');
    var filterContainer = document.querySelector('.reviews-page-filter-container');
    var locationSelect = document.getElementById('reviews-page-location');
    var searchInput = document.getElementById('reviews-page-search');
    var keywordsEl = document.getElementById('reviews-page-keywords');
    var filterDropdown = document.getElementById('reviews-page-filter-dropdown');
    var filterDropdownKeywords = document.getElementById('reviews-page-filter-dropdown-keywords');
    if (!listEl || !filterContainer) return;

    var currentPage = 1;
    var currentSort = 'latest';
    var currentRating = '';
    var currentHasMedia = false;
    var currentKeyword = '';

    function setActiveFilterBtn(btn) {
        if (!filterContainer) return;
        filterContainer.querySelectorAll('.reviews-page-filter-btn:not(.reviews-page-has-media):not(.reviews-page-keyword-btn)').forEach(function (b) {
            b.classList.remove('bg-[#674c1d]', 'text-white', 'reviews-page-active');
            b.classList.add('bg-stone-200', 'text-stone-700');
        });
        if (btn) {
            btn.classList.add('bg-[#674c1d]', 'text-white', 'reviews-page-active');
            btn.classList.remove('bg-stone-200', 'text-stone-700');
        }
    }
    function setHasMediaActive(active) {
        var btn = filterContainer.querySelector('.reviews-page-has-media');
        if (!btn) return;
        if (active) { btn.classList.add('bg-[#674c1d]', 'text-white', 'reviews-page-active'); btn.classList.remove('bg-stone-200', 'text-stone-700'); }
        else { btn.classList.remove('bg-[#674c1d]', 'text-white', 'reviews-page-active'); btn.classList.add('bg-stone-200', 'text-stone-700'); }
        currentHasMedia = active;
    }
    function setActiveKeywordBtn(btn) {
        filterContainer.querySelectorAll('.reviews-page-keyword-btn').forEach(function (b) {
            b.classList.remove('bg-[#674c1d]', 'text-white', 'reviews-page-active');
            b.classList.add('bg-stone-200', 'text-stone-700');
        });
        if (btn) { btn.classList.add('bg-[#674c1d]', 'text-white', 'reviews-page-active'); btn.classList.remove('bg-stone-200', 'text-stone-700'); currentKeyword = btn.getAttribute('data-keyword') || ''; }
        else { currentKeyword = ''; }
    }

    function renderCard(r) {
        var identity = (r.hide_identity || !r.instagram) ? 'Anonymous' : ('IG: @' + r.instagram);
        var stars = '';
        for (var i = 1; i <= 5; i++) { stars += '<i class="fas fa-star text-sm ' + (i <= r.rating ? 'text-[#674c1d]' : 'text-stone-200') + '"></i>'; }
        var mediaHtml = '';
        if (r.media && r.media.length) {
            var imgs = r.media.filter(function (m) { return typeof m === 'object' ? m.type === 'image' : true; });
            var vid = r.media.filter(function (m) { return typeof m === 'object' && m.type === 'video'; })[0];
            var parts = [];
            imgs.forEach(function (m) {
                var url = typeof m === 'object' ? (m.url || ('/storage/' + m.file_path)) : m;
                parts.push('<button type="button" class="review-page-media-preview block w-20 h-20 sm:w-24 sm:h-24 rounded-lg border border-[#674c1d]/30 overflow-hidden flex-shrink-0 focus:outline-none" data-src="' + url + '" data-type="image"><img src="' + url + '" alt="" class="w-full h-full object-cover"></button>');
            });
            if (vid) {
                var vs = vid.url || ('/storage/' + vid.file_path);
                parts.push('<button type="button" class="review-page-media-preview relative block w-32 h-24 rounded-lg border border-[#674c1d]/30 overflow-hidden bg-stone-100 flex-shrink-0 focus:outline-none" data-src="' + vs + '" data-type="video"><video src="' + vs + '" class="w-full h-full object-cover pointer-events-none" preload="metadata" muted></video><span class="absolute inset-0 flex items-center justify-center bg-black/20"><i class="fas fa-play text-white text-2xl"></i></span></button>');
            }
            if (parts.length) mediaHtml = '<div class="mt-4 flex flex-wrap gap-2 items-start">' + parts.join('') + '</div>';
        }
        var repliesHtml = '';
        if (r.replies && r.replies.length) {
            repliesHtml = r.replies.map(function (rep) {
                return '<div class="mt-4 pl-4 py-2 border-l-2 border-[#674c1d]/40 bg-stone-100 rounded-r-lg"><p class="text-xs font-semibold text-[#674c1d]">' + (rep.admin_name || 'Admin') + '</p><p class="text-sm text-stone-700 mt-0.5">' + (rep.content || '') + '</p><p class="text-xs text-stone-500 mt-1">' + (rep.created_at || '') + '</p></div>';
            }).join('');
        }
        var likesCount = r.likes_count ?? 0;
        var dataLiked = (r.user_has_liked ? 'true' : 'false');
        var likeBtnHtml = '<button type="button" class="like-btn inline-flex flex-col items-center gap-0.5 border-0 bg-transparent p-0" data-review-id="' + (r.id || '') + '" data-liked="' + dataLiked + '" style="cursor:pointer;outline:none" title="Like komentar ini"><svg class="like-icon not-liked" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#9e9e9e;transition:color 0.2s ease"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg><span class="like-count" style="font-size:11px;color:#666">' + likesCount + '</span></button>';
        return '<article class="bg-white rounded-xl shadow-sm border border-stone-200 p-5 relative">' +
            '<div class="absolute top-4 right-4 z-10">' + likeBtnHtml + '</div>' +
            '<div class="flex flex-wrap items-center gap-2 mb-2 pr-16"><span class="text-xs font-semibold text-[#674c1d] uppercase tracking-wide">' + (r.location || '') + '</span>' +
            '<div class="flex items-center gap-1">' + stars + '</div>' +
            '<span class="text-stone-500 text-sm">' + identity + '</span>' +
            '<span class="text-stone-400 text-xs">' + (r.created_at || '') + '</span></div>' +
            '<p class="text-stone-800 text-sm leading-relaxed whitespace-pre-wrap">' + (r.content || '') + '</p>' +
            mediaHtml + repliesHtml + '</article>';
    }

    function renderPaginationHtml(p) {
        if (!p || p.last_page <= 1) return '';
        var html = '<div class="flex flex-wrap gap-2 justify-center reviews-detail-pagination-simple">';
        html += '<button type="button" class="reviews-detail-page-btn' + (p.current_page <= 1 ? ' reviews-detail-page-btn--disabled' : '') + '" data-page="' + (p.current_page - 1) + '">&laquo;</button>';
        var start = Math.max(1, p.current_page - 2), end = Math.min(p.last_page, p.current_page + 2);
        if (start > 1) html += '<button type="button" class="reviews-detail-page-btn" data-page="1">1</button>' + (start > 2 ? '<span class="reviews-detail-page-btn reviews-detail-page-btn--disabled">…</span>' : '');
        for (var i = start; i <= end; i++) { html += '<button type="button" class="reviews-detail-page-btn' + (i === p.current_page ? ' reviews-detail-page-btn--active' : '') + '" data-page="' + i + '">' + i + '</button>'; }
        if (end < p.last_page) html += (end < p.last_page - 1 ? '<span class="reviews-detail-page-btn reviews-detail-page-btn--disabled">…</span>' : '') + '<button type="button" class="reviews-detail-page-btn" data-page="' + p.last_page + '">' + p.last_page + '</button>';
        html += '<button type="button" class="reviews-detail-page-btn' + (p.current_page >= p.last_page ? ' reviews-detail-page-btn--disabled' : '') + '" data-page="' + (p.current_page + 1) + '">&raquo;</button>';
        return html + '</div>';
    }

    function fetchReviews() {
        var params = new URLSearchParams();
        var loc = locationSelect ? locationSelect.value : '';
        if (loc) params.set('location', loc);
        params.set('sort', currentSort);
        if (currentRating) params.set('rating', currentRating);
        if (currentHasMedia) params.set('has_media', '1');
        if (currentKeyword) params.set('keyword', currentKeyword);
        var q = searchInput ? searchInput.value.trim() : '';
        if (q) params.set('q', q);
        params.set('page', currentPage);
        params.set('per_page', '12');

        listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Memuat...</p>';
        if (paginationEl) paginationEl.innerHTML = '';

        fetch('/api/reviews?' + params.toString(), { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (aggEl) {
                    aggEl.querySelector('.text-3xl').textContent = Number(data.aggregate.avg).toFixed(1);
                    aggEl.querySelector('.text-2xl').textContent = data.aggregate.count;
                }
                var hasMediaBtn = filterContainer.querySelector('.reviews-page-has-media');
                var mediaCount = (data.aggregate.count_has_media ?? 0);
                if (hasMediaBtn) hasMediaBtn.textContent = 'Foto/Video (' + mediaCount + ')';
                var hasMediaOpt = filterDropdown && filterDropdown.querySelector('option[value="has_media"]');
                if (hasMediaOpt) hasMediaOpt.textContent = 'Foto/Video (' + mediaCount + ')';
                if (!data.reviews || data.reviews.length === 0) {
                    listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Belum ada ulasan.</p>';
                } else {
                    listEl.innerHTML = data.reviews.map(function (r) { return renderCard(r); }).join('');
                    if (window.initLikeStates) window.initLikeStates();
                }
                if (data.pagination && paginationEl) paginationEl.innerHTML = renderPaginationHtml(data.pagination);
            })
            .catch(function () {
                listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Gagal memuat ulasan.</p>';
            });
    }

    function loadKeywords() {
        var loc = locationSelect ? locationSelect.value : '';
        var params = new URLSearchParams();
        if (loc) params.set('location', loc);
        fetch('/api/reviews/keywords?' + params.toString())
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (!keywordsEl || !data.keywords || !data.keywords.length) {
                    if (keywordsEl) keywordsEl.innerHTML = '';
                    if (filterDropdownKeywords) filterDropdownKeywords.innerHTML = '';
                    return;
                }
                keywordsEl.innerHTML = '';
                if (filterDropdownKeywords) {
                    filterDropdownKeywords.innerHTML = '';
                    data.keywords.forEach(function (kw) {
                        var opt = document.createElement('option');
                        opt.value = 'kw:' + kw.word; opt.textContent = kw.word + ' (' + kw.count + ')';
                        filterDropdownKeywords.appendChild(opt);
                    });
                }
                data.keywords.forEach(function (kw) {
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'reviews-page-filter-btn reviews-page-keyword-btn px-3 py-1.5 rounded-lg text-sm bg-stone-200 text-stone-700 hover:bg-stone-300';
                    btn.setAttribute('data-keyword', kw.word);
                    btn.textContent = kw.word + ' (' + kw.count + ')';
                    btn.addEventListener('click', function () {
                        currentPage = 1;
                        var isActive = btn.classList.contains('reviews-page-active');
                        setActiveKeywordBtn(isActive ? null : btn);
                        fetchReviews();
                    });
                    keywordsEl.appendChild(btn);
                });
            });
    }

    // Filter button events
    filterContainer.querySelectorAll('.reviews-page-filter-btn:not(.reviews-page-has-media):not(.reviews-page-keyword-btn)').forEach(function (btn) {
        btn.addEventListener('click', function () {
            currentPage = 1;
            currentSort = btn.getAttribute('data-sort') || 'latest';
            currentRating = btn.getAttribute('data-rating') || '';
            if (btn.getAttribute('data-filter-type') === 'all') { setHasMediaActive(false); setActiveKeywordBtn(null); }
            setActiveFilterBtn(btn);
            fetchReviews();
        });
    });
    var hasMediaBtn = filterContainer.querySelector('.reviews-page-has-media');
    if (hasMediaBtn) {
        hasMediaBtn.addEventListener('click', function () {
            currentPage = 1;
            setHasMediaActive(!currentHasMedia);
            fetchReviews();
        });
    }
    if (locationSelect) locationSelect.addEventListener('change', function () { currentPage = 1; loadKeywords(); fetchReviews(); });

    var searchTimer;
    if (searchInput) searchInput.addEventListener('input', function () { clearTimeout(searchTimer); searchTimer = setTimeout(function () { currentPage = 1; fetchReviews(); }, 350); });

    if (filterDropdown) {
        filterDropdown.addEventListener('change', function () {
            var v = filterDropdown.value;
            currentPage = 1;
            if (v === 'all') { setHasMediaActive(false); setActiveKeywordBtn(null); currentSort = 'latest'; currentRating = ''; setActiveFilterBtn(filterContainer.querySelector('[data-filter-type="all"]')); fetchReviews(); return; }
            if (v === 'sort:latest') { currentSort = 'latest'; currentRating = ''; fetchReviews(); return; }
            if (v === 'sort:popular') { currentSort = 'popular'; currentRating = ''; fetchReviews(); return; }
            if (v === 'sort:longest') { currentSort = 'longest'; currentRating = ''; fetchReviews(); return; }
            if (v.indexOf('rating:') === 0) { currentSort = 'latest'; currentRating = v.slice(7); fetchReviews(); return; }
            if (v === 'has_media') { setHasMediaActive(true); fetchReviews(); return; }
            if (v.indexOf('kw:') === 0) {
                var word = v.slice(3);
                var kwBtn = filterContainer.querySelector('.reviews-page-keyword-btn[data-keyword="' + word + '"]');
                if (kwBtn) { setActiveKeywordBtn(kwBtn); fetchReviews(); }
            }
        });
    }

    if (paginationEl) {
        paginationEl.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-page]');
            if (!btn || btn.classList.contains('reviews-detail-page-btn--disabled') || btn.classList.contains('reviews-detail-page-btn--active')) return;
            var page = parseInt(btn.getAttribute('data-page'), 10);
            if (page < 1) return;
            currentPage = page;
            fetchReviews();
            document.getElementById('reviews-page-list').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }

    loadKeywords();

    // Media modal
    var overlay = document.getElementById('review-page-media-overlay');
    var contentBox = document.getElementById('review-page-media-content');
    var closeMediaBtn = document.getElementById('review-page-media-close');
    function openMedia(src, type) {
        contentBox.innerHTML = '';
        if (type === 'video') {
            var v = document.createElement('video');
            v.src = src; v.controls = true; v.className = 'max-w-full max-h-[85vh]'; v.preload = 'metadata';
            contentBox.appendChild(v);
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
            overlay.setAttribute('aria-hidden', 'false');
            v.play();
        } else {
            var img = document.createElement('img');
            img.src = src; img.alt = ''; img.className = 'max-w-full max-h-[85vh] object-contain';
            contentBox.appendChild(img);
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
            overlay.setAttribute('aria-hidden', 'false');
        }
    }
    function closeMedia() {
        overlay.classList.add('opacity-0', 'pointer-events-none');
        overlay.classList.remove('opacity-100', 'pointer-events-auto');
        overlay.setAttribute('aria-hidden', 'true');
        var v = contentBox.querySelector('video');
        if (v) v.pause();
        setTimeout(function () { contentBox.innerHTML = ''; }, 300);
    }
    if (listEl) listEl.addEventListener('click', function (e) {
        var btn = e.target.closest('.review-page-media-preview');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();
        var container = btn.closest('article') || btn.parentElement;
        var allBtns = container ? container.querySelectorAll('.review-page-media-preview') : [btn];
        var items = [], clickedIdx = 0;
        allBtns.forEach(function (b) {
            var src = b.getAttribute('data-src');
            var type = b.getAttribute('data-type') || 'image';
            if (src) {
                if (b === btn) clickedIdx = items.length;
                items.push({ src: src, type: type });
            }
        });
        if (items.length && typeof window.openMediaGallery === 'function') {
            window.openMediaGallery(items, clickedIdx);
        } else if (items.length) {
            openMedia(items[clickedIdx].src, items[clickedIdx].type);
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.reviews-detail-pagination-simple { margin-top: 0; }
.reviews-detail-page-btn {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 2.25rem; height: 2.25rem; padding: 0 0.5rem;
    border: 1px solid #674c1d; background: #fff; color: #674c1d;
    border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500;
    text-decoration: none; transition: background 0.2s, color 0.2s; cursor: pointer;
}
.reviews-detail-page-btn:hover { background: #674c1d; color: #fff; }
.reviews-detail-page-btn--active { background: #674c1d; color: #fff; border-color: #674c1d; cursor: default; }
.reviews-detail-page-btn--disabled { background: #f5f5f4; color: #a8a29e; border-color: #d6d3d1; cursor: default; pointer-events: none; }
</style>
@endpush

@endsection
