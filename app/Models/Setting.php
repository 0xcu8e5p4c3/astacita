<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['key', 'value', 'group', 'type'];

    protected $casts = [
        'value' => 'json' // Laravel akan otomatis decode ke array atau object
    ];

    /**
     * Get a setting by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getSetting($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Get all settings by group
     *
     * @param string $group
     * @return \Illuminate\Support\Collection
     */
    public static function getSettingsByGroup($group)
    {
        return self::where('group', $group)->get()->pluck('value', 'key');
    }

    /**
     * Get all settings as key-value pairs
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getAllSettings()
    {
        return self::all()->pluck('value', 'key');
    }
}
