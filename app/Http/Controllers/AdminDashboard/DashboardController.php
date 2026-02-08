<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Komentar;
use App\Models\Promo;
use App\Models\KomentarTpj;
use App\Models\KomentarTpc;
use App\Models\KomentarGkl;
use App\Models\KomentarPlu;
use App\Models\KomentarGwc;
use App\Models\KomentarPgv;
use App\Models\KomentarBsr;
use App\Models\KomentarGpc;
use App\Models\KomentarSpl;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate stats
        $totalRooms = Room::count();
        $totalTestimonials = Komentar::count() + 
                           KomentarTpj::count() + 
                           KomentarTpc::count() + 
                           KomentarGkl::count() + 
                           KomentarPlu::count() + 
                           KomentarGwc::count() + 
                           KomentarPgv::count() + 
                           KomentarBsr::count() + 
                           KomentarSpl::count() + 
                           KomentarGpc::count();
        $totalPromos = Promo::count();
        
        $stats = [
            'apartments' => 9, // Fixed number of apartments
            'rooms' => $totalRooms,
            'testimonials' => $totalTestimonials,
            'promos' => $totalPromos
        ];
        
        return view('admin.dashboard.index', compact('stats'));
    }
}
