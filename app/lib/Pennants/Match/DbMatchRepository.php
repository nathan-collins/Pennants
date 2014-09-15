<?php namespace Pennants\Match;

use Match;

class DbMatchRepository implements MatchRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Match::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Match::find($id);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$match = $this->get($id);

		$match->save(\Input::all());

		return $match;
	}

	/**
	 * @param $id
	 *
	 * @return bool
	 */

	public function delete($id)
	{
		$match = $this->get($id);

		if(!$match) {
			return false;
		}

		return $match->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Seasons
	 */

	public function create($data)
	{
		$match = new Match($data);

		$match->save($match->toArray());

		return $match;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @return mixed
	 */
	public function getMatchesFromClub($season_id, $grade_id, $club_id)
	{
		return Match::JoinGame()->getSeason($season_id)->getGrade($grade_id)->getClubOrOpponent($club_id);
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @return mixed
	 */
	public function getMatchesFromHost($season_id, $grade_id, $club_id)
	{
		return Match::getSeason($season_id)->getGrade($grade_id)->getHost($club_id);
	}

	public function getGameFromMatch($match_id)
	{
		return Match::JoinGame()->getMatch($match_id);
	}
}