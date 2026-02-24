<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Review;
use Illuminate\Http\Request;

class tampilanUserController extends Controller
{
    public function homeTampilanUser(Request $request)
    {
        // Utama: hanya tampilkan yang status=accepted dan is_featured=1
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

        $reviews = $query->limit(50)->get();

        $baseQuery = Review::accepted()->featured();
        $reviewAggregate = [
            'avg' => round((float) $baseQuery->avg('rating'), 1),
            'count' => $baseQuery->count(),
            'count_has_media' => (clone $baseQuery)->whereHas('media')->count(),
            'breakdown' => $baseQuery->selectRaw('rating, count(*) as count')->groupBy('rating')->orderByDesc('rating')->pluck('count', 'rating')->toArray(),
        ];

        $promos = Promo::latest()->get();

        $locations = ['keseluruhan', 'Transpark Juanda', 'Transpark Cibubur', 'Grand Kamala Lagoon', 'Patraland Urbano', 'Gateway Cicadas', 'Podomoro Golf View', 'Bassura City', 'Green Pramuka City', 'Spring Lake Summarecon'];

        return view('user.index', compact('reviews', 'reviewAggregate', 'promos', 'locations'));
    }
}