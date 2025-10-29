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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            
            // Basic Site Info
            $table->string('site_name')->nullable();
            $table->string('site_tagline')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->text('about_description')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('about_short_description')->nullable();
            $table->year('year_established')->nullable();
            
            // Editorial Team (JSON field)
            $table->json('editorial_team')->nullable();
            $table->text('editorial_statement')->nullable();
            
            // Ethics Code
            $table->text('ethics_code')->nullable();
            $table->date('ethics_last_updated')->nullable();
            
            // Cyber Media Guidelines
            $table->text('cyber_media_guidelines')->nullable();
            $table->date('guidelines_last_updated')->nullable();
            $table->string('guidelines_reference')->nullable();
            
            // Contact Information
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('contact_address')->nullable();
            $table->text('maps_embed_code')->nullable();
            
            // Social Media
            $table->string('social_facebook')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_linkedin')->nullable();

            // API CMC
            $table->text('coinmarketcap_api_key')->nullable();
            $table->boolean('crypto_ticker_enabled')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};