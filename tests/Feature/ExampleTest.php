<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppHealthTest extends TestCase
{
    /**
     * Daftar URL yang akan diuji.
     */
    protected array $urls = [
        '/',                // Homepage
        '/login',           // Login
        '/register',        // Register
        '/dashboard',       // Dashboard (pastikan user login untuk ini)
        '/profile',         // Halaman profil
        // Tambahkan rute lain yang ingin diuji di sini
    ];

    /**
     * Test semua halaman bisa diakses tanpa error (untuk guest).
     */
    public function test_public_pages_are_accessible()
    {
        foreach ($this->urls as $url) {
            $response = $this->get($url);
            
            // Kita anggap halaman login/redirect (302), OK (200), atau forbidden (403) masih acceptable
            $response->assertStatus(fn($status) => in_array($status, [200, 302, 403]));
        }
    }

    /**
     * Test halaman terproteksi bisa diakses setelah login.
     */
    public function test_protected_pages_after_login()
    {
        $user = \App\Models\User::factory()->create();

        $protectedUrls = [
            '/dashboard',
            '/profile',
            // Tambahkan rute proteksi lain
        ];

        foreach ($protectedUrls as $url) {
            $response = $this->actingAs($user)->get($url);
            $response->assertStatus(200);
        }
    }
}
