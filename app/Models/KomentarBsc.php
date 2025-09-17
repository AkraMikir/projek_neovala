<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarBsc extends Model
{
    use HasFactory;

    protected $table = 'komentar_bscs';

    protected $fillable = [
        'instagram',
        'message',
        'rating',
        'hide_identity',
        'section',
        'status',
    ];
}
