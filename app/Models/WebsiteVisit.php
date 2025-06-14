<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WebsiteVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'page_url',
        'referrer',
        'user_agent',
        'visited_at',
        'duration' // durasi dalam detik
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    // Scope untuk mendapatkan visit hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('visited_at', Carbon::today());
    }

    // Scope untuk mendapatkan visit minggu ini
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('visited_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    // Scope untuk mendapatkan visit bulan ini
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('visited_at', Carbon::now()->month)
                    ->whereYear('visited_at', Carbon::now()->year);
    }

    // Static method untuk mendapatkan data chart visit harian
    public static function getDailyVisitsChart($days = 30)
    {
        return static::query()
            ->select(\DB::raw('DATE(visited_at) as date'), \DB::raw('COUNT(DISTINCT session_id) as unique_visits'))
            ->where('visited_at', '>=', Carbon::now()->subDays($days))
            ->groupBy(\DB::raw('DATE(visited_at)'))
            ->orderBy('date')
            ->get()
            ->pluck('unique_visits', 'date')
            ->toArray();
    }

    // Static method untuk mendapatkan halaman paling populer
    public static function getPopularPages($limit = 10)
    {
        return static::query()
            ->select('page_url', \DB::raw('COUNT(*) as total_visits'))
            ->groupBy('page_url')
            ->orderBy('total_visits', 'desc')
            ->limit($limit)
            ->get();
    }
}