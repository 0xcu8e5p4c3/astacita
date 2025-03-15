<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'slug'];

    /**
     * Mutator: Set slug otomatis berdasarkan name.
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Relasi: Kategori memiliki banyak artikel (One to Many)
     */
    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class, 'category_id');
    }
}
