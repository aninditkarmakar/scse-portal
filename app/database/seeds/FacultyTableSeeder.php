<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FacultyTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$faculties = User::whereHas('roles', function($q) {
								$q->where('role', 'like', 'faculty');
							})->get();

		foreach($faculties as $user)
		{
			$faculty = new Faculty();
			$faculty->firstname = $faker->firstName;
			$faculty->lastname = $faker->lastName;
			$faculty->faculty_code = $faker->unique()->numberBetween(10000, 70000);
			$faculty->cabin = strtoupper($faker->unique()->bothify('???-###-?##'));			
			$faculty->user()->associate($user);
			$faculty->save();
		}
	}

}