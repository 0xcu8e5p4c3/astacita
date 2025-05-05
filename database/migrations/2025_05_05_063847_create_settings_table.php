<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->json('value')->nullable();
            $table->string('group')->default('general');
            $table->string('type')->default('string');
            $table->timestamps();
            $table->softDeletes();
        });
        
        // Insert default settings
        DB::table('settings')->insert([
            // Tentang Astacita.co
            [
                'key' => 'site_name',
                'value' => json_encode('Astacita.co'),
                'group' => 'about',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_tagline',
                'value' => json_encode('Berita dan Informasi Terpercaya'),
                'group' => 'about',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'about_description',
                'value' => json_encode('<p>Astacita.co adalah portal berita dan informasi yang berdedikasi untuk menyajikan konten berkualitas dan terpercaya.</p>'),
                'group' => 'about',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Redaksi
            [
                'key' => 'editorial_team',
                'value' => json_encode([
                    [
                        'name' => 'John Doe',
                        'position' => 'Pemimpin Redaksi',
                        'email' => 'john@astacita.co',
                        'bio' => 'Jurnalis berpengalaman selama 15 tahun',
                        'photo' => null
                    ],
                ]),
                'group' => 'editorial',
                'type' => 'array',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Kode Etik
            [
                'key' => 'ethics_code',
                'value' => json_encode('<p>Kode Etik Jurnalistik Astacita.co mengacu pada standar profesional jurnalistik yang berlaku secara nasional.</p>'),
                'group' => 'ethics',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Pedoman Media Cyber
            [
                'key' => 'cyber_media_guidelines',
                'value' => json_encode('<p>Pedoman Media Siber Astacita.co mematuhi regulasi yang ditetapkan oleh Dewan Pers Indonesia.</p>'),
                'group' => 'guidelines',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Kontak
            [
                'key' => 'contact_email',
                'value' => json_encode('info@astacita.co'),
                'group' => 'contact',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_phone',
                'value' => json_encode('021-12345678'),
                'group' => 'contact',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_address',
                'value' => json_encode('Jl. Contoh No. 123, Jakarta Pusat, DKI Jakarta 10110'),
                'group' => 'contact',
                'type' => 'string',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};