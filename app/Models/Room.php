<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
    'section',
    'folder',
    'main_photo',
    'popup1',
    'popup2',
    'popup3',
    'popup4'
];

}