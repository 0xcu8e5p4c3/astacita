<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmartAdsAnalytic extends Model
{
    protected $fillable = [
        'smart_ad_id',
        'impressions',
        'clicks',
        'ctr',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
        'ctr' => 'decimal:2',
    ];

    public function smartAd(): BelongsTo
    {
        return $this->belongsTo(SmartAd::class);
    }

    public function updateCtr(): self
    {
        if ($this->impressions > 0) {
            $this->ctr = ($this->clicks / $this->impressions) * 100;
            $this->save();
        }
        
        return $this;
    }
}