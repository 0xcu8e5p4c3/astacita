<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('views', function (Blueprint $table) {
            $table->foreignId('article_id')->primary()->constrained('articles')->cascadeOnDelete();
            $table->integer('view_count')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
