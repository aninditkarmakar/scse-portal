<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnToFacultiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('faculties', function(Blueprint $table)
		{
			$table->string('designation', 45)->after('user_id')->nullable();
			$table->string('mobile_no')->after('user_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('faculties', function(Blueprint $table)
		{
			$table->dropColumn('designation');
			$table->dropColumn('mobile_no');
		});
	}

}
