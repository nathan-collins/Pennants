<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript;
use Mj\Breadcrumb\Breadcrumb;

class GameController extends \BaseController {
	public function __construct()
	{
		$this->breadcrumb = new Breadcrumb();
	}
	
	public function showGame()
	{
		return \View::make('pennants.draws.draws');
	}

	/**
	 * @return mixed
	 */

	public function addGame()
	{
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/dashboard/pennants/grade');
		$this->breadcrumb->addBreadcrumb('Game Add', '/dashboard/pennants/game/add');

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.game.create', $data);
	}
}