<?php namespace api_v1;

use Pennants\PlayerResult\PlayerResultRepositoryInterface;
use Pennants\PlayerSeason\PlayerSeasonRepositoryInterface;
use Pennants\Player\PlayerRepositoryInterface;

class PlayerController extends \BaseController {

	protected $player;

	public function __construct(PlayerRepositoryInterface $player, PlayerSeasonRepositoryInterface $player_season, PlayerResultRepositoryInterface $player_result)
	{
		$this->player = $player;
		$this->player_season = $player_season;
		$this->player_result = $player_result;
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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$player = $this->player->getPlayerAndHandicap($id)->first();

		return $player;
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function searchPlayer($name) {
		$players = $this->player->searchPlayerByName($name)->get();

		return $players;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @return mixed
	 */
	public function getPlayerBySeason($season_id, $grade_id, $club_id) {
		if(empty($season_id)) {
			return \Response::json(array(
				'error' => true,
				'season' => array('message' => "No season supplied"),
				'code' 	=> 400
			));
		}

		if(empty($grade_id)) {
			return \Response::json(array(
				'error' => true,
				'grade' => array('message' => "No grade supplied"),
				'code' 	=> 400
			));
		}

		$player = $this->player_season->getPlayerByResults($season_id, $grade_id, $club_id)->get();

		return $player;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @return mixed
	 */
	public function getPlayerByResult($season_id, $grade_id, $club_id) {
		if(empty($season_id)) {
			return \Response::json(array(
				'error' => true,
				'season' => array('message' => "No season supplied"),
				'code' 	=> 400
			));
		}

		if(empty($grade_id)) {
			return \Response::json(array(
				'error' => true,
				'grade' => array('message' => "No grade supplied"),
				'code' 	=> 400
			));
		}

		$player = $this->player_result->getPlayerByResults($season_id, $grade_id, $club_id)->get();

		return $player;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $club_id
	 * @param $match_id
	 * @param $player_id
	 * @return mixed
	 */
	public function getPlayerByMatch($season_id, $grade_id, $club_id, $match_id, $player_id) {
		if(empty($season_id)) {
			return \Response::json(array(
				'error' => true,
				'season' => array('message' => "No season supplied"),
				'code' 	=> 400
			));
		}

		if(empty($grade_id)) {
			return \Response::json(array(
				'error' => true,
				'grade' => array('message' => "No grade supplied"),
				'code' 	=> 400
			));
		}

		$player = $this->player_result->getPlayerByMatch($season_id, $grade_id, $club_id, $match_id, $player_id)->first();

		return $player;
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