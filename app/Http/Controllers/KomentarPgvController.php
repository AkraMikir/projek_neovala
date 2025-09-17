<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomentarPgv;

class KomentarPGvController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
        'instagram' => 'nullable|string|max:30',
        'message' => 'required|string|max:72',
        'rating' => 'required|integer|min:1|max:5',
        'hideIdentity' => 'nullable|in:on',
    ]);

    KomentarPgv::create([
        'instagram' => $request->has('hideIdentity') ? 'Anonymous' : $request->input('instagram'),
        'message' => $validated['message'],
        'rating' => $validated['rating'],
        'hide_identity' => $request->has('hideIdentity'),
        'section' => 'pgv',
        'status' => 'pending',
    ]);

        return redirect()->back()->with('success', 'Terima kasih atas feedback Anda!');
    }

    public function accept($id)
    {
        $komentar = KomentarPgv::findOrFail($id);
        $komentar->status = 'accepted';
        $komentar->save();

        return redirect()->back()->with('success', 'Komentar telah di-apply.');
    }

    public function unapply($id)
    {
        $komentar = KomentarPgv::findOrFail($id);
        $komentar->status = 'pending';
        $komentar->save();

        return redirect()->back()->with('success', 'Komentar dikembalikan ke status pending.');
    }

    public function delete($id)
    {
        $komentar = KomentarPgv::findOrFail($id);
        $komentar->delete();
        return redirect()->back()->with('success', 'Komentar telah dihapus.');
    }
}
