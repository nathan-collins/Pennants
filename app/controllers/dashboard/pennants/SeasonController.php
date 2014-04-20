<?php namespace dashboard\pennants;

class SeasonController extends \BaseController {

	public function showSeason() {
		return \View::make('pennants.season.season');
	}

	public function addSeason() {
		\JavaScript::put([
			'competition_id' => \Config::get('pennants.competition_id')
		]);

		return \View::make('pennants.season.create');
	}
}