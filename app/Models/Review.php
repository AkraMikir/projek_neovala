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
        'likes',
    ];

    protected $casts = [
        'hide_identity' => 'boolean',
        'is_featured' => 'boolean',
        'rating' => 'integer',
        'likes' => 'integer',
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

    /** Mengembalikan nama lokasi untuk tampilan (slug → nama lengkap, untuk data lama). */
    public static function locationDisplay(?string $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }
        $slugToName = [
            'tpj' => 'Transpark Juanda',
            'tpc' => 'Transpark Cibubur',
            'gkl' => 'Grand Kamala Lagoon',
            'plu' => 'Patraland Urbano',
            'gwc' => 'Gateway Cicadas',
            'pgv' => 'Podomoro Golf View',
            'gpc' => 'Green Pramuka City',
            'bsr' => 'Bassura City',
            'spl' => 'Spring Lake Summarecon',
            'utama' => 'Keseluruhan',
            'keseluruhan' => 'Keseluruhan',
        ];
        return $slugToName[$value] ?? $value;
    }
}
