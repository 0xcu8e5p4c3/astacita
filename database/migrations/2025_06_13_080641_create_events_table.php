<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->string('event_name');
            $table->json('event_data')->nullable();
            $table->text('page_url');
            $table->timestamp('timestamp')->default(now());
            $table->timestamps();
            
            // Indexes
            $table->index('session_id');
            $table->index('event_name');
            $table->index('timestamp');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
