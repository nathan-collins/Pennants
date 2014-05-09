<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class MatchController extends \BaseController {

	/**
	 * @param $hostId
	 * @return mixed
	 */

	public function showMatch($hostId)
	{
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Match', '/dashboard/pennants/match/'.$hostId);

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'hostId' => $hostId
		]);

		return \View::make('pennants.match.match', $data);
	}

	public function addMatch($hostId)
	{
		JavaScript::put([
			'hostId' => $hostId
		]);

		return \View::make('pennants.match.create');
	}
}