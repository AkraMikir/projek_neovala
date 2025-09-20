<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Promo;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function destroy($tipe, $id)
{
    if ($tipe === 'komentar') {
        $komentar = Komentar::findOrFail($id);
        $komentar->forceDelete();

        return redirect()->route('admin.dashboard')->with('success', 'Komentar berhasil dihapus.');
    }

        if ($tipe === 'promo') {
            $promo = Promo::findOrFail($id);

            if (Storage::disk('public')->exists($promo->image)) {
                Storage::disk('public')->delete($promo->image);
            }

            $promo->forceDelete();

            return redirect()->route('admin.dashboard')->with([
    'success' => 'Promo berhasil dihapus.',
    'show_section' => 'promo' // ini penanda section mana yang harus dibuka
]);

    }

    if ($tipe === 'room') {
        try {
            $room = Room::findOrFail($id);

            // Hapus semua file
            $files = [
                $room->main_photo,
                $room->popup1,
                $room->popup2,
                $room->popup3,
                $room->popup4
            ];

            foreach ($files as $file) {
                if ($file && Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            // Hapus folder (opsional)
            $folderPath = dirname($room->main_photo);
            if ($folderPath && Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->deleteDirectory($folderPath);
            }

            // Hapus data dari database
            $room->forceDelete();

            return response()->json(['message' => 'Room berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus room: ' . $e->getMessage()], 500);
        }
    }


        return response()->json(['error' => 'Tipe data tidak dikenali.'], 400);
    }

    // BSC Room Management
    public function deleteRoom($id)
    {
        try {
            $room = Room::findOrFail($id);
            
            // Delete images from storage
            $images = [
                $room->main_image,
                $room->room_image_1,
                $room->room_image_2,
                $room->room_image_3,
                $room->room_image_4
            ];
            
            foreach ($images as $image) {
                if ($image) {
                    Storage::disk('public')->delete($image);
                }
            }
            
            $room->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Room deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting room: ' . $e->getMessage()
            ], 500);
        }
    }

}