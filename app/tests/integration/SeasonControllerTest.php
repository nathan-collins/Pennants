<?php

class SeasonControllerTest extends TestCase {

	public function setUp()
	{
		parent::setUp();

		$this->mock = $this->mock('Pennants\Season\SeasonRepositoryInterface');
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

	public function testSeasonIndex()
	{
		$this->mock->shouldReceive('all')->once();

		$this->call('GET', 'api/v1/pennants/season');

		$this->assertResponseOk();
	}

	public function testCreateSeason()
	{
		$this->call('GET', 'api/v1/pennants/season/create');

		$this->assertResponseOk();
	}

	public function testStoreSeasonFails()
	{
		$this->mock->shouldReceive('create')
			->once()
			->andReturn(Mockery::mock(array(
				'isSaved' => false,
				'errors' => array()
			)));

		$this->call('POST', 'api/v1/pennants/season');

		$this->assertRedirectedToRoute('api.v1.pennants.season.create');
		$this->assertSessionHasErrors();
	}

	public function testStoreSeasonSuccess()
	{
		$this->mock->shouldReceive('create')
			->once()
			->andReturn(Mockery::mock(array(
				'isSaved' => true
			)));

		$this->call('POST', 'api/v1/pennants/season');
		$this->assertRedirectedToRoute('api.v1.pennants.season.index');
		$this->assertSessionHas('flash');
	}

	public function testShowSeason()
	{
		$this->mock->shouldReceive('find')
			->once()
			->with(1);

		$this->call('GET', 'api/v1/pennants/season/1');

		$this->assertResponseOk();
	}

	/**
	 * Test Edit
	 */

	public function testEditSeason()
	{
		$season = \Mockery::self();

		$season->id = 1;
		$season->year = 2013;
		$season->name = "Test Entry";

		$this->mock->shouldReceive('find')
			->once()
			->with(1)
			->andReturn($season);

		$this->call('GET', 'api/v1/pennants/season/1/edit');

		$this->assertResponseOk();
	}

	public function testUpdateSeasonFails()
	{
		$this->mock->shouldReceive('update')
			->once()
			->with(1)
			->andReturn(Mockery::mock(array(
				'isSaved' => false,
				'errors' => array()
			)));

		$this->call('PUT', 'api/v1/pennants/season/1');

		$this->assertRedirectedToRoute('api.v1.pennants.season.edit', 1);
		$this->assertSessionHasErrors();
	}

	public function testUpdateSeasonSuccess()
	{
		$this->mock->shouldReceive('update')
			->once()
			->with(1)
			->andReturn(Mockery::mock(array(
				'isSaved' => true
			)));

		$this->call('PUT', 'api/v1/pennants/season/1');

		$this->assertRedirectedToRoute('api.v1.pennants.season.show', 1);
		$this->assertSessionHas('flash');
	}



}