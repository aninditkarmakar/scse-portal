<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProjectTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 50) as $index)
		{
			$project = new Project();
			
			$faculty = User::find($faker->randomNumber(1,50));
			$type = ProjectType::find($faker->randomNumber(1,2));

			$project->title = $faker->unique()->catchPhrase;

			$project->end_date = $faker->optional()->dateTimeBetween('-10 years', 'now');

			if(!is_null($project->end_date)) {
				$project->start_date = $faker->dateTimeBetween('-11 years', $project->end_date);
			} else {
				$project->start_date = $faker->dateTimeThisYear('now');
			}
			
			$project->mentor()->associate($faculty);
			$project->projectType()->associate($type);

			$project->save();

			foreach(range(1,$faker->randomNumber(1,4)) as $index) {
				$f = Faker::create();
				$project->students()->attach($f->unique()->randomNumber(1,200));
			}

			$abs = new ProjectAbstract();
			$abs->content = $faker->text(1000);
			$abs = $project->projectAbstract()->save($abs);

		}
	}

}