<?php namespace api_v1;

use Pennants\Competition\CompetitionRepositoryInterface;

class CompetitionController extends BaseController {

	/**
	 * @param CompetitionRepositoryInterface $competition
	 */

	protected $competition;

	public function __construct(CompetitionRepositoryInterface $competition)
	{
		$this->competition = $competition;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$seasons = $this->competition->all();

		return $seasons;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->competition->create(\Input::all());

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.season.index')
				->with('flash', 'A new season has been created');
		}

		return $s->errors();
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function searchCompetition($name) {
		$players = $this->competition->searchCompetitionByName($name)->get();

		return $players;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$competition = $this->competition->find($id);

		return $competition;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$s = $this->competition->update($id);

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.season.show', $id)
				->with('flash', 'The season was updated');
		}

		return \Response::json(array(
			'error' => true,
			'season' => $s->errors(),
			'code'	=> 400
		));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$competition = $this->competition->delete($id);

		return \Response::json(array(
			'error' => false,
			'season' => $competition,
			'code' 	=> 200
		));
	}
}