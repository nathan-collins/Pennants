<?php namespace Api;

use Pennants\Team\TeamRepositoryInterface;

class TeamController extends \BaseController {

	protected $team;

	public function __construct(TeamRepositoryInterface $team)
	{
		$this->team = $team;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$teams = $this->team->all();

		return \Response::json(array(
			'error' => false,
			'player' => $teams->toArray(),
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
		return \View::make('api.teams.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->team->create(\Input::all());

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.team.index')
				->with('flash', 'A new season has been created');
		}
		return \Redirect::route('api.v1.pennants.team.create')
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
		$team = $this->team->find($id);

		return \Response::json(array(
			'error' => false,
			'player' => $team->toArray(),
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
		$team = $this->team->find($id);

		return \View::make('api.team.edit')->with('team', $team);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$s = $this->team->update($id);

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.team.show', $id)
				->with('flash', 'The player was updated');
		}

		return \Redirect::route('api.v1.pennants.team.edit', $id)
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
		$team = $this->team->delete($id);

		return \Response::json(array(
			'error' => false,
			'player' => $team,
			'code' 	=> 200
		));
	}

}