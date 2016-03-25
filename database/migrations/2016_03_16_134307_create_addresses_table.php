<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('addresses', function(Blueprint $table)
            {
            	$table->increments('id');
            	$table->string('add_line_1');
                $table->string('add_line_2')->nullable();
                $table->string('town');
                $table->string('postcode');
			
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
        Schema::drop('addresses');
    }
}
