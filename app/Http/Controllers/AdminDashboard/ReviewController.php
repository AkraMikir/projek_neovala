<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewMedia;
use App\Models\ReviewReply;
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

        $reviews = $query->latest()->paginate(15)->withQueryString();
        $locations = ['utama', 'tpj', 'tpc', 'gkl', 'plu', 'gwc', 'pgv', 'gpc', 'bsr', 'spl'];

        return view('admin.reviews.index', compact('reviews', 'locations'));
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
        ]);

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

        $saved = 0;
        foreach (is_array($images) ? $images : [] as $file) {
            if ($saved >= 5) break;
            if ($file && $file->isValid()) {
                $path = $file->store('reviews', 'public');
                ReviewMedia::create(['review_id' => $review->id, 'type' => 'image', 'file_path' => $path]);
                $saved++;
            }
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
        ]);

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
        $toAdd = 0;
        foreach (is_array($images) ? $images : [] as $file) {
            if ($file && $file->isValid() && ($currentImages + $toAdd) < 5) {
                $path = $file->store('reviews', 'public');
                ReviewMedia::create(['review_id' => $review->id, 'type' => 'image', 'file_path' => $path]);
                $toAdd++;
            }
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
