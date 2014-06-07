<?php namespace Pennants\Player;

use Player;
use PlayerSeason;

class DbPlayerRepository implements PlayerRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Player::leftJoin('player_seasons', 'players.id', '=', 'player_seasons.player_id')->get();
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
		$player_data = array(
			'name' => $data['name'],
		);

		unset($data['name']);

		$player = new Player($player_data);

		$player->settings = json_encode(array());

		$player->save($player->toArray());

		$player_season_data = $this->playerSeasonData($player, $data);

		$player_season = new PlayerSeason($player_season_data);
		$player_season->save($player_season->toArray());

		return $player;
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function searchPlayerByName($name)
	{
		return Player::join('player_seasons', function($join) use ($name)
		{
			$join->on('players.id', '=', 'player_seasons.player_id')
					 ->where('players.name', 'LIKE', '%'.$name.'%');
		});
	}

	private function playerSeasonData($player, $data)
	{
		$player_season_data = array(
			'player_id' 				=> $player->id,
			'season_id' 				=> $data['season_id'],
			'club_id' 					=> $data['club_id'],
			'grade_id'		 			=> $data['grade_id'],
			'golf_link_number' 	=> isset($data['golf_link_number']) ? $data['golf_link_number'] : '',
			'handicap' 					=> $data['handicap']
		);

		return $player_season_data;
	}

	/**
	 * @param $playerId
	 * @return mixed
	 */

	public function getPlayerById($playerId)
	{
		return PlayerSeason::where('player_id', $playerId);
	}
}