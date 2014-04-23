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
		return \View::make('pennants.club.create');
	}
}