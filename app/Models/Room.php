<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'apartment_type',
        'section',
        'main_image',
        'room_image_1',
        'room_image_2',
        'room_image_3',
        'room_image_4'
    ];

}
