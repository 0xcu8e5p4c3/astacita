<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan (opsional jika mengikuti konvensi Laravel)
    protected $table = 'seos';

    // Primary key bukan id, jadi perlu diatur
    protected $primaryKey = 'article_id';

    // Tidak menggunakan timestamps (created_at & updated_at)
    public $timestamps = false;

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['article_id', 'meta_title', 'meta_description', 'meta_keywords'];

    /**
     * Relasi: SEO hanya terkait dengan satu artikel (One to One)
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
