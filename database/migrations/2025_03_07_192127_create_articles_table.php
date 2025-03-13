<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->text('content');
            $table->foreignId('author_id')->nullable()->constrained('roles')->cascadeOnDelete();
            $table->foreignId('editor_id')->nullable()->constrained('roles')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
