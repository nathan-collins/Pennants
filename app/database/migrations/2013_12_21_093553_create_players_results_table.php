<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayersResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players_results', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('player_id');
			$table->integer('grade_id');
			$table->integer('game_id');
			$table->smallInteger('hole');
			$table->smallInteger('score');
			$table->enum('status', array('up', 'down'));
			$table->enum('finished', array('Y', 'N'));
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('players_results');
	}

}
