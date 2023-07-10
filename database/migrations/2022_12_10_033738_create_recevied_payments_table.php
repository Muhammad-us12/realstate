<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceviedPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recevied_payments', function (Blueprint $table) {
            $table->id();

            $table->date('date')->nullable();
            $table->float('prev_balance')->nullable();
            $table->float('updated_balance')->nullable();
            $table->float('total_received');

            $table->json('Criteria');
            $table->json('Content');
            $table->json('Content_Ids');
            $table->json('Amount');
            $table->json('remarks');

            
            $table->foreignId('received_from')
                ->constrained('cash_accounts')
                ->onDelete('cascade')
                ->nullable();

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
        Schema::dropIfExists('recevied_payments');
    }
}
