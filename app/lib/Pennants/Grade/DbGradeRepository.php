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
	 * @param $rows
	 *
	 * @return mixed
	 */

	public function getWhere($rows)
	{
		foreach($rows as $column => $value) {
			$grade = Grade::where($column, '=', $value);
		}

		return $grade->orderBy('name')->get();
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
		$settings = array();

		$grade = new Grade($data);

		foreach($data as $key => $setting) {
			if(strpos($key, 'settings_') !== false) {
				$key = strstr($key, '_');
				$settings[ltrim($key, '_')] = $setting;
			}
		}

		$grade->settings = json_encode($settings);

		$grade->save($grade->toArray());

		return $grade;
	}
}