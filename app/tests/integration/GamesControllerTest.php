<?php

class GamesControllerTest extends TestCase {

	public function setUp()
	{
		parent::setUp();

		$this->mock = $this->mock('Pennants\Game\DbGameRepository');
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

	public function testIndex()
	{
		$this->mock
			->shouldReceive('all')
			->once()
			->andReturn($this->mock);

		$this->app->instance('Games', $this->mock);

		$this->call('GET', 'api/v1/pennants/game');

		$this->assertResponseOk();
	}

}