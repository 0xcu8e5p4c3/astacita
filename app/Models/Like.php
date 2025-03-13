<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel otomatis mengenali)
    protected $table = 'likes';

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['user_id', 'article_id'];

    /**
     * Relasi: Like terkait dengan satu artikel
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    /**
     * Relasi: Like terkait dengan satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
