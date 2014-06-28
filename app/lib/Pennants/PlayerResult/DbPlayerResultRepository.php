<?php namespace Pennants\PlayerResult;

use PlayerResult;
use Result;

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
}