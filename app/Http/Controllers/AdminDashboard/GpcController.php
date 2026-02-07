<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Carousel;
use App\Models\KomentarGpc;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GpcController extends TpcController
{
    protected $section = 'GPC';
    protected $apartmentName = 'Green Pramuka City';
    protected $roomSection = 'room_green_pramuka_city';
    protected $commentModel = KomentarGpc::class;
    protected $apartmentCode = 'gpc';
    protected $commentSection = 'gpc';
}
