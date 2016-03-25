<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('patients', function(Blueprint $table)
            {
            	$table->increments('id');
            	$table->string('title');
                $table->integer('user_id');
                $table->timestamp('dob');
                $table->integer('address_id');
                $table->integer('doctor_id');
                $table->string('phone');
                $table->integer('reminder_id')->default(1); // no reminder
			
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
        Schema::drop('patients');
    }
}
