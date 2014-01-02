<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SeasonTableSeeder extends Seeder {

	public function run() {

		$season = array(
			array(
				'year' => '2015',
				'name' => 'Test Entry',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			),
			array(
				'year' => '2015',
				'name' => 'New Test Entry',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			)
		);

		DB::table('seasons')->insert($season);
	}
}