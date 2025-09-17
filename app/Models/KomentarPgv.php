<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarPgv extends Model
{
    protected $table = 'komentar_pgvs';

    protected $fillable = [
        'instagram',
        'message',
        'rating',
        'hide_identity',
        'section',
        'status',
    ];
}
