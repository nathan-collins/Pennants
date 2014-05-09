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

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @return mixed
	 */
	public function getPlayerByParams($season_id, $grade_id, $club_id)
	{
		return PlayerSeason::season($season_id)->grade($grade_id)->club($club_id)->join('players', 'player_seasons.player_id', '=', 'players.id')->orderBy('player_seasons.handicap');
	}
}