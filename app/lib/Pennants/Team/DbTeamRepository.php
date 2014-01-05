<?php namespace Pennants\Team;

use Teams;

class DbTeamRepository implements TeamRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Teams::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Teams::find($id);
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
		$team = new Seasons($data);

		$team->save($team->toArray());

		return $team;
	}
}