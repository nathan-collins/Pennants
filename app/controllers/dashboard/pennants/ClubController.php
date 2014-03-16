<?php namespace dashboard\pennants;

class ClubController extends \BaseController {

	public function showClub($clubId) {
		return \View::make('pennants.club.container')->with('clubId', $clubId);
	}
}