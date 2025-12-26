<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomentarGpc;

class KomentarGpcController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'instagram' => 'nullable|string|max:30',
            'message' => 'required|string|max:72',
            'rating' => 'required|integer|min:1|max:5',
            'hideIdentity' => 'nullable|in:on',
        ]);

        $komentar = KomentarGpc::create([
            'instagram' => $request->has('hideIdentity') ? 'Anonymous' : $request->input('instagram'),
            'message' => $validated['message'],
            'rating' => $validated['rating'],
            'hide_identity' => $request->has('hideIdentity'),
            'section' => 'gpc',
            'status' => 'accepted', // Set langsung accepted agar langsung muncul
        ]);

        // Jika request AJAX, return JSON
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih atas feedback Anda!',
                'komentar' => [
                    'id' => $komentar->id,
                    'message' => $komentar->message,
                    'instagram' => $komentar->instagram,
                    'hide_identity' => $komentar->hide_identity,
                    'rating' => $komentar->rating,
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Terima kasih atas feedback Anda!');
    }

    public function accept($id)
    {
        $komentar = KomentarGpc::findOrFail($id);
        $komentar->status = 'accepted';
        $komentar->save();

        return response()->json(['success' => true, 'message' => 'Komentar telah di-apply.']);
    }

    public function unapply($id)
    {
        $komentar = KomentarGpc::findOrFail($id);
        $komentar->status = 'pending';
        $komentar->save();

        return response()->json(['success' => true, 'message' => 'Komentar telah dikembalikan ke status pending.']);
    }

    public function delete($id)
    {
        $komentar = KomentarGpc::findOrFail($id);
        $komentar->delete(); // <- ini menghapus dari DB
        return response()->json(['success' => true, 'message' => 'Komentar telah dihapus.']);
    }
}