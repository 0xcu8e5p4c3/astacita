<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->nullable()->constrained('articles')->cascadeOnDelete();
            $table->text('file_path');
            $table->enum('file_type', ['image', 'video']);
            $table->string('mime_type')->nullable(); // Menyimpan detail tipe file
            $table->timestamps(); // Menambahkan created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
