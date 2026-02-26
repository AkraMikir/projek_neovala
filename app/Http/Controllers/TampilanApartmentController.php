<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Carousel;
use App\Models\Review;
use App\Models\Room;

class TampilanApartmentController extends Controller
{
    private static $SLUG_TO_NAME = [
        'tpj' => 'Transpark Juanda',
        'tpc' => 'Transpark Cibubur',
        'gkl' => 'Grand Kamala Lagoon',
        'plu' => 'Patraland Urbano',
        'gwc' => 'Gateway Cicadas',
        'pgv' => 'Podomoro Golf View',
        'gpc' => 'Green Pramuka City',
        'bsr' => 'Bassura City',
        'spl' => 'Spring Lake Summarecon',
    ];

    private function getReviewDataForLocation(Request $request, string $locationSlug): array
    {
        $locationName = self::$SLUG_TO_NAME[$locationSlug] ?? null;
        $locationValues = $locationName ? [$locationSlug, $locationName] : [$locationSlug];

        $reviews = Review::accepted()
            ->whereIn('location', $locationValues)
            ->with(['media', 'replies.admin'])
            ->latest()
            ->limit(50)
            ->get();

        $baseQuery = Review::accepted()->whereIn('location', $locationValues);
        $reviewAggregate = [
            'avg'            => round((float) (clone $baseQuery)->avg('rating'), 1),
            'count'          => (clone $baseQuery)->count(),
            'count_has_media'=> (clone $baseQuery)->whereHas('media')->count(),
        ];

        return compact('reviews', 'reviewAggregate');
    }

    public function tpj(Request $request)
{
    $section = 'TPJ';

        // Ambil carousel berdasarkan section
    $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
    $carouselImages = [];

    if ($carousel) {
        for ($i = 1; $i <= 4; $i++) {
            $imagePath = $carousel->{'image' . $i};
                // Pastikan path tidak null dan tidak kosong
                if (!empty($imagePath) && $imagePath !== null) {
                    // Pastikan file benar-benar ada di storage
                    if (Storage::disk('public')->exists($imagePath)) {
                $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
            }
        }
    }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
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

    $reviewData = $this->getReviewDataForLocation($request, 'tpj');
    return view('user.discover-TPJ', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
}

    public function tpc(Request $request)
{
    $section = 'TPC';

    // Ambil carousel berdasarkan section
    $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
    $carouselImages = [];

    if ($carousel) {
        for ($i = 1; $i <= 4; $i++) {
            $imagePath = $carousel->{'image' . $i};
                // Pastikan path tidak null dan tidak kosong
                if (!empty($imagePath) && $imagePath !== null) {
                    // Pastikan file benar-benar ada di storage
                    if (Storage::disk('public')->exists($imagePath)) {
                $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
            }
        }
    }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
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

    $reviewData = $this->getReviewDataForLocation($request, 'tpc');
    return view('user.discover-TPC', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
}

    public function gkl(Request $request)
    {
        $section = 'GKL';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                // Pastikan path tidak null dan tidak kosong
                if (!empty($imagePath) && $imagePath !== null) {
                    // Pastikan file benar-benar ada di storage
                    if (Storage::disk('public')->exists($imagePath)) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
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

        $reviewData = $this->getReviewDataForLocation($request, 'gkl');
        return view('user.discover-GKL', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }
    public function plu(Request $request)
    {
        $section = 'PLU';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                // Pastikan path tidak null dan tidak kosong
                if (!empty($imagePath) && $imagePath !== null) {
                    // Pastikan file benar-benar ada di storage
                    if (Storage::disk('public')->exists($imagePath)) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
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

        $reviewData = $this->getReviewDataForLocation($request, 'plu');
        return view('user.discover-PLU', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }
    public function gwc(Request $request)
    {
        $section = 'GWC';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                // Pastikan path tidak null dan tidak kosong
                if (!empty($imagePath) && $imagePath !== null) {
                    // Pastikan file benar-benar ada di storage
                    if (Storage::disk('public')->exists($imagePath)) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
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

        $reviewData = $this->getReviewDataForLocation($request, 'gwc');
        return view('user.discover-GWC', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }

    public function PGV(Request $request)
    {
        $section = 'PGV';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                // Pastikan path tidak null dan tidak kosong
                if (!empty($imagePath) && $imagePath !== null) {
                    // Pastikan file benar-benar ada di storage
                    if (Storage::disk('public')->exists($imagePath)) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
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

        $reviewData = $this->getReviewDataForLocation($request, 'pgv');
        return view('user.discover-PGV', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }

    public function BSR(Request $request)
    {
        $section = 'BSR';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                // Pastikan path tidak null dan tidak kosong
                if (!empty($imagePath) && $imagePath !== null) {
                    // Pastikan file benar-benar ada di storage
                    if (Storage::disk('public')->exists($imagePath)) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
                }
            }
        }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
        $carouselImagesBySection = [
            $section => $carouselImages
        ];

        $rooms = Room::where('section', 'room_bassura')->get();

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

        $reviewData = $this->getReviewDataForLocation($request, 'bsr');
        return view('user.discover-BSC', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }

    public function gpc(Request $request)
    {
        $section = 'GPC';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                // Pastikan path tidak null dan tidak kosong
                if (!empty($imagePath) && $imagePath !== null) {
                    // Pastikan file benar-benar ada di storage
                    if (Storage::disk('public')->exists($imagePath)) {
                    $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
                }
            }
        }

        // Kirim ke view dalam bentuk $carouselImagesBySection agar konsisten dengan struktur blade
        $carouselImagesBySection = [
            $section => $carouselImages
        ];

        // Ambil data Room berdasarkan section
        $rooms = Room::where('section', 'room_green_pramuka_city')->get();

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

        $reviewData = $this->getReviewDataForLocation($request, 'gpc');
        return view('user.discover-GPC', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }

    public function spl(Request $request)
    {
        $section = 'SPL';

        // Ambil carousel berdasarkan section
        $carousel = Carousel::where('section', $section)->first();

        // Siapkan array gambar jika ada carousel
        $carouselImages = [];

        if ($carousel) {
            for ($i = 1; $i <= 4; $i++) {
                $imagePath = $carousel->{'image' . $i};
                if (!empty($imagePath) && $imagePath !== null) {
                    if (Storage::disk('public')->exists($imagePath)) {
                        $carouselImages[$i] = asset('storage/' . $imagePath);
                    }
                }
            }
        }

        $carouselImagesBySection = [
            $section => $carouselImages
        ];

        // Ambil data Room berdasarkan section
        $rooms = Room::where('section', 'room_springlake_summarecon')->get();

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

        $reviewData = $this->getReviewDataForLocation($request, 'spl');
        return view('user.discover-SPL', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }
}