<?php namespace dashboard\pennants;

class SeasonController extends \BaseController {

	public function showSeason() {
		return \View::make('pennants.season.season');
	}

	public function addSeason() {
		return \View::make('pennants.season.create');
	}
}