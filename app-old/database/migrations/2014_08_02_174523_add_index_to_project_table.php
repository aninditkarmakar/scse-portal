<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIndexToProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project', function(Blueprint $table)
		{
			$table->foreign('faculty_id')->references('id')->on('faculty')->onDelete('set null');
			$table->foreign('type_id')->references('id')->on('project_type')->onDelete('set null');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project', function(Blueprint $table)
		{
			$table->dropForeign('project_faculty_id_foreign');
			$table->dropForeign('project_type_id_foreign');
		});
	}

}
