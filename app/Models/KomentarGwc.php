<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarGwc extends Model
{
   protected $table = 'komentar_gwcs';

    protected $fillable = [
        'instagram',
        'message',
        'rating',
        'hide_identity',
        'section',
        'status',
    ];
}
