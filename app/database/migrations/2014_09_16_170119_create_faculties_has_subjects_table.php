<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultiesHasSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculties_has_subjects', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('faculty_id')->unsigned();
			$table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');

			$table->integer('subject_id')->unsigned();
			$table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('faculties_has_subjects');
	}

}
