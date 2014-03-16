<?php namespace Pennants\Player;

use Player;

class DbPlayerRepository implements PlayerRepositoryInterface {

	public function playerSeasons()
	{
		return $this->hasMany('PlayerSeason');
	}

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Player::has('player_seasons')->get();
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
	 * @param $rows
	 *
	 * @return mixed
	 */

	public function getWhere($rows)
	{
		foreach($rows as $column => $value) {
			return Player::where($column, $value)->get();
		}
	}

	/**
	 * @param $id
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