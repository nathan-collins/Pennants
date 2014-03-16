<?php namespace dashboard\pennants;

class GameController extends \BaseController {
	public function showGame()
	{
		return \View::make('pennants.draws.draws');
	}

	public function addGame()
	{
		return \View::make('pennants.game.create');
	}
}