<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media'; // Nama tabel di database
    protected $fillable = ['article_id', 'file_path', 'file_type', 'uploaded_at'];

    public $timestamps = false; // Karena kolom `uploaded_at` sudah ada dan diatur otomatis

    /**
     * Relasi ke model Article (Many-to-One)
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
