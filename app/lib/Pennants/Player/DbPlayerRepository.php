<?php namespace Pennants\Player;

use Player;

class DbPlayerRepository implements PlayerRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Player::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Player::find($id);
	}

	/**
	 * @param $column
	 * @param $value
	 *
	 * @return mixed
	 */

	public function getWhere($column, $value)
	{
		return Player::where($column, $value)->get();
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
		$player = new Player($data);

		$player->settings = json_encode(array());

		$player->save($player->toArray());

		return $player;
	}
}