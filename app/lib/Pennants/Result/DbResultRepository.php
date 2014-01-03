<?php namespace Pennants\Result;

use Results;

class DbResultRepository implements ResultRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Results::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function get($id)
	{
		return Results::find($id);
	}
}