<?php namespace Pennants\PlayerSeason;

use PlayerSeason;
use Illuminate\Support\Facades\DB;

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
	public function getPlayerBySeasons($season_id, $grade_id, $club_id)
	{
		return PlayerSeason::getSeason($season_id)
			->getGrade($grade_id)
			->getClub($club_id)
			->join('players', 'player_seasons.player_id', '=', 'players.id')
			->orderBy(DB::raw('player_seasons.handicap * 1'));
	}


	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @return mixed
	 */
	public function getPlayerByResults($season_id, $grade_id, $club_id)
	{
		return PlayerSeason::getSeason($season_id)
			->getGrade($grade_id)
			->getClub($club_id)
			->leftJoin('player_results', 'player_seasons.player_id', '=', 'player_results.player_id')
			->join('players', 'players.id', '=', 'player_seasons.player_id')
			->orderBy(DB::raw('player_results.handicap * 1'));
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $player_id
	 * @return mixed
	 */
	public function getPlayerHandicap($season_id, $grade_id, $player_id)
	{
		return PlayerSeason::getSeason($season_id)->getGrade($grade_id)->getPlayer($player_id)->pluck('handicap');
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $player_id
	 * @return mixed
	 */
	public function getPlayerByPlayerId($season_id, $grade_id, $player_id)
	{
		return PlayerSeason::getSeason($season_id)->getGrade($grade_id)->getPlayer($player_id);
	}

	/**
	 * @param $handicap
	 * @param $data
	 * @param $player_id / $versus_id
	 */
	public function updateHandicap($handicap, $data, $player_id)
	{
		$playerSeason = PlayerSeason::getSeason($data['season_id'])->getGrade($data['grade_id'])->getPlayer($player_id)->first();
		$playerSeason->handicap = $handicap;
		$playerSeason->save();
	}
}