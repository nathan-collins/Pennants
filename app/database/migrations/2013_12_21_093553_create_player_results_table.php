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
		Schema::create('player_results', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('player_id');
			$table->integer('grade_id');
			$table->integer('season_id');
			$table->integer('match_id');
			$table->smallInteger('hole');
			$table->smallInteger('score');
			$table->string('handicap', 10);
			$table->enum('status', array('up', 'down', 'square'));
			$table->enum('finished', array('Y', 'N'))->default('N');
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
		Schema::drop('player_results');
	}

}
