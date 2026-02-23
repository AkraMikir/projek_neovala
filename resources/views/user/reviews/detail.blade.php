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

        <div class="reviews-detail-filter flex flex-wrap gap-3 justify-center items-center mb-8" data-current-location="{{ $currentLocation ?? '' }}">
            @if($locations !== null)
                <div class="flex items-center gap-2">
                    <label class="text-stone-600 text-sm font-medium">Lokasi:</label>
                    <select id="reviews-detail-location" class="rounded-lg border border-[#674c1d]/40 px-3 py-2 text-sm text-[#674c1d] bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]">
                        <option value="">Semua</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>{{ strtoupper($loc) }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <span class="text-stone-600 text-sm">Filter:</span>
            <button type="button" class="reviews-detail-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('sort', 'latest') === 'latest' && !request('rating') ? 'bg-[#674c1d] text-white' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="">Terbaru</button>
            <button type="button" class="reviews-detail-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('sort') === 'longest' ? 'bg-[#674c1d] text-white' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="longest" data-rating="">Waktu terlama</button>
            @for ($r = 5; $r >= 1; $r--)
                <button type="button" class="reviews-detail-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('rating') == $r ? 'bg-[#674c1d] text-white' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="{{ $r }}">{{ $r }} Bintang</button>
            @endfor
        </div>

        <div id="reviews-detail-list" class="space-y-6">
            @forelse($reviews as $review)
                <article class="bg-white rounded-xl shadow-sm border border-stone-200 p-5">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="text-xs font-semibold text-[#674c1d] uppercase tracking-wide">{{ $review->location }}</span>
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-[#674c1d]' : 'text-stone-200' }}"></i>
                            @endfor
                        </div>
                        <span class="text-stone-500 text-sm">{{ $review->hide_identity ? 'Anonymous' : '@' . ($review->instagram ?? '-') }}</span>
                        <span class="text-stone-400 text-xs">{{ $review->created_at->format('d M Y') }}</span>
                    </div>
                    <p class="text-stone-800 text-sm leading-relaxed whitespace-pre-wrap">{{ $review->content }}</p>
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
    var filterBar = document.querySelector('.reviews-detail-filter');
    var locationSelect = document.getElementById('reviews-detail-location');
    if (!listEl || !aggEl || !filterBar) return;

    var currentLocation = (filterBar.getAttribute('data-current-location') || '').trim();
    var isDiscover = currentLocation.length > 0;

    function getParams() {
        var location = isDiscover ? currentLocation : (locationSelect ? locationSelect.value : '');
        var sort = 'latest';
        var rating = '';
        var page = 1;
        filterBar.querySelectorAll('.reviews-detail-filter-btn').forEach(function(btn) {
            if (btn.classList.contains('bg-[#674c1d]')) {
                sort = btn.getAttribute('data-sort') || sort;
                rating = btn.getAttribute('data-rating') || '';
            }
        });
        return { location: location, sort: sort, rating: rating, page: page };
    }

    function setActiveBtn(btn) {
        filterBar.querySelectorAll('.reviews-detail-filter-btn').forEach(function(b) {
            b.classList.remove('bg-[#674c1d]', 'text-white');
            b.classList.add('bg-stone-200', 'text-stone-700');
        });
        if (btn) {
            btn.classList.remove('bg-stone-200', 'text-stone-700');
            btn.classList.add('bg-[#674c1d]', 'text-white');
        }
    }

    function renderCard(r) {
        var identity = r.hide_identity ? 'Anonymous' : ('@' + (r.instagram || '-'));
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
        return '<article class="bg-white rounded-xl shadow-sm border border-stone-200 p-5">' +
            '<div class="flex flex-wrap items-center gap-2 mb-2">' +
            '<span class="text-xs font-semibold text-[#674c1d] uppercase tracking-wide">' + (r.location || '').toUpperCase() + '</span>' +
            '<div class="flex items-center gap-1">' + stars + '</div>' +
            '<span class="text-stone-500 text-sm">' + identity + '</span>' +
            '<span class="text-stone-400 text-xs">' + (r.created_at || '') + '</span></div>' +
            '<p class="text-stone-800 text-sm leading-relaxed whitespace-pre-wrap">' + (r.content || '') + '</p>' +
            mediaHtml + repliesHtml + '</article>';
    }

    function fetchReviews() {
        var p = getParams();
        var params = new URLSearchParams();
        if (p.location) params.set('location', p.location);
        params.set('sort', p.sort);
        if (p.rating) params.set('rating', p.rating);
        params.set('page', p.page);
        params.set('per_page', '12');

        listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Memuat...</p>';
        if (paginationEl) paginationEl.innerHTML = '';

        fetch('/api/reviews?' + params.toString())
            .then(function(res) { return res.json(); })
            .then(function(data) {
                aggEl.querySelector('.text-3xl').textContent = Number(data.aggregate.avg).toFixed(1);
                aggEl.querySelector('.text-2xl').textContent = data.aggregate.count;
                if (!data.reviews || data.reviews.length === 0) {
                    listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Belum ada ulasan.</p>';
                } else {
                    listEl.innerHTML = data.reviews.map(renderCard).join('');
                }
                if (data.pagination && paginationEl) {
                    // Optional: render pagination from data.pagination
                }
            })
            .catch(function() {
                listEl.innerHTML = '<p class="text-center text-stone-500 py-12">Gagal memuat ulasan.</p>';
            });
    }

    filterBar.querySelectorAll('.reviews-detail-filter-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            setActiveBtn(this);
            fetchReviews();
        });
    });
    if (locationSelect) {
        locationSelect.addEventListener('change', fetchReviews);
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
            var src = btn.getAttribute('data-src');
            var type = btn.getAttribute('data-type') || 'image';
            if (src) openMedia(src, type);
        });
    }
    if (overlay) {
        overlay.addEventListener('click', function(e) { if (e.target === overlay) closeMedia(); });
    }
    if (closeBtn) closeBtn.addEventListener('click', closeMedia);
});
</script>
@endpush
@endsection
