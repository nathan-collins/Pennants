<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class MatchController extends \BaseController {

	/**
	 * @param $teamId
	 * @return mixed
	 */

	public function showMatch($hostId)
	{
		JavaScript::put([
			'hostId' => $hostId
		]);

		return \View::make('pennants.match.match');
	}

	public function addMatch($hostId)
	{
		JavaScript::put([
			'hostId' => $hostId
		]);

		return \View::make('pennants.match.create');
	}
}