<?php namespace Api;

use Pennants\Player\PlayerRepositoryInterface;
use Pennants\Grade\GradeRepositoryInterface;

class PlayerController extends \BaseController {

	protected $player;
	protected $game;

	public function __construct(PlayerRepositoryInterface $player, GradeRepositoryInterface $grade)
	{
		$this->player = $player;
		$this->grade = $grade;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$players = $this->player->all();

		return \Response::json(array(
			'error' => false,
			'player' => $players->toArray(),
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
		return \View::make('api.players.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->player->create(\Input::all());

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.player.index')
				->with('flash', 'A new season has been created');
		}
		return \Redirect::route('api.v1.pennants.player.create')
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * @param $season_id
	 *
	 * @return mixed
	 */

	public function getClub($club_id)
	{
		$player = $this->grade->getWhere('club_id', $club_id);

		return \Response::json(array(
			'error' => false,
			'player' => $player->toArray(),
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
		$player = $this->player->get($id);

		return \Response::json(array(
			'error' => false,
			'player' => $player->toArray(),
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
		$player = $this->player->get($id);

		return \View::make('player.edit')->with('player', $player);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$s = $this->player->update($id);

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.player.show', $id)
				->with('flash', 'The player was updated');
		}

		return \Redirect::route('api.v1.pennants.player.edit', $id)
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
		$player = $this->player->delete($id);

		return \Response::json(array(
			'error' => false,
			'player' => $player,
			'code' 	=> 200
		));
	}

}