<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculties', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('user_id')->unsigned()->unique();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->string('firstname')->index();
			$table->string('lastname')->index();
			$table->mediuminteger('faculty_code')->unique();
			$table->string('cabin');

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
		Schema::drop('faculties');
	}

}
