<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id', 
        'session_id',
        'user_agent',
        'referrer',
        'viewed_at'
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Scope untuk mendapatkan views hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('viewed_at', Carbon::today());
    }

    // Scope untuk mendapatkan views minggu ini
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('viewed_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    // Scope untuk mendapatkan views bulan ini
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('viewed_at', Carbon::now()->month)
                    ->whereYear('viewed_at', Carbon::now()->year);
    }

    // Static method untuk mendapatkan top artikel berdasarkan views
    public static function getTopArticles($limit = 10, $period = 'all')
    {
        $query = static::query()
            ->select('article_id', \DB::raw('COUNT(*) as total_views'))
            ->with('article:id,title,slug')
            ->groupBy('article_id');

        switch ($period) {
            case 'today':
                $query->today();
                break;
            case 'week':
                $query->thisWeek();
                break;
            case 'month':
                $query->thisMonth();
                break;
        }

        return $query->orderBy('total_views', 'desc')
                    ->limit($limit)
                    ->get();
    }

    // Static method untuk mendapatkan data chart views harian
    public static function getDailyViewsChart($days = 30)
    {
        return static::query()
            ->select(\DB::raw('DATE(viewed_at) as date'), \DB::raw('COUNT(*) as views'))
            ->where('viewed_at', '>=', Carbon::now()->subDays($days))
            ->groupBy(\DB::raw('DATE(viewed_at)'))
            ->orderBy('date')
            ->get()
            ->pluck('views', 'date')
            ->toArray();
    }
}