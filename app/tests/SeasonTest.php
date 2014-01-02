<?php

class SeasonTest extends TestCase {

	public function __construct()
	{
		$this->mock = \Mockery::mock('Eloquent', 'Season');
	}

	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		\Mockery::close();
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

		$this->assertRedirectedToRoute('season.create');
		$this->assertSeasonHasErrors();
	}

	public function testStoreSeasonSuccess()
	{
		$this->mock->shouldReceive('create')
			->once()
			->andReturn(Mockery::mock(array(
				'isSaved' => true
			)));

		$this->call('POST', 'api/v1/pennants/season');
		$this->assertRedirectedToRoute('season.index');
		$this->assertSessionHas('flash');
	}

	public function testEditSeason()
	{
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

		$this->assertRedirectedToRoute('season.edit', 1);
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

		$this->assertRedirectedToRoute('season.edit', 1);
		$this->assertSessionHas('flash');
	}



}