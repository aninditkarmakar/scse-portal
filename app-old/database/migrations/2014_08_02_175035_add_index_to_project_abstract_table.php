<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIndexToProjectAbstractTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_abstract', function(Blueprint $table)
		{
			$table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project_abstract', function(Blueprint $table)
		{
			$table->dropForeign('project_abstract_project_id_foreign');
		});
	}

}
