<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('alamat')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable(); // L: Laki-laki, P: Perempuan
            $table->string('foto_profile')->nullable();
            $table->timestamps();

            // Relasi ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
