<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('website_visits', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->ipAddress('ip_address')->nullable();
            $table->string('page_url', 2048);
            $table->string('referrer', 2048)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('visited_at')->useCurrent();
            $table->integer('duration')->nullable(); // durasi dalam detik
            $table->timestamps();
            
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('website_visits');
    }
};
