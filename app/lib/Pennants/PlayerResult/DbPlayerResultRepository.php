<?php namespace Pennants\PlayerResult;

use PlayerResult;
use Illuminate\Support\Facades\DB;

class DbPlayerResultRepository implements PlayerResultRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return PlayerResult::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return PlayerResult::find($id);
	}

	/**
	 * @param $data
	 */
	public function create($data)
	{
		// We need to insert to player_results and also into results so we can pull back results via player or match.

		// results will need to be updated after a match has finished

		// player_results will need to be updated regularly
	}

	public function PlayerResultsData()
	{
		$playerResultsData = new \stdClass();
		$playerResultsData->player_id;
		$playerResultsData->season_id;
		$playerResultsData->grade_id;
		$playerResultsData->match_id;
		$playerResultsData->hole;
		$playerResultsData->score;
		$playerResultsData->status = 'square';
		$playerResultsData->finished = 'N';

		return $playerResultsData;
	}

	public function ResultData()
	{
		$resultData = new \stdClass();
		$resultData->game_id;
		$resultData->player_id;
		$resultData->versus_id;
		$resultData->result;
		$resultData->season_id;
		$resultData->grade_id;
		$resultData->position;
		return $resultData;
	}

	public function playerExists($player_id, $season_id, $grade_id, $match_id)
	{
		$player = PlayerResult::getSeason($season_id)->getgrade($grade_id)->getMatch($match_id)->getPlayer($player_id)->count();
		if($player) {
			return true;
		}
		return false;
	}

	/**
	 * @param $handicap
	 * @param $data
	 */
	public function updateHandicap($handicap, $data)
	{
		$playerSeason = PlayerResult::getSeason($data['season_id'])->getgrade($data['grade_id'])->getMatch($data['match_id'])->getPlayer($data['player_id'])->first();
		$playerSeason->handicap = $handicap;
		$playerSeason->save();
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $player_id
	 * @param $match_id
	 * @return mixed
	 */
	public function getPlayerByPlayerId($season_id, $grade_id, $match_id, $player_id)
	{
		return PlayerResult::getSeason($season_id)->getGrade($grade_id)->getMatch($match_id)->getPlayer($player_id);
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @return mixed
	 */
	public function getPlayerByResults($season_id, $grade_id, $club_id)
	{
		return PlayerResult::getSeason($season_id)->getGrade($grade_id)->getClub($club_id)->join('players', 'player_results.player_id', '=', 'players.id')->orderBy(DB::raw('player_results.handicap * 1'));
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @param $match_id
	 * @param $player_id
	 * @return mixed
	 */
	public function getPlayerByMatch($season_id, $grade_id, $club_id, $match_id, $player_id)
	{
		return PlayerResult::getSeason($season_id)->getGrade($grade_id)->getClub($club_id)->getMatch($match_id)->getPlayer($player_id)->leftJoin('players', 'player_results.player_id', '=', 'players.id')->filterAvailability();
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $player_id
	 * @return mixed
	 */
	public function getPlayerHandicap($season_id, $grade_id,$player_id)
	{
		return PlayerResult::getSeason($season_id)->getGrade($grade_id)->getPlayer($player_id)->pluck('handicap');
	}

	/**
	 * @param $availability
	 * @param $data
	 */
	public function updateAvailability($availability, $data)
	{
		$playerSeason = PlayerResult::getSeason($data['season_id'])->getGrade($data['grade_id'])->getPlayer($data['player_id'])->getClub($data['club_id'])->first();
		$playerSeason->availability = $availability;
		$playerSeason->save();
	}
}