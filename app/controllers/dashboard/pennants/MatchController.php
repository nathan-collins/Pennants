<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;
use Mj\Breadcrumb\Breadcrumb;

class MatchController extends \BaseController {

	public function __construct()
	{
		$this->breadcrumb = new Breadcrumb();
	}

	public function showMatch($hostId)
	{
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/dashboard/pennants/grade');
		$this->breadcrumb->addBreadcrumb('Match', "/dashboard/pennants/match/$hostId");

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate(), //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'hostId' => $hostId
		]);

		return \View::make('pennants.match.match', $data)->with('hostId', $hostId);
	}

	public function addMatch($hostId)
	{
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/dashboard/pennants/grade');
		$this->breadcrumb->addBreadcrumb('Match', "/dashboard/pennants/match/$hostId");

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate(), //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'hostId' => $hostId
		]);

		return \View::make('pennants.match.create', $data)->with('hostId', $hostId);
	}
}