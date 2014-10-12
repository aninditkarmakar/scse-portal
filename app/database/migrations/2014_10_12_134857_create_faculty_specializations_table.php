<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultySpecializationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculty_specializations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('specialization')->index();
			$table->integer('faculty_id')->unsigned();

			$table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('faculty_specializations');
	}

}
