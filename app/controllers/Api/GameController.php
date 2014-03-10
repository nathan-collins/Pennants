<?php namespace Api;

use Pennants\Game\GameRepositoryInterface;

class GameController extends BaseController {

	protected $game;

	public function __construct(GameRepositoryInterface $game)
	{
		$this->game = $game;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$games = $this->game->all();

		return $games;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->game->create(\Input::all());

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.game.index')
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
		$games = $this->game->find($id);

		return $games;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 *
	 * @return mixed
	 */

	public function getGameBySeason($season_id, $grade_id)
	{
		if(empty($season_id)) {
			return \Response::json(array(
				'season' => array('message' => "No season supplied")
			));
		}

		if(empty($grade_id)) {
			return \Response::json(array(
				'grade' => array('message' => "No grade supplied")
			));
		}

		$game = $this->game->getWhere(array('season_id' => $season_id, 'grade_id' => $grade_id));

		return $game;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$games = $this->game->where('id', $id);
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