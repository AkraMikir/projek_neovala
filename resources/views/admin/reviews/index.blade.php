<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reviews - Neovala Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/reviews.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="main-wrapper">
        <div class="main-content reviews-page">
            <header class="page-header">
                <div>
                    <h1>Reviews</h1>
                    <p class="subtitle">Kelola semua ulasan (unified)</p>
                </div>
                <a href="{{ route('admin.dashboard1.reviews.create') }}" class="btn-review-add">
                    <i class="fas fa-plus"></i> Tambah Review
                </a>
            </header>

            @if(session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
            @endif

            @php $aggregate = $aggregate ?? ['avg' => 0, 'count' => 0]; @endphp
            <div class="reviews-filter">
                <form method="GET" id="adminReviewsFilterForm">
                    <div class="filter-group">
                        <label for="filter-location">Lokasi</label>
                        <select name="location" id="filter-location">
                            <option value="">Semua</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>{{ strtoupper($loc) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="filter-status">Status</label>
                        <select name="status" id="filter-status">
                            <option value="">Semua</option>
                            <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="filter-rating">Bintang</label>
                        <select name="rating" id="filter-rating">
                            <option value="">Semua</option>
                            @for($r = 5; $r >= 1; $r--)
                                <option value="{{ $r }}" {{ request('rating') === (string)$r ? 'selected' : '' }}>{{ $r }} Bintang</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn-filter" id="adminReviewsFilterBtn">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>
                <div class="reviews-aggregate-inline">
                    <div class="reviews-aggregate-item">
                        <span id="adminReviewsAvg" class="reviews-aggregate-value">{{ number_format($aggregate['avg'], 1) }}</span>
                        <span class="reviews-aggregate-label">Rating rata-rata</span>
                    </div>
                    <div class="reviews-aggregate-item reviews-aggregate-divider">
                        <span id="adminReviewsCount" class="reviews-aggregate-value">{{ number_format($aggregate['count']) }}</span>
                        <span class="reviews-aggregate-label">Total ulasan</span>
                    </div>
                </div>
            </div>

            <div id="adminReviewsList" class="space-y-4">
                @forelse($reviews as $review)
                    <div class="bg-white rounded-lg shadow border border-stone-200 p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <span class="text-xs font-semibold text-amber-800 uppercase">{{ strtoupper(\App\Models\Review::locationDisplay($review->location)) }}</span>
                                <span class="text-xs text-stone-500 ml-2">{{ $review->user_source }}</span>
                                @if($review->is_featured)
                                    <span class="text-xs bg-amber-100 text-amber-800 px-2 py-0.5 rounded ml-2">Featured</span>
                                @endif
                                <p class="mt-1 text-stone-800">{{ Str::limit($review->content, 150) }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-amber-500' : 'text-stone-300' }}"></i>
                                    @endfor
                                    <span class="text-stone-500 text-sm">{{ $review->hide_identity ? 'Anonymous' : '@' . ($review->instagram ?? '-') }}</span>
                                    <span class="text-stone-400 text-xs">{{ $review->created_at->format('d M Y') }}</span>
                                    <span class="text-xs px-2 py-0.5 rounded {{ $review->status === 'accepted' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">{{ $review->status }}</span>
                                </div>
                                @if($review->media->count() > 0)
                                    <div class="flex gap-1 mt-2">
                                        @foreach($review->media->take(3) as $m)
                                            @if($m->type === 'image')
                                                <img src="{{ asset('storage/' . $m->file_path) }}" alt="" class="w-12 h-12 object-cover rounded">
                                            @else
                                                <span class="text-xs text-stone-500">Video</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                @foreach($review->replies as $reply)
                                    <div class="mt-2 pl-4 border-l-2 border-amber-200">
                                        <p class="text-xs font-medium text-amber-900">{{ $reply->admin->name ?? 'Admin' }}</p>
                                        <p class="text-sm text-stone-600">{{ $reply->content }}</p>
                                        <p class="text-xs text-stone-400">{{ $reply->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                @endforeach
                                <form action="{{ route('admin.dashboard1.reviews.replies.store', $review) }}" method="POST" class="mt-3 flex gap-2">
                                    @csrf
                                    <input type="text" name="content" placeholder="Balas review..." class="flex-1 rounded border border-stone-300 px-3 py-2 text-sm" required>
                                    <button type="submit" class="btn btn-primary py-2">Balas</button>
                                </form>
                            </div>
                            <div class="flex gap-2 ml-4">
                                <a href="{{ route('admin.dashboard1.reviews.edit', $review) }}" class="px-3 py-1.5 rounded bg-amber-100 text-amber-800 text-sm font-medium">Edit</a>
                                <form action="{{ route('admin.dashboard1.reviews.destroy', $review) }}" method="POST" class="inline" onsubmit="return confirm('Hapus review ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded bg-red-100 text-red-800 text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-stone-500 py-8">Belum ada review.</p>
                @endforelse
            </div>

            <div id="adminReviewsPagination" class="mt-6">
                @if($reviews->hasPages())
                    {{ $reviews->withQueryString()->links() }}
                @endif
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('adminReviewsFilterForm');
        var listEl = document.getElementById('adminReviewsList');
        var paginationEl = document.getElementById('adminReviewsPagination');
        var avgEl = document.getElementById('adminReviewsAvg');
        var countEl = document.getElementById('adminReviewsCount');
        var dataUrl = '{{ route("admin.dashboard1.reviews.data") }}';

        function buildCard(r) {
            var stars = '';
            for (var i = 1; i <= 5; i++) {
                stars += '<i class="fas fa-star text-sm ' + (i <= r.rating ? 'text-amber-500' : 'text-stone-300') + '"></i>';
            }
            var mediaHtml = '';
            if (r.media && r.media.length) {
                mediaHtml = '<div class="flex gap-1 mt-2">';
                r.media.slice(0, 3).forEach(function(m) {
                    if (m.type === 'image') {
                        mediaHtml += '<img src="/storage/' + m.file_path + '" alt="" class="w-12 h-12 object-cover rounded">';
                    } else {
                        mediaHtml += '<span class="text-xs text-stone-500">Video</span>';
                    }
                });
                mediaHtml += '</div>';
            }
            var repliesHtml = '';
            if (r.replies && r.replies.length) {
                r.replies.forEach(function(rep) {
                    repliesHtml += '<div class="mt-2 pl-4 border-l-2 border-amber-200"><p class="text-xs font-medium text-amber-900">' + (rep.admin_name || 'Admin') + '</p><p class="text-sm text-stone-600">' + rep.content + '</p><p class="text-xs text-stone-400">' + rep.created_at + '</p></div>';
                });
            }
            var identity = r.hide_identity ? 'Anonymous' : ('@' + (r.instagram || '-'));
            var featuredBadge = r.is_featured ? '<span class="text-xs bg-amber-100 text-amber-800 px-2 py-0.5 rounded ml-2">Featured</span>' : '';
            var statusClass = r.status === 'accepted' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
            return '<div class="bg-white rounded-lg shadow border border-stone-200 p-4">' +
                '<div class="flex justify-between items-start">' +
                '<div class="flex-1">' +
                '<span class="text-xs font-semibold text-amber-800 uppercase">' + (r.location ? r.location.toUpperCase() : '') + '</span>' +
                '<span class="text-xs text-stone-500 ml-2">' + (r.user_source || '') + '</span>' + featuredBadge +
                '<p class="mt-1 text-stone-800">' + (r.content ? r.content.substring(0, 150) + (r.content.length > 150 ? '...' : '') : '') + '</p>' +
                '<div class="flex items-center gap-2 mt-2">' + stars +
                '<span class="text-stone-500 text-sm">' + identity + '</span>' +
                '<span class="text-stone-400 text-xs">' + r.created_at + '</span>' +
                '<span class="text-xs px-2 py-0.5 rounded ' + statusClass + '">' + (r.status || '') + '</span></div>' +
                mediaHtml +
                repliesHtml +
                '<form action="' + r.reply_store_url + '" method="POST" class="mt-3 flex gap-2">' +
                '<input type="hidden" name="_token" value="' + (document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').content) + '">' +
                '<input type="text" name="content" placeholder="Balas review..." class="flex-1 rounded border border-stone-300 px-3 py-2 text-sm" required>' +
                '<button type="submit" class="btn btn-primary py-2">Balas</button></form></div>' +
                '<div class="flex gap-2 ml-4">' +
                '<a href="' + r.edit_url + '" class="px-3 py-1.5 rounded bg-amber-100 text-amber-800 text-sm font-medium">Edit</a>' +
                '<form action="' + r.destroy_url + '" method="POST" class="inline" onsubmit="return confirm(\'Hapus review ini?\');">' +
                '<input type="hidden" name="_token" value="' + (document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').content) + '">' +
                '<input type="hidden" name="_method" value="DELETE">' +
                '<button type="submit" class="px-3 py-1.5 rounded bg-red-100 text-red-800 text-sm font-medium">Hapus</button></form></div></div></div>';
        }

        function fetchReviews(page) {
            page = page || 1;
            var loc = document.getElementById('filter-location').value;
            var status = document.getElementById('filter-status').value;
            var rating = document.getElementById('filter-rating').value;
            var params = new URLSearchParams();
            if (loc) params.set('location', loc);
            if (status) params.set('status', status);
            if (rating) params.set('rating', rating);
            params.set('page', page);
            listEl.innerHTML = '<p class="text-center text-stone-500 py-8">Memuat...</p>';
            fetch(dataUrl + '?' + params.toString())
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (avgEl) avgEl.textContent = Number(data.aggregate.avg).toFixed(1);
                    if (countEl) countEl.textContent = data.aggregate.count;
                    if (!data.reviews || data.reviews.length === 0) {
                        listEl.innerHTML = '<p class="text-center text-stone-500 py-8">Belum ada review.</p>';
                    } else {
                        listEl.innerHTML = data.reviews.map(buildCard).join('');
                    }
                    var p = data.pagination;
                    if (p && p.last_page > 1) {
                        var links = [];
                        if (p.current_page > 1) {
                            links.push('<a href="#" class="admin-reviews-page-btn px-3 py-1.5 rounded border border-[#674c1d] text-[#674c1d] text-sm mr-1" data-page="' + (p.current_page - 1) + '">Sebelumnya</a>');
                        }
                        links.push('<span class="text-sm text-stone-500 px-2">Halaman ' + p.current_page + ' / ' + p.last_page + '</span>');
                        if (p.current_page < p.last_page) {
                            links.push('<a href="#" class="admin-reviews-page-btn px-3 py-1.5 rounded border border-[#674c1d] text-[#674c1d] text-sm ml-1" data-page="' + (p.current_page + 1) + '">Selanjutnya</a>');
                        }
                        paginationEl.innerHTML = links.join('');
                        paginationEl.querySelectorAll('.admin-reviews-page-btn').forEach(function(btn) {
                            btn.addEventListener('click', function(e) { e.preventDefault(); fetchReviews(parseInt(btn.getAttribute('data-page'), 10)); });
                        });
                    } else {
                        paginationEl.innerHTML = '';
                    }
                })
                .catch(function() {
                    listEl.innerHTML = '<p class="text-center text-stone-500 py-8">Gagal memuat data.</p>';
                    paginationEl.innerHTML = '';
                });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            fetchReviews(1);
        });
        paginationEl.addEventListener('click', function(e) {
            var a = e.target.closest('a[href*="page="]');
            if (a && a.getAttribute('href')) {
                e.preventDefault();
                var m = a.getAttribute('href').match(/[?&]page=(\d+)/);
                if (m) fetchReviews(parseInt(m[1], 10));
            }
        });
    });
    </script>
</body>
</html>
