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
	 *
	 *
	 * @param array $rows
	 * @return mixed
	 */

	public function getWhere($rows)
	{
		foreach($rows as $column => $value) {
			$club = Club::where($column, '=', $value);
		}

		return $club->orderBy('name')->get();
	}

	/**
	 * @param $seasonId
	 * @param $gradeId
	 * @return int
	 */

	public function countClubs($seasonId, $gradeId) {
		$clubs = $this->getWhere(array('season_id' => $seasonId, 'grade_id' => $gradeId));
		return count($clubs);
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
	 * @param $status
	 * @param $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
	 */

	public function updateStatus($status, $id)
	{
		$club = Club::find($id);

		$club->active = 'Y';

		if($status == 'disabled') {
			$club->active = 'N';
		}

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

		$exists = $this->getClubByParams($club->name, $club->season_id, $club->grade_id);

		if(count($exists) == 0) {
			$club->save($club->toArray());
		} else {
			foreach($exists as $club) {
				$club = $club;
			}
		}

		return $club;
	}

	public function getClubByParams($name, $season_id, $grade_id)
	{
		return Club::name($name)->season($season_id)->grade($grade_id);
	}
}