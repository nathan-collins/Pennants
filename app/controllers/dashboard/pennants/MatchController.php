<?php namespace dashboard\pennants;

class MatchController extends \BaseController {

	/**
	 * @param $teamId
	 * @return mixed
	 */

	public function showMatch($clubId)
	{
		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.match.match');
	}
}