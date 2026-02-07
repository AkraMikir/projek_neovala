<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Carousel;
use App\Models\KomentarPlu;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PluController extends TpcController
{
    protected $section = 'PLU';
    protected $apartmentName = 'Patraland Urbano';
    protected $roomSection = 'room_patraland_urbano';
    protected $commentModel = KomentarPlu::class;
    protected $apartmentCode = 'plu';
    protected $commentSection = 'plu';
}
