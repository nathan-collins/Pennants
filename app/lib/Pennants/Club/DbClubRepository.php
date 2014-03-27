<?php namespace Pennants\Club;

use Club;

class DbClubRepository implements ClubRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Club::orderBy('name')->get();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Club::find($id);
	}

	/**
	 * @param $column
	 * @param $value
	 *
	 * @return mixed
	 */

	public function getWhere($rows = array())
	{
		foreach($rows as $column => $value) {
			$club = Club::where($column, $value);
		}

		return $club->orderBy('name')->get();
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
	 * @param $name
	 * @param $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
	 */

	public function updateName($name, $id)
	{
		$club = Club::find($id);

		$club->name = $name;

		$club->save();

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
		$club = new Club($data);

		$club->save($club->toArray());

		return $club;
	}
}