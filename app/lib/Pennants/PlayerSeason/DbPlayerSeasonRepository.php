<?php namespace Pennants\PlayerSeason;

use PlayerSeason;

class DbPlayerSeasonRepository implements PlayerSeasonRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return PlayerSeason::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return PlayerSeason::find($id);
	}
}