<?php namespace Pennants\Season;

use Seasons;

class DbSeasonRepository implements SeasonRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Seasons::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function get($id)
	{
		return Seasons::find($id);
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
		$season = new Seasons($data);

		$season->save($season->toArray());

		return $season;
	}
}