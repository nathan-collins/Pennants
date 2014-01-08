<?php namespace Pennants\Team;

use Team;

class DbTeamRepository implements TeamRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Team::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Team::find($id);
	}

	/**
	 * Update season entry
	 *
	 * @param $id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$team = $this->get($id);

		$team->save(\Input::all());

		return $team;
	}

	public function delete($id)
	{
		$team = $this->get($id);

		if(!$team) {
			return false;
		}

		return $team->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Seasons
	 */

	public function create($data)
	{
		$team = new Team($data);

		$team->save($team->toArray());

		return $team;
	}
}