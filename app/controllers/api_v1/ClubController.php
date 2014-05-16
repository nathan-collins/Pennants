<?php namespace api_v1;

use Pennants\Club\ClubRepositoryInterface;

class ClubController extends \BaseController {

	protected $club;

	public function __construct(ClubRepositoryInterface $club)
	{
		$this->club = $club;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clubs = $this->club->all();

		return $clubs;
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
			return \Response::json(array(
				'code' => 201,
				'club' => $s->toArray(),
				'error' => false
			));
		} else {
			$response = $s->errors();
			if(!$s->isValid()) {
				return \Response::json(array(
					'code' => 400,
					'message' => $response,
					'error' => true
				));
			}
			// this has been updated
			return \Response::json(array(
				'code' => 202,
				'club' => $s->toArray(),
				'error' => false
			));
		}
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 *
	 * @return mixed
	 */

	public function getClubBySeason($season_id, $grade_id)
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

		$club = $this->club->getActiveClubs($season_id, $grade_id)->get();

		return $club;
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

		return $club;
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
	 * Enable/Disable the clubs status
	 *
	 * @param $status
	 * @param $id
	 */

	public function updateStatus($status, $id) {
		$s = $this->club->updateStatus($status, $id);

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