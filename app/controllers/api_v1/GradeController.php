<?php namespace api_v1;

use Pennants\Grade\GradeRepositoryInterface;

class GradeController extends \BaseController {

	protected $grade;

	public function __construct(GradeRepositoryInterface $grade)
	{
		$this->grade = $grade;
	}

	/**
	 * @return mixed
	 */
	public function index()
	{
		$grades = $this->grade->all();

		return $grades;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->grade->create(\Input::all());

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.grade.index')
				->with('flash', 'A new season has been created');
		}
		return \Redirect::route('api.v1.pennants.grade.create')
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * @param $season_id
	 *
	 * @return mixed
	 */

	public function getSeasons($season_id)
	{
		$grade = $this->grade->getGrades($season_id);

		return $grade;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function show($id)
	{
		$grade = $this->grade->find($id);

		return $grade;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function edit($id)
	{
		$grade = $this->grade->find($id);

		return \View::make('grade.edit')->with('grade', $grade);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function update($id)
	{
		$s = $this->grade->update($id);

		if($s->isSaved()) {

		}
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function destroy($id)
	{
		$grade = $this->grade->delete($id);

		return \Response::json(array(
			'error' => false,
			'season' => $grade,
			'code' 	=> 200
		));
	}

}