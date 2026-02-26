{{-- Section ulasan discover. Butuh: $reviews, $reviewAggregate, lalu salah satu: ($locationName + $locationSlug) atau $location (slug). $locationName = nilai yang dikirim ke form & API (nama lengkap). $locationSlug = untuk URL "Lihat semua" (tpj, tpc, ...). --}}
@php
$locationForForm = $locationName ?? $location ?? '';
$locationForFilter = $locationName ?? $location ?? '';
$locationForLink = $locationSlug ?? $location ?? '';
@endphp
<section id="testimoni-section" class="py-12 px-4 bg-stone-50">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 md:gap-9 max-w-6xl mx-auto items-stretch">
            {{-- Card form: 3/4 lebar (hanya geser sedikit ke kiri, form tetap besar) --}}
            <div class="col-span-4 md:col-span-3 flex flex-col min-w-0">
                <div
                    class="flex flex-col p-6 md:p-9 bg-white rounded-tr-[64px] rounded-es-[64px] shadow-lg border border-[#674c1d]/10 min-h-0">
                    <h2 class="text-xl font-semibold text-[#674c1d] mb-1" style="font-family: 'Georgia', serif;">GIVE US
                        FEEDBACK</h2>
                    <p class="text-[12px] text-[#674c1d]/70 mb-6">Bagikan cerita dan pendapatmu agar kami bisa
                        berkembang.</p>
                    <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data"
                        id="reviewForm">
                        @csrf
                        <input type="hidden" name="location" value="{{ $locationForForm }}">

                        <div class="flex flex-col md:flex-row md:space-x-6 md:gap-6">
                            {{-- Kolom kiri: Instagram, Samarkan, Gambar, Video --}}
                            <div class="flex flex-col w-full md:w-1/2 space-y-4">
                                <div class="space-y-2">
                                    <div class="flex flex-row justify-between items-center">
                                        <label class="text-[12px] font-semibold text-[#674c1d]">Instagram</label>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[12px] text-[#CFC3B7]">Samarkan</span>
                                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                                <input id="hideIdentityToggle" type="checkbox" name="hide_identity"
                                                    value="on" class="sr-only peer">
                                                <div
                                                    class="w-6 h-3.5 bg-gray-200 rounded-full peer-checked:bg-[#674c1d] transition-colors">
                                                </div>
                                                <span
                                                    class="absolute left-0.5 top-[1.5px] w-2.5 h-2.5 bg-white rounded-full border border-gray-300 transition-transform peer-checked:translate-x-[11px] pointer-events-none"
                                                    style="margin-left: 0;"></span>
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
                                        <button type="button" id="addPhotoBtn"
                                            class="flex items-center justify-center w-12 h-12 rounded-[8px] border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors"
                                            title="Tambah foto">
                                            <i class="fas fa-plus text-lg"></i>
                                        </button>
                                        <span id="photoCount" class="text-[12px] text-[#674c1d]/60">0/5 foto</span>
                                    </div>
                                    <div id="photoSlots" class="flex flex-wrap gap-2"></div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[12px] font-semibold text-[#674c1d]">Video (max 1)</label>
                                    <input type="file" name="video" id="videoInput" accept="video/*" class="hidden">
                                    <button type="button" id="addVideoBtn"
                                        class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-[8px] border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors text-sm">
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
                                        @for ($i = 1; $i <= 5; $i++) <i
                                            class="far fa-star text-2xl cursor-pointer transition-colors text-[#674c1d] hover:text-[#5a4218]"
                                            data-rating="{{ $i }}"></i>
                                            @endfor
                                    </div>
                                </div>
                                <div class="space-y-2 flex-1 flex flex-col">
                                    <label class="text-[12px] font-semibold text-[#674c1d]">Bagaimana pengalaman anda?
                                        *</label>
                                    <textarea name="content" id="contentTextarea" rows="6"
                                        class="w-full rounded-[8px] border border-[#674c1d]/35 p-2 text-sm text-[#674c1d] placeholder-[#CFC3B7] focus:outline-none focus:ring-1 focus:ring-[#674c1d]/30 resize-y min-h-[120px]"
                                        placeholder="Bagikan pengalaman Anda dengan kami" required
                                        maxlength="2000"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="submit" id="reviewSubmitBtn"
                                class="hidden py-3 px-6 rounded-[8px] bg-[#674c1d] text-white font-medium hover:bg-[#5a4218] transition-colors border border-[#674c1d]">Kirim</button>
                            <button type="button" id="reviewSubmitBtnDisabled" disabled
                                class="py-3 px-6 rounded-[8px] bg-[#F6EFE9] text-[#CFC3B7] font-medium cursor-not-allowed border border-[#CFC3B7]/50">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Foto carousel (kanan): 1/4 lebar, proporsi seperti referensi, rounded-tl/rounded-ee --}}
            @if(!empty($carouselImages) && is_array($carouselImages))
            <div id="feedbackCarouselOuter"
                class="col-span-1 hidden md:block min-h-[280px] md:min-h-0 h-full overflow-hidden rounded-tl-[96px] rounded-br-[96px] border border-[#674c1d]/10 shadow-lg bg-stone-100 relative">
                <div class="feedback-carousel-track flex h-full min-h-[280px] md:min-h-full transition-transform duration-500 ease-out"
                    style="width: {{ count($carouselImages) * 100 }}%;">
                    @foreach($carouselImages as $imgUrl)
                    <div class="feedback-carousel-slide flex-shrink-0 h-full min-h-[280px] md:min-h-full"
                        style="width: {{ 100 / count($carouselImages) }}%;">
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

        <div class="reviews-widget-filter-container bg-white rounded-xl border border-stone-200 shadow-sm p-4 md:p-5 mb-6" data-current-location="{{ $locationForFilter }}" data-detail-url="{{ route('reviews.detail.discover', $locationForLink) }}">
            <div class="reviews-widget-filter-row flex flex-wrap gap-3 items-center">
                <div class="flex-1 min-w-[180px]">
                    <input type="text" id="reviews-widget-search" class="w-full rounded-lg border border-[#674c1d]/40 px-3 py-2 text-sm text-[#674c1d] placeholder-stone-400 bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]" placeholder="Cari dalam ulasan..." value="{{ request('q', '') }}" autocomplete="off">
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-stone-200 flex flex-wrap gap-3 justify-center md:justify-start items-center">
                <span class="text-stone-600 text-sm font-medium shrink-0">Filter:</span>
                @php
                    $isSemuaActive = !request('rating') && !request('has_media') && !request('keyword');
                    $isTerbaruActive = !$isSemuaActive && request('sort', 'latest') === 'latest' && !request('rating');
                @endphp
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ $isSemuaActive ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="" data-filter-type="all">Semua</button>
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ $isTerbaruActive ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="">Terbaru</button>
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('sort') === 'popular' ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="popular" data-rating=""><i class="fas fa-thumbs-up text-xs mr-1"></i>Terpopuler</button>
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('sort') === 'longest' ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="longest" data-rating="">Waktu terlama</button>
                @for ($r = 5; $r >= 1; $r--)
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('rating') == $r ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="{{ $r }}">{{ $r }} Bintang</button>
                @endfor
                <button type="button" class="reviews-widget-filter-btn reviews-widget-has-media px-3 py-1.5 rounded-lg text-sm {{ request('has_media') ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-has-media="1">Foto/Video ({{ $reviewAggregate['count_has_media'] ?? 0 }})</button>
                <div id="reviews-widget-keywords" class="flex flex-wrap gap-2 items-center"></div>
            </div>
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('reviews.detail.discover', $locationForLink) }}"
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
                    class="reviews-slider-track flex gap-3 overflow-x-auto overflow-y-hidden py-2 pl-3 pr-2 scroll-smooth snap-x snap-mandatory"
                    style="scrollbar-width: thin;">
                    @forelse($reviews as $review)
                    <div class="reviews-card reviews-card-clickable relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm pt-1 px-3 pb-3 border border-stone-100 flex flex-col justify-center min-h-[140px]" data-review-id="{{ $review->id }}">
                        {{-- Like button di pojok kanan atas, di luar anchor agar click tidak trigger navigasi --}}
                        <div class="absolute top-1.5 right-2.5 z-10">
                            <x-like-button :review="$review" />
                        </div>
                        <a href="{{ route('reviews.detail.discover', $locationForLink) }}?pin={{ $review->id }}" class="reviews-card-link block h-full min-h-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#674c1d]/40 focus:ring-offset-1">
                            <div class="reviews-card-inner h-[100%]">
                                <p
                                    class="text-amber-900 font-semibold uppercase text-[11px] mb-0.5 text-center min-h-[2rem] flex items-center justify-center leading-tight">
                                    {{ \App\Models\Review::locationDisplay($review->location) }}</p>
                                <p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">{{ $review->content }}
                                </p>
                                <div class="flex items-center gap-1 mb-0.5">
                                    @for ($i = 1; $i <= 5; $i++) <i
                                        class="fas fa-star {{ $i <= $review->rating ? 'text-[#674c1d]' : 'text-stone-200' }} text-xs">
                                        </i>
                                        @endfor
                                </div>
                                <div class="mt-0.5">
                                    <p class="text-stone-500 text-[11px] truncate">
                                        {{ ($review->hide_identity || empty($review->instagram)) ? 'Anonymous' : 'IG: @' . $review->instagram }} ·
                                        {{ $review->created_at->format('d M Y') }}</p>
                                </div>
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
                                @if($review->media->count() > 0)
                                <div class="reviews-card-media mt-2 flex flex-wrap gap-1">
                                    @foreach($review->media->where('type', 'image') as $m)
                                    @php $url = asset('storage/' . $m->file_path); @endphp
                                    <button type="button" class="review-widget-media-preview w-9 h-9 rounded border border-[#674c1d]/30 overflow-hidden flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="{{ $url }}" data-type="image" aria-label="Perbesar gambar">
                                        <img src="{{ $url }}" alt="" class="w-full h-full object-cover">
                                    </button>
                                    @endforeach
                                    @php $video = $review->media->where('type', 'video')->first(); @endphp
                                    @if($video)
                                    @php $videoUrl = asset('storage/' . $video->file_path); @endphp
                                    <button type="button" class="review-widget-media-preview relative w-9 h-9 rounded border border-[#674c1d]/30 overflow-hidden flex-shrink-0 bg-stone-100 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="{{ $videoUrl }}" data-type="video" aria-label="Putar video">
                                        <video src="{{ $videoUrl }}" class="w-full h-full object-cover pointer-events-none" preload="metadata" muted></video>
                                        <span class="absolute inset-0 flex items-center justify-center bg-black/30"><i class="fas fa-play text-white text-xs"></i></span>
                                    </button>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <span class="reviews-card-more absolute right-2 bottom-2 text-[10px] font-medium bg-gradient-to-r from-amber-600 to-[#674c1d] bg-clip-text text-transparent lg:hidden pointer-events-none">Lihat selengkapnya &gt;</span>
                        </a>
                    </div>
                    @empty
                    <p class="flex-shrink-0 text-center text-stone-500 py-4 w-full text-sm">Belum ada ulasan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Modal perbesar foto/video dari card ulasan (WHAT THEY SAY) --}}
    <div id="review-widget-media-overlay"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 opacity-0 pointer-events-none transition-opacity duration-300" aria-hidden="true">
        <div class="relative max-w-4xl max-h-[90vh] w-full flex items-center justify-center" onclick="event.stopPropagation()">
            <button type="button" id="review-widget-media-close"
                class="absolute -top-10 right-0 w-10 h-10 flex items-center justify-center rounded-full bg-white border-2 border-[#674c1d] text-[#674c1d] hover:bg-[#674c1d] hover:text-white transition-colors z-10" aria-label="Tutup">
                <i class="fas fa-times text-lg"></i>
            </button>
            <div id="review-widget-media-content"
                class="bg-white rounded-xl overflow-hidden shadow-xl border-2 border-[#674c1d]/30 max-w-full max-h-[85vh]"></div>
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
                        if (typeof window.refreshReviewsList === 'function') window.refreshReviewsList();
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

    // Reviews filter (no refresh) on discover pages — filter seperti detail (Semua, Foto/Video, Keyword, Search)
    var filterContainer = document.querySelector('#testimoni-section .reviews-widget-filter-container');
    var listEl = document.getElementById('reviews-list');
    var aggEl = document.getElementById('reviews-aggregate');
    var searchInput = document.getElementById('reviews-widget-search');
    var keywordsEl = document.getElementById('reviews-widget-keywords');
    if (filterContainer && listEl && aggEl) {
        var currentLocation = (filterContainer.getAttribute('data-current-location') || '').trim();
        function getParams() {
            var sort = 'latest', rating = '', hasMedia = '', keyword = '';
            var activeFilter = filterContainer.querySelector('.reviews-widget-filter-btn.reviews-widget-active:not(.reviews-widget-has-media):not(.reviews-widget-keyword-btn)');
            if (activeFilter) {
                sort = activeFilter.getAttribute('data-sort') || sort;
                rating = activeFilter.getAttribute('data-rating') || '';
            }
            if (filterContainer.querySelector('.reviews-widget-has-media.reviews-widget-active')) hasMedia = '1';
            var activeKw = filterContainer.querySelector('.reviews-widget-keyword-btn.reviews-widget-active');
            if (activeKw) keyword = activeKw.getAttribute('data-keyword') || '';
            var q = (searchInput && searchInput.value) ? searchInput.value.trim() : '';
            return { location: currentLocation, sort: sort, rating: rating, has_media: hasMedia, keyword: keyword, q: q };
        }
        function setActiveFilterBtn(btn) {
            filterContainer.querySelectorAll('.reviews-widget-filter-btn:not(.reviews-widget-has-media):not(.reviews-widget-keyword-btn)').forEach(function(b) {
                b.classList.remove('bg-amber-800', 'text-white', 'reviews-widget-active');
                b.classList.add('bg-stone-200', 'text-stone-700');
            });
            if (btn) {
                btn.classList.remove('bg-stone-200', 'text-stone-700');
                btn.classList.add('bg-amber-800', 'text-white', 'reviews-widget-active');
            }
        }
        function setActiveKeywordBtn(btn) {
            if (!keywordsEl) return;
            keywordsEl.querySelectorAll('.reviews-widget-keyword-btn').forEach(function(b) {
                b.classList.remove('bg-amber-800', 'text-white', 'reviews-widget-active');
                b.classList.add('bg-stone-200', 'text-stone-700');
            });
            if (btn) {
                btn.classList.remove('bg-stone-200', 'text-stone-700');
                btn.classList.add('bg-amber-800', 'text-white', 'reviews-widget-active');
            }
        }
        function setHasMediaActive(active) {
            var hasMediaBtn = filterContainer.querySelector('.reviews-widget-has-media');
            if (!hasMediaBtn) return;
            if (active) {
                hasMediaBtn.classList.remove('bg-stone-200', 'text-stone-700');
                hasMediaBtn.classList.add('bg-amber-800', 'text-white', 'reviews-widget-active');
            } else {
                hasMediaBtn.classList.remove('bg-amber-800', 'text-white', 'reviews-widget-active');
                hasMediaBtn.classList.add('bg-stone-200', 'text-stone-700');
            }
        }
        function clearHasMediaAndKeyword() {
            setHasMediaActive(false);
            setActiveKeywordBtn(null);
        }
        function loadKeywords() {
            var params = new URLSearchParams();
            if (currentLocation) params.set('location', currentLocation);
            fetch('/api/reviews/keywords?' + params.toString())
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (!keywordsEl || !data.keywords || data.keywords.length === 0) return;
                    keywordsEl.innerHTML = '';
                    data.keywords.forEach(function(kw) {
                        var btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'reviews-widget-filter-btn reviews-widget-keyword-btn px-3 py-1.5 rounded-lg text-sm bg-stone-200 text-stone-700 hover:bg-stone-300';
                        btn.setAttribute('data-keyword', kw.word);
                        btn.textContent = kw.word + ' (' + kw.count + ')';
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            var isActive = btn.classList.contains('reviews-widget-active');
                            setActiveKeywordBtn(isActive ? null : btn);
                            fetchReviews();
                        });
                        keywordsEl.appendChild(btn);
                    });
                });
        }
        function fetchReviews() {
            var p = getParams();
            var params = new URLSearchParams();
            if (p.location) params.set('location', p.location);
            params.set('sort', p.sort);
            if (p.rating) params.set('rating', p.rating);
            if (p.has_media) params.set('has_media', p.has_media);
            if (p.keyword) params.set('keyword', p.keyword);
            if (p.q) params.set('q', p.q);
            params.set('per_page', '50');
            if (window.closeReviewsReplyDropdown) window.closeReviewsReplyDropdown();
            listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Memuat...</p>';
            fetch('/api/reviews?' + params.toString(), { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    aggEl.querySelector('.text-2xl').textContent = Number(data.aggregate.avg).toFixed(1);
                    aggEl.querySelector('.text-xl').textContent = data.aggregate.count;
                    var hasMediaBtn = filterContainer.querySelector('.reviews-widget-has-media');
                    if (hasMediaBtn) hasMediaBtn.textContent = 'Foto/Video (' + (data.aggregate.count_has_media ?? 0) + ')';
                    if (!data.reviews || data.reviews.length === 0) {
                        listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Belum ada ulasan.</p>';
                    } else {
                        listEl.innerHTML = data.reviews.map(renderCard).join('');
                        if (window.initLikeStates) window.initLikeStates();
                    }
                    if (typeof updateReviewsSliderButtons === 'function') updateReviewsSliderButtons();
                })
                .catch(function() {
                    listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Gagal memuat ulasan.</p>';
                    if (typeof updateReviewsSliderButtons === 'function') updateReviewsSliderButtons();
                });
        }
        var searchDebounceTimer;
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchDebounceTimer);
                searchDebounceTimer = setTimeout(fetchReviews, 350);
            });
        }
        filterContainer.querySelectorAll('.reviews-widget-filter-btn:not(.reviews-widget-has-media):not(.reviews-widget-keyword-btn)').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (btn.getAttribute('data-filter-type') === 'all') clearHasMediaAndKeyword();
                setActiveFilterBtn(this);
                fetchReviews();
            });
        });
        var hasMediaBtn = filterContainer.querySelector('.reviews-widget-has-media');
        if (hasMediaBtn) {
            hasMediaBtn.addEventListener('click', function(e) {
                e.preventDefault();
                var isActive = this.classList.contains('reviews-widget-active');
                setHasMediaActive(!isActive);
                fetchReviews();
            });
        }
        loadKeywords();
        window.refreshReviewsList = fetchReviews;

        function mediaPreviewHtml(media) {
            if (!media || media.length === 0) return '';
            var parts = [];
            media.forEach(function(m) {
                var url = typeof m === 'object' ? (m.url || (m.file_path ? ('/storage/' + m.file_path) : '')) : m;
                var type = typeof m === 'object' && m.type === 'video' ? 'video' : 'image';
                if (!url) return;
                if (type === 'video') {
                    parts.push('<button type="button" class="review-widget-media-preview relative w-9 h-9 rounded border border-[#674c1d]/30 overflow-hidden flex-shrink-0 bg-stone-100 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="' + url + '" data-type="video" aria-label="Putar video"><video src="' + url + '" class="w-full h-full object-cover pointer-events-none" preload="metadata" muted></video><span class="absolute inset-0 flex items-center justify-center bg-black/30"><i class="fas fa-play text-white text-xs"></i></span></button>');
                } else {
                    parts.push('<button type="button" class="review-widget-media-preview w-9 h-9 rounded border border-[#674c1d]/30 overflow-hidden flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="' + url + '" data-type="image" aria-label="Perbesar gambar"><img src="' + url + '" alt="" class="w-full h-full object-cover"></button>');
                }
            });
            return parts.length ? '<div class="reviews-card-media mt-2 flex flex-wrap gap-1">' + parts.join('') + '</div>' : '';
        }
        function renderCard(r) {
            var identity = (r.hide_identity || !r.instagram) ? 'Anonymous' : ('IG: @' + r.instagram);
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
            var mediaHtml = mediaPreviewHtml(r.media);
            var baseUrl = (filterContainer && filterContainer.getAttribute('data-detail-url')) || '/reviews';
            var detailUrl = baseUrl + (baseUrl.indexOf('?') >= 0 ? '&' : '?') + 'pin=' + (r.id || '');
            var likesCount = r.likes_count ?? 0;
            var dataLiked = (r.user_has_liked ? 'true' : 'false');
            var likeBtnHtml = '<button type="button" class="like-btn inline-flex flex-col items-center gap-0.5 border-0 bg-transparent p-0" data-review-id="' + (r.id || '') + '" data-liked="' + dataLiked + '" style="cursor:pointer;outline:none" title="Like komentar ini"><svg class="like-icon not-liked" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#9e9e9e;transition:color 0.2s ease"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg><span class="like-count" style="font-size:11px;color:#666">' + likesCount + '</span></button>';
            var metaHtml = '<div class="mt-0.5"><p class="text-stone-500 text-[11px] truncate">' + identity + ' · ' + (r.created_at || '') + '</p></div>';
            return '<div class="reviews-card reviews-card-clickable relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm pt-1 px-3 pb-3 border border-stone-100 flex flex-col justify-center min-h-[140px]" data-review-id="' + (r.id || '') + '">' +
                '<div class="absolute top-1.5 right-2.5 z-10">' + likeBtnHtml + '</div>' +
                '<a href="' + detailUrl + '" class="reviews-card-link block h-full min-h-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#674c1d]/40 focus:ring-offset-1">' +
                '<div class="reviews-card-inner h-[100%]">' +
                '<p class="text-amber-900 font-semibold uppercase text-[11px] mb-0.5 text-center min-h-[2rem] flex items-center justify-center leading-tight">' +
                (r.location ? r.location.toUpperCase() : '') + '</p>' +
                '<p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">' + (r.content || '') +
                '</p>' +
                '<div class="flex items-center gap-1 mb-0.5">' + stars + '</div>' +
                metaHtml + repliesHtml + mediaHtml + '</div>' +
                '<span class="reviews-card-more absolute right-2 bottom-2 text-[10px] font-medium bg-gradient-to-r from-amber-600 to-[#674c1d] bg-clip-text text-transparent lg:hidden pointer-events-none">Lihat selengkapnya &gt;</span>' +
                '</a></div>';
        }

        var widgetOverlay = document.getElementById('review-widget-media-overlay');
        var widgetContent = document.getElementById('review-widget-media-content');
        var widgetClose = document.getElementById('review-widget-media-close');
        function openWidgetMedia(src, type) {
            if (!widgetContent || !widgetOverlay) return;
            widgetContent.innerHTML = '';
            if (type === 'video') {
                var v = document.createElement('video');
                v.src = src;
                v.controls = true;
                v.className = 'max-w-full max-h-[85vh]';
                v.preload = 'metadata';
                widgetContent.appendChild(v);
                widgetOverlay.classList.remove('opacity-0', 'pointer-events-none');
                widgetOverlay.classList.add('opacity-100', 'pointer-events-auto');
                widgetOverlay.setAttribute('aria-hidden', 'false');
                v.play();
            } else {
                var img = document.createElement('img');
                img.src = src;
                img.alt = '';
                img.className = 'max-w-full max-h-[85vh] object-contain';
                widgetContent.appendChild(img);
                widgetOverlay.classList.remove('opacity-0', 'pointer-events-none');
                widgetOverlay.classList.add('opacity-100', 'pointer-events-auto');
                widgetOverlay.setAttribute('aria-hidden', 'false');
            }
        }
        function closeWidgetMedia() {
            if (!widgetOverlay || !widgetContent) return;
            widgetOverlay.classList.add('opacity-0', 'pointer-events-none');
            widgetOverlay.classList.remove('opacity-100', 'pointer-events-auto');
            widgetOverlay.setAttribute('aria-hidden', 'true');
            var v = widgetContent.querySelector('video');
            if (v) v.pause();
            setTimeout(function() { widgetContent.innerHTML = ''; }, 300);
        }
        listEl.addEventListener('click', function(e) {
            var btn = e.target.closest('.review-widget-media-preview');
            if (btn) {
                e.preventDefault();
                e.stopPropagation();
                var container = btn.closest('.reviews-card') || btn.closest('[data-review-id]') || btn.parentElement;
                var allBtns = container ? container.querySelectorAll('.review-widget-media-preview') : [btn];
                var items = [], clickedIdx = 0;
                allBtns.forEach(function(b) {
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
                    openWidgetMedia(items[clickedIdx].src, items[clickedIdx].type);
                }
                return;
            }
            var replyToggle = e.target.closest('.review-reply-toggle');
            if (replyToggle) e.stopPropagation();
        });
        if (widgetOverlay) widgetOverlay.addEventListener('click', function(e) { if (e.target === widgetOverlay) closeWidgetMedia(); });
        if (widgetClose) widgetClose.addEventListener('click', closeWidgetMedia);
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
            var sl = sliderTrack.scrollLeft;
            var step = getCardWidth();
            var minScrollForLeft = 2 * step;
            if (tw <= cw + 2) {
                sliderPrev.style.setProperty('display', 'none');
                sliderNext.style.setProperty('display', 'none');
                sliderPrev.disabled = true;
                sliderNext.disabled = true;
            } else {
                sliderPrev.style.setProperty('display', sl >= minScrollForLeft ? 'flex' : 'none');
                sliderPrev.disabled = sl < minScrollForLeft;
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

/* WHAT THEY SAY card: hover (desktop only) + Lihat selengkapnya (tablet/mobile) */
.reviews-card-clickable .reviews-card-link {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
@media (min-width: 1024px) {
    .reviews-card-clickable:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(180, 140, 45, 0.2), 0 0 0 1px rgba(212, 168, 83, 0.4);
    }
    .reviews-card-clickable:hover .reviews-card-link {
        box-shadow: none;
    }
}
.reviews-card-more {
    display: none;
    pointer-events: none;
}
@media (max-width: 1023px) {
    .reviews-card-more {
        display: block;
        pointer-events: none;
    }
}
</style>