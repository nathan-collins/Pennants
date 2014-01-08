<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('users')) {
			Schema::create('users', function(Blueprint $table)
			{
				$table->increments('id');
				$table->string('username')->unique();
				$table->string('password');
				$table->string('firstname')->nullable();
				$table->string('lastname')->nullable();
				$table->string("email")->unique();
				$table->timestamps();
				$table->softDeletes();
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
		Schema::drop('users');
	}

}
