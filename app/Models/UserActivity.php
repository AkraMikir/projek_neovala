<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserActivity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'session_id',
        'ip_address',
        'user_agent',
        'activity_type',
        'page_url',
        'page_path',
        'apartment_type',
        'target_name',
        'metadata'
    ];
    
    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    // --- SCOPES FOR EASY FILTERING ---
    
    public function scopeVisits($query)
    {
        return $query->where('activity_type', 'visit');
    }
    
    public function scopeBookNowClicks($query)
    {
        return $query->where('activity_type', 'click_book_now');
    }
    
    public function scopePromoDownloads($query)
    {
        return $query->where('activity_type', 'click_download_promo');
    }
    
    public function scopeFormSubmissions($query)
    {
        return $query->where('activity_type', 'submit_form');
    }
    
    public function scopeComments($query)
    {
        return $query->where('activity_type', 'submit_comment');
    }
    
    public function scopeDateRange($query, $startDate, $endDate)
    {
        // Pastikan format tanggal benar (Y-m-d 00:00:00 s/d Y-m-d 23:59:59)
        if ($startDate && $endDate) {
            return $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }
        return $query;
    }
    
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }
}
