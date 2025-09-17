<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Room;

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

}
