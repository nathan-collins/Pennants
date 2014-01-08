<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class SeasonUnitTest extends TestCase {

	public function __construct()
	{
		// Prepare FactoryMuff
		$this->factory = new FactoryMuff;
	}


	/**
	 * Test the name field is required
	 */

	public function testSeasonNameIsRequired()
	{
		$season = $this->factory->create('Season');

		$user = $this->factory->create('User');

		$season->name = "";

		$this->assertFalse($user->save($season->toArray()));

		$errors = $season->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The name field is required.");
	}

	public function testSeasonYearIsNumeric()
	{
		$season = new Season();

		$user = $this->factory->create('User');

		$season->name = "Test Entry";
		$season->year = "Test";
		$season->added_by = $user->id;

		$this->assertFalse($user->seasons()->save($season->toArray()));

		$errors = $season->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The year must be a number.");
	}

	public function testSeasonYearIsRequired()
	{
		$season = $this->factory->create('Season');

		$user = $this->factory->create('User');

		$season->year = "";

		$this->assertFalse($user->seasons()->save($season->toArray()));

		$errors = $season->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The year field is required.");
	}

	/**
	 *
	 */

	public function testAddedByIsRequired()
	{
		$season = new Season();

		$season->name = "Test Entry";
		$season->year = "Test";

		$this->assertFalse($season->save());

		$errors = $season->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The added by field is required.");
	}

	/**
	 * Test season saves correctly
	 */

	public function testSeasonSavesCorrectly()
	{
		// Create a new season
		$season = $this->factory->create('Season');

		$this->assertTrue($season->save($season->toArray()));
	}
}