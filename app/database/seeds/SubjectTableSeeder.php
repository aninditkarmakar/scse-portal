<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SubjectTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 100) as $index)
		{
			$subject = new Subject();
			$subject->subject = $faker->company;
			$subject->subject_code = $faker->unique()->bothify('CSE###');
			$subject->save();
			foreach(range(1, $faker->randomNumber(1,10)) as $index) {
				$subject->faculties()->attach($faker->randomNumber(1,100));
			}
		}
	}

}