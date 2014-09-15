<?php namespace Pennants\Grade;

use Grade;

class DbGradeRepository implements GradeRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Grade::orderBy('name')->get();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Grade::find($id);
	}


	/**
	 * @param $seasonId
	 * @param $gradeId
	 * @return mixed
	 */
	public function getSettings($seasonId, $gradeId)
	{
		return Grade::getByGrade($gradeId)->getBySeason($seasonId)->pluck('settings');
	}

	/**
	 * @param $seasonId
	 * @return mixed
	 */
	public function getGrades($seasonId)
	{
		return Grade::getBySeason($seasonId)->get();
	}

	/**
	 * @param $seasonId
	 * @return int
	 */

	public function countGrades($seasonId)
	{
		$seasons = $this->getWhere(array('season_id' => $seasonId));
		return count($seasons);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$grade = $this->find($id);

		$data = \Input::all();
		$data['settings'] = json_encode($data['settings']);

		$grade->save($data);

		return $grade;
	}

	/**
	 * @param $id
	 *
	 * @return bool
	 */

	public function delete($id)
	{
		$grade = $this->get($id);

		if(!$grade) {
			return false;
		}

		return $grade->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Seasons
	 */

	public function create($data)
	{
		$grade = new Grade($data);

		$grade->settings = json_encode($data['settings']);

		$grade->save($grade->toArray());

		return $grade;
	}
}