<?php namespace api_v1;

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

		return $seasons;
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

		return $s->errors();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$season = $this->season->find($id);

		return $season;
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
		$season = $this->season->delete($id);

		return \Response::json(array(
			'error' => false,
			'season' => $season,
			'code' 	=> 200
		));
	}

}