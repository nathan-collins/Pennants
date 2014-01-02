<?php
use Carbon\Carbon;

class GamesTest extends TestCase {

	public function __construct()
	{
		$this->mock = \Mockery::mock('Eloquent', 'Games');
	}

	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		\Mockery::close();
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

	/**
	 *
	 */

	public function testGamesCreate()
	{
		// Create the game
		$games = new Games;
		$games->club_id 		= "2";
		$games->opponent_id = "4";
		$games->host_id 		= "3";
		$games->player_id		= "1";
		$games->versus_id		= "2";
		$games->game_date		= Carbon::now();
		$games->created_at	= Carbon::now();
		$games->updated_at	= Carbon::now();

		// User should save
		$this->assertTrue($games->save());
	}

}