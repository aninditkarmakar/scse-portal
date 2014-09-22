<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIndexToFacultyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('faculty', function(Blueprint $table)
		{
			$table->index('firstname');
			$table->index('lastname');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('faculty', function(Blueprint $table)
		{
			$table->dropIndex('faculty_firstname_index');
			$table->dropIndex('faculty_lastname_index');
		});
	}

}
