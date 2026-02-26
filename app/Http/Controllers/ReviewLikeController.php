<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewLikeController extends Controller
{
    public function toggle(Request $request, Review $review)
    {
        $visitorId = $request->attributes->get('visitor_id');

        if (!$visitorId) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor ID tidak ditemukan'
            ], 400);
        }

        $result = DB::transaction(function () use ($review, $visitorId, $request) {
            $existingLike = ReviewLike::where('review_id', $review->id)
                ->where('visitor_id', $visitorId)
                ->first();

            if ($existingLike) {
                $existingLike->delete();
                $review->decrement('likes_count');

                return [
                    'action' => 'unliked',
                    'likes_count' => max(0, $review->fresh()->likes_count),
                ];
            } else {
                ReviewLike::create([
                    'review_id'  => $review->id,
                    'visitor_id' => $visitorId,
                    'ip_address' => $request->ip(),
                    'session_id' => session()->getId(),
                ]);
                $review->increment('likes_count');

                return [
                    'action' => 'liked',
                    'likes_count' => $review->fresh()->likes_count,
                ];
            }
        });

        return response()->json([
            'success' => true,
            'action'  => $result['action'],
            'likes_count' => $result['likes_count'],
        ]);
    }

    public function checkLikes(Request $request)
    {
        $visitorId = $request->attributes->get('visitor_id');
        $reviewIds = $request->input('review_ids', []);

        if (!$visitorId || empty($reviewIds)) {
            return response()->json(['liked_ids' => []]);
        }

        $likedIds = ReviewLike::where('visitor_id', $visitorId)
            ->whereIn('review_id', $reviewIds)
            ->pluck('review_id')
            ->toArray();

        return response()->json(['liked_ids' => $likedIds]);
    }
}
