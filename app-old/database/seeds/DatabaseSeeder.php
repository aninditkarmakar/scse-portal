<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('FacultyTableSeeder');
		$this->call('StudentTableSeeder');
		$this->call('ProjectTypeTableSeeder');
		$this->call('ProjectTableSeeder');
	}

}
