<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewMedia;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    private const DETAIL_LOCATIONS = ['Transpark Juanda', 'Transpark Cibubur', 'Grand Kamala Lagoon', 'Patraland Urbano', 'Gateway Cicadas', 'Podomoro Golf View', 'Bassura City', 'Green Pramuka City', 'Spring Lake Summarecon'];

    /** Slug (URL) → nama lengkap untuk query & tampilan */
    private const LOCATION_SLUG_TO_NAME = [
        'tpj' => 'Transpark Juanda',
        'tpc' => 'Transpark Cibubur',
        'gkl' => 'Grand Kamala Lagoon',
        'plu' => 'Patraland Urbano',
        'gwc' => 'Gateway Cicadas',
        'pgv' => 'Podomoro Golf View',
        'gpc' => 'Green Pramuka City',
        'bsr' => 'Bassura City',
        'spl' => 'Spring Lake Summarecon',
    ];

    /** Nilai location yang boleh disimpan (nama lengkap + keseluruhan) */
    private const STORE_LOCATIONS = ['keseluruhan', 'Transpark Juanda', 'Transpark Cibubur', 'Grand Kamala Lagoon', 'Patraland Urbano', 'Gateway Cicadas', 'Podomoro Golf View', 'Bassura City', 'Green Pramuka City', 'Spring Lake Summarecon'];

    private static function locationToName(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }
        if (isset(self::LOCATION_SLUG_TO_NAME[$value])) {
            return self::LOCATION_SLUG_TO_NAME[$value];
        }
        if (in_array($value, self::DETAIL_LOCATIONS, true)) {
            return $value;
        }
        return null;
    }

    /** Nilai location yang mungkin di DB (nama lengkap + slug lama) agar filter/detail tampil untuk data lama & baru. */
    private static function locationFilterValues(?string $value): array
    {
        if ($value === null || $value === '') {
            return [];
        }
        if (isset(self::LOCATION_SLUG_TO_NAME[$value])) {
            return [$value, self::LOCATION_SLUG_TO_NAME[$value]];
        }
        foreach (self::LOCATION_SLUG_TO_NAME as $slug => $name) {
            if ($name === $value) {
                return [$value, $slug];
            }
        }
        return [$value];
    }

    /**
     * Detail page: utama – all featured reviews, filter by location + rating + sort.
     */
    public function detailIndex(Request $request)
    {
        $query = Review::accepted()->featured()->with(['media', 'replies.admin']);

        $locationValues = self::locationFilterValues($request->get('location'));
        if (!empty($locationValues)) {
            $query->whereIn('location', $locationValues);
        }

        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderByDesc('likes')->orderByDesc('created_at');
        } elseif ($sort === 'longest') {
            $query->orderByRaw('LENGTH(content) DESC')->orderByDesc('created_at');
        } else {
            $query->latest();
        }

        $reviews = $query->paginate(12)->withQueryString();

        $baseQuery = Review::accepted()->featured();
        if (!empty($locationValues)) {
            $baseQuery->whereIn('location', $locationValues);
        }
        $aggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
            'count_has_media' => (clone $baseQuery)->whereHas('media')->count(),
        ];

        return view('user.reviews.detail', [
            'reviews' => $reviews,
            'aggregate' => $aggregate,
            'locations' => self::DETAIL_LOCATIONS,
            'currentLocation' => null,
            'hideNavbar' => true,
            'backUrl' => route('home'),
        ]);
    }

    /**
     * Detail page: discover – reviews for one location, filter by rating + sort.
     * URL memakai slug (tpj, tpc, ...); query & tampilan memakai nama lengkap.
     */
    public function detailDiscover(Request $request, string $locationSlug)
    {
        $locationName = self::locationToName($locationSlug);
        if ($locationName === null) {
            abort(404);
        }

        $locationValues = [$locationName, $locationSlug];

        $query = Review::accepted()->whereIn('location', $locationValues)->with(['media', 'replies.admin']);

        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderByDesc('likes')->orderByDesc('created_at');
        } elseif ($sort === 'longest') {
            $query->orderByRaw('LENGTH(content) DESC')->orderByDesc('created_at');
        } else {
            $query->latest();
        }

        $reviews = $query->paginate(12)->withQueryString();

        $baseQuery = Review::accepted()->whereIn('location', $locationValues);
        $aggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
            'count_has_media' => (clone $baseQuery)->whereHas('media')->count(),
        ];

        $discoverRoutes = [
            'tpj' => 'discoverTPJ', 'tpc' => 'discoverTPC', 'gkl' => 'discoverGKL',
            'plu' => 'discoverPLU', 'gwc' => 'discoverGWC', 'pgv' => 'discoverPGV',
            'gpc' => 'discoverGPC', 'bsr' => 'discoverBSC', 'spl' => 'discoverSPL',
        ];

        return view('user.reviews.detail', [
            'reviews' => $reviews,
            'aggregate' => $aggregate,
            'locations' => null,
            'currentLocation' => $locationName,
            'hideNavbar' => true,
            'backUrl' => route($discoverRoutes[$locationSlug] ?? 'home'),
        ]);
    }

    /**
     * Escape string for LIKE: % and _ so no wildcard injection.
     */
    private static function escapeLike(string $value): string
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $value);
    }

    /**
     * API: filtered reviews (no page refresh). GET ?location=&rating=&sort=&has_media=&keyword=&q=
     * Home (utama): no location → only accepted + is_featured=1.
     * Discover: location set → only accepted (tampil di discover).
     */
    public function listApi(Request $request)
    {
        $query = Review::accepted()->with(['media', 'replies.admin']);

        $locationValues = self::locationFilterValues($request->get('location'));
        if (!empty($locationValues)) {
            $query->whereIn('location', $locationValues);
        } else {
            $query->featured();
        }

        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        if ($request->filled('has_media') && (int) $request->get('has_media') === 1) {
            $query->whereHas('media');
        }

        $keyword = $request->get('keyword');
        if (is_string($keyword) && ($keyword = trim($keyword)) !== '' && strlen($keyword) <= 100) {
            $query->where('content', 'like', '%' . self::escapeLike($keyword) . '%');
        }

        $search = $request->get('q');
        if (is_string($search) && ($search = trim($search)) !== '' && strlen($search) <= 100) {
            $query->where('content', 'like', '%' . self::escapeLike($search) . '%');
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderByDesc('likes')->orderByDesc('created_at');
        } elseif ($sort === 'longest') {
            $query->orderByRaw('LENGTH(content) DESC')->orderByDesc('created_at');
        } else {
            $query->latest();
        }

        $usePagination = $request->filled('page') || $request->filled('per_page');
        $perPage = min((int) $request->get('per_page', 12), 50);
        if ($perPage < 1) {
            $perPage = 12;
        }

        if ($usePagination) {
            $reviews = $query->paginate($perPage)->withQueryString();
        } else {
            $reviews = $query->limit(50)->get();
        }

        $baseQuery = Review::accepted();
        if (!empty($locationValues)) {
            $baseQuery->whereIn('location', $locationValues);
        } else {
            $baseQuery->featured();
        }
        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $baseQuery->where('rating', $r);
        }
        if ($request->filled('has_media') && (int) $request->get('has_media') === 1) {
            $baseQuery->whereHas('media');
        }
        $kw = is_string($request->get('keyword')) ? trim($request->get('keyword')) : '';
        if ($kw !== '' && strlen($kw) <= 100) {
            $baseQuery->where('content', 'like', '%' . self::escapeLike($kw) . '%');
        }
        $q = is_string($request->get('q')) ? trim($request->get('q')) : '';
        if ($q !== '' && strlen($q) <= 100) {
            $baseQuery->where('content', 'like', '%' . self::escapeLike($q) . '%');
        }

        $aggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
            'count_has_media' => (clone $baseQuery)->whereHas('media')->count(),
        ];

        $fullMedia = $usePagination;
        $collection = $usePagination ? collect($reviews->items()) : $reviews;
        $items = $collection->map(function ($review) use ($fullMedia) {
            if ($fullMedia) {
                $media = $review->media->map(fn ($m) => [
                    'type' => $m->type,
                    'url' => asset('storage/' . $m->file_path),
                    'file_path' => $m->file_path,
                ])->values()->all();
            } else {
                $media = $review->media->where('type', 'image')->take(3)->map(fn ($m) => asset('storage/' . $m->file_path))->values()->all();
            }
            return [
                'id' => $review->id,
                'location' => Review::locationDisplay($review->location),
                'content' => $review->content,
                'rating' => $review->rating,
                'hide_identity' => $review->hide_identity,
                'instagram' => $review->instagram,
                'created_at' => $review->created_at->format('d M Y'),
                'likes' => (int) ($review->likes ?? 0),
                'media' => $media,
                'replies' => $review->replies->map(fn ($r) => [
                    'admin_name' => $r->admin->name ?? 'Admin',
                    'content' => $r->content,
                    'created_at' => $r->created_at->format('d M Y'),
                ])->all(),
            ];
        });

        $response = [
            'reviews' => $items,
            'aggregate' => $aggregate,
        ];
        if ($usePagination && $reviews instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $response['pagination'] = [
                'total' => $reviews->total(),
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'per_page' => $reviews->perPage(),
            ];
        }
        return response()->json($response);
    }

    /** Stopwords bahasa Indonesia (singkat) untuk word cloud. */
    private static function stopwords(): array
    {
        return [
            'dan', 'di', 'ke', 'yang', 'dengan', 'untuk', 'ini', 'itu', 'dari', 'ada', 'adalah', 'bisa', 'sudah', 'akan',
            'juga', 'atau', 'tapi', 'saya', 'kami', 'mereka', 'dia', 'kita', 'oleh', 'pada', 'tak', 'tidak', 'jika', 'kalau',
            'sangat', 'sekali', 'sudah', 'masih', 'sudah', 'per', 'oleh', 'agar', 'supaya', 'karena', 'sebagai', 'dalam',
        ];
    }

    /**
     * API: top keywords (word cloud) from review content. GET ?location=
     * Returns [{ "word": "nyaman", "count": 12 }, ...] max 5.
     */
    public function keywordsApi(Request $request)
    {
        $query = Review::accepted()->select('content');

        $locationValues = self::locationFilterValues($request->get('location'));
        if (!empty($locationValues)) {
            $query->whereIn('location', $locationValues);
        } else {
            $query->featured();
        }

        $contents = $query->pluck('content')->filter()->map(function ($text) {
            $text = (string) $text;
            $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text);
            $text = mb_strtolower($text);
            return preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        })->flatten();

        $stopwords = array_fill_keys(self::stopwords(), true);
        $minLength = 3;
        $counts = [];
        foreach ($contents as $word) {
            $w = trim($word);
            if ($w === '' || mb_strlen($w) < $minLength || isset($stopwords[$w])) {
                continue;
            }
            $counts[$w] = ($counts[$w] ?? 0) + 1;
        }
        arsort($counts, SORT_NUMERIC);
        $top = array_slice(array_keys($counts), 0, 5, true);
        $result = [];
        foreach ($top as $word) {
            $result[] = ['word' => $word, 'count' => $counts[$word]];
        }

        return response()->json(['keywords' => $result]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|in:keseluruhan,Transpark Juanda,Transpark Cibubur,Grand Kamala Lagoon,Patraland Urbano,Gateway Cicadas,Podomoro Golf View,Bassura City,Green Pramuka City,Spring Lake Summarecon',
            'instagram' => 'nullable|string|max:50',
            'content' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
            'hide_identity' => 'nullable|in:on,1',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:20480',
            'video' => 'nullable|file|mimes:mp4,mov,avi,webm|max:20480',
        ], ['video.max' => 'File video maksimal 20 MB.', 'images.*.max' => 'Gambar maksimal 20 MB (akan dikompres otomatis).']);

        $images = $request->file('images') ?? [];
        $video = $request->file('video');

        if (is_array($images) && count($images) > 5) {
            return $this->failResponse('Maksimal 5 gambar.');
        }
        if ($video && !$video->isValid()) {
            return $this->failResponse('File video tidak valid.');
        }

        $review = Review::create([
            'location' => $validated['location'],
            'user_source' => 'user',
            'instagram' => $request->has('hide_identity') ? 'Anonymous' : ($validated['instagram'] ?? null),
            'content' => $validated['content'],
            'rating' => (int) $validated['rating'],
            'hide_identity' => $request->has('hide_identity'),
            'status' => 'accepted',
            'is_featured' => true,
        ]);

        try {
            $saved = 0;
            foreach (is_array($images) ? $images : [] as $file) {
                if ($saved >= 5) break;
                if ($file && $file->isValid()) {
                    $filename = ImageService::upload($file, 'reviews', 1200, 80);
                    $path = 'reviews/' . $filename;
                    ReviewMedia::create(['review_id' => $review->id, 'type' => 'image', 'file_path' => $path]);
                    $saved++;
                }
            }
        } catch (\Throwable $e) {
            foreach ($review->media as $media) {
                Storage::disk('public')->delete($media->file_path);
            }
            $review->delete();
            return $this->failResponse('Gambar tidak valid atau gagal diproses.');
        }

        if ($video && $video->isValid()) {
            $path = $video->store('reviews', 'public');
            ReviewMedia::create(['review_id' => $review->id, 'type' => 'video', 'file_path' => $path]);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Ulasan Anda telah ditampilkan.',
                'review' => [
                    'id' => $review->id,
                    'location' => $review->location,
                    'content' => $review->content,
                    'rating' => $review->rating,
                    'instagram' => $review->instagram,
                    'hide_identity' => $review->hide_identity,
                    'created_at' => $review->created_at->toIso8601String(),
                ],
            ]);
        }

        return redirect()->back()->with('success', 'Terima kasih atas ulasan Anda!');
    }

    /**
     * POST /api/reviews/{id}/like — increment likes counter.
     */
    public function like(int $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }
        $review->timestamps = false;
        $review->increment('likes');
        return response()->json(['success' => true, 'likes' => (int) $review->fresh()->likes]);
    }

    /**
     * Standalone /ulasan page — form + reviews widget (featured only).
     */
    public function reviewsPage(Request $request)
    {
        $query = Review::accepted()->featured()->with(['media', 'replies.admin']);

        $locationValues = self::locationFilterValues($request->get('location'));
        if (!empty($locationValues)) {
            $query->whereIn('location', $locationValues);
        }

        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderByDesc('likes')->orderByDesc('created_at');
        } elseif ($sort === 'longest') {
            $query->orderByRaw('LENGTH(content) DESC')->orderByDesc('created_at');
        } else {
            $query->latest();
        }

        $reviews = $query->paginate(12)->withQueryString();

        $baseQuery = Review::accepted()->featured();
        if (!empty($locationValues)) {
            $baseQuery->whereIn('location', $locationValues);
        }
        $reviewAggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
            'count_has_media' => (clone $baseQuery)->whereHas('media')->count(),
        ];

        $locations = self::STORE_LOCATIONS;

        return view('user.reviews.page', [
            'reviews' => $reviews,
            'reviewAggregate' => $reviewAggregate,
            'locations' => $locations,
            'hideNavbar' => true,
            'backUrl' => route('home'),
        ]);
    }

    private function failResponse(string $message)
    {
        return request()->expectsJson() || request()->ajax()
            ? response()->json(['success' => false, 'message' => $message], 422)
            : redirect()->back()->withErrors(['media' => $message]);
    }
}