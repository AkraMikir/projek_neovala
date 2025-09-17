<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Models\Room;

class TampilanApartmentController extends Controller
{
    public function tpj()
{
    $section = 'TPJ';

    // Carousel seperti biasa
    $carousel = Carousel::where('section', $section)->first();
    $carouselImages = [];

    if ($carousel) {
        for ($i = 1; $i <= 4; $i++) {
            $imagePath = $carousel->{'image' . $i};
            if ($imagePath) {
                $carouselImages[$i] = asset('storage/' . $imagePath);
            }
        }
    }

    $carouselImagesBySection = [
        $section => $carouselImages
    ];

    // Ambil data Room berdasarkan section
    $rooms = Room::where('section', 'room_transpark_juanda')->get();

    // Format data rooms
    $roomsFormatted = $rooms->map(function ($room) {
        return [
            'id' => $room->id,
            'section' => $room->section,
            'room_name' => pathinfo($room->main_photo, PATHINFO_FILENAME),
            'main_photo' => asset('storage/' . $room->main_photo),
            'popup_photos' => collect([$room->popup1, $room->popup2, $room->popup3, $room->popup4])
                ->filter()
                ->map(function ($popup) {
                    return asset('storage/' . $popup);
                })->values()->all()
        ];
    });

    return view('user.discover-TPJ', compact('carouselImagesBySection', 'roomsFormatted'));
}

    public function tpc()
{
    $section = 'TPC';

    // Ambil carousel berdasarkan section
    $carousel = Carousel::where('section', $section)->first();
    $carouselImages = [];

    if ($carousel) {
        for ($i = 1; $i <= 4; $i++) {
            $imagePath = $carousel->{'image' . $i};
            if ($imagePath) {
                $carouselImages[$i] = asset('storage/' . $imagePath);
            }
        }
    }

    $carouselImagesBySection = [
        $section => $carouselImages
    ];

    // Ambil data Room berdasarkan section
    $rooms = Room::where('section', 'room_transpark_cibubur')->get();

    // Format data rooms
    $roomsFormatted = $rooms->map(function ($room) {
        return [
            'id' => $room->id,
            'section' => $room->section,
            'room_name' => pathinfo($room->main_photo, PATHINFO_FILENAME),
            'main_photo' => asset('storage/' . $room->main_photo),
            'popup_photos' => collect([$room->popup1, $room->popup2, $room->popup3, $room->popup4])
                ->filter()
                ->map(function ($popup) {
                    return asset('storage/' . $popup);
                })->values()->all()
        ];
    });

    return view('user.discover-TPC', compact('carouselImagesBySection', 'roomsFormatted'));
}

