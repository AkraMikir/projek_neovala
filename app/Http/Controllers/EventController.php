<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Track event dari frontend dengan deduplication
     */
    public function track(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'event_name' => 'required|string|in:visit,download_promo,book_now,form_submit',
                'url' => 'nullable|string',
                'referrer' => 'nullable|string',
                'metadata' => 'nullable|array'
            ]);

            $ipAddress = $request->ip();
            $userAgent = $request->header('User-Agent');
            $url = $validatedData['url'] ?? $request->header('referer');
            $eventName = $validatedData['event_name'];
            $sessionId = $validatedData['metadata']['session_id'] ?? null;

            // Deduplication: Cek apakah event yang sama sudah ada dalam waktu tertentu
            $deduplicationWindow = $this->getDeduplicationWindow($eventName);
            $recentEvent = Event::where('event_name', $eventName)
                ->where('ip_address', $ipAddress)
                ->where('url', $url)
                ->where('created_at', '>=', now()->subSeconds($deduplicationWindow))
                ->first();

            // Jika event visit dan sudah ada dalam 30 detik terakhir, skip
            if ($recentEvent && $eventName === 'visit') {
                return response()->json([
                    'success' => false, 
                    'message' => 'Duplicate visit prevented',
                    'duplicate' => true
                ], 200);
            }

            // Untuk event lainnya, cek dalam 10 detik
            if ($recentEvent && $eventName !== 'visit') {
                // Allow jika session_id berbeda (user berbeda)
                if ($sessionId && $recentEvent->metadata && 
                    isset($recentEvent->metadata['session_id']) && 
                    $recentEvent->metadata['session_id'] !== $sessionId) {
                    // Different session, allow tracking
                } else {
                    // Same session/IP, prevent duplicate
                    return response()->json([
                        'success' => false, 
                        'message' => 'Duplicate event prevented',
                        'duplicate' => true
                    ], 200);
                }
            }

            // Create event
            Event::create([
                'event_name' => $eventName,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'url' => $url,
                'referrer' => $validatedData['referrer'] ?? $request->header('referer'),
                'metadata' => $validatedData['metadata'] ?? null
            ]);

            return response()->json(['success' => true, 'message' => 'Event tracked successfully']);
        } catch (\Exception $e) {
            \Log::error('Tracking error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to track event'], 500);
        }
    }

    /**
     * Get deduplication window in seconds based on event type
     */
    private function getDeduplicationWindow(string $eventName): int
    {
        // Visit: 30 detik (prevent refresh spam)
        // Other events: 10 detik (prevent double-click)
        return $eventName === 'visit' ? 30 : 10;
    }

    /**
     * Get dashboard statistics dengan unique visitor tracking
     */
    public function getDashboardStats(Request $request)
    {
        try {
            $days = $request->get('days', 30);
            $startDate = now()->subDays($days);
            $endDate = now();

            // Get unique visitors (distinct IP addresses)
            $uniqueVisitors = Event::where('event_name', 'visit')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->distinct('ip_address')
                ->count('ip_address');

            // Get total visits (after deduplication, should be more accurate)
            $totalVisits = Event::where('event_name', 'visit')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

            // Get today's stats
            $todayStart = now()->startOfDay();
            $todayVisits = Event::where('event_name', 'visit')
                ->whereBetween('created_at', [$todayStart, $endDate])
                ->count();
            $todayDownloads = Event::where('event_name', 'download_promo')
                ->whereBetween('created_at', [$todayStart, $endDate])
                ->count();
            $todayBookNow = Event::where('event_name', 'book_now')
                ->whereBetween('created_at', [$todayStart, $endDate])
                ->count();
            $todayFormSubmit = Event::where('event_name', 'form_submit')
                ->whereBetween('created_at', [$todayStart, $endDate])
                ->count();

            $stats = [
                'total_visits' => $totalVisits,
                'unique_visitors' => $uniqueVisitors,
                'total_downloads' => Event::where('event_name', 'download_promo')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'total_book_now' => Event::where('event_name', 'book_now')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'total_form_submit' => Event::where('event_name', 'form_submit')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'today_visits' => $todayVisits,
                'today_downloads' => $todayDownloads,
                'today_book_now' => $todayBookNow,
                'today_form_submit' => $todayFormSubmit,
                'daily_stats' => $this->getDailyStats($startDate, $endDate),
                'recent_events' => Event::with([])
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get()
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            \Log::error('Dashboard stats error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get statistics'], 500);
        }
    }

    /**
     * Get daily statistics
     */
    private function getDailyStats($startDate, $endDate)
    {
        $events = ['visit', 'download_promo', 'book_now', 'form_submit'];
        $dailyStats = [];

        foreach ($events as $event) {
            $dailyStats[$event] = Event::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->where('event_name', $event)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->pluck('count', 'date')
                ->toArray();
        }

        return $dailyStats;
    }

    /**
     * Get event details for admin dashboard
     */
    public function getEventDetails(Request $request)
    {
        try {
            $eventName = $request->get('event_name');
            $days = $request->get('days', 30);
            $page = $request->get('page', 1);
            $perPage = $request->get('per_page', 20);

            $query = Event::query();

            if ($eventName) {
                $query->where('event_name', $eventName);
            }

            $query->where('created_at', '>=', now()->subDays($days))
                ->orderBy('created_at', 'desc');

            $events = $query->paginate($perPage, ['*'], 'page', $page);

            return response()->json($events);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to get event details'], 500);
        }
    }

    /**
     * Show tracking dashboard for admin dengan statistik yang lebih akurat
     */
    public function trackingDashboard()
    {
        $days = 30;
        $startDate = now()->subDays($days);
        $endDate = now();

        // Get unique visitors
        $uniqueVisitors = Event::where('event_name', 'visit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->distinct('ip_address')
            ->count('ip_address');

        // Get today's stats
        $todayStart = now()->startOfDay();
        $todayVisits = Event::where('event_name', 'visit')
            ->whereBetween('created_at', [$todayStart, $endDate])
            ->count();

        $stats = [
            'total_visits' => Event::where('event_name', 'visit')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'unique_visitors' => $uniqueVisitors,
            'total_downloads' => Event::where('event_name', 'download_promo')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'total_book_now' => Event::where('event_name', 'book_now')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'total_form_submit' => Event::where('event_name', 'form_submit')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'today_visits' => $todayVisits,
        ];

        $recentEvents = Event::orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('admin.tracking', compact('stats', 'recentEvents'));
    }
}
