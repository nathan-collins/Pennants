<?php

class TeamsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('teams')->truncate();

		$now = date('Y-m-d H:i:s');

		$teams = array(
			array(
				'player_id' => 1,
				'created_at' => $now,
				'updated_at' => $now,
			),
			array(
				'player_id' => 2,
				'created_at' => $now,
				'updated_at' => $now,
			)
		);

		// Uncomment the below to run the seeder
		DB::table('teams')->insert($teams);
	}

}
