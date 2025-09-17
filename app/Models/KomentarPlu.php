<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarPlu extends Model
{
    protected $table = 'komentar_plus';

    protected $fillable = [
        'instagram',
        'message',
        'rating',
        'hide_identity',
        'section',
        'status',
    ];
}