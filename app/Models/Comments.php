<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel otomatis mengenali)
    protected $table = 'comments';

    // Tidak menggunakan timestamps karena hanya ada `created_at`
    public $timestamps = false;

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['article_id', 'user_id', 'content', 'created_at'];

    /**
     * Relasi: Komentar milik satu artikel (Many to One)
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    /**
     * Relasi: Komentar milik satu pengguna (Many to One)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
