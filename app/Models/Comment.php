<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'section',
        'instagram',
        'message',
        'rating',
        'hide_identity',
        'status'
    ];
}