<?php namespace dashboard\pennants;

class MatchController extends \BaseController {

	/**
	 * @param $teamId
	 * @return mixed
	 */

	public function showMatch($teamId)
	{
		return \View::make('pennants.match.match')->with('temId', $teamId);
	}
}