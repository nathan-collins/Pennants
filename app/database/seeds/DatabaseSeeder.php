<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$tables = array(

		);

		foreach($tables as $table) {
			DB::table($table)->truncate();
		}

		$this->call('GamesTableSeeder');
		$this->call('SeasonsTableSeeder');
		$this->call('TeamsTableSeeder');
	}

}