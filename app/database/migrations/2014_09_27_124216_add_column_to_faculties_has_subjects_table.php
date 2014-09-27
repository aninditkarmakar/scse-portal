<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnToFacultiesHasSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('faculties_has_subjects', function(Blueprint $table)
		{
			$table->integer('semester_id')->unsigned()->nullable();
			$table->foreign('semester_id')->references('id')->on('semesters')->onDelete('set null');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('faculties_has_subjects', function(Blueprint $table)
		{
			$table->dropForeign('faculties_has_subjects_semester_id_foreign');
			$table->dropColumn('semester_id');
		});
	}

}
