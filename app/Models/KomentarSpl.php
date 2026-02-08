<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarSpl extends Model
{
    use HasFactory;

    protected $table = 'komentar_spls';

    protected $fillable = [
        'instagram',
        'message',
        'rating',
        'hide_identity',
        'section',
        'status',
    ];
}
