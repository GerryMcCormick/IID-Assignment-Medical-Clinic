<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('doctors', function(Blueprint $table)
            {
            	$table->increments('id');
            	$table->string('title');
                $table->string('forename');
                $table->string('surname');
                $table->text('qualifications')->nullable();
                $table->string('image')->nullable();
                $table->text('about')->nullable();
			
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
        Schema::drop('doctors');
    }
}
