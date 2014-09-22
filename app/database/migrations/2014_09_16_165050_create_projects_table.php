<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->index();
			
			$table->integer('type_id')->unsigned()->nullable();
			$table->foreign('type_id')->references('id')->on('project_types')->onDelete('set null');
			
			$table->integer('faculty_id')->unsigned()->nullable();
			$table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('set null');

			$table->date('start_date')->index();
			$table->date('end_date')->index();			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
