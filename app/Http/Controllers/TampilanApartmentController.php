<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Carousel;
use App\Models\Room;
use App\Models\Review;

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

    private function getReviewDataForLocation(string $locationSlug): array
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

    public function tpj()
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

    $reviewData = $this->getReviewDataForLocation('tpj');
    return view('user.discover-TPJ', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
}

    public function tpc()
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

    $reviewData = $this->getReviewDataForLocation('tpc');
    return view('user.discover-TPC', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
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

        $reviewData = $this->getReviewDataForLocation('gkl');
        return view('user.discover-GKL', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
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

        $reviewData = $this->getReviewDataForLocation('plu');
        return view('user.discover-PLU', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
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

        $reviewData = $this->getReviewDataForLocation('gwc');
        return view('user.discover-GWC', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
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

        $reviewData = $this->getReviewDataForLocation('pgv');
        return view('user.discover-PGV', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }

    public function BSR()
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

        $reviewData = $this->getReviewDataForLocation('bsr');
        return view('user.discover-BSC', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
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

        $reviewData = $this->getReviewDataForLocation('gpc');
        return view('user.discover-GPC', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }

    public function spl()
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

        $reviewData = $this->getReviewDataForLocation('spl');
        return view('user.discover-SPL', array_merge(compact('carouselImagesBySection', 'roomsFormatted'), $reviewData));
    }
}