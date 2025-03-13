<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan kolom role
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cek apakah user adalah seorang Author
     */
    public function isAuthor(): bool
    {
        return $this->role === 'author';
    }

    /**
     * Cek apakah user adalah seorang Editor
     */
    public function isEditor(): bool
    {
        return $this->role === 'editor';
    }

    /**
     * Relasi: User sebagai author memiliki banyak artikel
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * Relasi: User sebagai editor memiliki banyak artikel
     */
    public function editedArticles()
    {
        return $this->hasMany(Article::class, 'editor_id');
    }

    /**
     * Relasi: User memiliki banyak komentar
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * Relasi: User memiliki banyak like
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }
}
