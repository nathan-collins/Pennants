<?php namespace Pennants\Repositories;

use Pennants\Interfaces;
use Players;

class DbPlayerRepository implements Interfaces\PlayerRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function getAll()
	{
		return Players::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Players::findOrFail($id);
	}
}