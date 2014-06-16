<?php namespace Pennants\PlayerResult;

use PlayerResult;

class DbPlayerResultRepository implements PlayerResultRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
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