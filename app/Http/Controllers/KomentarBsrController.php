<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomentarBsr;

class KomentarBsrController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'instagram' => 'nullable|string|max:30',
            'message' => 'required|string|max:72',
            'rating' => 'required|integer|min:1|max:5',
            'hideIdentity' => 'nullable|in:on',
        ]);

        KomentarBsr::create([
            'instagram' => $request->has('hideIdentity') ? null : $request->input('instagram'),
            'message' => $validated['message'],
            'rating' => $validated['rating'],
            'hide_identity' => $request->has('hideIdentity'),
            'section' => 'bsr',
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas feedback Anda!');
    }

    public function accept($id)
    {
        $komentar = KomentarBsr::findOrFail($id);
        $komentar->status = 'accepted';
        $komentar->save();

        return redirect()->back()->with('success', 'Komentar telah di-apply.');
    }

    public function unapply($id)
    {
        $komentar = KomentarBsr::findOrFail($id);
        $komentar->status = 'pending';
        $komentar->save();

        return redirect()->back()->with('success', 'Komentar telah dikembalikan ke status pending.');
    }

    public function delete($id)
    {
        $komentar = KomentarBsr::findOrFail($id);
        $komentar->delete(); // <- ini menghapus dari DB
        return redirect()->back()->with('success', 'Komentar telah dihapus.');
    }
}