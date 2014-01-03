<?php namespace Api;

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

		return \Response::json(array(
			'error' => false,
			'grade' => $grades->toArray(),
			'code'	=> 200
		));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('grades.create');
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
		$grade = $this->grade->getWhere('season_id', $season_id);

		return \Response::json(array(
			'error' => false,
			'season' => $grade->toArray(),
			'code' 	=> 200
		));
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function show($id)
	{
		$grade = $this->grade->get($id);

		return \Response::json(array(
			'error' => false,
			'season' => $grade->toArray(),
			'code' 	=> 200
		));
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function edit($id)
	{
		$grade = $this->grade->get($id);

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
			return \Redirect::route('api.v1.pennants.grade.show', $id)
				->with('flash', 'The grade was updated');
		}

		return \Redirect::route('api.v1.pennants.grade.edit', $id)
			->withInput()
			->withErrors($s->errors());
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