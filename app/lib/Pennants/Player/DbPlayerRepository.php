<?php namespace Pennants\Player;

use Player;
use PlayerSeason;

class DbPlayerRepository implements PlayerRepositoryInterface {

	public function playerSeason()
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

	public function create($player_season_data)
	{
		$player_data = array(
			'name' => $player_season_data['name'],
		);

		unset($player_season_data['name']);

		$player = new Player($player_data);

		$player->settings = json_encode(array());

		$player->save($player->toArray());

		$player_season = new \PlayerSeason($player_season_data);
		$player_season->save($player_season->toArray());

		return $player;
	}
}