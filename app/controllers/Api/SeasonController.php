<?php namespace Api;

use Pennants\Season\SeasonRepositoryInterface;

class SeasonController extends BaseController {

	/**
	 * @param SeasonRepositoryInterface $season
	 */

	protected $season;

	public function __construct(SeasonRepositoryInterface $season)
	{
		$this->season = $season;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$seasons = $this->season->all();

		return \Response::json(array(
			'error' => false,
			'season' => $seasons->toArray(),
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
		return \View::make('season.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->season->create(\Input::all());

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.season.index')
				->with('flash', 'A new season has been created');
		}

		return \Redirect::route('api.v1.pennants.season.create')
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$season = $this->season->get($id);

		return \Response::json(array(
			'error' => false,
			'season' => $season->toArray(),
			'code' 	=> 200
		));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$season = $this->season->get($id);

		return \View::make('season.edit')->with('season', $season);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$s = $this->season->update($id);

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.season.show', $id)
				->with('flash', 'The season was updated');
		}

		return \Redirect::route('api.v1.pennants.season.edit', $id)
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$season = $this->season->delete($id);

		return \Response::json(array(
			'error' => false,
			'season' => $season,
			'code' 	=> 200
		));
	}

}