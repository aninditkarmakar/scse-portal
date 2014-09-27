<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SemesterTableSeeder extends Seeder {

	public function run()
	{
		//$faker = Faker::create();
		// $sems = [
		// 	'Fall 2005-2006',
		// 	'Winter 2005-2006',
		// 	'Fall 2006-2007',
		// 	'Winter 2006-2007',
		// 	'Fall 2007-2008',
		// 	'Winter 2007-2008',
		// 	'Fall 2008-2009',
		// 	'Winter 2008-2009',
		// 	'Fall 2009-2010',
		// 	'Winter 2009-2010',
		// 	'Fall 2010-2011',
		// 	'Winter 2010-2011',
		// 	'Fall 2011-2012',
		// 	'Winter 2011-2012',
		// 	'Fall 2012-2013',
		// 	'Winter 2012-2013',
		// 	'Fall 2013-2014',
		// 	'Winter 2013-2014',
		// 	'Fall 2014-2015',
		// 	'Winter 2014-2015'
		// ];

		foreach(range(0, 14) as $index) {
			$baseYear = 2000;

			$sem = new Semester();
			$sem->type = 'Fall';
			$sem->start_year = $baseYear+$index;
			$sem->end_year = $sem->start_year + 1;
			$sem->save();

			$sem = new Semester();
			$sem->type = 'Winter';
			$sem->start_year = $baseYear+$index;
			$sem->end_year = $sem->start_year + 1;
			$sem->save();

		}
	}

}