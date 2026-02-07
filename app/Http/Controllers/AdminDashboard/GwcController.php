<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Carousel;
use App\Models\KomentarGwc;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GwcController extends TpcController
{
    protected $section = 'GWC';
    protected $apartmentName = 'Gateway Cicadas';
    protected $roomSection = 'room_gateway_cicadas';
    protected $commentModel = KomentarGwc::class;
    protected $apartmentCode = 'gwc';
    protected $commentSection = 'gwc';
}
