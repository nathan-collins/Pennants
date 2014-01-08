<?php namespace Pennants\PlayerResults;

use PlayerResult;

class DbPlayerResultRepository implements PlayerResultRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function getAll()
	{
		return PlayerResult::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return PlayerResult::find($id);
	}
}