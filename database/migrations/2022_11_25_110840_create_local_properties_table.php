<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_properties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('location_id')
                ->constrained('locations')
                ->onDelete('cascade');

            $table->foreignId('society_id')
                ->constrained('societies')
                ->onDelete('cascade');

            $table->string('state_type');
            $table->string('property_type');
            $table->string('area')->nullable();
            $table->string('road_size')->nullable();
            $table->string('street_size')->nullable();
            $table->string('owner_name');

            $table->float('demand_amount');

            $table->foreignId('customer_id')
            ->constrained('customers')
            ->onDelete('cascade')
            ->nullable();

            $table->foreignId('agent_id')
                ->constrained('agents')
                ->onDelete('cascade')
                ->nullable();

            $table->foreignId('marala_type')
                ->constrained('maralas')
                ->onDelete('cascade')
                ->nullable();
            
            $table->float('sale_amount')->nullable();
            $table->float('recevied_amount')->nullable();
            $table->float('remaining_amount')->nullable();
            $table->float('commission_amount')->nullable();
            
            $table->foreignId('account_id_recv')
                ->constrained('cash_accounts')
                ->onDelete('cascade')
                ->nullable();

            $table->foreignId('buyer_id')
                ->constrained('buyers')
                ->onDelete('cascade')
                ->nullable();


           
            
            $table->date('sold_date')->nullable();

        

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
        Schema::dropIfExists('local_properties');
    }
}
