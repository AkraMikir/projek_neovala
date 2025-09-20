<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{
    public function KomentarUpdate(Request $request, $id)
{
    $validated = $request->validate([
        'apartmen' => 'required|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'isi' => 'required|string',
        'bintang' => 'required|integer|min:1|max:5',
    ]);

    $komentar = Komentar::findOrFail($id);
    $komentar->update($validated);

    return redirect()->route('admin.dashboard')->with('success', 'Komentar berhasil diupdate.');
}

// BSC Room Management
public function updateRoom(Request $request, $id)
{
    $request->validate([
        'apartment_type' => 'required|string',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'room_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'room_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'room_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'room_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        $room = Room::findOrFail($id);
        
        // Update main image if provided
        if ($request->hasFile('main_image')) {
            // Delete old image
            if ($room->main_image) {
                Storage::disk('public')->delete($room->main_image);
            }
            $room->main_image = $request->file('main_image')->store('rooms/' . $request->apartment_type, 'public');
        }
        
        // Update room images if provided
        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile("room_image_$i")) {
                // Delete old image
                $oldImageField = "room_image_$i";
                if ($room->$oldImageField) {
                    Storage::disk('public')->delete($room->$oldImageField);
                }
                $room->$oldImageField = $request->file("room_image_$i")->store('rooms/' . $request->apartment_type, 'public');
            }
        }

        $room->apartment_type = $request->apartment_type;
        $room->save();

        return response()->json([
            'success' => true,
            'message' => 'Room updated successfully',
            'room' => $room
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error updating room: ' . $e->getMessage()
        ], 500);
    }
}

}
