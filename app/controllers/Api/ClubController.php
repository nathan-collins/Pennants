<?php namespace Api;

use Pennants\Club\ClubRepositoryInterface;

class ClubController extends \BaseController {

	protected $clubs;

	public function __construct(ClubRepositoryInterface $clubs)
	{
		$this->club = $clubs;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clubs = $this->club->all();

		return \Response::json(array(
			'error' => false,
			'club' => $clubs->toArray(),
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
		return \View::make('clubs.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->club->create(\Input::all());

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.club.index')
				->with('flash', 'A new season has been created');
		}
		return \Redirect::route('api.v1.pennants.club.create')
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
		if(empty($season_id)) {
			return \Response::json(array(
				'error' => true,
				'season' => array('message' => "No season supplied"),
				'code' 	=> 400
			));
		}

		$club = $this->club->getWhere('season_id', $season_id);

		return \Response::json(array(
			'error' => false,
			'season' => $club->toArray(),
			'code' 	=> 200
		));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$club = $this->club->find($id);

		return \Response::json(array(
			'error' => false,
			'season' => $club->toArray(),
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
		$club = $this->club->find($id);

		return \View::make('club.edit')->with('club', $club);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$s = $this->club->update($id);

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.club.show', $id)
				->with('flash', 'The grade was updated');
		}

		return \Redirect::route('api.v1.pennants.club.edit', $id)
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
		$club = $this->club->delete($id);

		return \Response::json(array(
			'error' => false,
			'season' => $club,
			'code' 	=> 200
		));
	}

}