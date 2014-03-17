<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class ClubController extends \BaseController {

	public function showClub($clubId) {
		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.club.container');
	}

	/**
	 * @return mixed
	 */

	public function addClub() {
		return \View::make('pennants.club.create');
	}
}