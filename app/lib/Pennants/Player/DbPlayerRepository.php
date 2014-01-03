<?php namespace Pennants\Player;

use Players;

class DbPlayerRepository implements PlayerRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Players::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function get($id)
	{
		return Players::find($id);
	}

	/**
	 * @param $column
	 * @param $value
	 *
	 * @return mixed
	 */

	public function getWhere($column, $value)
	{
		return Players::where($column, $value)->get();
	}

	/**
	 * @param $id
	 * @param $region_id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$player = $this->get($id);

		$player->save(\Input::all());

		return $player;
	}

	/**
	 * @param $id
	 * @param $season_id
	 *
	 * @return bool
	 */

	public function delete($id)
	{
		$player = $this->get($id);

		if(!$player) {
			return false;
		}

		return $player->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Players
	 */

	public function create($data)
	{
		$player = new Players($data);

		$player->season_id = "1";

		$player->save($player->toArray());

		return $player;
	}
}