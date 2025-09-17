<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Promo;

class tampilanUserController extends Controller
{
    public function homeTampilanUser()
    {
        // Ambil komentar yang sudah dipublish saja
        $komentars = Komentar::where('published', true)->latest()->get();

        // Ambil semua promo terbaru
        $promos = Promo::latest()->get();

        // Kirim semua data ke view user.index
        return view('user.index', compact('komentars', 'promos'));
    }
}