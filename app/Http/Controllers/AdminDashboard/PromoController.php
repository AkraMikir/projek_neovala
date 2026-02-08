<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->get();
        
        $apartments = [
            'TRANSPARK JUANDA',
            'TRANSPARK CIBUBUR',
            'GRAND KAMALA LAGOON',
            'PATRALAND URBANO',
            'GATEWAY CICADAS',
            'PODOMORO GOLF VIEW',
            'BASSURA',
            'GREEN PRAMUKA CITY'
        ];
        
        return view('admin.promo.index', compact('promos', 'apartments'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:5120', // Max 5MB
            'title' => 'required|string|max:255'
        ]);
        
        // Upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $customName = time() . '_' . str_replace(' ', '_', $validated['title']);
            
            $filename = ImageService::upload(
                $image,
                'promos',
                1200, 80,
                $customName
            );
            
            Promo::create([
                'image' => 'promos/' . $filename,
                'title' => $validated['title']
            ]);
            
            return redirect()->route('admin.dashboard1.promo')
                ->with('success', 'Promo berhasil ditambahkan!');
        }
        
        return redirect()->route('admin.dashboard1.promo')
            ->with('error', 'Gagal mengupload gambar!');
    }
    
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        
        // Delete image from storage
        if ($promo->image && Storage::disk('public')->exists($promo->image)) {
            Storage::disk('public')->delete($promo->image);
        }
        
        $promo->delete();
        
        return redirect()->route('admin.dashboard1.promo')
            ->with('success', 'Promo berhasil dihapus!');
    }
}
