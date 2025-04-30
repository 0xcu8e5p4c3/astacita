<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser; // Perbaiki namespace
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail; // Perbaiki namespace
use App\Notifications\CustomVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

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
    public function isUser(): bool
    {
        return $this->role === 'user';
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
        return $this->hasMany(\App\Models\Article::class, 'author_id');
    }

    /**
     * Relasi: User sebagai editor memiliki banyak artikel
     */
    public function editedArticles()
    {
        return $this->hasMany(\App\Models\Article::class, 'editor_id');
    }

    /**
     * Relasi: User memiliki banyak komentar
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'user_id');
    }

    /**
     * Relasi: User memiliki banyak like
     */
    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class, 'user_id');
    }
        public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Hak akses ke Filament Admin Panel
     */
    public function canAccessPanel(Panel $panel): bool
    
    {
        if ($panel->getId() === 'editor') {
            return true;
        }
        
        if ($panel->getId() === 'author') {
            return true;
        }
        
        if ($panel->getId() === 'user') {
            return true;
        }
        
        // Default return untuk semua kasus lainnya
        return true;
        
    }
    
    
}
