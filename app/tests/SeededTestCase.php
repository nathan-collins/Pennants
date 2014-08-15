<?php
/**
 * @author Matthew Morgan
 * @since Oct 25, 2013
 */

use \CVCNetwork\YesheisCatalog\Models\Item;
use \CVCNetwork\YesheisCatalog\Models\ItemProvider;

class SeededTestCase extends \TestCase {

  public function setUp()
  {
    parent::setUp();

    /**
     * install sqlite data for testing
     */
    $artisan = $this->app->make('artisan');
    $artisan->call('migrate', array('--database' => 'mysql'));
    $artisan->call('db:seed', array('--database' => 'mysql'));
  }

  protected function mockedConfigDatabaseSettings()
  {
    \Config::shouldReceive('offsetGet')->with('database.default')->andReturn('sqlite');
    \Config::shouldReceive('offsetGet')->with('database.connections.sqlite')->andReturn(array(
      'driver'   => 'sqlite',
      'database' => ':memory:',
      'prefix'   => '',
    ));
  }

}