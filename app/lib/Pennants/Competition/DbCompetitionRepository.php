<?php namespace Pennants\Competition;

use Competition;

class DbCompetitionRepository implements \CompetitionRepositoryInterface {
	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		$season = Competition::find($id)->season;
		return $season;
	}
}
