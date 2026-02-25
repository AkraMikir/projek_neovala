@extends('layouts.app')

@section('title', $currentLocation ? 'Ulasan ' . strtoupper($currentLocation) . ' - Neovala' : 'Semua Ulasan - Neovala')

@section('content')
<section class="py-12 px-4 bg-stone-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ $backUrl ?? route('home') }}" class="inline-flex items-center gap-2 text-[#674c1d] font-medium hover:underline">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <h1 class="text-2xl md:text-3xl font-bold text-[#674c1d] text-center mb-2">
            {{ $currentLocation ? 'Ulasan ' . strtoupper($currentLocation) : 'Semua Ulasan' }}
        </h1>
        <div class="border-b-2 border-[#674c1d] w-24 mx-auto mb-8"></div>

        <div id="reviews-detail-aggregate" class="flex flex-wrap items-center justify-center gap-6 mb-8">
            <div class="text-center px-4">
                <span class="text-3xl font-bold text-[#674c1d]">{{ number_format($aggregate['avg'] ?? 0, 1) }}</span>
                <p class="text-sm text-stone-600 mt-0.5">Rating rata-rata</p>
            </div>
            <div class="text-center px-4 border-l border-stone-300">
                <span class="text-2xl font-semibold text-[#674c1d]">{{ number_format($aggregate['count'] ?? 0) }}</span>
                <p class="text-sm text-stone-600 mt-0.5">Ulasan</p>
            </div>
        </div>

        <div class="reviews-detail-filter-container bg-white rounded-xl border border-stone-200 shadow-sm p-4 md:p-5 mb-8" data-current-location="{{ $currentLocation ?? '' }}">
            <div class="reviews-detail-filter flex flex-wrap gap-3 items-center" id="reviews-detail-filter-bar">
                {{-- Baris 1: Lokasi + Search --}}
                @if($locations !== null)
                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <label class="text-stone-600 text-sm font-medium shrink-0">Lokasi:</label>
                        <select id="reviews-detail-location" class="rounded-lg border border-[#674c1d]/40 px-3 py-2 text-sm text-[#674c1d] bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]">
                            <option value="">Semua</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>{{ strtoupper($loc) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="flex-1 min-w-[180px]">
                    <input type="text" id="reviews-detail-search" class="w-full rounded-lg border border-[#674c1d]/40 px-3 py-2 text-sm text-[#674c1d] placeholder-stone-400 bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]" placeholder="Cari dalam ulasan..." value="{{ request('q', '') }}" autocomplete="off">
                </div>
            </div>
            {{-- Mobile: satu dropdown filter (md:hidden) --}}
            <div class="mt-4 pt-4 border-t border-stone-200 md:hidden">
                <label for="reviews-detail-filter-dropdown" class="block text-stone-600 text-sm font-medium mb-2">Filter ulasan</label>
                <select id="reviews-detail-filter-dropdown" class="reviews-detail-filter-dropdown w-full rounded-lg border border-[#674c1d]/40 px-3 py-2.5 text-sm text-[#674c1d] bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]" aria-label="Filter ulasan">
                    <option value="all">Semua</option>
                    <option value="sort:latest">Terbaru</option>
                    <option value="sort:popular">Terpopuler</option>
                    <option value="sort:longest">Waktu terlama</option>
                    <option value="rating:5">5 Bintang</option>
                    <option value="rating:4">4 Bintang</option>
                    <option value="rating:3">3 Bintang</option>
                    <option value="rating:2">2 Bintang</option>
                    <option value="rating:1">1 Bintang</option>
                    <option value="has_media">Foto/Video ({{ $aggregate['count_has_media'] ?? 0 }})</option>
                    <optgroup label="Kata kunci" id="reviews-detail-filter-dropdown-keywords">
                        {{-- Option keyword diisi JS dari loadKeywords --}}
                    </optgroup>
                </select>
            </div>
            {{-- Desktop: baris tombol (hidden di mobile) --}}
            <div class="reviews-detail-filter-buttons mt-4 pt-4 border-t border-stone-200 hidden md:flex flex-wrap gap-3 justify-center md:justify-start items-center">
                <span class="text-stone-600 text-sm font-medium shrink-0">Filter:</span>
                @php
                    $isSemuaActive = !request('rating') && !request('has_media') && !request('keyword');
                    $isTerbaruActive = !$isSemuaActive && request('sort', 'latest') === 'latest' && !request('rating');
                @endphp
                <button type="button" class="reviews-detail-filter-btn px-3 py-1.5 rounded-lg text-sm {{ $isSemuaActive ? 'bg-[#674c1d] text-white reviews-detail-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="" data-filter-type="all">Semua</button>
                <button type="button" class="reviews-detail-filter-btn px-3 py-1.5 rounded-lg text-sm {{ $isTerbaruActive ? 'bg-[#674c1d] text-white reviews-detail-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="">Terbaru</button>
                <button type="button" class="reviews-detail-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('sort') === 'popular' ? 'bg-[#674c1d] text-white reviews-detail-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="popular" data-rating=""><i class="fas fa-thumbs-up text-xs mr-1"></i>Terpopuler</button>
                <button type="button" class="reviews-detail-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('sort') === 'longest' ? 'bg-[#674c1d] text-white reviews-detail-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="longest" data-rating="">Waktu terlama</button>
                @for ($r = 5; $r >= 1; $r--)
                    <button type="button" class="reviews-detail-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('rating') == $r ? 'bg-[#674c1d] text-white reviews-detail-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="{{ $r }}">{{ $r }} Bintang</button>
                @endfor
                <button type="button" class="reviews-detail-filter-btn reviews-detail-has-media px-3 py-1.5 rounded-lg text-sm {{ request('has_media') ? 'bg-[#674c1d] text-white reviews-detail-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-has-media="1">Foto/Video ({{ $aggregate['count_has_media'] ?? 0 }})</button>
                <div id="reviews-detail-keywords" class="flex flex-wrap gap-2 items-center">
                    {{-- Keyword buttons diisi oleh JS dari API --}}
                </div>
            </div>
        </div>

        <div id="reviews-detail-list" class="space-y-6">
            @forelse($reviews as $review)
                <article class="bg-white rounded-xl shadow-sm border border-stone-200 p-5">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="text-xs font-semibold text-[#674c1d] uppercase tracking-wide">{{ \App\Models\Review::locationDisplay($review->location) }}</span>
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-[#674c1d]' : 'text-stone-200' }}"></i>
                            @endfor
                        </div>
                        <span class="text-stone-500 text-sm">{{ ($review->hide_identity || empty($review->instagram)) ? 'Anonymous' : 'IG: @' . $review->instagram }}</span>
                        <span class="text-stone-400 text-xs">{{ $review->created_at->format('d M Y') }}</span>
                    </div>
                    @php
                        $contentSafe = e($review->content);
                        if (request('keyword') && strlen(request('keyword')) <= 100) {
                            $kw = preg_quote(request('keyword'), '/');
                            $contentSafe = preg_replace('/(' . $kw . ')/iu', '<mark class="bg-amber-200/90 text-stone-900 font-semibold rounded px-0.5">$1</mark>', $contentSafe);
                        }
                    @endphp
                    <p class="text-stone-800 text-sm leading-relaxed whitespace-pre-wrap">{!! $contentSafe !!}</p>
                    @if($review->media->count() > 0)
                        @php
                            $images = $review->media->where('type', 'image');
                            $video = $review->media->where('type', 'video')->first();
                        @endphp
                        <div class="mt-4 flex flex-wrap gap-2 items-start">
                            @foreach($images as $m)
                                @php $url = asset('storage/' . $m->file_path); @endphp
                                <button type="button" class="review-media-preview block w-20 h-20 sm:w-24 sm:h-24 rounded-lg border border-[#674c1d]/30 overflow-hidden flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="{{ $url }}" data-type="image" aria-label="Perbesar gambar">
                                    <img src="{{ $url }}" alt="" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                            @if($video)
                                @php $videoUrl = asset('storage/' . $video->file_path); @endphp
                                <button type="button" class="review-media-preview relative block w-32 h-24 sm:w-40 sm:h-28 rounded-lg border border-[#674c1d]/30 overflow-hidden bg-stone-100 flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="{{ $videoUrl }}" data-type="video" aria-label="Putar video">
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
                    <div class="flex items-center justify-end mt-3 pt-3 border-t border-stone-100">
                        <button type="button"
                            class="review-like-btn flex items-center gap-1.5 text-xs text-stone-400 hover:text-[#674c1d] transition-colors focus:outline-none"
                            data-review-id="{{ $review->id }}"
                            title="Suka ulasan ini">
                            <i class="fas fa-thumbs-up text-sm"></i>
                            <span class="review-like-count">{{ $review->likes ?? 0 }}</span>
                        </button>
                    </div>
                </article>
            @empty
                <p class="text-center text-stone-500 py-12">Belum ada ulasan.</p>
            @endforelse
        </div>

        <div id="reviews-detail-pagination" class="mt-8">
            @if($reviews->hasPages())
                {{ $reviews->withQueryString()->links('user.reviews.pagination') }}
            @endif
        </div>
    </div>
</section>

{{-- Modal media (foto/video) dengan fade --}}
<div id="review-media-overlay" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 opacity-0 pointer-events-none transition-opacity duration-300" aria-hidden="true">
    <div class="relative max-w-4xl max-h-[90vh] w-full flex items-center justify-center" onclick="event.stopPropagation()">
        <button type="button" id="review-media-close" class="absolute -top-10 right-0 w-10 h-10 flex items-center justify-center rounded-full bg-white border-2 border-[#674c1d] text-[#674c1d] hover:bg-[#674c1d] hover:text-white transition-colors z-10" aria-label="Tutup">
            <i class="fas fa-times text-lg"></i>
        </button>
        <div id="review-media-content" class="bg-white rounded-xl overflow-hidden shadow-xl border-2 border-[#674c1d]/30 max-w-full max-h-[85vh]"></div>
    </div>
</div>

@push('styles')
<style>
    .reviews-detail-pagination-simple { margin-top: 0; }
    .reviews-detail-page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.25rem;
        height: 2.25rem;
        padding: 0 0.5rem;
        border: 1px solid #674c1d;
        background: #fff;
        color: #674c1d;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .reviews-detail-page-btn:hover { background: #674c1d; color: #fff; }
    .reviews-detail-page-btn--active {
        background: #674c1d;
        color: #fff;
        border-color: #674c1d;
        cursor: default;
    }
    .reviews-detail-page-btn--disabled {
        background: #f5f5f4;
        color: #a8a29e;
        border-color: #d6d3d1;
        cursor: default;
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var listEl = document.getElementById('reviews-detail-list');
    var aggEl = document.getElementById('reviews-detail-aggregate');
    var paginationEl = document.getElementById('reviews-detail-pagination');
    var filterContainer = document.querySelector('.reviews-detail-filter-container');
    var locationSelect = document.getElementById('reviews-detail-location');
    var searchInput = document.getElementById('reviews-detail-search');
    var keywordsEl = document.getElementById('reviews-detail-keywords');
    if (!listEl || !aggEl || !filterContainer) return;

    var currentLocation = (filterContainer.getAttribute('data-current-location') || '').trim();
    var isDiscover = currentLocation.length > 0;
    var currentPage = 1;

    var hadPinOnLoad = false;
    (function initPinFromUrl() {
        var params = new URLSearchParams(window.location.search);
        var pinId = params.get('pin');
        if (pinId) {
            hadPinOnLoad = true;
            try { sessionStorage.setItem('review_pin_id', pinId); } catch (e) {}
        } else {
            try { sessionStorage.removeItem('review_pin_id'); } catch (e) {}
        }
    })();
    window.addEventListener('pagehide', function() {
        try { sessionStorage.removeItem('review_pin_id'); } catch (e) {}
    });
    window.addEventListener('beforeunload', function() {
        try { sessionStorage.removeItem('review_pin_id'); } catch (e) {}
    });

    function getParams() {
        var location = isDiscover ? currentLocation : (locationSelect ? locationSelect.value : '');
        var sort = 'latest';
        var rating = '';
        var hasMedia = '';
        var keyword = '';
        var activeFilter = filterContainer.querySelector('.reviews-detail-filter-btn.reviews-detail-active:not(.reviews-detail-has-media):not(.reviews-detail-keyword-btn)');
        if (activeFilter) {
            sort = activeFilter.getAttribute('data-sort') || sort;
            rating = activeFilter.getAttribute('data-rating') || '';
        }
        if (filterContainer.querySelector('.reviews-detail-has-media.reviews-detail-active')) hasMedia = '1';
        var activeKw = filterContainer.querySelector('.reviews-detail-keyword-btn.reviews-detail-active');
        if (activeKw) keyword = activeKw.getAttribute('data-keyword') || '';
        var q = (searchInput && searchInput.value) ? searchInput.value.trim() : '';
        return { location: location, sort: sort, rating: rating, has_media: hasMedia, keyword: keyword, q: q, page: currentPage };
    }

    function renderPaginationHtml(pag) {
        if (!pag || pag.last_page <= 1) return '';
        var first = (pag.current_page - 1) * pag.per_page + 1;
        var last = Math.min(pag.current_page * pag.per_page, pag.total);
        var html = '<div class="reviews-detail-pagination-simple">';
        html += '<p class="text-sm text-stone-500 mb-3 text-center">Menampilkan <span class="font-medium text-[#674c1d]">' + first + '</span>&ndash;<span class="font-medium text-[#674c1d]">' + last + '</span> dari <span class="font-medium text-[#674c1d]">' + pag.total + '</span> ulasan</p>';
        html += '<nav class="flex flex-wrap justify-center items-center gap-2" aria-label="Navigasi halaman">';
        if (pag.current_page <= 1) {
            html += '<span class="reviews-detail-page-btn reviews-detail-page-btn--disabled" aria-disabled="true">&lsaquo;</span>';
        } else {
            html += '<button type="button" class="reviews-detail-page-btn" data-page="' + (pag.current_page - 1) + '" aria-label="Sebelumnya">&lsaquo;</button>';
        }
        var start = Math.max(1, pag.current_page - 2);
        var end = Math.min(pag.last_page, pag.current_page + 2);
        for (var i = start; i <= end; i++) {
            if (i === pag.current_page) {
                html += '<span class="reviews-detail-page-btn reviews-detail-page-btn--active" aria-current="page">' + i + '</span>';
            } else {
                html += '<button type="button" class="reviews-detail-page-btn" data-page="' + i + '" aria-label="Halaman ' + i + '">' + i + '</button>';
            }
        }
        if (pag.current_page >= pag.last_page) {
            html += '<span class="reviews-detail-page-btn reviews-detail-page-btn--disabled" aria-disabled="true">&rsaquo;</span>';
        } else {
            html += '<button type="button" class="reviews-detail-page-btn" data-page="' + (pag.current_page + 1) + '" aria-label="Selanjutnya">&rsaquo;</button>';
        }
        html += '</nav></div>';
        return html;
    }

    function setActiveFilterBtn(btn) {
        filterContainer.querySelectorAll('.reviews-detail-filter-btn:not(.reviews-detail-has-media):not(.reviews-detail-keyword-btn)').forEach(function(b) {
            b.classList.remove('bg-[#674c1d]', 'text-white', 'reviews-detail-active');
            b.classList.add('bg-stone-200', 'text-stone-700');
        });
        if (btn) {
            btn.classList.remove('bg-stone-200', 'text-stone-700');
            btn.classList.add('bg-[#674c1d]', 'text-white', 'reviews-detail-active');
        }
    }
    function setActiveKeywordBtn(btn) {
        if (!keywordsEl) return;
        keywordsEl.querySelectorAll('.reviews-detail-keyword-btn').forEach(function(b) {
            b.classList.remove('bg-[#674c1d]', 'text-white', 'reviews-detail-active');
            b.classList.add('bg-stone-200', 'text-stone-700');
        });
        if (btn) {
            btn.classList.remove('bg-stone-200', 'text-stone-700');
            btn.classList.add('bg-[#674c1d]', 'text-white', 'reviews-detail-active');
        }
    }
    function setHasMediaActive(active) {
        var hasMediaBtn = filterContainer.querySelector('.reviews-detail-has-media');
        if (!hasMediaBtn) return;
        if (active) {
            hasMediaBtn.classList.remove('bg-stone-200', 'text-stone-700');
            hasMediaBtn.classList.add('bg-[#674c1d]', 'text-white', 'reviews-detail-active');
        } else {
            hasMediaBtn.classList.remove('bg-[#674c1d]', 'text-white', 'reviews-detail-active');
            hasMediaBtn.classList.add('bg-stone-200', 'text-stone-700');
        }
    }
    function clearHasMediaAndKeyword() {
        setHasMediaActive(false);
        setActiveKeywordBtn(null);
    }

    var filterDropdown = document.getElementById('reviews-detail-filter-dropdown');
    var filterDropdownKeywords = document.getElementById('reviews-detail-filter-dropdown-keywords');
    function getCurrentDropdownValue() {
        if (filterContainer.querySelector('.reviews-detail-has-media.reviews-detail-active')) return 'has_media';
        var activeKw = filterContainer.querySelector('.reviews-detail-keyword-btn.reviews-detail-active');
        if (activeKw) return 'kw:' + (activeKw.getAttribute('data-keyword') || '');
        var activeFilter = filterContainer.querySelector('.reviews-detail-filter-btn.reviews-detail-active:not(.reviews-detail-has-media):not(.reviews-detail-keyword-btn)');
        if (!activeFilter) return 'all';
        if (activeFilter.getAttribute('data-filter-type') === 'all') return 'all';
        if (activeFilter.getAttribute('data-sort') === 'popular') return 'sort:popular';
        if (activeFilter.getAttribute('data-sort') === 'longest') return 'sort:longest';
        var rating = activeFilter.getAttribute('data-rating');
        if (rating) return 'rating:' + rating;
        return 'sort:latest';
    }
    function syncDropdownFromButtons() {
        if (!filterDropdown) return;
        var v = getCurrentDropdownValue();
        for (var i = 0; i < filterDropdown.options.length; i++) {
            if (filterDropdown.options[i].value === v) { filterDropdown.value = v; return; }
        }
    }
    function applyDropdownSelection(value) {
        if (!value) return;
        currentPage = 1;
        if (value === 'all') {
            clearHasMediaAndKeyword();
            var btn = filterContainer.querySelector('.reviews-detail-filter-btn[data-filter-type="all"]');
            if (btn) { setActiveFilterBtn(btn); fetchReviews(); }
            return;
        }
        if (value === 'sort:latest') {
            var terbaru = filterContainer.querySelector('.reviews-detail-filter-btn[data-sort="latest"][data-rating=""]:not([data-filter-type="all"])');
            if (terbaru) { terbaru.click(); return; }
        }
        if (value === 'sort:popular') {
            var popular = filterContainer.querySelector('.reviews-detail-filter-btn[data-sort="popular"]');
            if (popular) { popular.click(); return; }
        }
        if (value === 'sort:longest') {
            var longest = filterContainer.querySelector('.reviews-detail-filter-btn[data-sort="longest"]');
            if (longest) { longest.click(); return; }
        }
        if (value.indexOf('rating:') === 0) {
            var r = value.slice(7);
            var ratingBtn = filterContainer.querySelector('.reviews-detail-filter-btn[data-rating="' + r + '"]');
            if (ratingBtn) { ratingBtn.click(); return; }
        }
        if (value === 'has_media') {
            setHasMediaActive(true);
            fetchReviews();
            return;
        }
        if (value.indexOf('kw:') === 0) {
            var word = value.slice(3);
            var kwBtn = filterContainer.querySelector('.reviews-detail-keyword-btn[data-keyword="' + word.replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '"]');
            if (kwBtn) { setActiveKeywordBtn(kwBtn); fetchReviews(); }
        }
    }

    function renderCard(r) {
        var identity = (r.hide_identity || !r.instagram) ? 'Anonymous' : ('IG: @' + r.instagram);
        var stars = '';
        for (var i = 1; i <= 5; i++) {
            stars += '<i class="fas fa-star text-sm ' + (i <= r.rating ? 'text-[#674c1d]' : 'text-stone-200') + '"></i>';
        }
        var mediaHtml = '';
        if (r.media && r.media.length) {
            var imgs = r.media.filter(function(m) { return typeof m === 'object' ? m.type === 'image' : true; });
            var vid = r.media.filter(function(m) { return typeof m === 'object' && m.type === 'video'; })[0];
            var imgUrls = imgs.map(function(m) { return typeof m === 'object' ? (m.url || (m.file_path ? ('/storage/' + m.file_path) : '')) : m; });
            var parts = [];
            imgUrls.forEach(function(url) {
                parts.push('<button type="button" class="review-media-preview block w-20 h-20 sm:w-24 sm:h-24 rounded-lg border border-[#674c1d]/30 overflow-hidden flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="' + url + '" data-type="image" aria-label="Perbesar gambar"><img src="' + url + '" alt="" class="w-full h-full object-cover"></button>');
            });
            if (vid && (vid.url || vid.file_path)) {
                var videoSrc = vid.url || (vid.file_path ? ('/storage/' + vid.file_path) : '');
                if (videoSrc) parts.push('<button type="button" class="review-media-preview relative block w-32 h-24 sm:w-40 sm:h-28 rounded-lg border border-[#674c1d]/30 overflow-hidden bg-stone-100 flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="' + videoSrc + '" data-type="video" aria-label="Putar video"><video src="' + videoSrc + '" class="w-full h-full object-cover pointer-events-none" preload="metadata" muted></video><span class="absolute inset-0 flex items-center justify-center bg-black/20"><i class="fas fa-play text-white text-2xl"></i></span></button>');
            }
            if (parts.length) mediaHtml = '<div class="mt-4 flex flex-wrap gap-2 items-start">' + parts.join('') + '</div>';
        }
        var repliesHtml = '';
        if (r.replies && r.replies.length) {
            repliesHtml = r.replies.map(function(rep) {
                return '<div class="mt-4 pl-4 py-2 border-l-2 border-[#674c1d]/40 bg-stone-100 rounded-r-lg"><p class="text-xs font-semibold text-[#674c1d]">' + (rep.admin_name || 'Admin') + '</p><p class="text-sm text-stone-700 mt-0.5">' + (rep.content || '') + '</p><p class="text-xs text-stone-500 mt-1">' + (rep.created_at || '') + '</p></div>';
            }).join('');
        }
        var likeHtml = '<div class="flex items-center justify-end mt-3 pt-3 border-t border-stone-100">' +
            '<button type="button" class="review-like-btn flex items-center gap-1.5 text-xs text-stone-400 hover:text-[#674c1d] transition-colors focus:outline-none" data-review-id="' + r.id + '" title="Suka ulasan ini">' +
            '<i class="fas fa-thumbs-up text-sm"></i>' +
            '<span class="review-like-count">' + (r.likes || 0) + '</span></button></div>';
        return '<article class="bg-white rounded-xl shadow-sm border border-stone-200 p-5">' +
            '<div class="flex flex-wrap items-center gap-2 mb-2">' +
            '<span class="text-xs font-semibold text-[#674c1d] uppercase tracking-wide">' + (r.location || '').toUpperCase() + '</span>' +
            '<div class="flex items-center gap-1">' + stars + '</div>' +
            '<span class="text-stone-500 text-sm">' + identity + '</span>' +
            '<span class="text-stone-400 text-xs">' + (r.created_at || '') + '</span></div>' +
            '<p class="text-stone-800 text-sm leading-relaxed whitespace-pre-wrap">' + (r.content || '') + '</p>' +
            mediaHtml + repliesHtml + likeHtml + '</article>';
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
        params.set('page', p.page);
        params.set('per_page', '12');

        listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Memuat...</p>';
        if (paginationEl) paginationEl.innerHTML = '';

        fetch('/api/reviews?' + params.toString())
            .then(function(res) { return res.json(); })
            .then(function(data) {
                aggEl.querySelector('.text-3xl').textContent = Number(data.aggregate.avg).toFixed(1);
                aggEl.querySelector('.text-2xl').textContent = data.aggregate.count;
                var hasMediaBtn = filterContainer.querySelector('.reviews-detail-has-media');
                var mediaCount = data.aggregate.count_has_media ?? 0;
                if (hasMediaBtn) hasMediaBtn.textContent = 'Foto/Video (' + mediaCount + ')';
                var hasMediaOpt = filterDropdown && filterDropdown.querySelector('option[value="has_media"]');
                if (hasMediaOpt) hasMediaOpt.textContent = 'Foto/Video (' + mediaCount + ')';
                if (!data.reviews || data.reviews.length === 0) {
                    listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Belum ada ulasan.</p>';
                } else {
                    var reviewsToRender = data.reviews;
                    var isFilterSemua = !p.rating && !p.has_media && !p.keyword;
                    var pinId = null;
                    try { pinId = sessionStorage.getItem('review_pin_id'); } catch (e) {}
                    if (isFilterSemua && pinId) {
                        var pinItem = data.reviews.filter(function(r) { return String(r.id) === String(pinId); })[0];
                        if (pinItem) {
                            reviewsToRender = [pinItem].concat(data.reviews.filter(function(r) { return String(r.id) !== String(pinId); }));
                        }
                    }
                    listEl.innerHTML = reviewsToRender.map(function(r) { return renderCard(r, p.keyword); }).join('');
                }
                if (data.pagination && paginationEl) {
                    paginationEl.innerHTML = renderPaginationHtml(data.pagination);
                }
            })
            .catch(function() {
                listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Gagal memuat ulasan.</p>';
            });
    }

    function loadKeywords() {
        var location = isDiscover ? currentLocation : (locationSelect ? locationSelect.value : '');
        var params = new URLSearchParams();
        if (location) params.set('location', location);
        fetch('/api/reviews/keywords?' + params.toString())
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (!keywordsEl || !data.keywords || data.keywords.length === 0) {
                    if (filterDropdownKeywords) filterDropdownKeywords.innerHTML = '';
                    return;
                }
                keywordsEl.innerHTML = '';
                if (filterDropdownKeywords) {
                    filterDropdownKeywords.innerHTML = '';
                    data.keywords.forEach(function(kw) {
                        var opt = document.createElement('option');
                        opt.value = 'kw:' + kw.word;
                        opt.textContent = kw.word + ' (' + kw.count + ')';
                        filterDropdownKeywords.appendChild(opt);
                    });
                }
                data.keywords.forEach(function(kw) {
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'reviews-detail-filter-btn reviews-detail-keyword-btn px-3 py-1.5 rounded-lg text-sm bg-stone-200 text-stone-700 hover:bg-stone-300';
                    btn.setAttribute('data-keyword', kw.word);
                    btn.textContent = kw.word + ' (' + kw.count + ')';
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        currentPage = 1;
                        var isActive = btn.classList.contains('reviews-detail-active');
                        setActiveKeywordBtn(isActive ? null : btn);
                        fetchReviews();
                    });
                    keywordsEl.appendChild(btn);
                });
                syncDropdownFromButtons();
            });
    }

    var searchDebounceTimer;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(fetchReviews, 350);
        });
    }

    filterContainer.querySelectorAll('.reviews-detail-filter-btn:not(.reviews-detail-has-media):not(.reviews-detail-keyword-btn)').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (btn.getAttribute('data-filter-type') === 'all') {
                clearHasMediaAndKeyword();
            }
            setActiveFilterBtn(this);
            fetchReviews();
        });
    });
    var hasMediaBtn = filterContainer.querySelector('.reviews-detail-has-media');
    if (hasMediaBtn) {
        hasMediaBtn.addEventListener('click', function(e) {
            e.preventDefault();
            var isActive = this.classList.contains('reviews-detail-active');
            setHasMediaActive(!isActive);
            fetchReviews();
        });
    }
    if (locationSelect) {
        locationSelect.addEventListener('change', function() { loadKeywords(); fetchReviews(); });
    }

    if (filterDropdown) {
        syncDropdownFromButtons();
        filterDropdown.addEventListener('change', function() {
            applyDropdownSelection(filterDropdown.value);
        });
    }

    loadKeywords();

    // Utama dengan ?pin=: fetch sekali agar list + pin di atas. Apartment (discover): fetch sekali agar list + pagination dari API tampil konsisten.
    if (hadPinOnLoad || isDiscover) {
        fetchReviews();
    }

    // Media popup (fade in/out)
    var overlay = document.getElementById('review-media-overlay');
    var contentBox = document.getElementById('review-media-content');
    var closeBtn = document.getElementById('review-media-close');
    function openMedia(src, type) {
        contentBox.innerHTML = '';
        if (type === 'video') {
            var v = document.createElement('video');
            v.src = src;
            v.controls = true;
            v.className = 'max-w-full max-h-[85vh]';
            v.preload = 'metadata';
            contentBox.appendChild(v);
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
            overlay.setAttribute('aria-hidden', 'false');
            v.play();
        } else {
            var img = document.createElement('img');
            img.src = src;
            img.alt = '';
            img.className = 'max-w-full max-h-[85vh] object-contain';
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
        setTimeout(function() {
            contentBox.innerHTML = '';
        }, 300);
    }
    if (listEl) {
        listEl.addEventListener('click', function(e) {
            var btn = e.target.closest('.review-media-preview');
            if (!btn) return;
            e.preventDefault();
            e.stopPropagation();
            var container = btn.closest('article') || btn.parentElement;
            var allBtns = container ? container.querySelectorAll('.review-media-preview') : [btn];
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
                openMedia(items[clickedIdx].src, items[clickedIdx].type);
            }
        });
    }
});
</script>
@endpush
@endsection
