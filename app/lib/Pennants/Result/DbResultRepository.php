<?php namespace Pennants\Repositories;

use Pennants\Interfaces;
use Results;

class DbResultRepository implements Interfaces\ResultRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function getAll()
	{
		return Results::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Results::findOrFail($id);
	}
}