<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewMedia;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    private const DETAIL_LOCATIONS = ['tpj', 'tpc', 'gkl', 'plu', 'gwc', 'pgv', 'gpc', 'bsr', 'spl'];

    /**
     * Detail page: utama – all featured reviews, filter by location + rating + sort.
     */
    public function detailIndex(Request $request)
    {
        $query = Review::accepted()->featured()->with(['media', 'replies.admin']);

        if ($request->filled('location') && in_array($request->location, self::DETAIL_LOCATIONS, true)) {
            $query->where('location', $request->location);
        }

        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'longest') {
            $query->orderByRaw('LENGTH(content) DESC')->orderByDesc('created_at');
        } else {
            $query->latest();
        }

        $reviews = $query->paginate(12)->withQueryString();

        $baseQuery = Review::accepted()->featured();
        if ($request->filled('location') && in_array($request->location, self::DETAIL_LOCATIONS, true)) {
            $baseQuery->where('location', $request->location);
        }
        $aggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
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
     */
    public function detailDiscover(Request $request, string $location)
    {
        if (!in_array($location, self::DETAIL_LOCATIONS, true)) {
            abort(404);
        }

        $query = Review::accepted()->forLocation($location)->with(['media', 'replies.admin']);

        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'longest') {
            $query->orderByRaw('LENGTH(content) DESC')->orderByDesc('created_at');
        } else {
            $query->latest();
        }

        $reviews = $query->paginate(12)->withQueryString();

        $baseQuery = Review::accepted()->forLocation($location);
        $aggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
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
            'currentLocation' => $location,
            'hideNavbar' => true,
            'backUrl' => route($discoverRoutes[$location] ?? 'home'),
        ]);
    }

    /**
     * API: filtered reviews (no page refresh). GET ?location=&rating=&sort=latest|longest
     * Home (utama): no location → only accepted + is_featured=1.
     * Discover: location set → only accepted (tampil di discover).
     */
    public function listApi(Request $request)
    {
        $query = Review::accepted()->with(['media', 'replies.admin']);

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        } else {
            $query->featured();
        }

        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'longest') {
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
        if ($request->filled('location')) {
            $baseQuery->where('location', $request->location);
        } else {
            $baseQuery->featured();
        }

        $aggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
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
                'location' => $review->location,
                'content' => $review->content,
                'rating' => $review->rating,
                'hide_identity' => $review->hide_identity,
                'instagram' => $review->instagram,
                'created_at' => $review->created_at->format('d M Y'),
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|in:utama,tpj,tpc,gkl,plu,gwc,pgv,gpc,bsr,spl',
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

    private function failResponse(string $message)
    {
        return request()->expectsJson() || request()->ajax()
            ? response()->json(['success' => false, 'message' => $message], 422)
            : redirect()->back()->withErrors(['media' => $message]);
    }
}
