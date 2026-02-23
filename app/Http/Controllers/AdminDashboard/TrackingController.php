<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        // 1. FILTER REQUEST (Default: 30 Hari Terakhir)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // Konversi ke Carbon object untuk query scope
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        // 2. STATS TOTAL (Semua Waktu / Periode Tertentu)
        $stats = [
            'total_visits' => UserActivity::visits()->dateRange($start, $end)->count(),
            'today_visits' => UserActivity::visits()->today()->count(),
            'total_bookings' => UserActivity::where('activity_type', 'click_book_now')->dateRange($start, $end)->count(),
            'total_downloads' => UserActivity::where('activity_type', 'click_download_promo')->dateRange($start, $end)->count(),
            'total_forms' => UserActivity::where('activity_type', 'submit_form')->dateRange($start, $end)->count(),
        ];

        // 3. TRENDS HARIAN (Untuk Grafik)
        $visitTrends = UserActivity::visits()
            ->dateRange($start, $end)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
            
        // 4. ACTION BREAKDOWN (Booking, Download, Submit, Comment)
        $actionTrends = UserActivity::whereIn('activity_type', ['click_book_now', 'click_download_promo', 'submit_form', 'submit_comment'])
            ->dateRange($start, $end)
            ->select('activity_type', DB::raw('count(*) as count'))
            ->groupBy('activity_type')
            ->get();

        // Daftar lengkap apartment (termasuk SPL) agar konsisten di semua branch
        $knownApartments = ['GPC', 'TPC', 'TPJ', 'PLU', 'GKL', 'GWC', 'PGV', 'BSR', 'SPL'];
        $discoverPaths = array_map(fn ($code) => '/discover-' . strtolower($code), $knownApartments);

        // 5. POPULAR APARTMENTS (gabung data DB + daftar tetap, agar SPL dll selalu muncul)
        $apartmentCounts = UserActivity::whereNotNull('apartment_type')
            ->dateRange($start, $end)
            ->select('apartment_type', DB::raw('count(*) as count'))
            ->groupBy('apartment_type')
            ->get()
            ->keyBy('apartment_type');

        $popularApartments = collect($knownApartments)
            ->map(fn ($apt) => (object) [
                'apartment_type' => $apt,
                'count' => $apartmentCounts->get($apt)?->count ?? 0,
            ])
            ->sortByDesc('count')
            ->values()
            ->take(10);

        // 6. POPULAR PAGES (gabung top visits + semua path discover-* agar /discover-spl dll selalu masuk)
        $pageCounts = UserActivity::visits()
            ->dateRange($start, $end)
            ->select('page_path', DB::raw('count(*) as visits'))
            ->groupBy('page_path')
            ->get()
            ->keyBy('page_path');

        foreach ($discoverPaths as $path) {
            if (!$pageCounts->has($path)) {
                $pageCounts->put($path, (object) ['page_path' => $path, 'visits' => 0]);
            }
        }

        $popularPages = $pageCounts
            ->sortByDesc('visits')
            ->values()
            ->take(10);

        // 7. DEVICE BREAKDOWN (Mobile vs Desktop)
        // Simple logic: check 'Mobile' in user_agent string
        $deviceStats = UserActivity::visits()
            ->dateRange($start, $end)
            ->select(DB::raw("CASE WHEN user_agent LIKE '%Mobile%' THEN 'Mobile' ELSE 'Desktop' END as device"), DB::raw('count(*) as count'))
            ->groupBy('device')
            ->get();

        // 6. Recent Activity Log (Paginated)
        $recentActivitiesQuery = UserActivity::dateRange($start, $end)
            ->latest();



        $recentActivities = $recentActivitiesQuery->paginate(5)->appends($request->all());

        return view('admin.tracking.index', compact(
            'stats',
            'visitTrends',
            'actionTrends',
            'popularApartments',
            'popularPages',
            'deviceStats',
            'recentActivities',
            'startDate',
            'endDate'
        ));
    }

    public function exportData(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        
        $data = UserActivity::dateRange($startDate, $endDate)
            ->latest()
            ->get();
        
        $filename = 'activity_log_' . $startDate . '_to_' . $endDate . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Defines headers (User Friendly Format)
            fputcsv($file, [
                'Date', 
                'Time', 
                'User Action', 
                'Target Page', 
                'Apartment Unit', 
                'Interaction Details'
            ]);
            
            foreach ($data as $row) {
                // 1. Format Activity Type
                // Example: 'click_book_now' -> 'Clicked Book Now'
                $action = ucwords(str_replace(['click_', 'submit_', '_'], ['', '', ' '], $row->activity_type));
                if ($row->activity_type == 'visit') $action = 'Visited Page';
                if ($row->activity_type == 'click_book_now') $action = 'Clicked Book Now';
                if ($row->activity_type == 'submit_form') $action = 'Submitted Form';
                if ($row->activity_type == 'click_download_promo') $action = 'Downloaded Promo';
                
                // 2. Format Page Path
                $pagePath = $row->page_path ?: parse_url($row->page_url, PHP_URL_PATH);
                
                // 3. Extract Details & Apartment
                $details = $row->target_name;
                $apartment = $row->apartment_type;
                
                // Parse metadata safely
                if (!empty($row->metadata)) {
                    $meta = is_string($row->metadata) ? json_decode($row->metadata, true) : $row->metadata;
                    
                    // Fallback apartment from metadata
                    if (!$apartment && isset($meta['apartment_type'])) {
                        $apartment = $meta['apartment_type'];
                    }
                    
                    // Specific details from Form ID or other meta
                    if (isset($meta['form_id'])) {
                        $formName = ucfirst(str_replace('Form', '', $meta['form_id']));
                        $details = 'Form Type: ' . $formName;
                    }
                }
                
                // Final Data Row
                fputcsv($file, [
                    $row->created_at->format('d M Y'), 
                    $row->created_at->format('H:i'),   
                    $action,
                    $pagePath,
                    $apartment ?: '-',
                    $details ?: '-'
                ]);
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
