<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProjectTypeTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		
		ProjectType::create([
			'type' => 'Faculty Project'
		]);

		ProjectType::create([
			'type' => 'Semester Project'
		]);
	}

}