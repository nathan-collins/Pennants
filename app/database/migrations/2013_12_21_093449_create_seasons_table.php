<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('seasons')) {
			Schema::create('seasons', function(Blueprint $table) {
				$table->increments('id');
				$table->string('year', 5);
				$table->string('name', 100);
				$table->integer('added_by');
				$table->timestamps();
			});
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('season');
	}

}
