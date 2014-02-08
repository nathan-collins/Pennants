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
	 * @param $column
	 * @param $value
	 *
	 * @return mixed
	 */

	public function getWhere($column, $value)
	{
		return Match::where($column, $value)->get();
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
}