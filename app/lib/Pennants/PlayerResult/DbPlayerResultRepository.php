<?php namespace Pennants\Repositories;

use Pennants\Interfaces;
use PlayerResults;

class DbPlayerResultRepository implements Interfaces\PlayerResultRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function getAll()
	{
		return PlayerResults::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return PlayerResults::find($id);
	}
}