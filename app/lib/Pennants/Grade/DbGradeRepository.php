<?php namespace Pennants\Grade;

use Grades;

class DbGradeRepository implements GradeRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Grades::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Grades::find($id);
	}

	/**
	 * @param $column
	 * @param $value
	 *
	 * @return mixed
	 */

	public function getWhere($column, $value)
	{
		return Grades::where($column, $value)->get();
	}

	/**
	 * @param $id
	 * @param $region_id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$grade = $this->get($id);

		$grade->save(\Input::all());

		return $grade;
	}

	/**
	 * @param $id
	 * @param $season_id
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
		$grade = new Grades($data);

		$grade->season_id = "1";

		$grade->save($grade->toArray());

		return $grade;
	}
}