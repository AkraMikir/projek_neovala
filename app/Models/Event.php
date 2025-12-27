<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_name',
        'ip_address',
        'user_agent',
        'url',
        'referrer',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Scope untuk mendapatkan unique visitors
     */
    public function scopeUniqueVisitors($query, $startDate = null, $endDate = null)
    {
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->where('event_name', 'visit')
            ->distinct('ip_address')
            ->count('ip_address');
    }

    // Scope untuk filter event berdasarkan nama
    public function scopeEventName($query, $eventName)
    {
        return $query->where('event_name', $eventName);
    }

    // Scope untuk filter berdasarkan tanggal
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    // Method untuk mendapatkan statistik event
    public static function getEventStats($eventName = null, $days = 30)
    {
        $query = self::where('created_at', '>=', now()->subDays($days));
        
        if ($eventName) {
            $query->where('event_name', $eventName);
        }
        
        return $query->count();
    }

    // Method untuk mendapatkan statistik harian
    public static function getDailyStats($eventName = null, $days = 7)
    {
        $query = self::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date');
        
        if ($eventName) {
            $query->where('event_name', $eventName);
        }
        
        return $query->get();
    }
}
