<?php namespace Pennants\Result;

use Result;

class DbResultRepository implements ResultRepositoryInterface {

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
	 * @param $season_id
	 * @param $grade_id
	 * @param $match_id
	 */
	public function getResultsByParams($season_id, $grade_id, $match_id)
	{
		return Result::getSeason($season_id)->getGrade($grade_id)->getMatch($match_id);
	}
}