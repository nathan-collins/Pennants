<?php namespace api_v1;

use Pennants\Match\MatchRepositoryInterface;

class MatchController extends \BaseController {

	protected $match;

	public function __construct(MatchRepositoryInterface $match)
	{
		$this->match = $match;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$matches = $this->match->all();

		return \Response::json(array(
			'error' => false,
			'match' => $matches,
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
		$matches = $this->match->find($id);

		return \Response::json(array(
			'error' => false,
			'matches' => $matches,
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
		$match = $this->match->find($id);

		return \View::make('matches.edit')->with('match', $match)->with('clubs', $match);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$matches = $this->match->where('id', $id);
		// we need to do a few checks.

		if( \Request::get('club_id') && Request::get('opponent_id') ) {
			$matches->club_id = Request::get('club_id');
			$matches->opponent_id = Request::get('opponent_id');

			if($matches->club_id === $matches->opponent_id) {
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
			$matches->host_id = Request::get('host_id');
		}

		if( \Request::get('player_id') && Request('versus_id') )
		{
			$matches->player_id = Request::get('player_id');
			$matches->versus_id = Request::get('versus_id');

			if($matches->versus_id === $matches->player_id) {
				// We need to fail
				return Response::json(array(
					'error' 	=> true,
					'message' => 'The player_id and versus_id cannot be the same.',
					'code' 		=> 400
				));
			}
		}

		$matches->save();

		return \Response::json(array(
			'error' 	=> false,
			'message' => 'match updated',
			'code' 		=> 200
		));
	}


	public function getMatchBySeason($season_id, $grade_id, $club_id)
	{
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

		$match = $this->match->getWhere(array('season_id' => $season_id, 'grade_id' => $grade_id, 'club_id' => $club_id));

		return $match;
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
			'message' => 'match removed',
			'code' 		=> 200
		));
	}

}