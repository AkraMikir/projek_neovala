<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\KomentarBsc;
use App\Models\Promo;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Room;
use App\Models\FormData;

class ViewsController extends Controller
{
    public function dashboardView(Request $request)
    {
        $komentars = Komentar::latest()->get();
        $promos = Promo::latest()->get();

        // Ambil semua data carousel
        $carousels = Carousel::all();

        // Kelompokkan gambar carousel berdasarkan section
        $carouselImagesBySection = [];

        foreach ($carousels as $carousel) {
            $section = $carousel->section;

            $carouselImagesBySection[$section] = [
                1 => $carousel->image1 ? asset('storage/' . $carousel->image1) : null,
                2 => $carousel->image2 ? asset('storage/' . $carousel->image2) : null,
                3 => $carousel->image3 ? asset('storage/' . $carousel->image3) : null,
                4 => $carousel->image4 ? asset('storage/' . $carousel->image4) : null,
            ];
        }

        // Daftar section rooms
        $roomSections = [
            'room_transpark_juanda',
            'room_transpark_cibubur',
            'room_grand_kamala_lagoon',
            'room_patraland_urbano',
            'room_gateway_cicadas',
            'room_podomoro_golf_view',
            'room_green_pramuka_city',
            'room_bassura_city'
        ];

        $roomsBySection = [];

        foreach ($roomSections as $section) {
            $rooms = Room::where('section', $section)->get()->map(function ($room) {
    return [
        'id' => $room->id,
        'folder' => $room->folder ?? 'room-' . $room->id,
        'room_name' => strtoupper($room->folder ?? 'ROOM ' . $room->id),
        'main_photo' => $room->main_photo ? asset('storage/' . $room->main_photo) : null,
        'popup1' => $room->popup1 ? asset('storage/' . $room->popup1) : null,
        'popup2' => $room->popup2 ? asset('storage/' . $room->popup2) : null,
        'popup3' => $room->popup3 ? asset('storage/' . $room->popup3) : null,
        'popup4' => $room->popup4 ? asset('storage/' . $room->popup4) : null,
        'popup_photos' => collect([
            $room->popup1,
            $room->popup2,
            $room->popup3,
            $room->popup4,
        ])->filter()->map(fn($file) => asset('storage/' . $file))->values()->toArray(),
        'section' => $room->section,
        'safe_id' => Str::slug($room->folder ?? 'room-' . $room->id),
    ];
});

            $roomsBySection[$section] = $rooms;
        }

        $apartmentSections = [
    'Transpark Juanda by Neovala',
    'Transpark Cibubur by Neovala',
    'Podomoro Golf View by Neovala',
    'Patraland Urbano by Neovala',
    'Grand Kamala Lagoon by Neovala',
    'Gateway Cicadas by Neovala',
    'Green Pramuka City by Neovala',
    'Bassura City by Neovala',
];

$apartmentForms = [];

foreach ($apartmentSections as $apartment) {
    $forms = FormData::where('apartment_type', $apartment)
                ->orderBy('created_at', 'desc')
                ->get();
    $apartmentForms[$apartment] = $forms;
}

        return view('admin.admin', compact(
    'komentars',
    'promos',
    'carouselImagesBySection',
    'roomsBySection',
    'apartmentForms',
    'apartmentSections'
));

    }

    // BSC Admin Functions
    public function bscRooms()
    {
        $rooms = Room::where('apartment_type', 'bsc')->get();
        return response()->json(['rooms' => $rooms]);
    }

    public function bscComments()
    {
        $comments = KomentarBsc::all();
        return response()->json(['comments' => $comments]);
    }

    public function roomDetails($id)
    {
        $room = Room::find($id);
        return response()->json($room);
    }
}
