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

            <div class="reviews-filter">
                <form method="GET">
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
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>
            </div>

            <div class="space-y-4">
                @forelse($reviews as $review)
                    <div class="bg-white rounded-lg shadow border border-stone-200 p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <span class="text-xs font-semibold text-amber-800 uppercase">{{ $review->location }}</span>
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

            @if($reviews->hasPages())
                <div class="mt-6">
                    {{ $reviews->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>
