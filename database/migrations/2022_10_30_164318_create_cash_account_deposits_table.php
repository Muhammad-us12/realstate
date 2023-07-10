<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashAccountDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_account_deposits', function (Blueprint $table) {
            $table->id();
            $table->float('deposit_amount');
            $table->string('deposit_by');
            $table->integer('user_id');
             $table->foreignId('account_id')
                    ->constrained('cash_accounts')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('cash_account_deposits');
    }
}
