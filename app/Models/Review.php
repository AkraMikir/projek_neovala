<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'user_source',
        'instagram',
        'content',
        'rating',
        'hide_identity',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'hide_identity' => 'boolean',
        'is_featured' => 'boolean',
        'rating' => 'integer',
    ];

    public function media()
    {
        return $this->hasMany(ReviewMedia::class);
    }

    public function replies()
    {
        return $this->hasMany(ReviewReply::class)->latest();
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeForLocation($query, string $location)
    {
        return $query->where('location', $location);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
