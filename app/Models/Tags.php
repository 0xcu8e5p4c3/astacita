<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini (opsional jika mengikuti konvensi Laravel)
    protected $table = 'tags';

    // Primary key (opsional, Laravel otomatis mengenali `id` sebagai primary key)
    protected $primaryKey = 'id';

    // Menonaktifkan timestamps karena tidak ada `created_at` dan `updated_at` di migration
    public $timestamps = false;

    // Mass assignable attributes
    protected $fillable = ['name'];

    /**
     * Relasi Many-to-Many dengan model Article.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag', 'tag_id', 'article_id');
    }
}
