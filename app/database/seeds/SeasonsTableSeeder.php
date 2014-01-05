<?php

class SeasonsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('seasons')->truncate();

		$seasons = Seasons::create(
			array(
				'year' => '2015',
				'name' => 'Test Entry',
			)
		);

		$faker = Faker\Factory::create();

		for ($i = 0; $i < 100; $i++)
		{
			$seasons = Seasons::create(
				array(
					'year' => $faker->year+1,
					'name' => $faker->name
				)
			);
		}

		// Uncomment the below to run the seeder
		DB::table('seasons')->insert($seasons);
	}

}
