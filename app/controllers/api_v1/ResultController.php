<?php namespace api_v1;

use Pennants\Result\ResultRepositoryInterface;

class ResultController extends \BaseController {

	public function __construct(ResultRepositoryInterface $result)
	{
		$this->result = $result;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$results = $this->result->all();

		return $results;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->result->create(\Input::all());

		if($s->isSaved()) {

		}
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $match_id
	 * @return mixed
	 */
	public function getResultsByMatch($season_id, $grade_id, $match_id)
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

		$result = $this->result->getResultsByParams($season_id, $grade_id, $match_id)->get();

		return $result;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$result = $this->result->find($id);

		return $result;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getResultFromMatch($season_id, $grade_id, $match_id)
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

		$result = $this->result->getResultsByParams($season_id, $grade_id, $match_id)->orderBy('position')->get();

		return $result;
	}

}