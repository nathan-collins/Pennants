<?php

use Illuminate\Foundation\Testing\Client;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = TRUE;
		$testEnvironment = 'testing';

		return require __DIR__ . '/../../bootstrap/start.php';
	}


	/**
	 * Extract the path from a URL
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	public function pathFromUrl($url)
	{
		$bits = parse_url($url);
		return $bits['path'];
	}

	/**
	 * Create a new HttpKernel client instance.
	 *
	 * @param  array  $server
	 * @return \Symfony\Component\HttpKernel\Client
	 */
	protected function createClient(array $server = array())
	{
		$primaryDomain = \Config::get('route.primaryDomain');
		$server = array_merge(array('HTTP_HOST' => $primaryDomain), $server);
		return new Client($this->app, $server);
	}

}

/**
 * Class Accessor
 *
 * Provides access to Partial mock functionality, as well as exposing hidden methods and properties.
 *
 * Usages:
 *
 * $obj = new \Accessor('namespace\classname',array('constructorArgs'));
 * Creates an object that you can mock individual methods on, whilst providing full class functionality. As opposed to
 * a conventional \Mockery::mock('namespace\classname') which just gives you the shell of the class.
 *
 * $obj = new \Accessor($existingObject);
 * Provides access via the new $obj to hidden methods and properties on the $existingObject.
 *
 */
class Accessor {
	private $obj;
	private $obj_name;

	public function __construct($objectOrClassName, array $constructorArgs = array())
	{
		//Provide a new mocked class but with full access to properties and methods rather the normal husk of a class
		//created by mocking.
		if (is_string($objectOrClassName)) {
			$this->obj = \Mockery::mock($objectOrClassName, $constructorArgs)->makePartial();
			$this->obj_name = $objectOrClassName;
		}
		else {
			//Provides for only unlocking inaccessable methods and properties. No mocking of functions is available.
			$this->obj = $objectOrClassName;
			$this->obj_name = get_class($objectOrClassName);
		}
	}

	/**
	 * Call a method on the object that has been set up
	 *
	 * @param $name
	 * @param $arguments
	 *
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		$class = new \ReflectionClass($this->obj_name);
		$m = $class->getMethod($name);
		$m->setAccessible(TRUE);

		return $m->invokeArgs($this->obj, $arguments);
	}

	/**
	 * Set a property on the object that has been set up
	 *
	 * @param $property
	 * @param $value
	 */
	public function __set($property, $value)
	{
		$class = new \ReflectionClass($this->obj_name);
		$p = $class->getProperty($property);
		$p->setAccessible(TRUE);

		$p->setValue($this->obj, $value);
	}

	//  Not sure if we need this but here is a starter of maybe how to do this
	//  public function __callStatic($name, $arguments) {
	//    $this->obj->__call($name, $arguments);
	//  }

	public function shouldReceive()
	{
		if (!$this->obj instanceof \Mockery\MockInterface) {
			throw new \Exception('Object isn\'t a mock, how can I treat it as such?');
		}

		return call_user_func_array(array($this->obj, 'shouldReceive'), func_get_args());
	}

}
