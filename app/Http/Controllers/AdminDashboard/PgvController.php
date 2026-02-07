<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Carousel;
use App\Models\KomentarPgv;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PgvController extends TpcController
{
    protected $section = 'PGV';
    protected $apartmentName = 'Podomoro Golf View';
    protected $roomSection = 'room_podomoro_golf_view';
    protected $commentModel = KomentarPgv::class;
    protected $apartmentCode = 'pgv';
    protected $commentSection = 'pgv';
}
