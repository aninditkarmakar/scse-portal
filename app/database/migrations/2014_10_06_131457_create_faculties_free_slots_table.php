<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultiesFreeSlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculties_free_slots', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('day',15);
			$table->tinyInteger('from_time')->unsigned();
			$table->tinyInteger('to_time')->unsigned();
			$table->integer('faculty_id')->unsigned();

			$table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
			// $table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('faculties_free_slots');
	}

}
