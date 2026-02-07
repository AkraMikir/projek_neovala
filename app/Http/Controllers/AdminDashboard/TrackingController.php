<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\{FormData, Komentar, Room, Promo};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        // Date range filter (default: last 30 days)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        
        // Overview Statistics
        $stats = [
            'total_visits' => 0, // Would need tracking table
            'total_bookings' => FormData::whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_testimonials' => Komentar::whereBetween('created_at', [$startDate, $endDate])->count(),
            'active_rooms' => Room::count(),
        ];
        
        // Visit trends - placeholder (no tracking table)
        $visitTrends = collect([]);
        
        // Booking trends (last 7 days)
        $bookingTrends = FormData::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as bookings')
        )
        ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();
        
        // Popular apartments (by booking count) - using apartment_type
        $popularApartments = FormData::select('apartment_type', DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('apartment_type')
            ->where('apartment_type', '!=', '')
            ->groupBy('apartment_type')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
        
        // Recent bookings
        $recentBookings = FormData::whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->limit(10)
            ->get();
        
        // Popular pages - placeholder (no tracking table)
        $popularPages = collect([]);
        
        // Device breakdown - placeholder (no tracking table)
        $deviceStats = collect([]);
        
        return view('admin.tracking.index', compact(
            'stats',
            'visitTrends',
            'bookingTrends',
            'popularApartments',
            'recentBookings',
            'popularPages',
            'deviceStats',
            'startDate',
            'endDate'
        ));
    }
    
    public function exportData(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        
        $data = FormData::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Simple CSV export
        $filename = 'bookings_' . $startDate . '_to_' . $endDate . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'WhatsApp', 'Room Type', 'Check In', 'Arrival Time', 'Duration', 'Message', 'Apartment Type', 'Date']);
            
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->nama ?? '',
                    $row->nomor_wa ?? '',
                    $row->tipe_kamar ?? '',
                    $row->tanggal_checkin ?? '',
                    $row->jam_kedatangan ?? '',
                    $row->durasi ?? '',
                    $row->pesan ?? '',
                    $row->apartment_type ?? '',
                    $row->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
