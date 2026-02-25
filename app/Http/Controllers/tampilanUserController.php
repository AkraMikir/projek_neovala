<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class tampilanUserController extends Controller
{
    public function homeTampilanUser(Request $request)
    {
        // Batasi ulasan awal ke 10 saja — sisanya dimuat via AJAX saat user filter
        $query = Review::accepted()->featured()->with(['media', 'replies.admin']);

        if ($request->filled('rating')) {
            $rating = (int) $request->rating;
            if ($rating >= 1 && $rating <= 5) {
                $query->where('rating', $rating);
            }
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'longest') {
            $query->orderByRaw('LENGTH(content) DESC')->orderByDesc('created_at');
        } else {
            $query->latest();
        }

        $reviews = $query->limit(10)->get();

        // Cache aggregate queries selama 5 menit karena jarang berubah
        $reviewAggregate = Cache::remember('review_aggregate_home', 300, function () {
            $baseQuery = Review::accepted()->featured();
            return [
                'avg' => round((float) $baseQuery->avg('rating'), 1),
                'count' => $baseQuery->count(),
                'count_has_media' => (clone $baseQuery)->whereHas('media')->count(),
                'breakdown' => $baseQuery->selectRaw('rating, count(*) as count')->groupBy('rating')->orderByDesc('rating')->pluck('count', 'rating')->toArray(),
            ];
        });

        $promos = Cache::remember('promos_all', 300, function () {
            return Promo::latest()->get();
        });

        $locations = ['keseluruhan', 'Transpark Juanda', 'Transpark Cibubur', 'Grand Kamala Lagoon', 'Patraland Urbano', 'Gateway Cicadas', 'Podomoro Golf View', 'Bassura City', 'Green Pramuka City', 'Spring Lake Summarecon'];

        return view('user.index', compact('reviews', 'reviewAggregate', 'promos', 'locations'));
    }
}