    public function gkl()
    {
        $section = 'GKL';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                if ($imagePath) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                }
            }
        }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
        $carouselImagesBySection = [
            $section => $carouselImages
        ];

        // Ambil data Room berdasarkan section
    $rooms = Room::where('section', 'room_grand_kamala_lagoon')->get();

    // Format data rooms
    $roomsFormatted = $rooms->map(function ($room) {
        return [
            'id' => $room->id,
            'section' => $room->section,
            'room_name' => pathinfo($room->main_photo, PATHINFO_FILENAME),
            'main_photo' => asset('storage/' . $room->main_photo),
            'popup_photos' => collect([$room->popup1, $room->popup2, $room->popup3, $room->popup4])
                ->filter()
                ->map(function ($popup) {
                    return asset('storage/' . $popup);
                })->values()->all()
        ];
    });

        return view('user.discover-GKL', compact('carouselImagesBySection', 'roomsFormatted'));
    }
    public function plu()
    {
        $section = 'PLU';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                if ($imagePath) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                }
            }
        }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
        $carouselImagesBySection = [
            $section => $carouselImages
        ];

            // Ambil data Room berdasarkan section
    $rooms = Room::where('section', 'room_patraland_urbano')->get();

    // Format data rooms
    $roomsFormatted = $rooms->map(function ($room) {
        return [
            'id' => $room->id,
            'section' => $room->section,
            'room_name' => pathinfo($room->main_photo, PATHINFO_FILENAME),
            'main_photo' => asset('storage/' . $room->main_photo),
            'popup_photos' => collect([$room->popup1, $room->popup2, $room->popup3, $room->popup4])
                ->filter()
                ->map(function ($popup) {
                    return asset('storage/' . $popup);
                })->values()->all()
        ];
    });

        return view('user.discover-PLU', compact('carouselImagesBySection', 'roomsFormatted'));
    }
    public function gwc()
    {
        $section = 'GWC';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                if ($imagePath) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                }
            }
        }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
        $carouselImagesBySection = [
            $section => $carouselImages
        ];

        // Ambil data Room berdasarkan section
    $rooms = Room::where('section', 'room_gateway_cicadas')->get();

    // Format data rooms
    $roomsFormatted = $rooms->map(function ($room) {
        return [
            'id' => $room->id,
            'section' => $room->section,
            'room_name' => pathinfo($room->main_photo, PATHINFO_FILENAME),
            'main_photo' => asset('storage/' . $room->main_photo),
            'popup_photos' => collect([$room->popup1, $room->popup2, $room->popup3, $room->popup4])
                ->filter()
                ->map(function ($popup) {
                    return asset('storage/' . $popup);
                })->values()->all()
        ];
    });

        return view('user.discover-GWC', compact('carouselImagesBySection', 'roomsFormatted'));
    }

    public function PGV()
    {
        $section = 'PGV';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                if ($imagePath) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                }
            }
        }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
        $carouselImagesBySection = [
            $section => $carouselImages
        ];

        $rooms = Room::where('section', 'room_podomoro_golf_view')->get();

    // Format data rooms
    $roomsFormatted = $rooms->map(function ($room) {
        return [
            'id' => $room->id,
            'section' => $room->section,
            'room_name' => pathinfo($room->main_photo, PATHINFO_FILENAME),
            'main_photo' => asset('storage/' . $room->main_photo),
            'popup_photos' => collect([$room->popup1, $room->popup2, $room->popup3, $room->popup4])
                ->filter()
                ->map(function ($popup) {
                    return asset('storage/' . $popup);
                })->values()->all()
        ];
    });

        return view('user.discover-PGV', compact('carouselImagesBySection', 'roomsFormatted'));
    }

    public function gpc()
    {
        $section = 'GPC';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                if ($imagePath) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                }
            }
        }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
        $carouselImagesBySection = [
            $section => $carouselImages
        ];

        // Ambil data Room berdasarkan section
        $rooms = Room::where('section', 'room_grand_pramuka_city')->get();

        // Format data rooms
        $roomsFormatted = $rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'section' => $room->section,
                'room_name' => pathinfo($room->main_photo, PATHINFO_FILENAME),
                'main_photo' => asset('storage/' . $room->main_photo),
                'popup_photos' => collect([$room->popup1, $room->popup2, $room->popup3, $room->popup4])
                    ->filter()
                    ->map(function ($popup) {
                        return asset('storage/' . $popup);
                    })->values()->all()
            ];
        });

        return view('user.discover-GPC', compact('carouselImagesBySection', 'roomsFormatted'));
    }

    public function bsc()
    {
        $section = 'BSC';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                if ($imagePath) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                }
            }
        }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
        $carouselImagesBySection = [
            $section => $carouselImages
        ];

        // Ambil data Room berdasarkan section
        $rooms = Room::where('section', 'room_bassura_city')->get();

        // Format data rooms
        $roomsFormatted = $rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'section' => $room->section,
                'room_name' => pathinfo($room->main_photo, PATHINFO_FILENAME),
                'main_photo' => asset('storage/' . $room->main_photo),
                'popup_photos' => collect([$room->popup1, $room->popup2, $room->popup3, $room->popup4])
                    ->filter()
                    ->map(function ($popup) {
                        return asset('storage/' . $popup);
                    })->values()->all()
            ];
        });

        return view('user.discover-BSC', compact('carouselImagesBySection', 'roomsFormatted'));
    }
}
