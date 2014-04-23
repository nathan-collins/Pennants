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
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Players', '/dashboard/pennants/player/add');

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.player.create', $data);
	}
}