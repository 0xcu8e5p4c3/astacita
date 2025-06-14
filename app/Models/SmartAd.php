<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class SmartAd extends Model
{
    protected $fillable = [
        'title',
        'type',
        'position',
        'content',
        'is_active',
        'priority',
        'start_date',
        'end_date',
        'target_pages',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function analytics(): HasMany
    {
        return $this->hasMany(SmartAdsAnalytic::class);
    }

    public function isActive(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();
        
        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        return true;
    }

    public function recordImpression(): void
    {
        $today = now()->toDateString();
        
        SmartAdsAnalytic::updateOrCreate(
            ['smart_ad_id' => $this->id, 'date' => $today],
            ['impressions' => \DB::raw('impressions + 1')]
        )->updateCtr();
    }

    public function recordClick(): void
    {
        $today = now()->toDateString();
        
        SmartAdsAnalytic::updateOrCreate(
            ['smart_ad_id' => $this->id, 'date' => $today],
            ['clicks' => \DB::raw('clicks + 1')]
        )->updateCtr();
    }

    public static function getActiveAds(string $type = null, string $position = null, string $page = null)
    {
        $cacheKey = "smart_ads_{$type}_{$position}_{$page}";
        
        return Cache::remember($cacheKey, 300, function () use ($type, $position, $page) {
            $query = self::where('is_active', true)
                ->where(function ($q) {
                    $q->whereNull('start_date')
                      ->orWhere('start_date', '<=', now());
                })
                ->where(function ($q) {
                    $q->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
                })
                ->orderBy('priority', 'desc');

            if ($type) {
                $query->where('type', $type);
            }

            if ($position) {
                $query->where('position', $position);
            }

            if ($page) {
                $query->where(function ($q) use ($page) {
                    $q->whereNull('target_pages')
                      ->orWhere('target_pages', 'LIKE', "%{$page}%");
                });
            }

            return $query->get();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('smart_ads_*');
        Cache::flush(); // Clear all cache if needed
    }

    protected static function booted()
    {
        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }
}