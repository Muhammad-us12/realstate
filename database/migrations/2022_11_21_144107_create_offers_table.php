<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('picture');
            $table->string('status')->default('pending');
            $table->text('description');
            $table->foreignId('offer_category')
                    ->constrained('offers_categories')
                    ->onDelete('cascade');

            $table->foreignId('offer_location')
                    ->constrained('locations')
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
        Schema::dropIfExists('offers');
    }
}
