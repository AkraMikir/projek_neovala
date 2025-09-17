<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Komentar;
use App\Models\Promo;
use App\Models\Room;
use App\Models\Carousel; // pastikan model ini sudah dibuat

class StoreController extends Controller
{
    public function store(Request $request)
{
    // =======================
    // 1. Proses update carousel
    // =======================
    if ($request->has('carousel_section')) {
        $request->validate([
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000000',
            'carousel_section' => 'required|string|max:255',
        ]);

        $section = $request->carousel_section;
        $carousel = Carousel::where('section', $section)->first();

        if (!$carousel) {
            $carousel = new Carousel(['section' => $section]);
        }

        $errors = [];
        for ($i = 1; $i <= 4; $i++) {
            if (!$carousel->{'image' . $i} && !$request->hasFile("images.$i")) {
                $errors[] = "Gambar ke-$i harus diisi.";
            }
        }

        if (count($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile("images.$i")) {
                $oldPath = $carousel->{'image' . $i};

                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                $filename = "slide_$i." . $request->file("images.$i")->getClientOriginalExtension();
                $path = $request->file("images.$i")->storeAs("carousel_images/$section", $filename, 'public');

                $carousel->{'image' . $i} = $path;
            }
        }

        $carousel->save();
        return redirect()->back()->with('success', 'Slide berhasil diperbarui!');
    }

    // =======================
    // 2. Proses komentar form
    // =======================
    if ($request->has('bintang')) {
        $validated = $request->validate([
            'apartmen' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'bintang' => 'required|integer|min:1|max:5',
        ]);

        Komentar::create($validated);
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    // =======================
    // 3. Proses upload promo
    // =======================
    if ($request->hasFile('image') && $request->has('title')) {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1000000',
            'title' => 'required|string',
        ]);

        $path = $request->file('image')->store('promos', 'public');

        Promo::create([
            'image' => $path,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Promo berhasil ditambahkan!');
    }

// =======================
// 4. Proses tambah / update room
// =======================
if ($request->has('room_section')) {
    $validated = $request->validate([
        'room_section' => 'required|string|max:255',
        'room_id' => 'nullable|exists:rooms,id',
        'main_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1000000',
        'popup1' => 'nullable|image|mimes:jpeg,png,jpg|max:1000000',
        'popup2' => 'nullable|image|mimes:jpeg,png,jpg|max:1000000',
        'popup3' => 'nullable|image|mimes:jpeg,png,jpg|max:1000000',
        'popup4' => 'nullable|image|mimes:jpeg,png,jpg|max:1000000',
    ]);

    $section = $validated['room_section'];

    // =============== UPDATE ROOM ===============
    if ($request->filled('room_id')) {
        $room = Room::findOrFail($request->room_id);
        $folder = $room->folder ?? '1';

        // Update main photo jika ada
        if ($request->hasFile('main_photo')) {
            if ($room->main_photo && Storage::disk('public')->exists($room->main_photo)) {
                Storage::disk('public')->delete($room->main_photo);
            }

            $mainPath = $request->file('main_photo')->store("rooms/{$section}/{$folder}", 'public');
            $room->main_photo = $mainPath;
        }

        // Update popup1 - popup4 jika ada
        foreach (['popup1', 'popup2', 'popup3', 'popup4'] as $popup) {
            if ($request->hasFile($popup)) {
                if ($room->$popup && Storage::disk('public')->exists($room->$popup)) {
                    Storage::disk('public')->delete($room->$popup);
                }

                $ext = $request->file($popup)->getClientOriginalExtension();
                $filename = "$popup.$ext";
                $popupPath = $request->file($popup)->storeAs("rooms/{$section}/{$folder}", $filename, 'public');
                $room->$popup = $popupPath;
            }
        }

        $room->save();
        return redirect()->back()->with('success', 'Room berhasil diperbarui!');
    }

    // =============== STORE ROOM BARU ===============
    $latestFolder = collect(Storage::disk('public')->directories("rooms/$section"))
        ->map(fn($f) => (int) basename($f))->filter()->max() ?? 0;

    $newFolder = $latestFolder + 1;

    $paths = [];
    foreach (['main_photo', 'popup1', 'popup2', 'popup3', 'popup4'] as $field) {
        if ($request->hasFile($field)) {
            $ext = $request->file($field)->getClientOriginalExtension();
            $filename = "$field.$ext";
            $paths[$field] = $request->file($field)->storeAs("rooms/$section/$newFolder", $filename, 'public');
        } else {
            $paths[$field] = null;
        }
    }

    Room::create([
        'section' => $section,
        'folder' => $newFolder,
        'main_photo' => $paths['main_photo'],
        'popup1' => $paths['popup1'],
        'popup2' => $paths['popup2'],
        'popup3' => $paths['popup3'],
        'popup4' => $paths['popup4'],
    ]);

    return redirect()->back()->with('success', 'Room berhasil ditambahkan!');
}


    return redirect()->back()->with('error', 'Form tidak dikenali atau data tidak lengkap.');
}


}
