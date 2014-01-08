<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class GradeUnitTest extends TestCase {

	public function __construct()
	{
		// Prepare FactoryMuff
		$this->factory = new FactoryMuff;
	}

	public function testGradeNameIsRequired()
	{
		$season = $this->factory->create('Season');
		$grade = $this->factory->create('Grade');

		$user = $this->factory->create('User');

		$grade->name = "";

		$grade->users()->save($user->toArray());

		$this->assertFalse($grade->users);

		$season->grades()->save($grade->toArray());

		$this->assertFalse($season->grades);

		$errors = $grade->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The name field is required.");
	}

	public function testGradeSeasonIdIsRequired()
	{
		$grade = new Grade;

		$grade->name = "Test Entry";

		$this->assertFalse($grade->save());

		$errors = $grade->errors()->all();

		$this->assertCount(1, $errors);

		$this->assertEquals($errors[0], "The season id field is required.");
	}

	public function testGradeSavesCorrectly()
	{
		$grade = $this->factory->create('Grade');

	 	$this->assertTrue($grade->save());
	}

	public function testRelationshipWithSeason()
	{
		$grade = $this->factory->create('Grade');

		$this->assertEquals($grade->season_id, $grade->season->id);
	}
}