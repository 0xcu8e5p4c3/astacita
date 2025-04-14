<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini (opsional jika mengikuti konvensi Laravel)
    protected $table = 'articles';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'title', 'slug', 'content', 'author_id', 'editor_id', 'category_id', 'is_featured', 'published', 'published_at','scheduled_at', 'status'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected $dates = [
        'published_at',
        'scheduled_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($article) {
            if ($article->scheduled_at && now()->greaterThanOrEqualTo($article->scheduled_at)) {
                $article->published = true;
                $article->published_at = now();
            }
        });
    }

    /**
     * Mutator: Set slug otomatis berdasarkan title.
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Relasi: Artikel memiliki satu kategori (Many to One)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relasi: Artikel memiliki satu penulis (Many to One)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relasi: Artikel memiliki satu editor (Many to One)
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    /**
     * Relasi: Artikel memiliki banyak tag (Many to Many)
     */
    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'article_tag', 'article_id', 'tag_id');
    }

    /**
     * Relasi: Artikel memiliki banyak komentar (One to Many)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    /**
     * Relasi: Artikel memiliki banyak likes (One to Many)
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'article_id');
    }

    /**
     * Relasi: Artikel memiliki banyak views (One to Many)
     */
    public function views()
    {
        return $this->hasMany(View::class, 'article_id');
    }
        /**
     * Relasi: Artikel memiliki 1 cover
     */
    public function media()
    {
        return $this->hasOne(Media::class, 'article_id');
    }

    
}
