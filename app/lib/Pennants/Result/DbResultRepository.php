<?php namespace Pennants\Result;

use Pennants\PlayerResult\PlayerResultRepositoryInterface;
use Pennants\PlayerSeason\PlayerSeasonRepositoryInterface;
use Result;
use PlayerResult;
use Illuminate\Support\Facades\DB;

class DbResultRepository implements ResultRepositoryInterface {

	public function __construct(PlayerSeasonRepositoryInterface $playerSeason, PlayerResultRepositoryInterface $playerResult)
	{
		$this->playerSeason = $playerSeason;
		$this->playerResult = $playerResult;
	}

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Result::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Result::find($id);
	}

	/**
	 * @param $set_data
	 * @param $match_id
	 * @param $player_id
	 * @return mixed
	 */
	public function update($set_data, $match_id, $player_id)
	{
		$result = Result::getMatch($match_id)->getPlayer($player_id);

		$result->save($set_data);

		return $result;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $match_id
	 */
	public function getResultsByParams($season_id, $grade_id, $match_id)
	{
		return Result::getSeason($season_id)->getGrade($grade_id)->getMatch($match_id);
	}

	/**
	 * @param $data
	 */
	public function create($data)
	{
		$player_result = new PlayerResult($data);
		$result_player = ($data['player_type'] == "player") ? $data['player_id'] : $data['versus_id'];
		$player_result['handicap'] = $this->playerSeason->getPlayerHandicap($result_player)->pluck('handicap');
		$data['position'] = $this->position($data['status'], $data['match_id'], $data['season_id'], $data['grade_id'], $data['club_id']);
		$result = new Result($data);

		$exists = $this->getResultByParams($result->season_id, $result->grade_id, $data['position'], $result->match_id)->first();

		if(!$exists) {
			$result->save($result->toArray());
			unset($player_result->status);
			$player_result->save($player_result->toArray());
		} else {
			$result_update = Result::find($exists->id);
			$result_update->update($result->toArray());
			$player_exists = $this->playerResult->playerExists($result_player, $data['season_id'], $data['grade_id'], $data['match_id']);
			if(!$player_exists) {
				unset($player_result->status);
				$player_result->player_id = $result_player;
				$player_result->save($player_result->toArray());
			}
		}
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $position
	 * @param $match_id
	 * @return mixed
	 */
	protected function getResultByParams($season_id, $grade_id, $position,  $match_id)
	{
		return Result::getSeason($season_id)->getGrade($grade_id)->getPosition($position)->getMatch($match_id);
	}

	/**
	 * @param $player_id
	 * @param $status
	 * @param $match_id
	 * @param $season_id
	 * @param $grade_id
	 * @param $handicap
	 * @param $club_id
	 * @return int
	 */
	protected function position($status, $match_id, $season_id, $grade_id, $club_id)
	{
		$position = 0;
		switch($status) {
			case "Yes":
				$position = 1;
				break;
			case "Res":
				$position = 8;
				break;
			case "No":
				$position = 0;
				break;
		}

		if($position == 1) {
			$players = Result::join('players', function($join) use( $season_id, $grade_id, $match_id ) {
				$join->on('players.id', '=', 'results.player_id')
					->where('results.season_id', '=', $season_id)
					->where('results.grade_id', '=', $grade_id)
					->where('results.match_id', '=', $match_id)
					->where('results.status', '=', 'Yes');
			})
			->leftJoin('player_results', function($join) use( $season_id, $grade_id, $match_id ) {
				$join->on('player_results.player_id', '=', 'results.player_id')
					->where('results.season_id', '=', $season_id)
					->where('results.grade_id', '=', $grade_id)
					->where('results.match_id', '=', $match_id)
					->where('results.status', '=', 'Yes');
			})
			->join('player_seasons', function($join) use ($club_id) {
				$join->on('player_seasons.player_id', '=', 'results.player_id')
					->where('player_seasons.club_id', '=', $club_id);
			})->orderBy(DB::raw('player_results.handicap * 1'))->get();

			if(count($players) > 0) {
				foreach($players as $player) {
					// Update the position
					$this->update(array('position' => $position), $player->match_id, $player->player_id);
					$position++;
				}
			}

		}

		return $position;
	}
}