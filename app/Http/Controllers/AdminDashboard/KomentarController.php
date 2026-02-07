<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index()
    {
        $komentars = Komentar::latest()->get();
        return view('admin.komentar.index', compact('komentars'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apartmen' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'bintang' => 'required|integer|min:1|max:5'
        ]);
        
        Komentar::create($validated);
        
        return redirect()->route('admin.dashboard1.komentar')
            ->with('success', 'Testimonial berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'apartmen' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'bintang' => 'required|integer|min:1|max:5'
        ]);
        
        $komentar = Komentar::findOrFail($id);
        $komentar->update($validated);
        
        return redirect()->route('admin.dashboard1.komentar')
            ->with('success', 'Testimonial berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();
        
        return redirect()->route('admin.dashboard1.komentar')
            ->with('success', 'Testimonial berhasil dihapus!');
    }
}
