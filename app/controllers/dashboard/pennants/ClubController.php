<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class ClubController extends \BaseController {

	public function showClub($clubId) {
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Club', '/dashboard/pennants/club/'.$clubId);

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.club.container', $data)->with('clubId', $clubId);
	}

	/**
	 * @return mixed
	 */

	public function addClub() {
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Add Club', '/dashboard/pennants/club/add');

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.club.create', $data);
	}

	public function showMatches($clubId) {
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Club Matches', '/dashboard/pennants/club/'.$clubId);

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.club.matches', $data)->with('clubId', $clubId);
	}

	public function showPlayers($clubId) {
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Club Players', '/dashboard/pennants/club/'.$clubId);

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.club.players', $data)->with('clubId', $clubId);
	}
}