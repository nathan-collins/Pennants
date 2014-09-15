<?php namespace Pennants\Result;

use Pennants\Match\MatchRepositoryInterface;
use Pennants\PlayerResult\PlayerResultRepositoryInterface;
use Pennants\PlayerSeason\PlayerSeasonRepositoryInterface;
use Pennants\Grade\GradeRepositoryInterface;
use Result;
use PlayerResult;
use Match;
use Illuminate\Support\Facades\DB;
use GolfLink;

class DbResultRepository implements ResultRepositoryInterface {

	public function __construct(PlayerSeasonRepositoryInterface $playerSeason, PlayerResultRepositoryInterface $playerResult, GradeRepositoryInterface $grade, MatchRepositoryInterface $match)
	{
		$this->playerSeason = $playerSeason;
		$this->playerResult = $playerResult;
		$this->grade = $grade;
		$this->match = $match;
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
		return Result::getSeason($season_id)->getGrade($grade_id)->getMatch($match_id)->filterStatus();
	}

	protected function buildCacheKey($data, $type)
	{
		if($type == "match") {
			$cacheKey = $data['season_id'].$data['grade_id'].$data['match_id'].$data['club_id'].$data['player_id'];
		} else {
			$cacheKey = $data['season_id'].$data['grade_id'].$data['club_id'].$data['player_id'];
		}
		return $cacheKey;
	}

	/**
	 * @param $golf_link_number
	 * @param $game_date
	 * @return number
	 */
	protected function checkForMatchHandicap($golf_link_number, $game_date)
	{
		if($golf_link_number) {
			$golfLink = new GolfLink();
			$crawler = $golfLink->initialize($golf_link_number);
			$handicap = $golfLink->getHandicapByDate($crawler, $game_date);
			return $handicap;
		}
	}

	/**
	 * @param $golf_link_number
	 * @return string
	 */
	protected function checkForCurrentHandicap($golf_link_number)
	{
		if($golf_link_number) {
			$golfLink = new GolfLink();
			$crawler = $golfLink->initialize($golf_link_number);
			$handicap = $golfLink->getHandicap($crawler);
			return $handicap;
		}
	}

	/**
	 * @param $data
	 * @return bool
	 */
	public function create($data)
	{
		$player_result = new PlayerResult($data);
		$result = new Result($data);

		$settings = $this->gradeSettings($data['season_id'], $data['grade_id']);
		$position = $this->initializePosition($data['status'], $settings);
		$result_player = ($data['player_type'] == "player") ? $data['player_id'] : $data['versus_id'];

		$exists = $this->getResultByParams($result->season_id, $result->grade_id, $result->match_id, $result_player)->first();

		if(!$exists) {
			$position_id = false;
			// Remove the status
			if($data['status'] == "Yes") {
				unset($player_result->status);
				$player_result->player_id = $result_player;
				$player_result->save($player_result->toArray());

				// We need to have a position here
				$result->position = $this->setPosition($data, $position, $settings, $player_result->player_id);

				$position_id = $this->positionExists($result->position);
			}

			if($position_id) {
				$result_update = Result::find($position_id);
				$result_update->update($result->toArray());
			} else {
				$result->save($result->toArray());
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
		}

		$game_date = $this->match->getGameFromMatch($data['match_id'])->pluck('game_date');

		// Get players handicap if the game is handicapped
		if(in_array($settings->handicapped, array('all', 'some'))) {
			$player_result['handicap'] = $this->actionHandicap($data, $game_date);
		}
		// We need to update the order again since a new player has been added
		$this->setPosition($data, $position, $settings);

		return true;
	}

	/**
	 * @param $data
	 * @param $game_date
	 * @return mixed
	 */
	protected function actionHandicap($data, $game_date)
	{
		$golf_link_number = $this->playerSeason->getPlayerByPlayerId($data['season_id'], $data['grade_id'], $data['player_id'])->pluck('golf_link_number');
		// we should cache this value for a very long time because it should never change
		if(!empty($golf_link_number)) {
			$cache_key = $this->buildCacheKey($data, "match");
			$match_handicap = \Cache::rememberForever($cache_key, function() use($golf_link_number, $game_date) {
				return $this->checkForMatchHandicap($golf_link_number, $game_date);
			});

			$cache_key = $this->buildCacheKey($data, "current");
			$day = strtotime('+1 day', 0);
			$current_handicap = \Cache::remember($cache_key, $day, function() use($golf_link_number) {
				return $this->checkForCurrentHandicap($golf_link_number);
			});
			// Update the handicap for the current selected match
			$this->playerResult->updateHandicap($match_handicap, $data);
			// Update Match Handicap
			$this->playerSeason->updateHandicap($current_handicap, $data);
		} else {
			$match_handicap = $this->playerResult->getPlayerHandicap($data['season_id'], $data['grade_id'], $data['player_id']);
		}

		return $match_handicap;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @return mixed
	 */
	protected function gradeSettings($season_id, $grade_id)
	{
		$gradeSettings = $this->grade->getSettings($season_id, $grade_id);
		$settings = json_decode($gradeSettings);

		return $settings;
	}

	/**
	 * @param $status
	 * @param $settings
	 * @return int
	 */
	protected function initializePosition($status, $settings) {
		$position = 0;
		switch($status) {
			case "Yes":
				$position = 1;
				break;
			case "Res":
				$position = $settings['players'] + 1;
				break;
			case "No":
				$position = 0;
				break;
		}
		return $position;
	}

	/**
	 * @param $position
	 * @return bool
	 */
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
		return Result::getSeason($season_id)->getGrade($grade_id)->getMatch($match_id)->getPlayer($player_id)->filterStatus();
	}

	/**
	 * @param $data
	 * @param $position
	 * @param $settings
	 * @param null $player_id
	 * @return mixed
	 */
	protected function setPosition($data, $position, $settings, $player_id = null)
	{
		$season_id = $data['season_id'];
		$grade_id = $data['grade_id'];
		$match_id = $data['match_id'];
		$club_id = $data['club_id'];

		$player_id_field = ($data['player_type'] == 'player') ? 'player_id' : 'versus_id';

		if($position == 1) {
			$players = PlayerResult::join('players', function($join) use( $season_id, $grade_id, $match_id, $club_id ) {
				$join->on('players.id', '=', 'player_results.player_id')
					->where('player_results.season_id', '=', $season_id)
					->where('player_results.grade_id', '=', $grade_id)
					->where('player_results.match_id', '=', $match_id)
					->where('player_results.club_id', '=', $club_id);
			})
				->orderBy(DB::raw('player_results.handicap * 1'))
				->groupBy('players.name')
				->get();


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