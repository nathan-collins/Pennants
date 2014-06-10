<?php namespace Pennants\Competition;

use Competition;

class DbCompetitionRepository implements CompetitionRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Competition::get();
	}


	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		$competition = Competition::leftJoin('seasons', 'seasons.competition_id', '=', 'competitions.id')->where('seasons.competition_id', '=', $id)->get();
		return $competition;
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function searchCompetitionByName($name)
	{
		return Competition::leftJoin('seasons', function($join) use ($name)
		{
			$join->on('seasons.id', '=', 'competitions.id')
				->where('competitions.name', 'LIKE', '%'.$name.'%');
		});
	}
}
