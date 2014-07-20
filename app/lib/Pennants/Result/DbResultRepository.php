<?php namespace Pennants\Result;

use Pennants\PlayerResult\PlayerResultRepositoryInterface;
use Pennants\PlayerSeason\PlayerSeasonRepositoryInterface;
use Pennants\Grade\GradeRepositoryInterface;
use Result;
use PlayerResult;
use Illuminate\Support\Facades\DB;

class DbResultRepository implements ResultRepositoryInterface {

	public function __construct(PlayerSeasonRepositoryInterface $playerSeason, PlayerResultRepositoryInterface $playerResult, GradeRepositoryInterface $grade)
	{
		$this->playerSeason = $playerSeason;
		$this->playerResult = $playerResult;
		$this->grade = $grade;
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
	 * @param $data
	 * @param $result_id
	 */
	public function update($data, $result_id)
	{

	}

	/**
	 * @param $set_data
	 * @param $match_id
	 * @param $position
	 * @return mixed
	 */
	public function updatePosition($set_data, $match_id, $position)
	{
		$result = Result::getMatch($match_id)->getPosition($position)->first();

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
		$position = $this->initializePosition($data['status']);

		$result_player = ($data['player_type'] == "player") ? $data['player_id'] : $data['versus_id'];

		$player_result = new PlayerResult($data);
		// Get players handicap
		$player_result['handicap'] = $this->playerSeason->getPlayerHandicap($result_player)->pluck('handicap');

		$result = new Result($data);

		$exists = $this->getResultByParams($result->season_id, $result->grade_id, $result->match_id, $result_player)->first();

		if(!$exists) {
			unset($player_result->status);
			$player_result->player_id = $result_player;
			$player_result->save($player_result->toArray());
			// We need to have a position here
			$result->position = $this->setPosition($data['match_id'], $data['season_id'], $data['grade_id'], $data['club_id'], $player_result->player_id, $data['player_type'], $position);
			$position_id = $this->positionExists($result->position);
			if($position_id) {
				$result_update = Result::find($position_id);
				$result_update->update($result->toArray());
				$this->setPosition($data['match_id'], $data['season_id'], $data['grade_id'], $data['club_id'], null, $data['player_type'], $position);
			} else {
				$result->save($result->toArray());
				// We need to update the order again since a new player has been added
				$this->setPosition($data['match_id'], $data['season_id'], $data['grade_id'], $data['club_id'], null, $data['player_type'], $position);
			}
		} else {
			$player_exists = $this->playerResult->playerExists($result_player, $data['season_id'], $data['grade_id'], $data['match_id']);
			if(!$player_exists) {
				unset($player_result->status);
				$player_result->player_id = $result_player;
				$player_result->save($player_result->toArray());
				$result_update = Result::find($exists->id);
				$result_update->update($result->toArray());
			}
			$result->position = $this->setPosition($data['match_id'], $data['season_id'], $data['grade_id'], $data['club_id'], null, $data['player_type'], $position);
		}
	}

	protected function initializePosition($status) {
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
		return $position;
	}

	protected function positionExists($position)
	{
		$id = Result::getPosition($position)->pluck('id');
		if($id) {
			return $id;
		}
		return false;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $match_id
	 * @param $player_id
	 * @return mixed
	 */
	protected function getResultByParams($season_id, $grade_id,  $match_id, $player_id)
	{
		return Result::getSeason($season_id)->getGrade($grade_id)->getMatch($match_id)->getPlayer($player_id);
	}

	/**
	 * @param $match_id
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @param $player_id
	 * @param $player_type
	 * @param $position
	 * @return mixed
	 */
	protected function setPosition($match_id, $season_id, $grade_id, $club_id, $player_id, $player_type, $position)
	{
		$player_id_field = ($player_type == 'player') ? 'player_id' : 'versus_id';

		if($position == 1) {
			$players = PlayerResult::join('players', function($join) use( $season_id, $grade_id, $match_id, $club_id ) {
				$join->on('players.id', '=', 'player_results.player_id')
					->where('player_results.season_id', '=', $season_id)
					->where('player_results.grade_id', '=', $grade_id)
					->where('player_results.match_id', '=', $match_id)
					->where('player_results.club_id', '=', $club_id);
			})->orderBy(DB::raw('player_results.handicap * 1'))->get();

			if(count($players) > 0) {
				foreach($players as $player) {
					if($player->id !== $player_id) {
						// Update the position
						$this->updatePosition(array('position' => $position, $player_id_field => $player->id), $player->match_id, $position);
						$position++;
					}
				}
			}

		}

		return $position;
	}
}