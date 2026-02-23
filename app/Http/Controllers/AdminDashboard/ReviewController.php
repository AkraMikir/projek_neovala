<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewMedia;
use App\Models\ReviewReply;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['media', 'replies.admin']);

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        $baseQuery = Review::query();
        if ($request->filled('location')) {
            $baseQuery->where('location', $request->location);
        }
        if ($request->filled('status')) {
            $baseQuery->where('status', $request->status);
        }
        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $baseQuery->where('rating', $r);
        }
        $aggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
        ];

        $reviews = $query->latest()->paginate(15)->withQueryString();
        $locations = ['utama', 'tpj', 'tpc', 'gkl', 'plu', 'gwc', 'pgv', 'gpc', 'bsr', 'spl'];

        return view('admin.reviews.index', compact('reviews', 'locations', 'aggregate'));
    }

    /**
     * API: filtered reviews + aggregate (no page refresh).
     */
    public function data(Request $request)
    {
        $query = Review::with(['media', 'replies.admin']);

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $query->where('rating', $r);
        }

        $baseQuery = Review::query();
        if ($request->filled('location')) {
            $baseQuery->where('location', $request->location);
        }
        if ($request->filled('status')) {
            $baseQuery->where('status', $request->status);
        }
        if ($request->filled('rating') && ($r = (int) $request->rating) >= 1 && $r <= 5) {
            $baseQuery->where('rating', $r);
        }
        $aggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
        ];

        $page = max(1, (int) $request->get('page', 1));
        $reviews = $query->latest()->paginate(15)->withQueryString();

        $items = collect($reviews->items())->map(function ($review) {
            $media = $review->media->map(fn ($m) => [
                'type' => $m->type,
                'file_path' => $m->file_path,
            ])->values()->all();
            $replies = $review->replies->map(fn ($r) => [
                'admin_name' => $r->admin->name ?? 'Admin',
                'content' => $r->content,
                'created_at' => $r->created_at->format('d M Y H:i'),
            ])->values()->all();
            return [
                'id' => $review->id,
                'location' => $review->location,
                'user_source' => $review->user_source,
                'is_featured' => $review->is_featured,
                'content' => $review->content,
                'rating' => $review->rating,
                'hide_identity' => $review->hide_identity,
                'instagram' => $review->instagram,
                'created_at' => $review->created_at->format('d M Y'),
                'status' => $review->status,
                'media' => $media,
                'replies' => $replies,
                'edit_url' => route('admin.dashboard1.reviews.edit', $review),
                'destroy_url' => route('admin.dashboard1.reviews.destroy', $review),
                'reply_store_url' => route('admin.dashboard1.reviews.replies.store', $review),
            ];
        })->all();

        return response()->json([
            'reviews' => $items,
            'aggregate' => $aggregate,
            'pagination' => [
                'total' => $reviews->total(),
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'per_page' => $reviews->perPage(),
            ],
        ]);
    }

    public function create()
    {
        $locations = ['utama', 'tpj', 'tpc', 'gkl', 'plu', 'gwc', 'pgv', 'gpc', 'bsr', 'spl'];
        return view('admin.reviews.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|in:utama,tpj,tpc,gkl,plu,gwc,pgv,gpc,bsr,spl',
            'instagram' => 'nullable|string|max:50',
            'content' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'nullable|in:on,1',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:20480',
            'video' => 'nullable|file|mimes:mp4,mov,avi,webm|max:20480',
        ], ['video.max' => 'File video maksimal 20 MB.', 'images.*.max' => 'Gambar maksimal 20 MB (akan dikompres otomatis).']);

        $images = $request->file('images') ?? [];
        $video = $request->file('video');
        if (is_array($images) && count($images) > 5) {
            return redirect()->back()->withErrors(['media' => 'Maksimal 5 gambar.'])->withInput();
        }

        $review = Review::create([
            'location' => $validated['location'],
            'user_source' => 'admin',
            'instagram' => $validated['instagram'] ?? null,
            'content' => $validated['content'],
            'rating' => (int) $validated['rating'],
            'hide_identity' => false,
            'status' => 'accepted',
            'is_featured' => $request->has('is_featured'),
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
            return redirect()->back()->withErrors(['media' => 'Gambar tidak valid atau gagal diproses.'])->withInput();
        }

        if ($video && $video->isValid()) {
            $path = $video->store('reviews', 'public');
            ReviewMedia::create(['review_id' => $review->id, 'type' => 'video', 'file_path' => $path]);
        }

        return redirect()->route('admin.dashboard1.reviews.index')->with('success', 'Review berhasil ditambahkan.');
    }

    public function edit(Review $review)
    {
        $review->load(['media', 'replies.admin']);
        $locations = ['utama', 'tpj', 'tpc', 'gkl', 'plu', 'gwc', 'pgv', 'gpc', 'bsr', 'spl'];
        return view('admin.reviews.edit', compact('review', 'locations'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:pending,accepted',
            'is_featured' => 'nullable|in:on,1',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:20480',
            'video' => 'nullable|file|mimes:mp4,mov,avi,webm|max:20480',
        ], ['video.max' => 'File video maksimal 20 MB.', 'images.*.max' => 'Gambar maksimal 20 MB (akan dikompres otomatis).']);

        $review->update([
            'content' => $validated['content'],
            'rating' => (int) $validated['rating'],
            'status' => $validated['status'],
            'is_featured' => $request->has('is_featured'),
        ]);

        $images = $request->file('images') ?? [];
        $video = $request->file('video');
        $currentImages = $review->media()->where('type', 'image')->count();
        $hasVideo = $review->media()->where('type', 'video')->exists();
        $addedMedia = [];

        try {
            $toAdd = 0;
            foreach (is_array($images) ? $images : [] as $file) {
                if ($file && $file->isValid() && ($currentImages + $toAdd) < 5) {
                    $filename = ImageService::upload($file, 'reviews', 1200, 80);
                    $path = 'reviews/' . $filename;
                    $media = ReviewMedia::create(['review_id' => $review->id, 'type' => 'image', 'file_path' => $path]);
                    $addedMedia[] = $media;
                    $toAdd++;
                }
            }
        } catch (\Throwable $e) {
            foreach ($addedMedia as $media) {
                Storage::disk('public')->delete($media->file_path);
                $media->delete();
            }
            return redirect()->back()->withErrors(['media' => 'Gambar tidak valid atau gagal diproses.'])->withInput();
        }

        if ($video && $video->isValid() && !$hasVideo) {
            $path = $video->store('reviews', 'public');
            ReviewMedia::create(['review_id' => $review->id, 'type' => 'video', 'file_path' => $path]);
        }

        return redirect()->route('admin.dashboard1.reviews.index')->with('success', 'Review berhasil diupdate.');
    }

    public function destroy(Review $review)
    {
        foreach ($review->media as $media) {
            Storage::disk('public')->delete($media->file_path);
        }
        $review->delete();
        return redirect()->route('admin.dashboard1.reviews.index')->with('success', 'Review berhasil dihapus.');
    }

    public function storeReply(Request $request, Review $review)
    {
        $validated = $request->validate(['content' => 'required|string|max:2000']);
        ReviewReply::create([
            'review_id' => $review->id,
            'admin_id' => auth('admin')->id(),
            'content' => $validated['content'],
        ]);
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Balasan tersimpan.']);
        }
        return redirect()->back()->with('success', 'Balasan tersimpan.');
    }

    public function updateReply(Request $request, Review $review, ReviewReply $reply)
    {
        if ($reply->review_id !== $review->id) {
            abort(404);
        }
        $validated = $request->validate(['content' => 'required|string|max:2000']);
        $reply->update(['content' => $validated['content']]);
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Balasan diupdate.', 'content' => $reply->content]);
        }
        return redirect()->back()->with('success', 'Balasan diupdate.');
    }

    public function destroyReply(Review $review, ReviewReply $reply)
    {
        if ($reply->review_id !== $review->id) {
            abort(404);
        }
        $reply->delete();
        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Balasan dihapus.']);
        }
        return redirect()->back()->with('success', 'Balasan dihapus.');
    }

    public function deleteMedia(Review $review, ReviewMedia $medium)
    {
        if ($medium->review_id !== $review->id) {
            abort(404);
        }
        Storage::disk('public')->delete($medium->file_path);
        $medium->delete();
        return redirect()->back()->with('success', 'Media dihapus.');
    }
}
