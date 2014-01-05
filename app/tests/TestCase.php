<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	public function __call($method, $args)
	{
		if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
		{
			return $this->call($method, $args[0]);
		}

		throw new BadMethodCallException;
	}

	public function setUp()
	{
		parent::setUp(); // Don't forget this!

		$this->prepareForTests();
	}

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	/**
	 * Prepare for tests
	 */
	private function prepareForTests()
	{
		Artisan::call('migrate');
	}

}
