<?php

class GameControllerTest extends TestCase {

	public function setUp()
	{
		parent::setUp();

		$this->mock = $this->mock('Pennants\Game\GameRepositoryInterface');
	}

	public function tearDown()
	{
		\Mockery::close();
	}

	public function mock($class)
	{
		$mock = \Mockery::mock($class);

		$this->app->instance($class, $mock);

		return $mock;
	}

	/**
	 *
	 */

	public function testGameIndex()
	{
		$this->mock->shouldReceive('all')->once();

		$this->call('GET', 'api/v1/pennants/game');

		$this->assertResponseOk();
	}

}