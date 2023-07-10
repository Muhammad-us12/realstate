<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerledgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerledgers', function (Blueprint $table) {
            $table->id();
            $table->float('payment')->nullable();
            $table->float('received')->nullable();
            $table->float('balance');
            $table->integer('payment_id')->nullable();
            $table->integer('recevied_id')->nullable();
            $table->integer('file_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->foreignId('customer_id')
                    ->constrained('customers')
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
        Schema::dropIfExists('customerledgers');
    }
}
