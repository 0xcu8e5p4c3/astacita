<?php
// File: database/migrations/xxxx_xx_xx_create_views_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();

            // Index untuk performa
            $table->index(['article_id', 'viewed_at']);
            $table->index('session_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('views');
    }
};
