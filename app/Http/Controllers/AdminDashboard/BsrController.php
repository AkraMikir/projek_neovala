<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Carousel;
use App\Models\KomentarBsr;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BsrController extends TpcController
{
    protected $section = 'BSR';
    protected $apartmentName = 'Bassura';
    protected $roomSection = 'room_bassura';
    protected $commentModel = KomentarBsr::class;
    protected $apartmentCode = 'bsr';
    protected $commentSection = 'bsr';
}
