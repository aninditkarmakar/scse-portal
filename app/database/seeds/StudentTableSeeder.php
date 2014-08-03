<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class StudentTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 200) as $index)
		{
			Student::create([
				'firstname' => $faker->firstName,
				'lastname' => $faker->lastName,
				'reg_no' => strtoupper($faker->unique()->bothify('##???0###')),
			]);
		}
	}

}