<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ratings', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('club_id');
			$table->string('tee_name');
			$table->string('tee_sex');
			$table->smallInteger('par');
			$table->smallInteger('scratch');
			$table->smallInteger('slope');
			$table->string('holes', 10)->nullable();
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
		Schema::drop('ratings');
	}

}
