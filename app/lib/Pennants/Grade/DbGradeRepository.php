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
	 * @param $id
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

		$grade->save($grade->toArray());

		return $grade;
	}
}