<?php namespace dashboard\pennants;

class PlayerController extends \BaseController {

	public function showPlayer($clubId) {
		return \View::make('pennants.club.container')->with('clubId', $clubId);
	}

	public function addPlayer($clubId) {
		return \View::make('pennants.club.create')->with('clubId', $clubId);
	}
}