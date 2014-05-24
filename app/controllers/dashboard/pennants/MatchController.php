<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class MatchController extends \BaseController {

	public function showMatch($hostId)
	{
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Match', "/dashboard/pennants/match/$hostId");

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate(), //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'hostId' => $hostId
		]);

		return \View::make('pennants.match.match', $data)->with('hostId', $hostId);
	}

	public function addMatch($hostId)
	{
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Match', "/dashboard/pennants/match/$hostId");

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate(), //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'hostId' => $hostId
		]);

		return \View::make('pennants.match.create', $data)->with('hostId', $hostId);
	}
}