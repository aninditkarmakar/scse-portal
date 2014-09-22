<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$admin = Role::where('role','like','admin')->firstOrFail();
		$faculty = Role::where('role','like','faculty')->firstOrFail();

		$user = new User();
		$user->username = 'anindit';
		$user->password = Hash::make('hello123');
		$user->email = 'aninditkarmakar@yahoo.com';
		$user->save();
		$user->roles()->save($admin);

		$user = new User();
		$user->username = 'reetika';
		$user->password = Hash::make('hello123');
		$user->email = 'reetikaroy@gmail.com';
		$user->save();
		$user->roles()->save($admin);


		foreach(range(1, 100) as $index)
		{
			$user = new User();
			$user->username = $faker->unique()->userName;
			$user->password = Hash::make('hello123');
			$user->email = $faker->unique()->email;
			$user->save();
			$user->roles()->save($faculty);
		}
	}

}