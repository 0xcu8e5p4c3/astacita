<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel otomatis mengenali)
    protected $table = 'media';

    // Tidak menggunakan timestamps default Laravel (created_at & updated_at)
    public $timestamps = false;

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['article_id', 'file_path', 'file_type', 'uploaded_at'];

    /**
     * Relasi: Media terkait dengan satu artikel (Many to One)
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
