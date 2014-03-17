<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayerSeasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('player_seasons', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('player_id');
			$table->integer('season_id');
			$table->integer('club_id');
			$table->integer('grade_id');
			$table->smallInteger('handicap');
			$table->string('golf_link_number', 10);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('player_seasons');
	}

}
