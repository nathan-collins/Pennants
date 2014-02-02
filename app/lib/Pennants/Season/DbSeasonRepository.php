<?php namespace Pennants\Season;

use Season;

class DbSeasonRepository implements SeasonRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Season::orderBy('name')->get();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Season::find($id);
	}

	/**
	 * Update season entry
	 *
	 * @param $id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$season = $this->get($id);

		$season->save(\Input::all());

		return $season;
	}

	public function delete($id)
	{
		$season = $this->get($id);

		if(!$season) {
			return false;
		}

		return $season->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Seasons
	 */

	public function create($data)
	{
		$season = new Season($data);

		$season->save($season->toArray());

		return $season;
	}
}