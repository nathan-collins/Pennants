<?php

class GamesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('games')->truncate();

		$now = date('Y-m-d H:i:s');

		$games = array(
			array(
				'club_id' => 2,
				'opponent_id' => 4,
				'host_id' => 3,
				'player_id' => 1,
				'versus_id' => 2,
				'game_date' => $now,
				'created_at' => $now,
				'updated_at' => $now,
			),
			array(
				'club_id' => 1,
				'opponent_id' => 4,
				'host_id' => 3,
				'player_id' => 2,
				'versus_id' => 1,
				'game_date' => $now,
				'created_at' => $now,
				'updated_at' => $now,
			)
		);

		// Uncomment the below to run the seeder
		DB::table('games')->insert($games);
	}

}
