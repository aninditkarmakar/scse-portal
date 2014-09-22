<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProjectTagTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$tags = [
			'machine-learning',
			'image-processing',
			'neural-networks',
			'computer-networks',
			'hadoop',
			'distributed-systems',
			'operating-systems',
			'data-structures',
			'computer-architecture',
			'algorithms'];
		foreach(range(0, 9) as $index)
		{
			ProjectTag::create([
				'tag' => $tags[$index],
			]);
		}
	}

}