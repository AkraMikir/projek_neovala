<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserActivityController extends Controller
{
    /**
     * Handle incoming tracking request from frontend
     * /api/track-activity
     */
    public function store(Request $request)
    {
        try {
            // 1. Validasi Input
            $validated = $request->validate([
                'activity_type' => 'required|in:visit,click_book_now,click_download_promo,submit_form,submit_comment',
                'page_url'      => 'required|url',
                'session_id'    => 'required|string|max:100', // Dari localstorage frontend
                'metadata'      => 'nullable|array'
            ]);

            $urlComponents = parse_url($validated['page_url']);
            $pagePath = $urlComponents['path'] ?? '/';
            
            // 2. LOGIC PENCEGAHAN DUPLIKASI (DEBOUNCING)
            
            // A. Untuk VISIT: Cegah hitungan ganda jika user refresh dalam 30 menit
            if ($validated['activity_type'] === 'visit') {
                $recentVisit = UserActivity::where('session_id', $validated['session_id'])
                    ->where('activity_type', 'visit')
                    ->where('page_path', $pagePath)
                    ->where('created_at', '>=', Carbon::now()->subMinutes(30)) // 30 menit debounce
                    ->exists();

                if ($recentVisit) {
                    return response()->json(['status' => 'skipped', 'message' => 'Visit recorded recently']);
                }
            }
            
            // B. Untuk CLICKS & SUBMITS: Cegah double-click dalam 5 detik
            if (in_array($validated['activity_type'], ['click_book_now', 'click_download_promo', 'submit_form', 'submit_comment'])) {
                $recentAction = UserActivity::where('session_id', $validated['session_id'])
                    ->where('activity_type', $validated['activity_type'])
                    ->where('page_path', $pagePath)
                    ->where('created_at', '>=', Carbon::now()->subSeconds(5)) // 5 detik debounce
                    ->exists();
                    
                if ($recentAction) {
                    return response()->json(['status' => 'skipped', 'message' => 'Action recorded recently']);
                }
            }

            // 3. Simpan Data Baru
            $activity = UserActivity::create([
                'session_id'    => $validated['session_id'],
                'ip_address'    => $request->ip(),
                'user_agent'    => $request->header('User-Agent'),
                'activity_type' => $validated['activity_type'],
                'page_url'      => $validated['page_url'],
                'page_path'     => $pagePath,
                
                // Ekstrak metadata penting ke kolom terpisah untuk indexing
                'apartment_type' => $validated['metadata']['apartment_type'] ?? null,
                'target_name'    => $validated['metadata']['target_name'] ?? null,
                
                'metadata'      => $validated['metadata']
            ]);

            return response()->json(['status' => 'success', 'id' => $activity->id]);

        } catch (\Exception $e) {
            Log::error('Tracking Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
