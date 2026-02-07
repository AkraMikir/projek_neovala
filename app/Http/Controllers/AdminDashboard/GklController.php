<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Carousel;
use App\Models\KomentarGkl;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GklController extends TpcController
{
    protected $section = 'GKL';
    protected $apartmentName = 'Grand Kamala Lagoon';
    protected $roomSection = 'room_grand_kamala_lagoon';
    protected $commentModel = KomentarGkl::class;
    protected $apartmentCode = 'gkl';
    protected $commentSection = 'gkl';
}
