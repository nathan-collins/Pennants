<?php namespace dashboard\pennants;

class DrawController extends \BaseController {

	public function showDraw()
	{
		return \View::make('pennants.draws.draws');
	}
}