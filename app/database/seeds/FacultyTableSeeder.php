<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FacultyTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 50) as $index)
		{
			User::create([
				'firstname' => $faker->firstName,
				'lastname' => $faker->lastName,
				'faculty_code' => $faker->unique()->numberBetween(10000, 70000),
				'password' => Hash::make('hello123'),
				'email' => $faker->unique()->companyEmail(),
				'cabin' => strtoupper($faker->unique()->bothify('???-###-?##')),
			]);
		}
	}

}