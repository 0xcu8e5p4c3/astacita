<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('smart_ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['banner', 'popup', 'sidebar', 'inline']);
            $table->enum('position', ['top', 'bottom', 'left', 'right', 'center']);
            $table->json('content'); // Stores image_url, link_url, alt_text
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(1);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('target_pages')->nullable(); // home,about,blog
            $table->timestamps();
        });

        Schema::create('smart_ads_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('smart_ad_id')->constrained()->onDelete('cascade');
            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->decimal('ctr', 5, 2)->default(0); // Click Through Rate
            $table->date('date');
            $table->timestamps();
            
            $table->unique(['smart_ad_id', 'date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('smart_ads_analytics');
        Schema::dropIfExists('smart_ads');
    }
};