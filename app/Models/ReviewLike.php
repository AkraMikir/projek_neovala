<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewLike extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'review_id',
        'visitor_id',
        'ip_address',
        'session_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
