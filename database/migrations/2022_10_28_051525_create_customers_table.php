<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('custfname');
            $table->string('custlname');
            $table->string('email');
            $table->string('CNIC')->unique();
            $table->string('customer_type');
            $table->string('picture');
            $table->string('country');
            $table->string('city');
            $table->string('phone');
            $table->string('address');
            $table->integer('user_id');
            $table->float('opening_bal');
            $table->string('status')->default('active');
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
        Schema::dropIfExists('customers');
    }
}
