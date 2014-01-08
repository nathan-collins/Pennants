<?php namespace Pennants\Result;

use Result;

class DbResultRepository implements ResultRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Result::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Result::find($id);
	}
}