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
		
		$this->call('SemesterTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('FacultyTableSeeder');
		$this->call('StudentTableSeeder');
		$this->call('ProjectTagTableSeeder');
		$this->call('ProjectTypeTableSeeder');
		$this->call('ProjectTableSeeder');
		$this->call('SubjectTableSeeder');
	}

}
