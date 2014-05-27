<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript;

class GameController extends \BaseController {
	public function showGame()
	{
		return \View::make('pennants.draws.draws');
	}

	/**
	 * @return mixed
	 */

	public function addGame()
	{
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Game Add', '/dashboard/pennants/game/add');

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.game.create', $data);
	}
}