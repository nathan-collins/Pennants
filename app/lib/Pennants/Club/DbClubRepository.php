<?php namespace Pennants\Club;

use Clubs;

class DbClubRepository implements ClubRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Clubs::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Clubs::find($id);
	}

	/**
	 * @param $column
	 * @param $value
	 *
	 * @return mixed
	 */

	public function getWhere($column, $value)
	{
		return Clubs::where($column, $value)->get();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$club = $this->get($id);

		$club->save(\Input::all());

		return $club;
	}

	/**
	 * @param $id
	 *
	 * @return bool
	 */

	public function delete($id)
	{
		$club = $this->get($id);

		if(!$club) {
			return false;
		}

		return $club->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Seasons
	 */

	public function create($data)
	{
		$club = new Clubs($data);

		$club->save($club->toArray());

		return $club;
	}
}