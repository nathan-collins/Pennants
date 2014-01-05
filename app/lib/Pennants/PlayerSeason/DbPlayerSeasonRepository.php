<?php namespace Pennants\PlayerSeason;

use PlayerSeasons;

class DbPlayerSeasonRepository implements PlayerSeasonRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return PlayerSeasons::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return PlayerSeasons::find($id);
	}
}