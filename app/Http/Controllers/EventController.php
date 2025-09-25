<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Track event dari frontend
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

            Event::create([
                'event_name' => $validatedData['event_name'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'url' => $validatedData['url'] ?? $request->header('referer'),
                'referrer' => $validatedData['referrer'] ?? $request->header('referer'),
                'metadata' => $validatedData['metadata'] ?? null
            ]);

            return response()->json(['success' => true, 'message' => 'Event tracked successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to track event'], 500);
        }
    }

    /**
     * Get dashboard statistics
     */
    public function getDashboardStats(Request $request)
    {
        try {
            $days = $request->get('days', 30);
            $startDate = now()->subDays($days);
            $endDate = now();

            $stats = [
                'total_visits' => Event::where('event_name', 'visit')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'total_downloads' => Event::where('event_name', 'download_promo')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'total_book_now' => Event::where('event_name', 'book_now')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'total_form_submit' => Event::where('event_name', 'form_submit')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'daily_stats' => $this->getDailyStats($startDate, $endDate),
                'recent_events' => Event::with([])
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get()
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
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
     * Show tracking dashboard for admin
     */
    public function trackingDashboard()
    {
        $days = 30;
        $startDate = now()->subDays($days);
        $endDate = now();

        $stats = [
            'total_visits' => Event::where('event_name', 'visit')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'total_downloads' => Event::where('event_name', 'download_promo')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'total_book_now' => Event::where('event_name', 'book_now')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'total_form_submit' => Event::where('event_name', 'form_submit')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
        ];

        $recentEvents = Event::orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('admin.tracking', compact('stats', 'recentEvents'));
    }
}
