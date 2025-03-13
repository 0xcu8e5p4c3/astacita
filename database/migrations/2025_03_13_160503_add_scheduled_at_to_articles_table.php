<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dateTime('scheduled_at')->nullable()->after('published_at'); // Waktu publikasi otomatis
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('scheduled_at');
        });
    }
};
