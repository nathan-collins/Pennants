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
		$season = new Seasons;

		$season->name = "";
		$season->year = "2013";

		$this->assertFalse($season->save($season->toArray()));

		$errors = $season->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The name field is required.");
	}

	public function testSeasonYearIsNumeric()
	{
		$season = new Seasons;

		$season->name = "Test Entry";
		$season->year = "text";

		$this->assertFalse($season->save($season->toArray()));

		$errors = $season->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The year must be a number.");
	}

	public function testSeasonYearIsRequired()
	{
		$season = new Seasons;

		$season->name = "Test Entry";
		$season->year = "";

		$this->assertFalse($season->save($season->toArray()));

		$errors = $season->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The year field is required.");
	}

	/**
	 * Test season saves correctly
	 */

	public function testSeasonSavesCorrectly()
	{
		// Create a new season
		$season = new Seasons;

		$season->year = "2013";
		$season->name = "Test Entry";

		$this->assertTrue($season->save($season->toArray()));
	}
}