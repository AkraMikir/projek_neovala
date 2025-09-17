<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarGpc extends Model
{
    use HasFactory;

    protected $table = 'komentar_gpcs';

    protected $fillable = [
        'instagram',
        'message',
        'rating',
        'hide_identity',
        'section',
        'status',
    ];
}
