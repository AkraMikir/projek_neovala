<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Carousel.php
class Carousel extends Model
{
    protected $fillable = ['section', 'image1', 'image2', 'image3', 'image4'];
}