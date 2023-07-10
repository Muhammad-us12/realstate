<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentLedegersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_ledegers', function (Blueprint $table) {
            $table->id();
            $table->float('payment')->nullable();
            $table->float('received')->nullable();
            $table->float('balance');
            $table->integer('payment_id')->nullable();
            $table->integer('recevied_id')->nullable();
            $table->integer('file_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->foreignId('agent_id')
                    ->constrained('agents')
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
        Schema::dropIfExists('agent_ledegers');
    }
}
