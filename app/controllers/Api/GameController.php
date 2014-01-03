<?php namespace Api;

use Pennants\Game\GameRepositoryInterface;

class GameController extends \BaseController {

	protected $games;

	public function __construct(GameRepositoryInterface $games)
	{
		$this->games = $games;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$games = $this->games->all();

		return \Response::json(array(
			'error' => false,
			'game' => $games,
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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$games = $this->games->get($id);

		return \Response::json(array(
			'error' => false,
			'games' => $games,
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
		$game = $this->games->get($id);
		$clubs = $this->clubs->where();

		return \View::make('games.edit')->with('game', $game)->with('clubs', $clubs);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$games = $this->games->where('id', $id);
		// we need to do a few checks.

		if( \Request::get('club_id') && Request::get('opponent_id') ) {
			$games->club_id = Request::get('club_id');
			$games->opponent_id = Request::get('opponent_id');

			if($games->club_id === $games->opponent_id) {
				// We need to fail
				return Response::json(array(
					'error' 	=> true,
					'message' => 'The club_id and opponent_id cannot be the same.',
					'code' 		=> 400
				));
			}
		}

		if( \Request::get('host_id') )
		{
			$games->host_id = Request::get('host_id');
		}

		if( \Request::get('player_id') && Request('versus_id') )
		{
			$games->player_id = Request::get('player_id');
			$games->versus_id = Request::get('versus_id');

			if($games->versus_id === $games->player_id) {
				// We need to fail
				return Response::json(array(
					'error' 	=> true,
					'message' => 'The player_id and versus_id cannot be the same.',
					'code' 		=> 400
				));
			}
		}

		$games->save();

		return \Response::json(array(
			'error' 	=> false,
			'message' => 'game updated',
			'code' 		=> 200
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
		return \Response::json(array(
			'error' 	=> false,
			'message' => 'game removed',
			'code' 		=> 200
		));
	}

}