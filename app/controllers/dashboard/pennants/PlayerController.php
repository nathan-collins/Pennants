<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class PlayerController extends \BaseController {

	public function showPlayer($clubId) {
		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.club.container');
	}

	public function addPlayer($clubId) {
		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.player.create');
	}
}