<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media'; // Nama tabel di database
    protected $fillable = ['article_id', 'file_path', 'file_type', 'uploaded_at'];

    public $timestamps = false; // Karena kolom `uploaded_at` sudah ada dan diatur otomatis

// Model Media
public function getOriginalNameAttribute(): ?string
{
    $file = pathinfo($this->file_path, PATHINFO_FILENAME);

    if (!Str::contains($file, '-')) {
        return null;
    }

    $b64 = Str::afterLast($file, '-');
    $b64 = strtr($b64, '-_', '+/');

    $pad = strlen($b64) % 4;
    if ($pad) {
        $b64 .= str_repeat('=', 4 - $pad);
    }

    $decoded = base64_decode($b64);

    return $decoded ?: null;
}



    /**
     * Relasi ke model Article (Many-to-One)
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
