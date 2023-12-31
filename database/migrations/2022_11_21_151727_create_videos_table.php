<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_link');
            $table->string('status')->default('pending');
            $table->text('description');
            $table->foreignId('video_category')
                    ->constrained('video_categories')
                    ->onDelete('cascade');

            $table->foreignId('scoiety_id')
                    ->constrained('societies')
                    ->onDelete('cascade');

            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
