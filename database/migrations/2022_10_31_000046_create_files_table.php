<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no');

            $table->foreignId('location_id')
                ->constrained('locations')
                ->onDelete('cascade');

            $table->foreignId('society_id')
                ->constrained('societies')
                ->onDelete('cascade');

            $table->foreignId('block_id')
                ->constrained('blocks')
                ->onDelete('cascade');

            $table->foreignId('account_id')
                ->constrained('cash_accounts')
                ->onDelete('cascade');

            $table->foreignId('account_id_recv')
                ->constrained('cash_accounts')
                ->onDelete('cascade')
                ->nullable();

            $table->foreignId('marala_type')
                ->constrained('maralas')
                ->onDelete('cascade');

            $table->float('purchase_amount');
            
            $table->float('sale_amount')->nullable();
            $table->float('recevied_amount')->nullable();
            $table->float('remaining_amount')->nullable();
            $table->float('commission_amount')->nullable();
            $table->date('purchase_date');
            
            $table->date('sold_date')->nullable();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->onDelete('cascade')
                ->nullable();

            $table->foreignId('agent_id')
                ->constrained('agents')
                ->onDelete('cascade')
                ->nullable();

            $table->string('state_type');
            $table->string('description')->nullable();
            $table->string('status')->default('pending');
            $table->boolean('purc_post_status')->default(false);
            $table->boolean('sale_post_status')->default(false);
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
        Schema::dropIfExists('files');
    }
}
